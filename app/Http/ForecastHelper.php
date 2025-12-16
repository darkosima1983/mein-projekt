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
public static function weatherIcon(string $type): string
    {
        return match ($type) {
            'sonnig'     => 'fa-solid fa-sun text-warning',
            'regnerisch' => 'fa-solid fa-cloud-rain text-primary',
            'bewölkt'    => 'fa-solid fa-cloud text-secondary',
            'schneit'    => 'fa-solid fa-snowflake text-info',
            default      => 'fa-solid fa-question',
        };
}
}