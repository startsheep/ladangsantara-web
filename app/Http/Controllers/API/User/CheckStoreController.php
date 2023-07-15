<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Http\Traits\MessageFixer;
use App\Models\Store;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CheckStoreController extends Controller
{
    use MessageFixer;

    protected $store;

    public function __construct(Store $store)
    {
        $this->store = $store;
    }

    public function __invoke(Request $request)
    {
        $store = $this->store->where('user_id', auth()->user()->id)->first();

        if (!$store) {
            return $this->customMessage(
                "WARNING",
                "anda belum terdaftar sebagai penjual",
                JsonResponse::HTTP_BAD_REQUEST,
            );
        }

        return $this->customMessage(
            "SUCCESS",
            "anda sudah terdaftar sebagai penjual",
            JsonResponse::HTTP_OK,
        );
    }
}
