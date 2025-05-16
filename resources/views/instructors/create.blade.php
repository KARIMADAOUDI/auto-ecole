<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajouter un Moniteur') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('instructors.store') }}" class="space-y-6">
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

                            <!-- Numéro de licence -->
                            <div>
                                <x-input-label for="license_number" :value="__('Numéro de licence')" />
                                <x-text-input id="license_number" name="license_number" type="text" class="mt-1 block w-full" :value="old('license_number')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('license_number')" />
                            </div>

                            <!-- Date d'expiration de la licence -->
                            <div>
                                <x-input-label for="license_expiry_date" :value="__('Date d\'expiration de la licence')" />
                                <x-text-input id="license_expiry_date" name="license_expiry_date" type="date" class="mt-1 block w-full" :value="old('license_expiry_date')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('license_expiry_date')" />
                            </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Enregistrer') }}</x-primary-button>
                            <a href="{{ route('instructors.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Annuler') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 