<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Weather;

class HomePageController extends Controller
{
    public function index()
    {
        date_default_timezone_set("Europe/Berlin");

        $trenutnoVreme = date("H:i:s");
        $trenutniSat = date("H");

        $weathers = Weather::orderBy('created_at', 'desc')->take(5)->get();

        return view("home", compact("trenutnoVreme", "trenutniSat", "weathers"));
    }
}
