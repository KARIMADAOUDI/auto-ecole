<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-indigo-800 leading-tight flex items-center gap-2">
                <i class="bi bi-cash-stack"></i> {{ __('Paiements') }}
            </h2>
            <div class="flex items-center gap-4">
                <span class="text-sm font-medium text-indigo-600 bg-indigo-50 px-4 py-2 rounded-full">
                    Total: {{ number_format($totalAmount, 2) }} DH
                </span>
                <a href="{{ route('payments.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all duration-200 shadow">
                    <i class="bi bi-plus-circle mr-2"></i> Nouveau paiement
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-2xl rounded-3xl border border-gray-100">
                <div class="p-8 text-gray-900">
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @php
                        $groupedPayments = $payments->groupBy('student_id');
                    @endphp

                    @foreach($groupedPayments as $studentId => $studentPayments)
                        <div class="mb-8 bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                            <div class="bg-indigo-50 px-6 py-4 border-b border-gray-200">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-12 w-12">
                                            <div class="h-12 w-12 rounded-full bg-indigo-100 flex items-center justify-center">
                                                <i class="bi bi-person text-2xl text-indigo-600"></i>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <h3 class="text-lg font-semibold text-indigo-900">
                                                {{ $studentPayments->first()->student->first_name }} {{ $studentPayments->first()->student->last_name }}
                                            </h3>
                                            <div class="text-sm text-indigo-600">
                                                Type de permis: {{ $studentPayments->first()->student->license_type }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-sm font-medium text-indigo-900">
                                            Total payé: {{ number_format($studentPayments->sum('amount'), 2) }} DH
                                        </div>
                                        <div class="text-sm text-indigo-600">
                                            {{ $studentPayments->count() }} paiement(s)
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date</th>
                                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Montant</th>
                                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Méthode</th>
                                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Référence</th>
                                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Notes</th>
                                            <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($studentPayments as $payment)
                                            <tr class="hover:bg-gray-50 transition-all">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ $payment->payment_date->format('d/m/Y') }}</div>
                                                    <div class="text-sm text-gray-500">{{ $payment->payment_date->format('H:i') }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-medium text-gray-900">{{ number_format($payment->amount, 2) }} DH</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 h-8 w-8">
                                                            <div class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center">
                                                                @if($payment->payment_method === 'credit_card')
                                                                    <i class="bi bi-credit-card text-indigo-600"></i>
                                                                @elseif($payment->payment_method === 'cash')
                                                                    <i class="bi bi-cash text-indigo-600"></i>
                                                                @elseif($payment->payment_method === 'bank_transfer')
                                                                    <i class="bi bi-bank text-indigo-600"></i>
                                                                @else
                                                                    <i class="bi bi-check2-square text-indigo-600"></i>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="ml-3">
                                                            <div class="text-sm font-medium text-gray-900">
                                                                {{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ $payment->reference ?? '-' }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ Str::limit($payment->notes, 50) ?? '-' }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex items-center gap-2 justify-end">
                                                    <a href="{{ route('payments.show', $payment) }}"
                                                       class="inline-flex items-center px-3 py-1 rounded-full border border-blue-600 text-blue-600 hover:bg-blue-50 hover:scale-105 transition-all duration-200"
                                                       title="Afficher">
                                                        <i class="bi bi-eye mr-1"></i> Afficher
                                                    </a>
                                                    <a href="{{ route('payments.edit', $payment) }}" 
                                                       class="inline-flex items-center px-3 py-1 rounded-full border border-yellow-500 text-yellow-500 hover:bg-yellow-50 hover:scale-105 transition-all duration-200"
                                                       title="Modifier">
                                                        <i class="bi bi-pencil-square mr-1"></i> Modifier
                                                    </a>
                                                    <form action="{{ route('payments.destroy', $payment) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                            class="inline-flex items-center px-3 py-1 rounded-full border border-red-600 text-red-600 hover:bg-red-50 hover:scale-105 transition-all duration-200"
                                                            title="Supprimer"
                                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce paiement ?')">
                                                            <i class="bi bi-trash3 mr-1"></i> Supprimer
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach

                    <div class="mt-6">
                        {{ $payments->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 