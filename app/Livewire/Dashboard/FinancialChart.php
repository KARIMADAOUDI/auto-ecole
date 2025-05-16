<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Payment;
use App\Models\VehicleExpense;
use App\Models\PersonalExpense;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class FinancialChart extends Component
{
    public $monthlyRevenue = [];
    public $monthlyExpenses = [];
    public $monthlyProfit = [];

    public function mount()
    {
        $this->loadFinancialData();
    }

    public function loadFinancialData()
    {
        $this->monthlyRevenue = Payment::select(
            DB::raw('MONTH(payment_date) as month'),
            DB::raw('YEAR(payment_date) as year'),
            DB::raw('SUM(amount) as total')
        )
        ->whereYear('payment_date', now()->year)
        ->groupBy('year', 'month')
        ->orderBy('year')
        ->orderBy('month')
        ->get()
        ->toArray();

        $this->monthlyExpenses = VehicleExpense::select(
            DB::raw('MONTH(expense_date) as month'),
            DB::raw('YEAR(expense_date) as year'),
            DB::raw('SUM(amount) as total')
        )
        ->whereYear('expense_date', now()->year)
        ->groupBy('year', 'month')
        ->orderBy('year')
        ->orderBy('month')
        ->get()
        ->merge(
            PersonalExpense::select(
                DB::raw('MONTH(expense_date) as month'),
                DB::raw('YEAR(expense_date) as year'),
                DB::raw('SUM(amount) as total')
            )
            ->whereYear('expense_date', now()->year)
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get()
        )
        ->toArray();

        $this->monthlyProfit = $this->calculateMonthlyProfit();
    }

    private function calculateMonthlyProfit()
    {
        $profit = [];
        for ($i = 1; $i <= 12; $i++) {
            $revenue = collect($this->monthlyRevenue)->where('month', $i)->sum('total');
            $expenses = collect($this->monthlyExpenses)->where('month', $i)->sum('total');
            $profit[] = [
                'month' => $i,
                'year' => now()->year,
                'total' => $revenue - $expenses
            ];
        }
        return $profit;
    }

    public function render()
    {
        return view('livewire.dashboard.financial-chart');
    }
} 