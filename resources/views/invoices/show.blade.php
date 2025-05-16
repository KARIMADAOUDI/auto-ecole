<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Détails de la facture') }} #{{ $invoice->invoice_number }}
            </h2>
            <div class="flex space-x-4">
                <a href="{{ route('invoices.edit', $invoice) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                    Modifier
                </a>
                @if($invoice->status !== 'paid')
                    <form action="{{ route('invoices.mark-as-paid', $invoice) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Marquer comme payée
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Informations principales -->
                        <div class="space-y-4">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900">Informations générales</h3>
                                <dl class="mt-4 space-y-4">
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Numéro de facture</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $invoice->invoice_number }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Type de facture</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $invoice->type_label }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Montant</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ number_format($invoice->amount, 2) }} DH</dd>
                                    </div>
                                </dl>
                            </div>
                        </div>

                        <!-- Statut et dates -->
                        <div class="space-y-4">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900">Statut et dates</h3>
                                <dl class="mt-4 space-y-4">
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Statut</dt>
                                        <dd class="mt-1">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ $invoice->status === 'paid' ? 'bg-green-100 text-green-800' : 
                                                   ($invoice->status === 'overdue' ? 'bg-red-100 text-red-800' : 
                                                   'bg-yellow-100 text-yellow-800') }}">
                                                {{ $invoice->status_label }}
                                            </span>
                                        </dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Date d'échéance</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $invoice->due_date->format('d/m/Y') }}</dd>
                                    </div>
                                    @if($invoice->payment_date)
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500">Date de paiement</dt>
                                            <dd class="mt-1 text-sm text-gray-900">{{ $invoice->payment_date->format('d/m/Y') }}</dd>
                                        </div>
                                    @endif
                                </dl>
                            </div>
                        </div>
                    </div>

                    <!-- Notes -->
                    @if($invoice->notes)
                        <div class="mt-8">
                            <h3 class="text-lg font-medium text-gray-900">Notes</h3>
                            <div class="mt-4 text-sm text-gray-900">
                                {{ $invoice->notes }}
                            </div>
                        </div>
                    @endif

                    <!-- Boutons d'action -->
                    <div class="mt-8 flex justify-end space-x-4">
                        <a href="{{ route('invoices.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                            Retour à la liste
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 