<?php

namespace App\Livewire\Transaction;

use App\Models\Transaction;
use Livewire\Component;

class Laporan extends Component
{

    public $start_date, $end_date;
    public $data_laporan = [];


    public function getLaporan()
    {
        $this->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ], [
            'end_date.after_or_equal' => 'The end date must be after or equal to the start date.',
        ]);

        $this->data_laporan = Transaction::whereBetween('date', [$this->start_date, $this->end_date])->get();
    }


    public function render()
    {
        return view('livewire.transaction.laporan');
    }
}
