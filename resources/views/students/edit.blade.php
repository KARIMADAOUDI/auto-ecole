<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-indigo-800 leading-tight flex items-center gap-2">
            <i class="bi bi-person-vcard"></i> {{ __('Modifier un Élève') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-8 lg:px-16">
            <div class="bg-white overflow-hidden shadow-2xl rounded-3xl border border-gray-100">
                <div class="p-12 text-gray-900 text-lg">
                    <form method="POST" action="{{ route('students.update', $student) }}" class="space-y-8">
                        @csrf
                        @method('PUT')
                        
                        <!-- Informations personnelles -->
                        <div class="bg-gradient-to-br from-indigo-50 to-white p-8 rounded-2xl">
                            <h3 class="text-2xl font-bold text-indigo-700 mb-6 flex items-center gap-2">
                                <i class="bi bi-person-badge"></i> Informations personnelles
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <!-- Prénom -->
                                <div class="bg-white p-4 rounded-xl shadow-sm">
                                    <label for="first_name" class="block text-sm font-semibold text-indigo-700 mb-2 flex items-center gap-2">
                                        <i class="bi bi-person"></i> Prénom
                                    </label>
                                    <input id="first_name" name="first_name" type="text" 
                                        class="mt-1 block w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200" 
                                        value="{{ old('first_name', $student->first_name) }}" required autofocus />
                                    @error('first_name')
                                        <div class="text-red-500 text-sm mt-2 flex items-center gap-1">
                                            <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Nom -->
                                <div class="bg-white p-4 rounded-xl shadow-sm">
                                    <label for="last_name" class="block text-sm font-semibold text-indigo-700 mb-2 flex items-center gap-2">
                                        <i class="bi bi-person-badge"></i> Nom
                                    </label>
                                    <input id="last_name" name="last_name" type="text" 
                                        class="mt-1 block w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200" 
                                        value="{{ old('last_name', $student->last_name) }}" required />
                                    @error('last_name')
                                        <div class="text-red-500 text-sm mt-2 flex items-center gap-1">
                                            <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="bg-white p-4 rounded-xl shadow-sm">
                                    <label for="email" class="block text-sm font-semibold text-indigo-700 mb-2 flex items-center gap-2">
                                        <i class="bi bi-envelope"></i> Email
                                    </label>
                                    <input id="email" name="email" type="email" 
                                        class="mt-1 block w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200" 
                                        value="{{ old('email', $student->email) }}" required />
                                    @error('email')
                                        <div class="text-red-500 text-sm mt-2 flex items-center gap-1">
                                            <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Téléphone -->
                                <div class="bg-white p-4 rounded-xl shadow-sm">
                                    <label for="phone" class="block text-sm font-semibold text-indigo-700 mb-2 flex items-center gap-2">
                                        <i class="bi bi-telephone"></i> Téléphone
                                    </label>
                                    <input id="phone" name="phone" type="text" 
                                        class="mt-1 block w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200" 
                                        value="{{ old('phone', $student->phone) }}" required />
                                    @error('phone')
                                        <div class="text-red-500 text-sm mt-2 flex items-center gap-1">
                                            <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Date de naissance -->
                                <div class="bg-white p-4 rounded-xl shadow-sm">
                                    <label for="birth_date" class="block text-sm font-semibold text-indigo-700 mb-2 flex items-center gap-2">
                                        <i class="bi bi-calendar-date"></i> Date de naissance
                                    </label>
                                    <input id="birth_date" name="birth_date" type="date" 
                                        class="mt-1 block w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200" 
                                        value="{{ old('birth_date', $student->birth_date ? $student->birth_date->format('Y-m-d') : '') }}" required />
                                    @error('birth_date')
                                        <div class="text-red-500 text-sm mt-2 flex items-center gap-1">
                                            <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Adresse -->
                        <div class="bg-gradient-to-br from-indigo-50 to-white p-8 rounded-2xl">
                            <h3 class="text-2xl font-bold text-indigo-700 mb-6 flex items-center gap-2">
                                <i class="bi bi-geo-alt"></i> Adresse
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <!-- Adresse -->
                                <div class="bg-white p-4 rounded-xl shadow-sm">
                                    <label for="address" class="block text-sm font-semibold text-indigo-700 mb-2 flex items-center gap-2">
                                        <i class="bi bi-house"></i> Adresse
                                    </label>
                                    <input id="address" name="address" type="text" 
                                        class="mt-1 block w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200" 
                                        value="{{ old('address', $student->address) }}" required />
                                    @error('address')
                                        <div class="text-red-500 text-sm mt-2 flex items-center gap-1">
                                            <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Ville -->
                                <div class="bg-white p-4 rounded-xl shadow-sm">
                                    <label for="city" class="block text-sm font-semibold text-indigo-700 mb-2 flex items-center gap-2">
                                        <i class="bi bi-building"></i> Ville
                                    </label>
                                    <input id="city" name="city" type="text" 
                                        class="mt-1 block w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200" 
                                        value="{{ old('city', $student->city) }}" required />
                                    @error('city')
                                        <div class="text-red-500 text-sm mt-2 flex items-center gap-1">
                                            <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Code postal -->
                                <div class="bg-white p-4 rounded-xl shadow-sm">
                                    <label for="postal_code" class="block text-sm font-semibold text-indigo-700 mb-2 flex items-center gap-2">
                                        <i class="bi bi-mailbox"></i> Code postal
                                    </label>
                                    <input id="postal_code" name="postal_code" type="text" 
                                        class="mt-1 block w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200" 
                                        value="{{ old('postal_code', $student->postal_code) }}" required />
                                    @error('postal_code')
                                        <div class="text-red-500 text-sm mt-2 flex items-center gap-1">
                                            <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 justify-end mt-8">
                            <button type="submit" 
                                class="inline-flex items-center px-6 py-3 rounded-xl shadow-lg bg-indigo-600 text-white hover:bg-indigo-700 hover:scale-105 transition-all duration-200 font-semibold text-lg uppercase tracking-widest">
                                <i class="bi bi-save mr-2"></i> Enregistrer
                            </button>
                            <a href="{{ route('students.index') }}" 
                                class="inline-flex items-center px-6 py-3 rounded-xl shadow-lg bg-gray-800 text-white hover:bg-gray-900 hover:scale-105 transition-all duration-200 font-semibold text-lg uppercase tracking-widest">
                                <i class="bi bi-arrow-left mr-2"></i> Annuler
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 