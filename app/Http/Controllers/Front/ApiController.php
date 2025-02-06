<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    public function getProvinces()
    {
        // Cache các tỉnh trong 60 phút
        $provinces = Cache::remember('provinces', 60, function () {
            $response = Http::withOptions(['verify' => false])->get("https://esgoo.net/api-tinhthanh/1/0.htm");
            return $response->json();
        });
        return $provinces;
    }

    public function getDistricts($provinceId)
    {
        // Cache các huyện theo tỉnh trong 60 phút
        $cacheKey = 'districts_' . $provinceId;
        $districts = Cache::remember($cacheKey, 60, function () use ($provinceId) {
            $response = Http::withOptions(['verify' => false])
                ->get("https://esgoo.net/api-tinhthanh/2/{$provinceId}.htm");
            return $response->json();
        });
        return $districts;
    }

    public function getWards($districtId)
    {
        // Cache các xã theo huyện trong 60 phút
        $cacheKey = 'wards_' . $districtId;
        $wards = Cache::remember($cacheKey, 60, function () use ($districtId) {
            $response = Http::withOptions(['verify' => false])
                ->get("https://esgoo.net/api-tinhthanh/3/{$districtId}.htm");
            return $response->json();
        });
        return $wards;
    }
}
