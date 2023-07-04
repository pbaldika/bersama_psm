<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'required_capital',
        'current_capital',
        'progress_status',
        'project_photo',
        'company_id',
        'profit_margin_bersama',
        'profit_margin_investor',
        'profit',
    ];
}
