<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use App\Models\PersonalExpense;
use Illuminate\Http\Request;

class PersonalExpenseController extends Controller
{
    public function index()
    {
        $expenses = PersonalExpense::with('instructor')
            ->orderBy('expense_date', 'desc')
            ->paginate(10);

        return view('personal-expenses.index', compact('expenses'));
    }

    public function create()
    {
        $instructors = Instructor::where('status', 'active')->get();
        return view('personal-expenses.create', compact('instructors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'instructor_id' => 'required|exists:instructors,id',
            'expense_date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'type' => 'required|string',
            'description' => 'required|string',
            'invoice_number' => 'nullable|string',
            'supplier' => 'nullable|string',
            'notes' => 'nullable|string'
        ]);

        PersonalExpense::create($validated);

        return redirect()->route('personal-expenses.index')
            ->with('success', 'Dépense ajoutée avec succès.');
    }

    public function show(PersonalExpense $personalExpense)
    {
        return view('personal-expenses.show', compact('personalExpense'));
    }

    public function edit(PersonalExpense $personalExpense)
    {
        $instructors = Instructor::where('status', 'active')->get();
        return view('personal-expenses.edit', compact('personalExpense', 'instructors'));
    }

    public function update(Request $request, PersonalExpense $personalExpense)
    {
        $validated = $request->validate([
            'instructor_id' => 'required|exists:instructors,id',
            'expense_date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'type' => 'required|string',
            'description' => 'required|string',
            'invoice_number' => 'nullable|string',
            'supplier' => 'nullable|string',
            'notes' => 'nullable|string'
        ]);

        $personalExpense->update($validated);

        return redirect()->route('personal-expenses.index')
            ->with('success', 'Dépense mise à jour avec succès.');
    }

    public function destroy(PersonalExpense $personalExpense)
    {
        $personalExpense->delete();

        return redirect()->route('personal-expenses.index')
            ->with('success', 'Dépense supprimée avec succès.');
    }
} 