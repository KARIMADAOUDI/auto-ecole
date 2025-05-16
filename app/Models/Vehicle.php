<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'model',
        'year',
        'license_plate',
        'color',
        'status',
        'last_maintenance_date',
        'next_maintenance_date',
        'notes'
    ];

    protected $casts = [
        'year' => 'integer',
        'last_maintenance_date' => 'date',
        'next_maintenance_date' => 'date'
    ];

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function expenses()
    {
        return $this->hasMany(VehicleExpense::class);
    }

    public function getFullNameAttribute()
    {
        return "{$this->brand} {$this->model} ({$this->registration_number})";
    }
} 