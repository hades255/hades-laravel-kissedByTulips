<?php

namespace App\Http\Controllers;

use App\Cities;
use App\County;
use App\State;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function locationWeServe()
    {
        $dataRows = County::with('cities')->get();

        return view('location-we-serve', ['dataRows' => $dataRows]);
    }
}
