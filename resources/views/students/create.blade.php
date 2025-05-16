<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajouter un élève') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('students.store') }}" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Prénom -->
                            <div>
                                <x-input-label for="first_name" :value="__('Prénom')" />
                                <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full" :value="old('first_name')" required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
                            </div>

                            <!-- Nom -->
                            <div>
                                <x-input-label for="last_name" :value="__('Nom')" />
                                <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" :value="old('last_name')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
                            </div>

                            <!-- Email -->
                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                            </div>

                            <!-- Téléphone -->
                            <div>
                                <x-input-label for="phone" :value="__('Téléphone')" />
                                <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                            </div>

                            <!-- Date de naissance -->
                            <div>
                                <x-input-label for="birth_date" :value="__('Date de naissance')" />
                                <x-text-input id="birth_date" name="birth_date" type="date" class="mt-1 block w-full" :value="old('birth_date')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('birth_date')" />
                            </div>

                            <!-- Adresse -->
                            <div>
                                <x-input-label for="address" :value="__('Adresse')" />
                                <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('address')" />
                            </div>

                            <!-- Ville -->
                            <div>
                                <x-input-label for="city" :value="__('Ville')" />
                                <x-text-input id="city" name="city" type="text" class="mt-1 block w-full" :value="old('city')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('city')" />
                            </div>

                            <!-- Code postal -->
                            <div>
                                <x-input-label for="postal_code" :value="__('Code postal')" />
                                <x-text-input id="postal_code" name="postal_code" type="text" class="mt-1 block w-full" :value="old('postal_code')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('postal_code')" />
                            </div>

                            <!-- Type de permis -->
                            <div>
                                <x-input-label for="license_type" :value="__('Type de permis')" />
                                <select id="license_type" name="license_type" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                    <option value="">Sélectionnez un type de permis</option>
                                    <option value="A" {{ old('license_type') == 'A' ? 'selected' : '' }}>Permis A (Moto)</option>
                                    <option value="B" {{ old('license_type') == 'B' ? 'selected' : '' }}>Permis B (Voiture)</option>
                                    <option value="C" {{ old('license_type') == 'C' ? 'selected' : '' }}>Permis C (Poids lourd)</option>
                                    <option value="D" {{ old('license_type') == 'D' ? 'selected' : '' }}>Permis D (Transport en commun)</option>
                                    <option value="E" {{ old('license_type') == 'E' ? 'selected' : '' }}>Permis E (Remorque)</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('license_type')" />
                            </div>

                            <!-- Montant total -->
                            <div>
                                <x-input-label for="total_amount" :value="__('Montant total (DH)')" />
                                <x-text-input id="total_amount" name="total_amount" type="number" step="0.01" class="mt-1 block w-full" :value="old('total_amount', 2500)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('total_amount')" />
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button type="submit">{{ __('Enregistrer') }}</x-primary-button>
                            <a href="{{ route('students.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Annuler') }}
                            </a>
                        </div>
                    </form>

                    @if ($errors->any())
                        <div class="mt-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                const requiredFields = form.querySelectorAll('[required]');
                let isValid = true;

                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        isValid = false;
                        field.classList.add('border-red-500');
                    } else {
                        field.classList.remove('border-red-500');
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    alert('Veuillez remplir tous les champs obligatoires.');
                }
            });
        });
    </script>
    @endpush
</x-app-layout> 