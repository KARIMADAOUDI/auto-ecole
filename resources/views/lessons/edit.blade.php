<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier la Leçon') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('lessons.update', $lesson) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Élève -->
                            <div class="bg-white p-4 rounded-xl shadow-sm">
                                <label for="student_id" class="block text-sm font-semibold text-indigo-700 mb-2 flex items-center gap-2">
                                    <i class="bi bi-person"></i> Élève
                                </label>
                                <select id="student_id" name="student_id" 
                                    class="mt-1 block w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200"
                                    required>
                                    <option value="">Sélectionner un élève</option>
                                    @foreach($students as $student)
                                        <option value="{{ $student->id }}" {{ old('student_id', $lesson->student_id) == $student->id ? 'selected' : '' }}>
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
                            <div>
                                <label for="instructor_id" class="block text-sm font-semibold text-indigo-700 mb-1">Moniteur</label>
                                <select id="instructor_id" name="instructor_id" class="mt-1 block w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm" required>
                                    <option value="">Sélectionner un moniteur</option>
                                    @foreach($instructors as $instructor)
                                        <option value="{{ $instructor->id }}" {{ old('instructor_id', $lesson->instructor_id) == $instructor->id ? 'selected' : '' }}>
                                            {{ $instructor->first_name }} {{ $instructor->last_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('instructor_id')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
                            </div>
                            <!-- Type de leçon -->
                            <div>
                                <label for="type" class="block text-sm font-semibold text-indigo-700 mb-1">Type de leçon</label>
                                <select id="type" name="type" class="mt-1 block w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm" required onchange="toggleVehicleField()">
                                    <option value="conduite" {{ old('type', $lesson->type) == 'conduite' ? 'selected' : '' }}>Leçon de conduite</option>
                                    <option value="code" {{ old('type', $lesson->type) == 'code' ? 'selected' : '' }}>Leçon de code</option>
                                </select>
                                @error('type')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
                            </div>
                            <!-- Véhicule (affiché seulement pour conduite) -->
                            <div id="vehicle_field" style="display: {{ old('type', $lesson->type) == 'conduite' ? 'block' : 'none' }};">
                                <label for="vehicle_id" class="block text-sm font-semibold text-indigo-700 mb-1">Véhicule</label>
                                <select id="vehicle_id" name="vehicle_id" class="mt-1 block w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                                    <option value="">Sélectionner un véhicule</option>
                                    @foreach($vehicles as $vehicle)
                                        <option value="{{ $vehicle->id }}" {{ old('vehicle_id', $lesson->vehicle_id) == $vehicle->id ? 'selected' : '' }}>
                                            {{ $vehicle->brand }} {{ $vehicle->model }} ({{ $vehicle->registration_number }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('vehicle_id')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
                            </div>
                            <!-- Date -->
                            <div>
                                <x-input-label for="date" :value="__('Date')" />
                                <x-text-input id="date" name="date" type="date" class="mt-1 block w-full" :value="old('date', $lesson->date->format('Y-m-d'))" required />
                                <x-input-error class="mt-2" :messages="$errors->get('date')" />
                            </div>

                            <!-- Heure de début -->
                            <div>
                                <x-input-label for="start_time" :value="__('Heure de début')" />
                                <x-text-input id="start_time" name="start_time" type="time" class="mt-1 block w-full" :value="old('start_time', $lesson->start_time->format('H:i'))" required />
                                <x-input-error class="mt-2" :messages="$errors->get('start_time')" />
                            </div>

                            <!-- Durée -->
                            <div>
                                <x-input-label for="duration" :value="__('Durée (minutes)')" />
                                <x-text-input id="duration" name="duration" type="number" class="mt-1 block w-full" :value="old('duration', $lesson->duration)" required min="30" step="30" />
                                <x-input-error class="mt-2" :messages="$errors->get('duration')" />
                            </div>

                            <!-- Statut -->
                            <div>
                                <x-input-label for="status" :value="__('Statut')" />
                                <select id="status" name="status" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                    <option value="scheduled" {{ old('status', $lesson->status) === 'scheduled' ? 'selected' : '' }}>Planifiée</option>
                                    <option value="completed" {{ old('status', $lesson->status) === 'completed' ? 'selected' : '' }}>Terminée</option>
                                    <option value="cancelled" {{ old('status', $lesson->status) === 'cancelled' ? 'selected' : '' }}>Annulée</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('status')" />
                            </div>

                            <!-- Notes -->
                            <div class="md:col-span-2">
                                <x-input-label for="notes" :value="__('Notes')" />
                                <textarea id="notes" name="notes" rows="3" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('notes', $lesson->notes) }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('notes')" />
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Enregistrer') }}</x-primary-button>
                            <a href="{{ route('lessons.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Annuler') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleVehicleField() {
            var type = document.getElementById('type').value;
            var vehicleField = document.getElementById('vehicle_field');
            vehicleField.style.display = (type === 'conduite') ? 'block' : 'none';
        }
        document.addEventListener('DOMContentLoaded', toggleVehicleField);
    </script>
</x-app-layout> 