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
            
        'city'=> "required|string|min:3|unique:weathers,city",
        'temperature'=> "required|string|min:1",
        'description'=> "nullable|string",
         ]);
     
       Weather::create([
           "city"=> $request->get("city"),
           "temperature"=> $request->get("temperature"),
           "description"=> $request->get("description"),

       ]);

       return redirect ()->route("welcome"); 

    }
}
