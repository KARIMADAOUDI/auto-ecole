<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Student;
use App\Models\Instructor;
use App\Models\Lesson;
use App\Models\Payment;
use App\Models\VehicleExpense;
use App\Models\PersonalExpense;

class StatsOverview extends Component
{
    public $totalStudents = 0;
    public $totalInstructors = 0;
    public $totalLessons = 0;
    public $totalRevenue = 0;
    public $totalExpenses = 0;
    public $totalProfit = 0;

    public function mount()
    {
        $this->loadStats();
    }

    public function loadStats()
    {
        $this->totalStudents = Student::count();
        $this->totalInstructors = Instructor::count();
        $this->totalLessons = Lesson::count();
        
        $this->totalRevenue = Payment::sum('amount');
        $this->totalExpenses = VehicleExpense::sum('amount') + PersonalExpense::sum('amount');
        $this->totalProfit = $this->totalRevenue - $this->totalExpenses;
    }

    public function render()
    {
        return view('livewire.dashboard.stats-overview');
    }
} 