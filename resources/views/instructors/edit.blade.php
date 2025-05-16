<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-indigo-800 leading-tight flex items-center gap-2">
            <i class="bi bi-person-badge"></i> {{ __('Modifier un Moniteur') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-8 lg:px-16">
            <div class="bg-white overflow-hidden shadow-2xl rounded-3xl border border-gray-100">
                <div class="p-12 text-gray-900 text-lg">
                    <form method="POST" action="{{ route('instructors.update', $instructor) }}" class="space-y-8">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Prénom -->
                            <div>
                                <label for="first_name" class="block text-sm font-semibold text-indigo-700 mb-1">Prénom</label>
                                <input id="first_name" name="first_name" type="text" class="mt-1 block w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm" value="{{ old('first_name', $instructor->first_name) }}" required autofocus />
                                @error('first_name')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
                            </div>
                            <!-- Nom -->
                            <div>
                                <label for="last_name" class="block text-sm font-semibold text-indigo-700 mb-1">Nom</label>
                                <input id="last_name" name="last_name" type="text" class="mt-1 block w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm" value="{{ old('last_name', $instructor->last_name) }}" required />
                                @error('last_name')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
                            </div>
                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-semibold text-indigo-700 mb-1">Email</label>
                                <input id="email" name="email" type="email" class="mt-1 block w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm" value="{{ old('email', $instructor->email) }}" required />
                                @error('email')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
                            </div>
                            <!-- Téléphone -->
                            <div>
                                <label for="phone" class="block text-sm font-semibold text-indigo-700 mb-1">Téléphone</label>
                                <input id="phone" name="phone" type="text" class="mt-1 block w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm" value="{{ old('phone', $instructor->phone) }}" required />
                                @error('phone')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
                            </div>
                            <!-- Numéro de licence -->
                            <div>
                                <label for="license_number" class="block text-sm font-semibold text-indigo-700 mb-1">Numéro de licence</label>
                                <input id="license_number" name="license_number" type="text" class="mt-1 block w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm" value="{{ old('license_number', $instructor->license_number) }}" required />
                                @error('license_number')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
                            </div>
                            <!-- Statut -->
                            <div>
                                <label for="status" class="block text-sm font-semibold text-indigo-700 mb-1">Statut</label>
                                <select id="status" name="status" class="mt-1 block w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                                    <option value="active" {{ old('status', $instructor->status) === 'active' ? 'selected' : '' }}>Actif</option>
                                    <option value="inactive" {{ old('status', $instructor->status) === 'inactive' ? 'selected' : '' }}>Inactif</option>
                                    <option value="on_leave" {{ old('status', $instructor->status) === 'on_leave' ? 'selected' : '' }}>En congé</option>
                                </select>
                                @error('status')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="flex items-center gap-4 justify-end mt-8">
                            <button type="submit" class="inline-flex items-center px-6 py-2 rounded-full shadow bg-indigo-600 text-white hover:bg-indigo-700 hover:scale-105 transition-all duration-200 font-semibold text-lg uppercase tracking-widest">
                                <i class="bi bi-save mr-2"></i> Enregistrer
                            </button>
                            <a href="{{ route('instructors.index') }}" class="inline-flex items-center px-6 py-2 rounded-full shadow bg-gray-800 text-white hover:bg-gray-900 hover:scale-105 transition-all duration-200 font-semibold text-lg uppercase tracking-widest">
                                <i class="bi bi-arrow-left mr-2"></i> Annuler
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 