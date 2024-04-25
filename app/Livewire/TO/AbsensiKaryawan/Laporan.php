<?php

namespace App\Livewire\TO\AbsensiKaryawan;

use App\Models\Absensi;
use Livewire\Component;

class Laporan extends Component
{

    public $start_date, $end_date;

    public $cuti;
    public $sakit;
    public $masuk;

    public $data_laporan_absensi = [];


    public function getLaporan()
    {
        $this->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ], [
            'end_date.after_or_equal' => 'The end date must be after or equal to the start date.',
        ]);

        $data_laporan = Absensi::whereBetween('tanggalMasuk', [$this->start_date, $this->end_date]);

        $this->data_laporan_absensi = $data_laporan->get();

        $this->count_kehadiran($data_laporan);
    }

    public function count_kehadiran($data_laporan)
    {
        $statusCounts = $data_laporan->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        $this->sakit = $statusCounts->get('sakit', 0);
        $this->cuti = $statusCounts->get('cuti', 0);
        $this->masuk = $statusCounts->get('masuk', 0);
    }



    public function render()
    {
        return view('livewire.t-o.absensi-karyawan.laporan');
    }
}
