<?php

namespace App\Http\Controllers\API\Region;

use App\Http\Controllers\API\Region\Facades\InitRegion;
use App\Http\Controllers\Controller;
use App\Http\Traits\MessageFixer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProvinceController extends Controller
{
    use MessageFixer;

    public function index()
    {
        $apiProvince = Http::get(InitRegion::API_REGION . InitRegion::PROVINCE)->json();

        return $this->customMessage("SUCCESS", "data provinsi berhasil diambil", JsonResponse::HTTP_OK, $apiProvince["provinsi"]);
    }

    public function show($id)
    {
        $apiProvince = Http::get(InitRegion::API_REGION . InitRegion::PROVINCE . $id)->json();

        return $this->customMessage("SUCCESS", "data provinsi berhasil diambil", JsonResponse::HTTP_OK, $apiProvince);
    }
}
