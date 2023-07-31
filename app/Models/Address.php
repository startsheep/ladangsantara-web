<?php

namespace App\Models;

use App\Http\Controllers\API\Region\Facades\InitRegion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Http;

class Address extends Model
{
    use HasFactory;

    const ACTIVE = 1;

    protected $fillable = [
        "user_id",
        "contact_name",
        "contact_phone",
        "province_id",
        "regency_id",
        "district_id",
        "village_id",
        "address",
        "is_default",
    ];

    public function getProvinceAttribute()
    {
        $apiProvince = Http::get(InitRegion::API_REGION . InitRegion::PROVINCE . $this->attributes["province_id"])->json();

        return $apiProvince;
    }

    public function getRegencyAttribute()
    {
        $apiRegency = Http::get(InitRegion::API_REGION . InitRegion::REGENCY . $this->attributes["regency_id"])->json();

        return $apiRegency;
    }

    public function getDistrictAttribute()
    {
        $apiDistrict = Http::get(InitRegion::API_REGION . InitRegion::DISTRICT . $this->attributes["district_id"])->json();

        return $apiDistrict;
    }

    public function getVillageAttribute()
    {
        $apiVillage = Http::get(InitRegion::API_REGION . InitRegion::VILLAGE . $this->attributes["village_id"])->json();

        return $apiVillage;
    }

    public function getMyAddressAttribute()
    {
        return $this->attributes["address"];
    }

    public function scopeIsActive(Builder $query)
    {
        return  $query->where("is_default", self::ACTIVE);
    }
}
