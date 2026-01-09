<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CitiesModel;
use App\Models\ForecastsModel ;
use Illuminate\Support\Facades\Http;
class ForecastController extends Controller
{
    public function index(CitiesModel $city)
    {
          $response = Http::get(env('WEATHER_API_ASTRONOMY_URL'), [
            'key'  => env('WEATHER_API_KEY'),
            'q'    => $city->name,
            'aqi'  => 'no',
            
        ]);
        $astronomyData = $response->json();
        $sunrise = $astronomyData['astronomy']['astro']['sunrise'] ?? 'N/A';
        $sunset = $astronomyData['astronomy']['astro']['sunset'] ?? 'N/A';
        return view('forecast_show', compact('city', 'sunrise', 'sunset'));
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
