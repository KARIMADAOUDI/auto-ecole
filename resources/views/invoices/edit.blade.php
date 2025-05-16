<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier la facture') }} #{{ $invoice->invoice_number }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('invoices.update', $invoice) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Type de facture -->
                            <div>
                                <x-input-label for="invoice_type" :value="__('Type de facture')" />
                                <select id="invoice_type" name="invoice_type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                    <option value="">Sélectionner un type</option>
                                    @foreach(App\Models\Invoice::TYPES as $key => $label)
                                        <option value="{{ $key }}" {{ old('invoice_type', $invoice->invoice_type) == $key ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('invoice_type')" />
                            </div>

                            <!-- Montant -->
                            <div>
                                <x-input-label for="amount" :value="__('Montant (DH)')" />
                                <x-text-input id="amount" name="amount" type="number" step="0.01" class="mt-1 block w-full" :value="old('amount', $invoice->amount)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('amount')" />
                            </div>

                            <!-- Date d'échéance -->
                            <div>
                                <x-input-label for="due_date" :value="__('Date d\'échéance')" />
                                <x-text-input id="due_date" name="due_date" type="date" class="mt-1 block w-full" :value="old('due_date', $invoice->due_date->format('Y-m-d'))" required />
                                <x-input-error class="mt-2" :messages="$errors->get('due_date')" />
                            </div>

                            <!-- Statut -->
                            <div>
                                <x-input-label for="status" :value="__('Statut')" />
                                <select id="status" name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                    @foreach(App\Models\Invoice::STATUSES as $key => $label)
                                        <option value="{{ $key }}" {{ old('status', $invoice->status) == $key ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('status')" />
                            </div>

                            <!-- Notes -->
                            <div class="md:col-span-2">
                                <x-input-label for="notes" :value="__('Notes')" />
                                <textarea id="notes" name="notes" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('notes', $invoice->notes) }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('notes')" />
                            </div>
                        </div>

                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <a href="{{ route('invoices.show', $invoice) }}" class="text-sm font-semibold leading-6 text-gray-900">
                                Annuler
                            </a>
                            <x-primary-button>
                                {{ __('Enregistrer les modifications') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 