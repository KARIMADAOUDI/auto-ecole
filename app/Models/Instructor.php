<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'birth_date',
        'address',
        'city',
        'postal_code',
        'license_number',
        'is_active',
        
        'status',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'is_active' => 'boolean',

    ];

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function expenses()
    {
        return $this->hasMany(PersonalExpense::class);
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
} 