<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-indigo-800 leading-tight flex items-center gap-2">
                <i class="bi bi-car-front"></i> {{ __('Véhicules') }}
            </h2>
            <a href="{{ route('vehicles.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all duration-200 shadow">
                <i class="bi bi-plus-circle mr-2"></i> Ajouter
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-2xl rounded-3xl border border-gray-100">
                <div class="p-8 text-gray-900">
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="overflow-x-auto rounded-lg shadow">
                        <table class="min-w-full bg-white divide-y divide-gray-200 rounded-xl overflow-hidden">
                            <thead class="bg-indigo-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">Véhicule</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">Immatriculation</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">Type</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">Statut</th>
                                    <th class="px-6 py-3 text-right text-xs font-semibold text-indigo-700 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($vehicles as $vehicle)
                                    <tr class="hover:bg-indigo-50 transition-all">
                                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-300">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                                                        <i class="bi bi-car-front text-indigo-600"></i>
                                                    </div>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $vehicle->brand }} {{ $vehicle->model }}
                                                    </div>
                                                    <div class="text-sm text-gray-500">
                                                        {{ $vehicle->year }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-300">
                                            <div class="text-sm font-medium text-gray-900">{{ $vehicle->registration_number }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-300">
                                            <span class="px-4 py-1 text-xs font-bold rounded-full shadow bg-gradient-to-r from-blue-200 to-blue-400 text-blue-900 border border-blue-300">
                                                {{ ucfirst($vehicle->type) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-300">
                                            <span class="px-4 py-1 text-xs font-bold rounded-full shadow bg-gradient-to-r from-green-200 to-green-400 text-green-900 border border-green-300"
                                                @if($vehicle->status === 'maintenance') style="background: linear-gradient(to right, #fef08a, #facc15); color: #92400e; border-color: #fde68a;"
                                                @elseif($vehicle->status === 'unavailable') style="background: linear-gradient(to right, #fca5a5, #f87171); color: #991b1b; border-color: #fecaca;" @endif>
                                                {{ ucfirst($vehicle->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex items-center gap-2">
                                            <a href="{{ route('vehicles.show', $vehicle) }}"
                                               class="inline-flex items-center px-3 py-1 rounded-full shadow-sm bg-blue-600 text-white hover:bg-blue-700 hover:scale-105 transition-all duration-200"
                                               title="Afficher">
                                                <i class="bi bi-eye mr-1"></i> Afficher
                                            </a>
                                            <a href="{{ route('vehicles.edit', $vehicle) }}" 
                                               class="inline-flex items-center px-3 py-1 rounded-full shadow-sm bg-yellow-500 text-white hover:bg-yellow-600 hover:scale-105 transition-all duration-200"
                                               title="Modifier">
                                                <i class="bi bi-pencil-square mr-1"></i> Modifier
                                            </a>
                                            <form action="{{ route('vehicles.destroy', $vehicle) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                    class="inline-flex items-center px-3 py-1 rounded-full shadow-sm bg-red-600 text-white hover:bg-red-700 hover:scale-105 transition-all duration-200"
                                                    title="Supprimer"
                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce véhicule ?')">
                                                    <i class="bi bi-trash3 mr-1"></i> Supprimer
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                                            <div class="flex flex-col items-center justify-center py-8">
                                                <i class="bi bi-car-front text-4xl text-gray-400 mb-2"></i>
                                                <p>Aucun véhicule enregistré</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $vehicles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 