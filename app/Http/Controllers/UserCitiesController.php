<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserCities;
use App\Models\CitiesModel;
class UserCitiesController extends Controller
{
   public function favorite(CitiesModel $city)
{
    $user = Auth::user();

    $fav = UserCities::firstWhere([
        'city_id' => $city->id,
        'user_id' => $user->id,
    ]);

    if ($fav) {
        $fav->delete();
        return back()->with('success', 'Stadt aus Favoriten entfernt.');
    }

    UserCities::create([
        'city_id' => $city->id,
        'user_id' => $user->id,
    ]);

    return back()->with('success', 'Stadt zu Favoriten hinzugefügt.');
}

    public function unfavorite($city)
    {
        $user = Auth::user();
        if ((!$user)) 
        {
            return redirect()->back()->with('error', 'Bitte melden Sie sich an, um Städte zu Ihren Favoriten hinzuzufügen.');
        }
       $userFavorite = UserCities::where([
            'city_id' => $city,
            'user_id' => $user->id,
        ])->first();

        if (!$userFavorite) {
        return redirect()->back()->with(
            'error',
            'Diese Stadt ist nicht in Ihren Favoriten.'
        );
        }
            $userFavorite->delete();
            return redirect()->back()->with('success', 'Stadt aus Favoriten entfernt.');
        

        return redirect()->back();
           
    }
}