<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Weather; 

class WeatherController extends Controller
{
    public function getAllWeathers()
    {
        $weathers = Weather::all(); 
        return view('admin/all-cities', compact('weathers'));
    }
    public function index()
    {
        return view("admin/add-city");
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
        $singleWeather = Weather::find($weather);
        if (!$singleWeather){
            abort(404, "Diese Stadt existiert nicht.");

        }
        return view('admin.edit-city', compact('singleWeather'));
    }
    public function update(Request $request, $weather)
    {
        $singleWeather = Weather::find($weather);
        if (!$singleWeather){
            abort(404, "Diese Stadt existiert nicht.");

        }
        $request->validate([
            'city_id'=> "required|exists:cities,id",
            'temperature'=> "required|string|min:1",
            'description'=> "nullable|string",
         ]);
        
         $singleWeather ->update([
           "city_id"=> $request->city_id,
           "temperature"=> $request->get("temperature"),
           "description"=> $request->get("description"),
        ]);

        return redirect()->route('all-cities');
    }
    public function destroy($weather)
    {
        $singleWeather = Weather::find($weather);
        if (!$singleWeather){
            abort(404, "Diese Stadt existiert nicht.");

        }
        $singleWeather->delete();
        return redirect()->back();
    }
}
