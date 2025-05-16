<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajouter une Leçon') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <!-- Affichage des erreurs de validation -->
                @if ($errors->any())
                    <div class="mb-4">
                        <ul class="list-disc list-inside text-sm text-red-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('lessons.store') }}">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Élèves -->
                        <div class="bg-white p-4 rounded-xl shadow-sm">
                            <label for="student_id" class="block text-sm font-semibold text-indigo-700 mb-2 flex items-center gap-2">
                                <i class="bi bi-person"></i> Élève
                            </label>
                            <select id="student_id" name="student_id" 
                                class="mt-1 block w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200"
                                required>
                                <option value="">Sélectionner un élève</option>
                                @foreach($students as $student)
                                    <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                        {{ $student->first_name }} {{ $student->last_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('student_id')
                                <div class="text-red-500 text-sm mt-2 flex items-center gap-1">
                                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Moniteur -->
                        <div class="bg-white p-4 rounded-xl shadow-sm">
                            <label for="instructor_id" class="block text-sm font-semibold text-indigo-700 mb-2 flex items-center gap-2">
                                <i class="bi bi-person-badge"></i> Moniteur
                            </label>
                            <select id="instructor_id" name="instructor_id" 
                                class="mt-1 block w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200"
                                required>
                                <option value="">Sélectionner un moniteur</option>
                                @foreach($instructors as $instructor)
                                    <option value="{{ $instructor->id }}">
                                        {{ $instructor->first_name }} {{ $instructor->last_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('instructor_id')
                                <div class="text-red-500 text-sm mt-2 flex items-center gap-1">
                                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Type de leçon -->
                        <div class="bg-white p-4 rounded-xl shadow-sm">
                            <label for="type" class="block text-sm font-semibold text-indigo-700 mb-2 flex items-center gap-2">
                                <i class="bi bi-book"></i> Type de leçon
                            </label>
                            <select id="type" name="type" 
                                class="mt-1 block w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200"
                                required>
                                <option value="code">Code de la route</option>
                                <option value="conduite">Conduite</option>
                            </select>
                            @error('type')
                                <div class="text-red-500 text-sm mt-2 flex items-center gap-1">
                                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Véhicule (visible uniquement pour les leçons de conduite) -->
                        <div id="vehicle_container" class="bg-white p-4 rounded-xl shadow-sm hidden">
                            <label for="vehicle_id" class="block text-sm font-semibold text-indigo-700 mb-2 flex items-center gap-2">
                                <i class="bi bi-car-front"></i> Véhicule
                            </label>
                            <select id="vehicle_id" name="vehicle_id" 
                                class="mt-1 block w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200">
                                <option value="">Sélectionner un véhicule</option>
                                @foreach($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}">
                                        {{ $vehicle->brand }} {{ $vehicle->model }} ({{ $vehicle->plate_number }})
                                    </option>
                                @endforeach
                            </select>
                            @error('vehicle_id')
                                <div class="text-red-500 text-sm mt-2 flex items-center gap-1">
                                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Date et heure de début -->
                        <div class="bg-white p-4 rounded-xl shadow-sm">
                            <label for="start_time" class="block text-sm font-semibold text-indigo-700 mb-2 flex items-center gap-2">
                                <i class="bi bi-calendar-plus"></i> Date et heure de début
                            </label>
                            <input id="start_time" name="start_time" type="datetime-local" 
                                class="mt-1 block w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200"
                                required />
                            @error('start_time')
                                <div class="text-red-500 text-sm mt-2 flex items-center gap-1">
                                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Date et heure de fin -->
                        <div class="bg-white p-4 rounded-xl shadow-sm">
                            <label for="end_time" class="block text-sm font-semibold text-indigo-700 mb-2 flex items-center gap-2">
                                <i class="bi bi-calendar-check"></i> Date et heure de fin
                            </label>
                            <input id="end_time" name="end_time" type="datetime-local" 
                                class="mt-1 block w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200"
                                required />
                            @error('end_time')
                                <div class="text-red-500 text-sm mt-2 flex items-center gap-1">
                                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Statut -->
                        <div class="bg-white p-4 rounded-xl shadow-sm">
                            <label for="status" class="block text-sm font-semibold text-indigo-700 mb-2 flex items-center gap-2">
                                <i class="bi bi-check-circle"></i> Statut
                            </label>
                            <select id="status" name="status" 
                                class="mt-1 block w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200"
                                required>
                                <option value="scheduled">Planifiée</option>
                                <option value="completed">Terminée</option>
                                <option value="cancelled">Annulée</option>
                            </select>
                            @error('status')
                                <div class="text-red-500 text-sm mt-2 flex items-center gap-1">
                                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Notes -->
                        <div class="bg-white p-4 rounded-xl shadow-sm">
                            <label for="notes" class="block text-sm font-semibold text-indigo-700 mb-2 flex items-center gap-2">
                                <i class="bi bi-pencil"></i> Notes
                            </label>
                            <textarea id="notes" name="notes" rows="3" 
                                class="mt-1 block w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200"></textarea>
                            @error('notes')
                                <div class="text-red-500 text-sm mt-2 flex items-center gap-1">
                                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6 flex space-x-2">
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded">Enregistrer</button>
                        <a href="{{ route('lessons.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const typeSelect = document.getElementById('type');
            const vehicleContainer = document.getElementById('vehicle_container');
            const vehicleSelect = document.getElementById('vehicle_id');

            function toggleVehicleField() {
                if (typeSelect.value === 'conduite') {
                    vehicleContainer.classList.remove('hidden');
                    vehicleSelect.setAttribute('required', 'required');
                } else {
                    vehicleContainer.classList.add('hidden');
                    vehicleSelect.removeAttribute('required');
                    vehicleSelect.value = '';
                }
            }

            typeSelect.addEventListener('change', toggleVehicleField);
            toggleVehicleField();
        });
    </script>
    @endpush
</x-app-layout> 