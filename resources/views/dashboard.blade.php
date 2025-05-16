<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Overview -->
            @livewire('dashboard.stats-overview')

            <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Lessons Chart -->
                @livewire('dashboard.lessons-chart')

                <!-- Financial Chart -->
                @livewire('dashboard.financial-chart')
            </div>

            <div class="mt-8">
                <!-- Lessons Calendar -->
                @livewire('dashboard.lessons-calendar')
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @endpush
</x-app-layout>
