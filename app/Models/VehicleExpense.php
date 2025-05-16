<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleExpense extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'expense_date',
        'amount',
        'type',
        'description',
        'invoice_number',
        'supplier',
        'notes'
    ];

    protected $casts = [
        'expense_date' => 'date',
        'amount' => 'decimal:2'
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
} 