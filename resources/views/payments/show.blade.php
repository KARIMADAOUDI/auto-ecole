<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Détails du Paiement') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Informations de l'élève -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Informations de l'élève</h3>
                            <div class="space-y-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Nom complet</p>
                                    <p class="mt-1">{{ $payment->student->first_name }} {{ $payment->student->last_name }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Email</p>
                                    <p class="mt-1">{{ $payment->student->email }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Téléphone</p>
                                    <p class="mt-1">{{ $payment->student->phone }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Détails du paiement -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Détails du paiement</h3>
                            <div class="space-y-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Montant</p>
                                    <p class="mt-1">{{ number_format($payment->amount, 2) }} €</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Date</p>
                                    <p class="mt-1">{{ $payment->payment_date->format('d/m/Y') }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Méthode de paiement</p>
                                    <p class="mt-1">
                                        @switch($payment->payment_method)
                                            @case('cash')
                                                Espèces
                                                @break
                                            @case('credit_card')
                                                Carte bancaire
                                                @break
                                            @case('bank_transfer')
                                                Virement
                                                @break
                                            @case('check')
                                                Chèque
                                                @break
                                        @endswitch
                                    </p>
                                </div>
                                @if($payment->reference)
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Référence</p>
                                        <p class="mt-1">{{ $payment->reference }}</p>
                                    </div>
                                @endif
                                @if($payment->notes)
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Notes</p>
                                        <p class="mt-1">{{ $payment->notes }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex items-center gap-4">
                        <a href="{{ route('payments.edit', $payment) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Modifier') }}
                        </a>
                        <form method="POST" action="{{ route('payments.destroy', $payment) }}" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce paiement ?')">
                                {{ __('Supprimer') }}
                            </button>
                        </form>
                        <a href="{{ route('payments.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Retour') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 