<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function getDistrict()
    {
        $district = District::with(['villages'])->get();
        return response()->json($district);
    }
}
