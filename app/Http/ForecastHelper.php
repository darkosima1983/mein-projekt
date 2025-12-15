<?php   
namespace App\Http;    

class ForecastHelper   
{

public static function getColorByTemperature($temperature)   
{   
    if ($temperature <= 0) {   
        $color = 'blue';   
    } elseif ($temperature > 0 && $temperature <= 15) {   
        $color = 'lightblue';   
    } elseif ($temperature > 15 && $temperature <= 25) {   
        $color = 'orange';   
    } else {   
        $color = 'red';   
    }   
    return $color;
}
}