<?php

namespace App\Http\Controllers\API\Region;

use App\Http\Controllers\API\Region\Facades\InitRegion;
use App\Http\Controllers\Controller;
use App\Http\Traits\MessageFixer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DistrictController extends Controller
{
    use MessageFixer;

    public function index(Request $request)
    {
        $apiDistrict = Http::get(InitRegion::API_REGION . InitRegion::DISTRICT, [
            "id_kota" => $request->regency_id
        ])->json();

        return $this->customMessage("SUCCESS", "data kecamatan berhasil diambil", JsonResponse::HTTP_OK, $apiDistrict['kecamatan']);
    }

    public function show($id)
    {
        $apiDistrict = Http::get(InitRegion::API_REGION . InitRegion::DISTRICT . $id)->json();

        return $this->customMessage("SUCCESS", "data kecamatan berhasil diambil", JsonResponse::HTTP_OK, $apiDistrict);
    }
}
