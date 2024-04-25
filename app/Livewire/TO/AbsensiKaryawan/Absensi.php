<?php

namespace App\Livewire\TO\AbsensiKaryawan;

use App\Models\Absensi as ModelsAbsensi;
use Livewire\Component;

class Absensi extends Component
{
    public $nama_karyawan, $tanggal_masuk, $waktu_masuk, $waktu_keluar, $status;

    public $waktu_masukEd;
    public $absensiid;



    public function updateStatus($absensiId, $value)
    {


        ModelsAbsensi::where('id', $absensiId)->update([
            'status' => $value,
        ]);

        $waktuKeluar = ($value === 'masuk') ? 'Selesai' : '00:00:00';

        if ($value === 'sakit' || $value === 'cuti') {
            ModelsAbsensi::where('id', $absensiId)->update([
                'waktuKeluar' => '00:00:00',
            ]);
        }

        redirect(route('absensi.index'));
    }

    public function updateWaktuKeluar($absensiId)
    {

        ModelsAbsensi::where('id', $absensiId)->update([
            'waktuKeluar' => now()->format('H:i:s')
        ]);

        redirect(route('absensi.index'));
    }


    public function clearInput()
    {
        $this->nama_karyawan = '';
        $this->tanggal_masuk = '';
        $this->waktu_masuk = '';
        $this->waktu_keluar = '';
        $this->status = '';
    }


    public function edit($absensiId)
    {
        $absensi = ModelsAbsensi::find($absensiId);
        $this->absensiid = $absensi->id;
        $this->nama_karyawan = $absensi->namaKaryawan;
        $this->tanggal_masuk = $absensi->tanggalMasuk;
        $this->waktu_masukEd = $absensi->waktuMasuk;
        $this->waktu_keluar = $absensi->waktuKeluar;
        $this->status = $absensi->status;
    }

    public function update()
    {
        $rules = [
            'nama_karyawan' => 'required',
            'tanggal_masuk' => 'required',
            'waktu_masukEd' => 'required',
            'waktu_keluar' => 'required',
            'status' => 'required|in:sakit,cuti,masuk',
        ];


        $this->validate($rules);

        $absensiKaryawan = ModelsAbsensi::findOrFail($this->absensiid);



        $absensiKaryawan->update([
            'namaKaryawan' => $this->nama_karyawan,
            'tanggalMasuk' => $this->tanggal_masuk,
            'waktuMasuk' => $this->waktu_masukEd,
            'waktuKeluar' => $this->waktu_keluar,
            'status' => $this->status,
        ]);

        $this->clearInput();
        redirect(route('absensi.index'));
    }

    public function store()
    {

        $rules = [
            'nama_karyawan' => 'required',
            'tanggal_masuk' => 'required',
            'waktu_masuk' => 'required',
            'status' => 'required|in:sakit,cuti,masuk',
        ];


        $this->validate($rules);

        ModelsAbsensi::create([
            'namaKaryawan' => $this->nama_karyawan,
            'tanggalMasuk' => $this->tanggal_masuk,
            'waktuMasuk' => $this->waktu_masuk,
            'waktuKeluar' => '00:00:00',
            'status' => $this->status,
        ]);

        $this->clearInput();
        redirect(route('absensi.index'));
    }

    public function render()
    {


        $absensiKaryawan = ModelsAbsensi::all();


        $this->tanggal_masuk = date('Y-m-d');
        $this->waktu_masuk = now()->format('H:i:s');

        return view('livewire.t-o.absensi-karyawan.absensi', compact('absensiKaryawan'));
    }
}
