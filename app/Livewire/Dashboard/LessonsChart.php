<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Lesson;
use Illuminate\Support\Facades\DB;

class LessonsChart extends Component
{
    public $lessonsByType = [];
    public $lessonsByStatus = [];

    public function mount()
    {
        $this->loadLessonsData();
    }

    public function loadLessonsData()
    {
        $this->lessonsByType = Lesson::select('type', DB::raw('count(*) as total'))
            ->groupBy('type')
            ->get()
            ->toArray();

        $this->lessonsByStatus = Lesson::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get()
            ->toArray();
    }

    public function render()
    {
        return view('livewire.dashboard.lessons-chart');
    }
} 