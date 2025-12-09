<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    use HasFactory;
    protected $table = 'weathers'; 
    protected $fillable = [
        'city_id',
        'temperature',
        'description',
        
    ];
    public function city()
    {
        return $this->hasOne(CitiesModel::class, 'id', 'city_id');
    }
    
}
