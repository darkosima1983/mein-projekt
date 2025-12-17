<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CitiesModel;
use Carbon\Carbon;
class HomePageController extends Controller
{
    
   public function index()
{
    
    $now = Carbon::now(); 

    return view('home', compact('now'));
}

    
    public function search(Request $request)
    {
        $cityName = $request->get('city');
        $cities = CitiesModel::where('name', 'LIKE', "%$cityName%")->get();

        if (count($cities) === 0) {
            return redirect()->back()->with('error', 'Keine Städte gefunden.');
        }
        return view('search_results', compact('cities', 'cityName'));
    }
}
