<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funding extends Model
{
    use HasFactory;

    protected $fillable = [
        'fund_required',
        'start_date',
        'end_date',
        'customer_id',
        'customerName',
        'customerOrder',
        'description',
        'status',
        'company_registration_number',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
}