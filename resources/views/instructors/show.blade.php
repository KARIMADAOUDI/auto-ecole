<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-indigo-800 leading-tight flex items-center gap-2">
            <i class="bi bi-person-vcard"></i> {{ __('Détails du Moniteur') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-2xl rounded-3xl border border-gray-100">
                <div class="p-8 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Informations personnelles -->
                        <div class="space-y-4">
                            <h3 class="text-2xl font-bold text-indigo-700 mb-2 flex items-center gap-2">
                                <i class="bi bi-person-badge"></i> Informations personnelles
                            </h3>
                            <div class="space-y-2">
                                <div>
                                    <span class="font-semibold">Nom complet :</span>
                                    <span>{{ $instructor->first_name }} {{ $instructor->last_name }}</span>
                                </div>
                                <div>
                                    <span class="font-semibold">Email :</span>
                                    <span>{{ $instructor->email }}</span>
                                </div>
                                <div>
                                    <span class="font-semibold">Téléphone :</span>
                                    <span>{{ $instructor->phone }}</span>
                                </div>
                                <div>
                                    <span class="font-semibold">Statut :</span>
                                    <span class="px-4 py-1 text-xs font-bold rounded-full shadow bg-gradient-to-r from-green-200 to-green-400 text-green-900 border border-green-300"
                                        @if($instructor->status === 'inactive') style="background: linear-gradient(to right, #fef08a, #facc15); color: #92400e; border-color: #fde68a;"
                                        @elseif($instructor->status === 'on_leave') style="background: linear-gradient(to right, #fca5a5, #f87171); color: #991b1b; border-color: #fecaca;" @endif>
                                        {{ ucfirst($instructor->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Informations professionnelles -->
                        <div class="space-y-4">
                            <h3 class="text-2xl font-bold text-indigo-700 mb-2 flex items-center gap-2">
                                <i class="bi bi-briefcase"></i> Informations professionnelles
                            </h3>
                            <div class="space-y-2">
                                <div>
                                    <span class="font-semibold">Numéro de licence :</span>
                                    <span>{{ $instructor->license_number }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Leçons -->
                    <div class="mt-10">
                        <h3 class="text-xl font-bold text-indigo-700 mb-4 flex items-center gap-2"><i class="bi bi-calendar-event"></i> Leçons</h3>
                        @if($instructor->lessons->count() > 0)
                            <div class="overflow-x-auto rounded-lg shadow">
                                <table class="min-w-full divide-y divide-gray-200 rounded-xl overflow-hidden">
                                    <thead class="bg-indigo-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">Élève</th>
                                            <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">Date</th>
                                            <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">Heure</th>
                                            <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">Durée</th>
                                            <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">Statut</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($instructor->lessons as $lesson)
                                            <tr class="hover:bg-indigo-50 transition-all">
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $lesson->student->first_name }} {{ $lesson->student->last_name }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $lesson->date->format('d/m/Y') }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $lesson->start_time->format('H:i') }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $lesson->duration }} minutes</td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="px-2 py-1 text-xs font-semibold rounded-full shadow-sm
                                                        @if($lesson->status === 'scheduled') bg-blue-100 text-blue-800
                                                        @elseif($lesson->status === 'completed') bg-green-100 text-green-800
                                                        @else bg-red-100 text-red-800 @endif">
                                                        {{ ucfirst($lesson->status) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-gray-500">Aucune leçon n'a été enregistrée pour ce moniteur.</p>
                        @endif
                    </div>

                    <!-- Actions -->
                    <div class="mt-10 flex flex-wrap items-center gap-4 justify-end">
                        <a href="{{ route('instructors.edit', $instructor) }}"
                           class="inline-flex items-center px-5 py-2 rounded-full shadow bg-yellow-500 text-white hover:bg-yellow-600 hover:scale-105 transition-all duration-200 font-semibold text-sm uppercase tracking-widest"
                           title="Modifier">
                            <i class="bi bi-pencil-square mr-2"></i> Modifier
                        </a>
                        <a href="{{ route('instructors.index') }}"
                           class="inline-flex items-center px-5 py-2 rounded-full shadow bg-gray-800 text-white hover:bg-gray-900 hover:scale-105 transition-all duration-200 font-semibold text-sm uppercase tracking-widest"
                           title="Retour à la liste">
                            <i class="bi bi-arrow-left mr-2"></i> Retour à la liste
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 