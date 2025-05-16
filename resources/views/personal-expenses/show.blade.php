<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Détails de la dépense') }}
            </h2>
            <div>
                <a href="{{ route('personal-expenses.edit', $personalExpense) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mr-2">
                    Modifier
                </a>
                <form action="{{ route('personal-expenses.destroy', $personalExpense) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette dépense ?')">
                        Supprimer
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Informations générales</h3>
                            <dl class="grid grid-cols-1 gap-4">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Instructeur</dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{ $personalExpense->instructor->first_name }} {{ $personalExpense->instructor->last_name }}
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Date de la dépense</dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{ $personalExpense->expense_date->format('d/m/Y') }}
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Montant</dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{ number_format($personalExpense->amount, 2) }} €
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Type de dépense</dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{ $personalExpense->type }}
                                    </dd>
                                </div>
                            </dl>
                        </div>

                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Détails supplémentaires</h3>
                            <dl class="grid grid-cols-1 gap-4">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Description</dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{ $personalExpense->description }}
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Numéro de facture</dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{ $personalExpense->invoice_number ?? 'Non spécifié' }}
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Fournisseur</dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{ $personalExpense->supplier ?? 'Non spécifié' }}
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Notes</dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{ $personalExpense->notes ?? 'Aucune note' }}
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('personal-expenses.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Retour à la liste
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 