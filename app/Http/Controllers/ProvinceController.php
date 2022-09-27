<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    public function getProvince()
    {
        $province = Province::with(['districts'])->get();
        return response()->json($province);
    }
}
