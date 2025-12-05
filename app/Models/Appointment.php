<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'user_id', 'doctor_id', 'date', 'time', 'status', 'is_remote'
    ];

    protected $casts = [
        'date' => 'date',
        'is_remote' => 'boolean',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function doctor() {
        return $this->belongsTo(Doctor::class);
    }
    use HasFactory;
}
