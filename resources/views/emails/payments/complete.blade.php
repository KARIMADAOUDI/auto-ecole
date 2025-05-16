@component('mail::message')
# Paiement Complet

Bonjour,

Le paiement de l'élève **{{ $student->full_name }}** est maintenant complet.

## Détails du paiement :
- Montant total : {{ number_format($student->total_amount, 2) }} DH
- Montant payé : {{ number_format($student->paid_amount, 2) }} DH
- Date de complétion : {{ now()->format('d/m/Y H:i') }}

@component('mail::button', ['url' => route('students.show', $student)])
Voir les détails de l'élève
@endcomponent

Merci,<br>
{{ config('app.name') }}
@endcomponent 