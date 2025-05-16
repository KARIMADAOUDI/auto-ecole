<div class="bg-white rounded-lg shadow p-6">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg font-semibold text-gray-800">Calendrier des Leçons</h2>
        <div class="flex space-x-2">
            <button wire:click="previousMonth" class="px-3 py-1 text-sm text-gray-600 hover:text-gray-800">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <span class="px-3 py-1 text-sm font-medium text-gray-800">
                {{ \Carbon\Carbon::create($currentYear, $currentMonth, 1)->format('F Y') }}
            </span>
            <button wire:click="nextMonth" class="px-3 py-1 text-sm text-gray-600 hover:text-gray-800">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </div>

    <div class="grid grid-cols-7 gap-1">
        @foreach(['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'] as $day)
        <div class="text-center text-sm font-medium text-gray-600 py-2">
            {{ $day }}
        </div>
        @endforeach

        @php
            $firstDayOfMonth = \Carbon\Carbon::create($currentYear, $currentMonth, 1);
            $lastDayOfMonth = $firstDayOfMonth->copy()->endOfMonth();
            $firstDayOfWeek = $firstDayOfMonth->dayOfWeek;
            $lastDayOfWeek = $lastDayOfMonth->dayOfWeek;
        @endphp

        @for($i = 0; $i < $firstDayOfWeek; $i++)
            <div class="h-24 bg-gray-50 rounded"></div>
        @endfor

        @for($day = 1; $day <= $lastDayOfMonth->day; $day++)
            @php
                $date = \Carbon\Carbon::create($currentYear, $currentMonth, $day)->format('Y-m-d');
                $dayLessons = $lessons[$date] ?? [];
            @endphp
            <div class="h-24 bg-white border rounded p-1 overflow-y-auto">
                <div class="text-sm font-medium text-gray-800">{{ $day }}</div>
                @foreach($dayLessons as $lesson)
                    <div class="text-xs mt-1 p-1 rounded {{ $lesson['status'] === 'completed' ? 'bg-green-100 text-green-800' : ($lesson['status'] === 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800') }}">
                        <div class="font-medium">{{ $lesson['student']['first_name'] }} {{ $lesson['student']['last_name'] }}</div>
                        <div>{{ \Carbon\Carbon::parse($lesson['start_time'])->format('H:i') }}</div>
                        <div class="text-xs">{{ $lesson['type'] }}</div>
                    </div>
                @endforeach
            </div>
        @endfor

        @for($i = $lastDayOfWeek; $i < 6; $i++)
            <div class="h-24 bg-gray-50 rounded"></div>
        @endfor
    </div>
</div> 