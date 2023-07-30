<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Filters\Store\Search;
use App\Http\Filters\Store\ShowUser;
use App\Http\Requests\API\Store\StoreCreateRequest;
use App\Http\Resources\Store\StoreCollection;
use App\Http\Resources\Store\StoreDetail;
use App\Http\Traits\MessageFixer;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    use MessageFixer;

    protected $store;

    public function __construct(Store $store)
    {
        $this->store = $store;
    }

    public function index(Request $request)
    {
        $stores = app(Pipeline::class)
            ->send($this->store->query())
            ->through([
                Search::class,
                ShowUser::class
            ])
            ->thenReturn()
            ->paginate($request->per_page);

        return new StoreCollection($stores);
    }

    public function store(StoreCreateRequest $request)
    {
        DB::beginTransaction();

        if (auth()->user()->role_id == User::MEMBER) {
            $request->merge([
                "user_id" => auth()->user()->id,
                "slug" => Str::slug($request->name),
            ]);
        }

        try {
            if ($request->hasFile('document_logo')) {
                $request->merge([
                    "logo" => $request->file('document_logo')->store('logo_member')
                ]);
            }

            $store = $this->store->create($request->all());

            DB::commit();
            return $this->successMessage("toko berhasil terdaftar", $store);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->errorMessage($th->getMessage());
        }
    }

    public function show(Request $request, $id)
    {
        $store = $this->store->find($id);
        if (!$store) {
            return $this->warningMessage("data toko tidak ditemukan.");
        }

        if ($request->has('user')) {
            $store->load("user");
        }

        return new StoreDetail($store);
    }

    public function update(StoreCreateRequest $request, $id)
    {
        DB::beginTransaction();

        $store = $this->store->find($id);
        if (!$store) {
            return $this->warningMessage("data toko tidak ditemukan.");
        }

        $request->merge([
            "slug" => Str::slug($request->name)
        ]);

        try {
            if ($request->hasFile('document_logo')) {
                $request->merge([
                    "logo" => $request->file('document_logo')->store('logo_member')
                ]);
            }

            $store->update($request->all());

            DB::commit();
            return $this->successMessage("data toko berhasil diperbaharui", $store);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->errorMessage($th->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        $store = $this->store->find($id);
        if (!$store) {
            return $this->warningMessage("data toko tidak ditemukan.");
        }

        try {
            if ($store->logo) {
                $path = str_replace(url('storage') . '/', '', $store->logo);
                Storage::delete($path);
            }

            if ($store->products) {
                foreach ($store->products as $product) {
                    $path = str_replace(url('storage') . '/', '', $product->image);
                    Storage::delete($path);
                }
            }

            $store->delete();

            DB::commit();
            return $this->successMessage("data toko berhasil dihapus", $store);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->errorMessage($th->getMessage());
        }
    }
}
