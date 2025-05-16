<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'birth_date',
        'city',
        'postal_code',
        'license_type',
        'license_obtained_at',
        'is_active',
        'notes',
        'is_paid',
        'total_amount',
        'paid_amount'
    ];
    

    protected $casts = [
        'birth_date' => 'date',
        'license_obtained_at' => 'date',
        'is_active' => 'boolean',
        'is_paid' => 'boolean',
        'total_amount' => 'decimal:2',
        'paid_amount' => 'decimal:2'
    ];

    public function lessons()
    {
        return $this->belongsToMany(Lesson::class)
            ->withTimestamps();
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable');
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function updatePaymentStatus()
    {
        $this->paid_amount = $this->payments()->sum('amount');
        $this->is_paid = $this->paid_amount >= $this->total_amount;
        
        try {
            $this->save();
            
            if ($this->is_paid) {
                // Créer une notification dans l'application
                $this->notifications()->create([
                    'type' => 'payment_complete',
                    'title' => 'Paiement Complet',
                    'message' => "Le paiement de {$this->full_name} est maintenant complet. Montant total : " . number_format($this->total_amount, 2) . " DH"
                ]);

                // Envoyer un email à l'auto-école
                Mail::to(config('mail.from.address'))->send(new \App\Mail\PaymentComplete($this));
            }
        } catch (\Exception $e) {
            Log::error('Erreur lors de la mise à jour du statut de paiement : ' . $e->getMessage());
            throw $e;
        }
    }
} 