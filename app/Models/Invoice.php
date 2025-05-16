<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'invoice_number',
        'invoice_type',
        'amount',
        'due_date',
        'status',
        'payment_date',
        'notes'
    ];

    /**
     * Les attributs qui doivent être castés.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'due_date' => 'date',
        'payment_date' => 'date',
        'amount' => 'decimal:2'
    ];

    // Types de factures disponibles
    const TYPES = [
        'electricity' => 'Électricité',
        'water' => 'Eau',
        'rent' => 'Loyer',
        'credit' => 'Crédit',
        'internet' => 'Internet',
        'phone' => 'Téléphone',
        'other' => 'Autre'
    ];

    // Statuts disponibles
    const STATUSES = [
        'pending' => 'En attente',
        'paid' => 'Payée',
        'overdue' => 'En retard'
    ];

    public function getTypeLabelAttribute()
    {
        return self::TYPES[$this->invoice_type] ?? $this->invoice_type;
    }

    public function getStatusLabelAttribute()
    {
        return self::STATUSES[$this->status] ?? $this->status;
    }

    public function markAsPaid()
    {
        $this->update([
            'status' => 'paid',
            'payment_date' => now()
        ]);
    }

    public function markAsOverdue()
    {
        if ($this->status === 'pending' && $this->due_date < now()) {
            $this->update(['status' => 'overdue']);
        }
    }
} 