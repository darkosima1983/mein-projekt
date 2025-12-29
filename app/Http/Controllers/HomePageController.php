<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CitiesModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\UserCities;
class HomePageController extends Controller
{
    
public function index()
{
    $now = Carbon::now();

    $userFavorites = collect(); // uvek kolekcija

    if (Auth::check()) {
        $userFavorites = UserCities::with('city.todaysForecast')
            ->where('user_id', Auth::id())
            ->get();
    }

    return view('home', compact('now', 'userFavorites'));
}


    
    public function search(Request $request)
    {
        $cityName = $request->get('city');
        $cities = CitiesModel::with('todaysForecast')->where('name', 'LIKE', "%$cityName%")->get();

        if (count($cities) === 0) {
            return redirect()->back()->with('error', 'Keine Städte gefunden.');
        }
        $userFavorites = [];
        if(Auth::check())
        {
        $userFavorites = Auth::user()->cityFavorites;
        $userFavorites = $userFavorites->pluck('city_id')->toArray();
        }

        return view('search_results', compact('cities', 'cityName', 'userFavorites'));
    }

}
