<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Student;
use App\Models\Instructor;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index()
    {
        $lessons = Lesson::with(['student', 'instructor', 'vehicle'])
            ->orderBy('start_time', 'desc')
            ->paginate(10);

        // Récupérer les statistiques des leçons
        $totalLessons = Lesson::count();
        $todayLessons = Lesson::whereDate('start_time', today())->count();
        $upcomingLessons = Lesson::whereDate('start_time', '>', today())->count();

        return view('lessons.index', compact('lessons', 'totalLessons', 'todayLessons', 'upcomingLessons'));
    }

    public function create()
    {
        $students = Student::orderBy('last_name')->get();
        $instructors = Instructor::where('status', 'active')->orderBy('last_name')->get();
        $vehicles = Vehicle::where('status', 'available')->orderBy('brand')->get();
        return view('lessons.create', compact('students', 'instructors', 'vehicles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'instructor_id' => 'required|exists:instructors,id',
            'student_id' => 'required|exists:students,id',
            'vehicle_id' => 'nullable|exists:vehicles,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'type' => 'required|in:code,conduite',
            'status' => 'required|in:scheduled,completed,cancelled',
            'notes' => 'nullable|string'
        ]);

        $lesson = Lesson::create([
            'instructor_id' => $validated['instructor_id'],
            'student_id' => $validated['student_id'],
            'vehicle_id' => $validated['type'] === 'conduite' ? $validated['vehicle_id'] : null,
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'type' => $validated['type'],
            'status' => $validated['status'],
            'notes' => $validated['notes']
        ]);

        return redirect()->route('lessons.show', $lesson)
            ->with('success', 'Leçon créée avec succès.');
    }

    public function show(Lesson $lesson)
    {
        $lesson->load(['student', 'instructor', 'vehicle']);
        return view('lessons.show', compact('lesson'));
    }

    public function edit(Lesson $lesson)
    {
        $students = Student::orderBy('last_name')->get();
        $instructors = Instructor::where('is_active', true)->orderBy('last_name')->get();
        $vehicles = Vehicle::where('is_available', true)->orderBy('brand')->get();

        return view('lessons.edit', compact('lesson', 'students', 'instructors', 'vehicles'));
    }

    public function update(Request $request, Lesson $lesson)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'instructor_id' => 'required|exists:instructors,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'duration' => 'required|integer|min:30',
            'status' => 'required|in:scheduled,completed,cancelled',
            'notes' => 'nullable|string',
        ]);

        $lesson->update($validated);

        return redirect()->route('lessons.index')
            ->with('success', 'La leçon a été mise à jour avec succès.');
    }

    public function destroy(Lesson $lesson)
    {
        $lesson->delete();

        return redirect()->route('lessons.index')
            ->with('success', 'La leçon a été supprimée avec succès.');
    }
} 