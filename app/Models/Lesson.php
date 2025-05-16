<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'instructor_id',
        'student_id',
        'vehicle_id',
        'start_time',
        'end_time',
        'type',
        'status',
        'notes'
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class)
            ->withTimestamps();
    }

    public function getEndTimeAttribute()
    {
        return $this->start_time->addMinutes($this->duration);
    }
} 