<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CitiesModel;
use App\Models\ForecastsModel ;
class ForecastController extends Controller
{
    public function index(CitiesModel $city)
    {
        
       $weathers = ForecastsModel::where(['city_id'=> $city->id])->get();
        return view('forecasts', compact('weathers'));
    }
}
