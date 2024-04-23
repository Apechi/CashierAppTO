<?php

namespace App\Livewire\TO\Absensi;

use App\Models\AbsensiKaryawan;
use Livewire\Component;

class Index extends Component
{
    public $nama_karyawan, $tanggal_masuk, $waktu_masuk, $waktu_keluar, $status;
    public $absensiKaryawanid;



    public function resetField()
    {
        $this->nama_karyawan = null;
        $this->tanggal_masuk = null;
        $this->waktu_masuk = null;
        $this->waktu_keluar = null;
        $this->status = null;
    }

    public function store()
    {
        $this->validate([
            'nama_karyawan' => 'required',
            'tanggal_masuk' => 'required|date',
            'waktu_masuk' => 'required',
            'status' => 'required|in:sakit,cuti,masuk',
        ]);

        AbsensiKaryawan::create([
            'namaKaryawan' => $this->nama_karyawan,
            'tanggalMasuk' => $this->tanggal_masuk,
            'waktuMasuk' => $this->waktu_masuk,
            'waktuKeluar' => '00:00:00', // Adjusted to TIME datatype format
            'status' => $this->status,
        ]);

        $this->resetField();
    }

    public function edit($id)
    {
        $absensi = AbsensiKaryawan::findOrFail($id);
        $this->absensiKaryawanid = $id;
        $this->nama_karyawan = $absensi->namaKaryawan;
        $this->tanggal_masuk = $absensi->tanggalMasuk;
        $this->waktu_masuk = $absensi->waktuMasuk;
        $this->waktu_keluar = $absensi->waktuKeluar;
        $this->status = $absensi->status;
    }

    // public function update()
    // {
    //     $this->validate([
    //         'nama_karyawan' => 'required',
    //         'tanggal_masuk' => 'required|date',
    //         'waktu_masuk' => 'required',
    //         'waktu_keluar' => 'required',
    //         'status' => 'required|in:sakit,cuti,masuk',
    //     ]);

    //     if ($this->absensiKaryawanid) {
    //         $absensi = AbsensiKaryawan::find($this->absensiKaryawanid);
    //         $absensi->update([
    //             'namaKaryawan' => $this->nama_karyawan,
    //             'tanggalMasuk' => $this->tanggal_masuk,
    //             'waktuMasuk' => $this->waktu_masuk,
    //             'waktuKeluar' => $this->waktu_keluar,
    //             'status' => $this->status,
    //         ]);
    //     }

    //     $this->resetField();
    // }

    // public function delete($id)
    // {
    //     $absensi = AbsensiKaryawan::findOrFail($id);
    //     $absensi->delete();
    // }

    public function render()
    {
        $this->tanggal_masuk = date('Y-m-d');
        $this->waktu_masuk = now()->format('H:i:s');
        $absensiKaryawan = AbsensiKaryawan::whereDate('tanggalMasuk', now()->toDateString())->get();


        return view('livewire.t-o.absensi.index', compact('absensiKaryawan'));
    }
}
