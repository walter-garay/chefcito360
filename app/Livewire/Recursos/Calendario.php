<?php

namespace App\Livewire\Recursos;

use Carbon\Carbon;
use Livewire\Component;

class Calendario extends Component
{

    public $currentMonth;
    public $currentYear;
    public $daysInMonth;
    public $firstDayOfMonth;

    public function mount()
    {
        // Inicializa el calendario con el mes y año actual
        $this->currentMonth = Carbon::now()->month;
        $this->currentYear = Carbon::now()->year;
        $this->updateCalendar();
    }

    public function updateCalendar()
    {
        // Obtiene la cantidad de días en el mes actual y el primer día de la semana
        $date = Carbon::create($this->currentYear, $this->currentMonth, 1);
        $this->daysInMonth = $date->daysInMonth;
        $this->firstDayOfMonth = $date->dayOfWeek;
    }

    public function previousMonth()
    {
        // Mueve al mes anterior
        $this->currentMonth--;
        if ($this->currentMonth < 1) {
            $this->currentMonth = 12;
            $this->currentYear--;
        }
        $this->updateCalendar();
    }

    public function nextMonth()
    {
        // Mueve al mes siguiente
        $this->currentMonth++;
        if ($this->currentMonth > 12) {
            $this->currentMonth = 1;
            $this->currentYear++;
        }
        $this->updateCalendar();
    }

    public function render()
    {
        return view('livewire.recursos.calendario');
    }
}
