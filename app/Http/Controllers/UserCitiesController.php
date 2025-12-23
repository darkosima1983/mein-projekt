<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserCities;
class UserCitiesController extends Controller
{
   public function favorite(Request $request, $city)
    {
        $user = Auth::user();
        if ((!$user)) 
        {
            return redirect()->back()->with('error', 'Bitte melden Sie sich an, um Städte zu Ihren Favoriten hinzuzufügen.');
        }
        $fav = UserCities::where('city_id', $city)
            ->where('user_id', $user->id)
            ->first();

        if ($fav) {
            $fav->delete();
            return redirect()->back()->with('success', 'Stadt aus Favoriten entfernt.');
        }
       UserCities::firstOrCreate([
            'city_id' => $city,
            'user_id' => $user->id,
        ]);

        return redirect()->back();
    }
}