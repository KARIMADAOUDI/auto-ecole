<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('student')
            ->orderBy('payment_date', 'desc')
            ->paginate(15);

        $totalAmount = Payment::sum('amount');

        return view('payments.index', compact('payments', 'totalAmount'));
    }

    public function create(Request $request)
    {
        $students = Student::orderBy('last_name')->get();
        $selectedStudent = $request->has('student_id') ? Student::find($request->student_id) : null;
        return view('payments.create', compact('students', 'selectedStudent'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'payment_method' => 'required|in:cash,credit_card,bank_transfer,check',
            'notes' => 'nullable|string|max:1000',
        ]);

        try {
            $payment = Payment::create($validated);

            // Mettre à jour le statut de paiement de l'élève
            $student = Student::find($validated['student_id']);
            $student->updatePaymentStatus();

            // Créer une notification pour le nouveau paiement
            $student->notifications()->create([
                'type' => 'payment_received',
                'title' => 'Nouveau Paiement',
                'message' => "Un paiement de " . number_format($validated['amount'], 2) . " DH a été reçu pour {$student->full_name}"
            ]);

            return redirect()->route('payments.index')
                ->with('success', 'Paiement enregistré avec succès.');
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur lors de l\'enregistrement du paiement : ' . $e->getMessage());
        }
    }

    public function show(Payment $payment)
    {
        $payment->load('student');
        return view('payments.show', compact('payment'));
    }

    public function edit(Payment $payment)
    {
        $students = Student::orderBy('last_name')->get();
        return view('payments.edit', compact('payment', 'students'));
    }

    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'payment_method' => 'required|in:cash,credit_card,bank_transfer,check',
            'reference' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $payment->update($validated);

        return redirect()->route('payments.index')
            ->with('success', 'Le paiement a été mis à jour avec succès.');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();

        return redirect()->route('payments.index')
            ->with('success', 'Le paiement a été supprimé avec succès.');
    }
} 