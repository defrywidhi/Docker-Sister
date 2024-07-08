<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantLocation extends Model
{
    use HasFactory;
    protected $table = 'plant_locations';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'location_name',
        'latitude',
        'longitude',
        'created_at',
        'updated_at'
    ];

     // Relasi dengan Plantys
     public function plants()
     {
         return $this->hasMany(Plantys::class, 'location_id');
     }
}
