<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'name', 'speciality', 'specialty', 'email', 'phone', 'bio',
        'address', 'is_eco_friendly', 'is_local_business', 'is_accessible', 'rse_score'
    ];
    use HasFactory;
}
