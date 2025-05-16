<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    public function index()
    {
        $instructors = Instructor::latest()->paginate(10);
        return view('instructors.index', compact('instructors'));
    }

    public function create()
    {
        return view('instructors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:instructors',
            'phone' => 'required|string|max:20',
            'license_number' => 'required|string|unique:instructors',
            'license_expiry_date' => 'required|date|after:today',
        ]);

        Instructor::create($validated);

        return redirect()->route('instructors.index')
            ->with('success', 'Moniteur créé avec succès.');
    }

    public function show(Instructor $instructor)
    {
        return view('instructors.show', compact('instructor'));
    }

    public function edit(Instructor $instructor)
    {
        return view('instructors.edit', compact('instructor'));
    }

    public function update(Request $request, Instructor $instructor)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:instructors,email,' . $instructor->id,
            'phone' => 'required|string|max:20',
            'license_number' => 'required|string|unique:instructors,license_number,' . $instructor->id,
            'status' => 'required|in:active,inactive,on_leave',
        ]);

        $instructor->update($validated);

        return redirect()->route('instructors.show', $instructor)
            ->with('success', 'Moniteur mis à jour avec succès.');
    }

    public function destroy(Instructor $instructor)
    {
        $instructor->delete();

        return redirect()->route('instructors.index')
            ->with('success', 'Moniteur supprimé avec succès.');
    }
} 