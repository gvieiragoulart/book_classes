<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'class_id',
        'name',
        'date'
    ];

    public $incrementing = false;

    protected $casts = [
        'date' => 'datetime',
    ];
}
