<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Enregistrement automatique des composants Livewire
        Livewire::component('dashboard.stats-overview', \App\Livewire\Dashboard\StatsOverview::class);
        Livewire::component('dashboard.lessons-chart', \App\Livewire\Dashboard\LessonsChart::class);
        Livewire::component('dashboard.financial-chart', \App\Livewire\Dashboard\FinancialChart::class);
        Livewire::component('dashboard.lessons-calendar', \App\Livewire\Dashboard\LessonsCalendar::class);
    }
}
