<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CitiesModel;
use App\Models\ForecastsModel ;
class ForecastController extends Controller
{
    public function index(CitiesModel $city)
    {
        
        return view('forecasts', compact('city'));
    }
    public function show()

    {
        $cities = CitiesModel::with('forecasts')->get(); 

        return view('admin/forecast', compact('cities'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'city_id' => 'required|exists:cities,id',
            'forecast_date' => 'required|date',
            'temperature' => 'required|numeric',
            'weather_type' => 'required|in:' . implode(',', ForecastsModel::WEATHERS),
        ]);

        ForecastsModel::create([
            'city_id' => $request->city_id,
            'forecast_date' => $request->forecast_date,
            'temperature' => $request->temperature,
            'weather_type' => $request->weather_type,
        ]);

        return redirect()->back()->with('success', 'Forecast erfolgreich hinzugefügt.');
    }

}
