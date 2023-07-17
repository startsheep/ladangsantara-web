<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Address\AddressCreateRequest;
use App\Http\Traits\MessageFixer;
use App\Models\Address;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\type;

class AddressController extends Controller
{
    use MessageFixer;

    protected $address;

    public function __construct(Address $address)
    {
        $this->address = $address;
    }

    public function index()
    {
        $data = [];

        $addresses = $this->address->where('user_id', auth()->user()->id)->get();

        foreach ($addresses as $address) {
            $address->province = $address->province;
            $address->regency = $address->regency;
            $address->district = $address->district;
            $address->village = $address->village;
            $data[] = $address;
        }

        return $this->customMessage('SUCCESS', 'data alamat berhasil diambil', JsonResponse::HTTP_OK, $data);
    }

    public function store(AddressCreateRequest $request)
    {
        DB::beginTransaction();

        $request->merge([
            "user_id" => auth()->user()->id
        ]);

        try {
            if ($request->is_default) {
                $this->address->where('user_id', auth()->user()->id)->update([
                    "is_default" => 0
                ]);
            }

            $address = $this->address->create($request->all());

            DB::commit();
            return $this->successMessage("alamat berhasil ditambahkan", $address);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->errorMessage($th->getMessage());
        }
    }

    public function show($id)
    {
        $address = $this->address->find($id);

        if (!$address) {
            return $this->warningMessage("data alamat tidak ditemukan.");
        }

        $address->province = $address->province;
        $address->regency = $address->regency;
        $address->district = $address->district;
        $address->village = $address->village;

        return $this->customMessage('SUCCESS', 'data alamat berhasil diambil', JsonResponse::HTTP_OK, $address);
    }

    public function update(AddressCreateRequest $request, $id)
    {
        DB::beginTransaction();

        $address = $this->address->find($id);

        if (!$address) {
            return $this->warningMessage("data alamat tidak ditemukan.");
        }

        try {
            if ($request->is_default) {
                $this->address->where('user_id', auth()->user()->id)->update([
                    "is_default" => 0
                ]);
            }

            $address->update($request->all());

            DB::commit();
            return $this->successMessage("alamat berhasil diperbaharui", $address);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->errorMessage($th->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        $address = $this->address->find($id);

        if (!$address) {
            return $this->warningMessage("data alamat tidak ditemukan.");
        }

        try {
            $address->delete();

            $this->address->where('user_id', auth()->user()->id)
                ->first()
                ->update([
                    "is_default" => 1
                ]);

            DB::commit();
            return $this->successMessage("alamat berhasil dihapus", $address);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->errorMessage($th->getMessage());
        }
    }
}
