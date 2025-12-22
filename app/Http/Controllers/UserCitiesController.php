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
        UserCities::create([
            'city_id' => $city,
            'user_id' => $user->id
        ]);
        return redirect()->back();
    }
}