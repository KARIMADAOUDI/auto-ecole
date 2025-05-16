<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier un Véhicule') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('vehicles.update', $vehicle) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Marque -->
                            <div>
                                <x-input-label for="brand" :value="__('Marque')" />
                                <x-text-input id="brand" name="brand" type="text" class="mt-1 block w-full" :value="old('brand', $vehicle->brand)" required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('brand')" />
                            </div>

                            <!-- Modèle -->
                            <div>
                                <x-input-label for="model" :value="__('Modèle')" />
                                <x-text-input id="model" name="model" type="text" class="mt-1 block w-full" :value="old('model', $vehicle->model)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('model')" />
                            </div>

                            <!-- Numéro d'immatriculation -->
                            <div>
                                <x-input-label for="registration_number" :value="__('Numéro d\'immatriculation')" />
                                <x-text-input id="registration_number" name="registration_number" type="text" class="mt-1 block w-full" :value="old('registration_number', $vehicle->registration_number)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('registration_number')" />
                            </div>

                            <!-- Type -->
                            <div>
                                <x-input-label for="type" :value="__('Type')" />
                                <select id="type" name="type" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="manual" {{ old('type', $vehicle->type) === 'manual' ? 'selected' : '' }}>Manuel</option>
                                    <option value="automatic" {{ old('type', $vehicle->type) === 'automatic' ? 'selected' : '' }}>Automatique</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('type')" />
                            </div>

                            <!-- Date d'achat -->
                            <div>
                                <x-input-label for="purchase_date" :value="__('Date d\'achat')" />
                                <x-text-input id="purchase_date" name="purchase_date" type="date" class="mt-1 block w-full" :value="old('purchase_date', $vehicle->purchase_date->format('Y-m-d'))" required />
                                <x-input-error class="mt-2" :messages="$errors->get('purchase_date')" />
                            </div>

                            <!-- Date du dernier contrôle technique -->
                            <div>
                                <x-input-label for="last_technical_inspection" :value="__('Date du dernier contrôle technique')" />
                                <x-text-input id="last_technical_inspection" name="last_technical_inspection" type="date" class="mt-1 block w-full" :value="old('last_technical_inspection', $vehicle->last_technical_inspection->format('Y-m-d'))" required />
                                <x-input-error class="mt-2" :messages="$errors->get('last_technical_inspection')" />
                            </div>

                            <!-- Statut -->
                            <div>
                                <x-input-label for="status" :value="__('Statut')" />
                                <select id="status" name="status" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="available" {{ old('status', $vehicle->status) === 'available' ? 'selected' : '' }}>Disponible</option>
                                    <option value="in_use" {{ old('status', $vehicle->status) === 'in_use' ? 'selected' : '' }}>En cours d'utilisation</option>
                                    <option value="maintenance" {{ old('status', $vehicle->status) === 'maintenance' ? 'selected' : '' }}>En maintenance</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('status')" />
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Mettre à jour') }}</x-primary-button>
                            <a href="{{ route('vehicles.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Annuler') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 