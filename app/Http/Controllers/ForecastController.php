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
            'probability'   => 'nullable|integer|min:0|max:100',
        ]);

        ForecastsModel::create($request->all());

        return redirect()->back()->with('success', 'Forecast erfolgreich hinzugefügt.');
    }

}
