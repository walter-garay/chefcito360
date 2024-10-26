<div>
    <div class="p-4 bg-white rounded-lg shadow-lg">
        <h2 class="mb-4 text-xl font-semibold">Calendario</h2>

        <!-- Controles de navegación -->
        <div class="flex items-center justify-between mb-4">
            <button wire:click="previousMonth" class="px-2 py-1 text-white bg-blue-500 rounded-lg"><</button>
            <span class="text-lg">{{ \Carbon\Carbon::create($currentYear, $currentMonth)->format('F Y') }}</span>
            <button wire:click="nextMonth" class="px-2 py-1 text-white bg-blue-500 rounded-lg">></button>
        </div>

        <!-- Nombres de los días de la semana -->
        <div class="grid grid-cols-7 gap-2 font-semibold text-center">
            <div class="p-2">L</div>
            <div class="p-2">M</div>
            <div class="p-2">M</div>
            <div class="p-2">J</div>
            <div class="p-2">V</div>
            <div class="p-2">S</div>
            <div class="p-2">D</div>
        </div>

        <!-- Días del mes -->
        <div class="grid grid-cols-7 gap-2 text-center">
            <!-- Días vacíos antes del primer día del mes -->
            @for($i = 0; $i < $firstDayOfMonth; $i++)
                <div class="p-2"></div>
            @endfor

            <!-- Días del mes -->
            @for($day = 1; $day <= $daysInMonth; $day++)
                <div class="p-2 rounded-lg
                    {{ $day == now()->day && $currentMonth == now()->month && $currentYear == now()->year ? 'bg-blue-200' : 'bg-gray-100' }}">
                    {{ $day }}
                </div>
            @endfor
        </div>
    </div>
</div>
