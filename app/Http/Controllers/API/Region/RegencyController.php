<?php

namespace App\Http\Controllers\API\Region;

use App\Http\Controllers\API\Region\Facades\InitRegion;
use App\Http\Controllers\Controller;
use App\Http\Traits\MessageFixer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RegencyController extends Controller
{
    use MessageFixer;

    public function index(Request $request)
    {
        $apiRegency = Http::get(InitRegion::API_REGION . InitRegion::REGENCY, [
            "id_provinsi" => $request->province_id
        ])->json();

        return $this->customMessage("SUCCESS", "data kota berhasil diambil", JsonResponse::HTTP_OK, $apiRegency['kota_kabupaten']);
    }

    public function show($id)
    {
        $apiRegency = Http::get(InitRegion::API_REGION . InitRegion::REGENCY . $id)->json();

        return $this->customMessage("SUCCESS", "data kota berhasil diambil", JsonResponse::HTTP_OK, $apiRegency);
    }
}
