<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Plantys extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = 'plants';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'name',
        'description',
        'scientific_name',
        // 'location',
        'habitat',
        'category_id',
        'location_id',
        'image',
        'created_at',
        'updated_at'
    ];
    public function category()
    {
        return $this->belongsTo(PlantCategory::class, 'category_id');
    }

    public function location()
    {
        return $this->belongsTo(PlantLocation::class, 'location_id');
    }

}
