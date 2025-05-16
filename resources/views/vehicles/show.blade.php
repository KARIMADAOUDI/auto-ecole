<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Détails du véhicule') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('vehicles.edit', $vehicle) }}" class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 focus:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <i class="bi bi-pencil-square mr-2"></i> Modifier
                </a>
                <a href="{{ route('vehicles.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <i class="bi bi-arrow-left mr-2"></i> Retour
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Informations principales -->
                        <div class="space-y-6">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900">Informations principales</h3>
                                <div class="mt-4 space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Marque</label>
                                        <div class="mt-1 text-sm text-gray-900">{{ $vehicle->brand }}</div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Modèle</label>
                                        <div class="mt-1 text-sm text-gray-900">{{ $vehicle->model }}</div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Immatriculation</label>
                                        <div class="mt-1 text-sm text-gray-900">{{ $vehicle->registration_number }}</div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Année</label>
                                        <div class="mt-1 text-sm text-gray-900">{{ $vehicle->year }}</div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Couleur</label>
                                        <div class="mt-1 text-sm text-gray-900">{{ $vehicle->color }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- État et maintenance -->
                        <div class="space-y-6">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900">État et maintenance</h3>
                                <div class="mt-4 space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Statut</label>
                                        <div class="mt-1">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                @if($vehicle->status === 'available') bg-green-100 text-green-800
                                                @elseif($vehicle->status === 'in_use') bg-yellow-100 text-yellow-800
                                                @else bg-red-100 text-red-800
                                                @endif">
                                                @if($vehicle->status === 'available') Disponible
                                                @elseif($vehicle->status === 'in_use') En cours d'utilisation
                                                @else En maintenance
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Type de transmission</label>
                                        <div class="mt-1 text-sm text-gray-900">
                                            {{ $vehicle->type === 'manual' ? 'Manuelle' : 'Automatique' }}
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Dernière maintenance</label>
                                        <div class="mt-1 text-sm text-gray-900">
                                            {{ $vehicle->last_maintenance_date ? $vehicle->last_maintenance_date->format('d/m/Y') : 'Non renseignée' }}
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Prochaine maintenance</label>
                                        <div class="mt-1 text-sm text-gray-900">
                                            {{ $vehicle->next_maintenance_date ? $vehicle->next_maintenance_date->format('d/m/Y') : 'Non renseignée' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Notes -->
                    @if($vehicle->notes)
                    <div class="mt-8">
                        <h3 class="text-lg font-medium text-gray-900">Notes</h3>
                        <div class="mt-4 text-sm text-gray-900 bg-gray-50 p-4 rounded-lg">
                            {{ $vehicle->notes }}
                        </div>
                    </div>
                    @endif

                    <!-- Historique des leçons -->
                    @if($vehicle->lessons->count() > 0)
                    <div class="mt-8">
                        <h3 class="text-lg font-medium text-gray-900">Historique des leçons</h3>
                        <div class="mt-4">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Élève</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Instructeur</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($vehicle->lessons as $lesson)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $lesson->date->format('d/m/Y H:i') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $lesson->student->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $lesson->instructor->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                @if($lesson->status === 'completed') bg-green-100 text-green-800
                                                @elseif($lesson->status === 'scheduled') bg-blue-100 text-blue-800
                                                @else bg-red-100 text-red-800
                                                @endif">
                                                {{ $lesson->status }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 