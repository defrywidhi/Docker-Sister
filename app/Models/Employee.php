<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employer';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'name',
        'email',
        'alamat',
        'jabatan',
        'Departement',
        'Gaji',
        'created_at',
        'updated_at',
    ];
}
