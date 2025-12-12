<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ForecastsModel;
class CitiesModel extends Model
{
    protected $table = "cities";

    protected $fillable = ["name"];

    public function forecasts()
    {
        return $this->hasMany(ForecastsModel::class, 'city_id', 'id');
    }
}
