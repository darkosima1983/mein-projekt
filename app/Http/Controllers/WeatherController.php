<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Weather; 
use App\Models\CitiesModel;
class WeatherController extends Controller
{
    public function getAllWeathers()
    {
        $weathers = Weather::with('city')->get();
        return view('admin/all-cities', compact('weathers'));
    }

    public function index()
    {
        $cities = CitiesModel::all();
        return view("admin/add-city", compact('cities'));
    }


     public function store(Request $request){
        $request->validate([
            
        'city_id' => "required|exists:cities,id",
        'temperature'=> "required|string|min:1",
        'description'=> "nullable|string",
         ]);
     
       Weather::create([
           "city_id"=> $request->get("city_id"),
           "temperature"=> $request->get("temperature"),
           "description"=> $request->get("description"),

       ]);

       return redirect ()->route("all-cities"); 

    }
    public function edit($weather)
    {
        $singleWeather = Weather::with('city')->find($weather);
        if (!$singleWeather){
            abort(404, "Diese Stadt existiert nicht.");

        }
        $cities = CitiesModel::all();
        return view('admin.edit-city', compact('singleWeather', 'cities'));
    }
    public function update(Request $request, Weather $weather)
        {
            $request->validate([
                'city_id' => 'required|exists:cities,id',
                'temperature' => 'required|string|min:1',
                'description' => 'nullable|string',
            ]);

            $weather->update($request->only([
                'city_id',
                'temperature',
                'description'
            ]));

            return redirect()->route('all-cities');
        }

    public function destroy($weather)
        {
            $singleWeather = Weather::with('city')->find($weather);
            if (!$singleWeather){
                abort(404, "Diese Stadt existiert nicht.");

            }
            $singleWeather->delete();
            return redirect()->back();
        }
}
