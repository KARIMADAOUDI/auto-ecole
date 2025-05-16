<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dépenses Véhicules') }}
            </h2>
            <a href="{{ route('vehicle-expenses.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <i class="bi bi-plus-circle mr-2"></i> Ajouter
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Véhicule</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Montant</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($expenses as $expense)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $expense->vehicle->brand }} {{ $expense->vehicle->model }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $expense->expense_date->format('d/m/Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ number_format($expense->amount, 2) }} €
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $expense->type }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ Str::limit($expense->description, 50) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex items-center space-x-2">
                                            <a href="{{ route('vehicle-expenses.edit', $expense) }}" class="inline-flex items-center px-2 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600" title="Modifier">
                                                <i class="bi bi-pencil-square mr-1"></i> Modifier
                                            </a>
                                            <form action="{{ route('vehicle-expenses.destroy', $expense) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette dépense ?')">
                                                    <i class="bi bi-trash3 mr-1"></i> Supprimer
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                                            Aucune dépense trouvée
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $expenses->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 