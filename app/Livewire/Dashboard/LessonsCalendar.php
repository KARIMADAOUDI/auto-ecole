<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Lesson;
use Carbon\Carbon;

class LessonsCalendar extends Component
{
    public $currentMonth;
    public $currentYear;
    public $lessons = [];

    public function mount()
    {
        $this->currentMonth = now()->month;
        $this->currentYear = now()->year;
        $this->loadLessons();
    }

    public function loadLessons()
    {
        $lessons = Lesson::with(['student', 'instructor', 'vehicle'])
            ->whereMonth('start_time', $this->currentMonth)
            ->whereYear('start_time', $this->currentYear)
            ->get();

        $this->lessons = $lessons->groupBy(function($lesson) {
            return Carbon::parse($lesson->start_time)->format('Y-m-d');
        })->toArray();
    }

    public function previousMonth()
    {
        $date = Carbon::create($this->currentYear, $this->currentMonth, 1)->subMonth();
        $this->currentMonth = $date->month;
        $this->currentYear = $date->year;
        $this->loadLessons();
    }

    public function nextMonth()
    {
        $date = Carbon::create($this->currentYear, $this->currentMonth, 1)->addMonth();
        $this->currentMonth = $date->month;
        $this->currentYear = $date->year;
        $this->loadLessons();
    }

    public function render()
    {
        return view('livewire.dashboard.lessons-calendar');
    }
} 