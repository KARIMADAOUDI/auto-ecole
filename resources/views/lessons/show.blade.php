<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Détail de la leçon') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="bg-gradient-to-br from-indigo-50 to-white p-8 rounded-2xl">
                            <h3 class="text-3xl font-bold text-indigo-700 mb-6 flex items-center gap-2">
                                <i class="bi bi-calendar-event"></i> Détails de la leçon
                            </h3>
                            <dl class="mt-4 grid grid-cols-1 gap-6">
                                <div class="bg-white p-4 rounded-xl shadow-sm">
                                    <dt class="text-sm font-medium text-gray-500">Type</dt>
                                    <dd class="mt-1 text-lg font-semibold text-gray-900">
                                        {{ $lesson->type === 'code' ? 'Code de la route' : 'Conduite' }}
                                    </dd>
                                </div>
                                <div class="bg-white p-4 rounded-xl shadow-sm">
                                    <dt class="text-sm font-medium text-gray-500">Date et heure</dt>
                                    <dd class="mt-1 text-lg font-semibold text-gray-900">
                                        {{ $lesson->start_time->format('d/m/Y H:i') }} - {{ $lesson->end_time->format('H:i') }}
                                    </dd>
                                </div>
                                <div class="bg-white p-4 rounded-xl shadow-sm">
                                    <dt class="text-sm font-medium text-gray-500">Moniteur</dt>
                                    <dd class="mt-1 text-lg font-semibold text-gray-900">
                                        {{ $lesson->instructor->first_name }} {{ $lesson->instructor->last_name }}
                                    </dd>
                                </div>
                                @if($lesson->vehicle)
                                <div class="bg-white p-4 rounded-xl shadow-sm">
                                    <dt class="text-sm font-medium text-gray-500">Véhicule</dt>
                                    <dd class="mt-1 text-lg font-semibold text-gray-900">
                                        {{ $lesson->vehicle->brand }} {{ $lesson->vehicle->model }} ({{ $lesson->vehicle->plate_number }})
                                    </dd>
                                </div>
                                @endif
                                <div class="bg-white p-4 rounded-xl shadow-sm">
                                    <dt class="text-sm font-medium text-gray-500">Statut</dt>
                                    <dd class="mt-1">
                                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full 
                                            @if($lesson->status === 'completed') bg-green-100 text-green-800
                                            @elseif($lesson->status === 'cancelled') bg-red-100 text-red-800
                                            @else bg-yellow-100 text-yellow-800 @endif">
                                            @if($lesson->status === 'completed')
                                                <i class="bi bi-check-circle mr-1"></i>
                                            @elseif($lesson->status === 'cancelled')
                                                <i class="bi bi-x-circle mr-1"></i>
                                            @else
                                                <i class="bi bi-clock mr-1"></i>
                                            @endif
                                            {{ ucfirst($lesson->status) }}
                                        </span>
                                    </dd>
                                </div>
                            </dl>
                        </div>

                        <div class="bg-gradient-to-br from-indigo-50 to-white p-8 rounded-2xl">
                            <h3 class="text-3xl font-bold text-indigo-700 mb-6 flex items-center gap-2">
                                <i class="bi bi-people"></i> Élèves
                            </h3>
                            <div class="mt-4 space-y-4">
                                @forelse($lesson->students as $student)
                                    <div class="bg-white p-4 rounded-xl shadow-sm">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-12 w-12">
                                                <div class="h-12 w-12 rounded-full bg-indigo-100 flex items-center justify-center">
                                                    <i class="bi bi-person text-2xl text-indigo-600"></i>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-lg font-semibold text-gray-900">
                                                    {{ $student->first_name }} {{ $student->last_name }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{ $student->email }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="bg-white p-8 rounded-xl shadow-sm text-center">
                                        <i class="bi bi-people text-4xl text-gray-400 mb-2"></i>
                                        <p class="text-gray-500">Aucun élève inscrit à cette leçon</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    @if($lesson->notes)
                    <div class="mt-8">
                        <h3 class="text-2xl font-bold text-indigo-700 mb-4 flex items-center gap-2">
                            <i class="bi bi-pencil"></i> Notes
                        </h3>
                        <div class="bg-white p-6 rounded-xl shadow-sm">
                            <p class="text-gray-700">{{ $lesson->notes }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 