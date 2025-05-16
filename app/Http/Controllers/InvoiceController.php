<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InvoiceController extends Controller
{
    /**
     * Affiche la liste des factures.
     */
    public function index()
    {
        $invoices = Invoice::orderBy('created_at', 'desc')
            ->paginate(10);

        return view('invoices.index', compact('invoices'));
    }

    /**
     * Affiche le formulaire de création d'une facture.
     */
    public function create()
    {
        return view('invoices.create');
    }

    /**
     * Enregistre une nouvelle facture.
     */
    public function store(Request $request)
    {
        try {
            Log::info('Début de la création de facture', $request->all());

            $validated = $request->validate([
                'invoice_type' => 'required|string',
                'amount' => 'required|numeric|min:0',
                'due_date' => 'required|date',
                'status' => 'required|in:pending,paid,overdue',
                'notes' => 'nullable|string',
            ]);

            Log::info('Données validées', $validated);

            DB::beginTransaction();

            // Générer un numéro de facture unique
            $year = date('Y');
            $month = date('m');
            $lastInvoice = Invoice::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->orderBy('invoice_number', 'desc')
                ->first();

            if ($lastInvoice) {
                $lastNumber = (int) substr($lastInvoice->invoice_number, -4);
                $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
            } else {
                $newNumber = '0001';
            }

            $invoiceNumber = "FAC-{$year}{$month}-{$newNumber}";
            Log::info('Numéro de facture généré', ['invoice_number' => $invoiceNumber]);

            // Créer la facture
            $invoice = Invoice::create([
                'invoice_number' => $invoiceNumber,
                'invoice_type' => $validated['invoice_type'],
                'amount' => $validated['amount'],
                'due_date' => $validated['due_date'],
                'status' => $validated['status'],
                'notes' => $validated['notes'],
            ]);

            Log::info('Facture créée', ['invoice' => $invoice->toArray()]);

            DB::commit();

            return redirect()
                ->route('invoices.index')
                ->with('success', 'La facture a été créée avec succès.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur lors de la création de la facture', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()
                ->withInput()
                ->withErrors(['error' => 'Une erreur est survenue lors de la création de la facture : ' . $e->getMessage()]);
        }
    }

    /**
     * Affiche les détails d'une facture.
     */
    public function show(Invoice $invoice)
    {
        return view('invoices.show', compact('invoice'));
    }

    /**
     * Affiche le formulaire de modification d'une facture.
     */
    public function edit(Invoice $invoice)
    {
        return view('invoices.edit', compact('invoice'));
    }

    /**
     * Met à jour une facture.
     */
    public function update(Request $request, Invoice $invoice)
    {
        $validated = $request->validate([
            'invoice_type' => 'required|string',
            'amount' => 'required|numeric|min:0',
            'due_date' => 'required|date',
            'status' => 'required|in:pending,paid,overdue',
            'notes' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            // Mettre à jour la facture
            $invoice->update([
                'invoice_type' => $validated['invoice_type'],
                'amount' => $validated['amount'],
                'due_date' => $validated['due_date'],
                'status' => $validated['status'],
                'notes' => $validated['notes'],
            ]);

            DB::commit();

            return redirect()
                ->route('invoices.index')
                ->with('success', 'La facture a été mise à jour avec succès.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->withErrors(['error' => 'Une erreur est survenue lors de la mise à jour de la facture.']);
        }
    }

    /**
     * Marque une facture comme payée.
     */
    public function markAsPaid(Invoice $invoice)
    {
        try {
            $invoice->update([
                'status' => 'paid',
                'payment_date' => now(),
            ]);

            return redirect()
                ->route('invoices.index')
                ->with('success', 'La facture a été marquée comme payée.');
        } catch (\Exception $e) {
            return back()
                ->withErrors(['error' => 'Une erreur est survenue lors de la mise à jour du statut de la facture.']);
        }
    }
} 