<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Product\ProductCreateRequest;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Traits\MessageFixer;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    use MessageFixer;

    protected $product, $store;

    public function __construct(Product $product, Store $store)
    {
        $this->product = $product;
        $this->store = $store;
    }

    public function index(Request $request)
    {
        $products = app(Pipeline::class)
            ->send($this->product->query())
            ->through([])
            ->thenReturn()
            ->paginate($request->per_page);

        return new ProductCollection($products);
    }

    public function store(ProductCreateRequest $request)
    {
        DB::beginTransaction();

        $request->merge([
            'slug' => Str::slug($request->name) . '-' . Str::random(6)
        ]);

        $store = $this->store->where('user_id', auth()->user()->id)->first();
        if (!$store) {
            return $this->customMessage('WARNING', ['store' => ['anda belum terdaftar sebagai penjual']], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $request->merge([
                'image' => $request->file('image_product')->store('product')
            ]);

            $product = $store->products()->create($request->all());

            DB::commit();
            return $this->successMessage("produk berhasil terdaftar", $product);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->errorMessage($th->getMessage());
        }
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
