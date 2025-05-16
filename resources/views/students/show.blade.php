<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Détail de l\'élève') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-12 lg:px-20">
            <!-- Statistiques -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow p-6 border border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total des leçons</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $student->lessons->count() }}</p>
                        </div>
                        <div class="p-3 bg-gray-100 rounded-full">
                            <i class="bi bi-calendar-check text-2xl text-gray-600"></i>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow p-6 border border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Leçons complétées</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $student->lessons->where('status', 'completed')->count() }}</p>
                        </div>
                        <div class="p-3 bg-gray-100 rounded-full">
                            <i class="bi bi-check-circle text-2xl text-gray-600"></i>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow p-6 border border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total des paiements</p>
                            <p class="text-2xl font-bold text-gray-800">{{ number_format($student->payments->sum('amount'), 2) }} DH</p>
                        </div>
                        <div class="p-3 bg-gray-100 rounded-full">
                            <i class="bi bi-cash-stack text-2xl text-gray-600"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-lg rounded-lg border border-gray-200">
                <div class="p-8 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h3 class="text-xl font-semibold text-gray-800 mb-6 flex items-center gap-2">
                                <i class="bi bi-person-badge"></i> Informations personnelles
                            </h3>
                            <dl class="mt-4 grid grid-cols-1 gap-4">
                                <div class="bg-white p-4 rounded-lg shadow-sm">
                                    <dt class="text-sm font-medium text-gray-500">Nom complet</dt>
                                    <dd class="mt-1 text-lg font-semibold text-gray-800">{{ $student->first_name }} {{ $student->last_name }}</dd>
                                </div>
                                <div class="bg-white p-4 rounded-lg shadow-sm">
                                    <dt class="text-sm font-medium text-gray-500">Email</dt>
                                    <dd class="mt-1 text-lg font-semibold text-gray-800">{{ $student->email }}</dd>
                                </div>
                                <div class="bg-white p-4 rounded-lg shadow-sm">
                                    <dt class="text-sm font-medium text-gray-500">Téléphone</dt>
                                    <dd class="mt-1 text-lg font-semibold text-gray-800">{{ $student->phone }}</dd>
                                </div>
                                <div class="bg-white p-4 rounded-lg shadow-sm">
                                    <dt class="text-sm font-medium text-gray-500">Date de naissance</dt>
                                    <dd class="mt-1 text-lg font-semibold text-gray-800">{{ $student->birth_date->format('d/m/Y') }}</dd>
                                </div>
                            </dl>
                        </div>

                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h3 class="text-xl font-semibold text-gray-800 mb-6 flex items-center gap-2">
                                <i class="bi bi-geo-alt"></i> Adresse
                            </h3>
                            <dl class="mt-4 grid grid-cols-1 gap-4">
                                <div class="bg-white p-4 rounded-lg shadow-sm">
                                    <dt class="text-sm font-medium text-gray-500">Adresse</dt>
                                    <dd class="mt-1 text-lg font-semibold text-gray-800">{{ $student->address }}</dd>
                                </div>
                                <div class="bg-white p-4 rounded-lg shadow-sm">
                                    <dt class="text-sm font-medium text-gray-500">Ville</dt>
                                    <dd class="mt-1 text-lg font-semibold text-gray-800">{{ $student->city }}</dd>
                                </div>
                                <div class="bg-white p-4 rounded-lg shadow-sm">
                                    <dt class="text-sm font-medium text-gray-500">Code postal</dt>
                                    <dd class="mt-1 text-lg font-semibold text-gray-800">{{ $student->postal_code }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h3 class="text-xl font-semibold text-gray-800 mb-6 flex items-center gap-2">
                            <i class="bi bi-calendar-event"></i> Leçons
                        </h3>
                        <div class="mt-4 overflow-x-auto rounded-lg shadow">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Moniteur</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Véhicule</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse ($student->lessons as $lesson)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">{{ $lesson->start_time->format('d/m/Y') }}</div>
                                                <div class="text-sm text-gray-500">{{ $lesson->start_time->format('H:i') }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10">
                                                        <div class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center">
                                                            <i class="bi bi-person text-gray-600"></i>
                                                        </div>
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ $lesson->instructor->first_name }} {{ $lesson->instructor->last_name }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($lesson->vehicle)
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 h-10 w-10">
                                                            <div class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center">
                                                                <i class="bi bi-car-front text-gray-600"></i>
                                                            </div>
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">
                                                                {{ $lesson->vehicle->brand }} {{ $lesson->vehicle->model }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <span class="text-gray-400">-</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full 
                                                    @if($lesson->status === 'completed') bg-gray-100 text-gray-800
                                                    @elseif($lesson->status === 'cancelled') bg-gray-100 text-gray-800
                                                    @else bg-gray-100 text-gray-800 @endif">
                                                    @if($lesson->status === 'completed')
                                                        <i class="bi bi-check-circle mr-1"></i>
                                                    @elseif($lesson->status === 'cancelled')
                                                        <i class="bi bi-x-circle mr-1"></i>
                                                    @else
                                                        <i class="bi bi-clock mr-1"></i>
                                                    @endif
                                                    {{ ucfirst($lesson->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
                                                <div class="flex flex-col items-center justify-center py-8">
                                                    <i class="bi bi-calendar-x text-4xl text-gray-400 mb-2"></i>
                                                    <p>Aucune leçon programmée</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h3 class="text-xl font-semibold text-gray-800 mb-6 flex items-center gap-2">
                            <i class="bi bi-cash-coin"></i> Paiements
                        </h3>
                        <div class="mt-4 overflow-x-auto rounded-lg shadow">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Montant</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Méthode</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse ($student->payments as $payment)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">{{ $payment->payment_date->format('d/m/Y') }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">{{ number_format($payment->amount, 2) }} DH</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10">
                                                        <div class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center">
                                                            @if($payment->payment_method === 'card')
                                                                <i class="bi bi-credit-card text-gray-600"></i>
                                                            @elseif($payment->payment_method === 'cash')
                                                                <i class="bi bi-cash text-gray-600"></i>
                                                            @else
                                                                <i class="bi bi-bank text-gray-600"></i>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ ucfirst($payment->payment_method) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                    @if($payment->status === 'completed')
                                                        <i class="bi bi-check-circle mr-1"></i>
                                                    @elseif($payment->status === 'failed')
                                                        <i class="bi bi-x-circle mr-1"></i>
                                                    @else
                                                        <i class="bi bi-clock mr-1"></i>
                                                    @endif
                                                    {{ ucfirst($payment->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
                                                <div class="flex flex-col items-center justify-center py-8">
                                                    <i class="bi bi-cash-stack text-4xl text-gray-400 mb-2"></i>
                                                    <p>Aucun paiement enregistré</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- État des paiements -->
                    <div class="mt-8 bg-white rounded-lg shadow p-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-6">État des paiements</h3>
                        
                        <div class="mb-6">
                            <div class="flex justify-between mb-2">
                                <span class="text-sm font-medium text-gray-700">Progression</span>
                                <span class="text-sm font-medium text-gray-700">
                                    {{ number_format(($student->paid_amount / $student->total_amount) * 100, 0) }}%
                                </span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-gray-600 h-2 rounded-full" style="width: {{ ($student->paid_amount / $student->total_amount) * 100 }}%"></div>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <p class="text-sm text-gray-600">Montant total</p>
                                <p class="text-lg font-semibold text-gray-800">{{ number_format($student->total_amount, 2) }} DH</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Montant payé</p>
                                <p class="text-lg font-semibold text-gray-800">{{ number_format($student->paid_amount, 2) }} DH</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Reste à payer</p>
                                <p class="text-lg font-semibold text-gray-800">{{ number_format($student->total_amount - $student->paid_amount, 2) }} DH</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Statut</p>
                                <p class="text-lg font-semibold {{ $student->is_paid ? 'text-gray-800' : 'text-gray-600' }}">
                                    {{ $student->is_paid ? 'Payé' : 'En cours' }}
                                </p>
                            </div>
                        </div>

                        @if(!$student->is_paid)
                            <div class="mt-6">
                                <a href="{{ route('payments.create', ['student_id' => $student->id]) }}" 
                                   class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                    <i class="bi bi-plus-circle mr-2"></i> Ajouter un paiement
                                </a>
                            </div>
                        @endif
                    </div>

                    <div class="mt-8 flex flex-wrap items-center gap-4 justify-end">
                        <a href="{{ route('students.edit', $student) }}"
                           class="inline-flex items-center px-6 py-3 rounded-md shadow bg-gray-800 text-white hover:bg-gray-700 transition-colors duration-200 font-semibold text-sm uppercase tracking-widest"
                           title="Modifier">
                            <i class="bi bi-pencil-square mr-2"></i> Modifier
                        </a>
                        <a href="{{ route('students.index') }}"
                           class="inline-flex items-center px-6 py-3 rounded-md shadow bg-gray-600 text-white hover:bg-gray-700 transition-colors duration-200 font-semibold text-sm uppercase tracking-widest"
                           title="Retour à la liste">
                            <i class="bi bi-arrow-left mr-2"></i> Retour à la liste
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 