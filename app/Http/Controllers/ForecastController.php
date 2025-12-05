<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForecastController extends Controller
{
    public function index($city)
    {
        
        $forecast = [
            "bamberg"=>[5, 8, 12, 11, 7],
            "coburg"=>[4, 7, 6, 11, 10],
        ];
        $city = strtolower($city);
        if(!array_key_exists($city, $forecast))
        {
            die("Die Stadt nicht Exsistiert");
        }
    }
}
