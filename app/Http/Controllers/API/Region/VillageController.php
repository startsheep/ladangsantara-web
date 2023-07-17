<?php

namespace App\Http\Controllers\API\Region;

use App\Http\Controllers\API\Region\Facades\InitRegion;
use App\Http\Controllers\Controller;
use App\Http\Traits\MessageFixer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class VillageController extends Controller
{
    use MessageFixer;

    public function index(Request $request)
    {
        $apiVillage = Http::get(InitRegion::API_REGION . InitRegion::VILLAGE, [
            "id_kecamatan" => $request->district_id
        ])->json();

        return $this->customMessage("SUCCESS", "data kecamatan berhasil diambil", JsonResponse::HTTP_OK, $apiVillage['kelurahan']);
    }

    public function show($id)
    {
        $apiVillage = Http::get(InitRegion::API_REGION . InitRegion::VILLAGE . $id)->json();

        return $this->customMessage("SUCCESS", "data kecamatan berhasil diambil", JsonResponse::HTTP_OK, $apiVillage);
    }
}
