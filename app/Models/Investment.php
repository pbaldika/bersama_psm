<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    use HasFactory;

    protected $fillable = [
        'total',
        'profit',
        'status',
        'payment_proof',
        'user_id',
        'project_id',
    ];

    protected $dates = [
        'payment_deadline',
    ];
}
