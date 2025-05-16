<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleExpense;
use Illuminate\Http\Request;

class VehicleExpenseController extends Controller
{
    public function index()
    {
        $expenses = VehicleExpense::with('vehicle')
            ->orderBy('expense_date', 'desc')
            ->paginate(10);

        return view('vehicle-expenses.index', compact('expenses'));
    }

    public function create()
    {
        $vehicles = Vehicle::where('status', 'active')->get();
        return view('vehicle-expenses.create', compact('vehicles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'expense_date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'type' => 'required|string',
            'description' => 'required|string',
            'invoice_number' => 'nullable|string',
            'supplier' => 'nullable|string',
            'notes' => 'nullable|string'
        ]);

        VehicleExpense::create($validated);

        return redirect()->route('vehicle-expenses.index')
            ->with('success', 'Dépense ajoutée avec succès.');
    }

    public function show(VehicleExpense $vehicleExpense)
    {
        return view('vehicle-expenses.show', compact('vehicleExpense'));
    }

    public function edit(VehicleExpense $vehicleExpense)
    {
        $vehicles = Vehicle::where('status', 'active')->get();
        return view('vehicle-expenses.edit', compact('vehicleExpense', 'vehicles'));
    }

    public function update(Request $request, VehicleExpense $vehicleExpense)
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'expense_date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'type' => 'required|string',
            'description' => 'required|string',
            'invoice_number' => 'nullable|string',
            'supplier' => 'nullable|string',
            'notes' => 'nullable|string'
        ]);

        $vehicleExpense->update($validated);

        return redirect()->route('vehicle-expenses.index')
            ->with('success', 'Dépense mise à jour avec succès.');
    }

    public function destroy(VehicleExpense $vehicleExpense)
    {
        $vehicleExpense->delete();

        return redirect()->route('vehicle-expenses.index')
            ->with('success', 'Dépense supprimée avec succès.');
    }
} 