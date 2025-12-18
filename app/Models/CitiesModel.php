<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ForecastsModel;
use Carbon\Carbon;
class CitiesModel extends Model
{
    protected $table = "cities";

    protected $fillable = ["name"];

    public function forecasts()
    {
        return $this->hasMany(ForecastsModel::class, 'city_id', 'id')
        ->orderBy('forecast_date');
    }
    public function todaysForecast()
    {
        return $this->hasOne(ForecastsModel::class, 'city_id', 'id')
        ->whereDate('forecast_date', Carbon::today());
    }
}
