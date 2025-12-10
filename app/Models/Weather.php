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
        return $this->belongsTo(CitiesModel::class, 'city_id', 'id');
    }
    
}
