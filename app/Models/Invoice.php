<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'investment_id',
    ];

    /**
     * Get the investment associated with the invoice.
     */
    public function investment()
    {
        return $this->belongsTo(Investment::class);
    }

    
}
