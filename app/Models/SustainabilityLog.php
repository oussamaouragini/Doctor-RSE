<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SustainabilityLog extends Model
{
    protected $fillable = [
        'user_id', 'action', 'co2_saved', 'points'
    ];
    use HasFactory;
}
