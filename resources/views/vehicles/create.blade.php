<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajouter un véhicule') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('vehicles.store') }}" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Marque -->
                            <div>
                                <x-input-label for="brand" :value="__('Marque')" />
                                <x-text-input id="brand" name="brand" type="text" class="mt-1 block w-full" :value="old('brand')" required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('brand')" />
                            </div>

                            <!-- Modèle -->
                            <div>
                                <x-input-label for="model" :value="__('Modèle')" />
                                <x-text-input id="model" name="model" type="text" class="mt-1 block w-full" :value="old('model')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('model')" />
                            </div>

                            <!-- Numéro d'immatriculation -->
                            <div>
                                <x-input-label for="registration_number" :value="__('Numéro d\'immatriculation')" />
                                <x-text-input id="registration_number" name="registration_number" type="text" class="mt-1 block w-full" :value="old('registration_number')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('registration_number')" />
                            </div>

                            <!-- Année -->
                            <div>
                                <x-input-label for="year" :value="__('Année')" />
                                <x-text-input id="year" name="year" type="number" class="mt-1 block w-full" :value="old('year')" required min="1900" max="{{ date('Y') + 1 }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('year')" />
                            </div>

                            <!-- Couleur -->
                            <div>
                                <x-input-label for="color" :value="__('Couleur')" />
                                <x-text-input id="color" name="color" type="text" class="mt-1 block w-full" :value="old('color')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('color')" />
                            </div>

                            <!-- Type de transmission -->
                            <div>
                                <x-input-label for="type" :value="__('Type de transmission')" />
                                <select id="type" name="type" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                    <option value="manual" {{ old('type') == 'manual' ? 'selected' : '' }}>Manuelle</option>
                                    <option value="automatic" {{ old('type') == 'automatic' ? 'selected' : '' }}>Automatique</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('type')" />
                            </div>

                            <!-- Statut -->
                            <div>
                                <x-input-label for="status" :value="__('Statut')" />
                                <select id="status" name="status" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                    <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Disponible</option>
                                    <option value="in_use" {{ old('status') == 'in_use' ? 'selected' : '' }}>En cours d'utilisation</option>
                                    <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>En maintenance</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('status')" />
                            </div>

                            <!-- Date de dernière maintenance -->
                            <div>
                                <x-input-label for="last_maintenance_date" :value="__('Date de dernière maintenance')" />
                                <x-text-input id="last_maintenance_date" name="last_maintenance_date" type="date" class="mt-1 block w-full" :value="old('last_maintenance_date')" />
                                <x-input-error class="mt-2" :messages="$errors->get('last_maintenance_date')" />
                            </div>

                            <!-- Date de prochaine maintenance -->
                            <div>
                                <x-input-label for="next_maintenance_date" :value="__('Date de prochaine maintenance')" />
                                <x-text-input id="next_maintenance_date" name="next_maintenance_date" type="date" class="mt-1 block w-full" :value="old('next_maintenance_date')" />
                                <x-input-error class="mt-2" :messages="$errors->get('next_maintenance_date')" />
                            </div>
                        </div>

                        <!-- Notes -->
                        <div>
                            <x-input-label for="notes" :value="__('Notes')" />
                            <textarea id="notes" name="notes" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3">{{ old('notes') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('notes')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Enregistrer') }}</x-primary-button>
                            <a href="{{ route('vehicles.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Annuler') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 