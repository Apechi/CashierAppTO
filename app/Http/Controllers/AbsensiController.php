<?php

namespace App\Http\Controllers;

use App\Exports\AbsensiKaryawanExport;
use App\Models\Absensi;
use App\Http\Requests\StoreAbsensiRequest;
use App\Http\Requests\UpdateAbsensiRequest;
use App\Imports\AbsensiKaryawanImport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('app.karyawan_absensi.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAbsensiRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Absensi $absensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Absensi $absensi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAbsensiRequest $request, Absensi $absensi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($absensi)
    {
        $absensiKaryawan = Absensi::findOrFail($absensi);

        $absensiKaryawan->delete();

        return redirect()
            ->route('absensi.index')
            ->withSuccess(__('crud.common.removed'));
    }


    public function laporan()
    {

        return view('app.karyawan_absensi.laporan');
    }

    public function exportExcel()
    {
        $now = date('Ymd');
        return Excel::download(new AbsensiKaryawanExport, "laporan-absensi-{$now}.xlsx");
    }

    public function import()
    {
        try {
            $file = request()->file('file');

            if (!$file) {
                throw new \Exception('Tidak ada file');
            }


            $tes = Excel::import(new AbsensiKaryawanImport(), $file);



            return redirect(route('absensi.index'))->with('success', 'Berhasil di Import');
        } catch (\Exception $e) {
            // Handle any exceptions that occurred during the import process
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function exportpdf()
    {
        $now = date('Ymd');
        $data = Absensi::latest()->get();
        $pdf = Pdf::loadView('app.karyawan_absensi.pdf', compact('data'));
        return $pdf->download("laporan-absensi-{$now}.pdf");
    }

    public function exportLaporan($start, $end)
    {
        $data_laporan = Absensi::whereBetween('tanggalMasuk', [$start, $end]);

        $laporan = $data_laporan->get();

        $statusCounts = $data_laporan->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        $sakit = $statusCounts->get('sakit', 0);
        $cuti = $statusCounts->get('cuti', 0);
        $masuk = $statusCounts->get('masuk', 0);

        $start_date = date('d-m-Y', strtotime($start));
        $end_date = date('d-m-Y', strtotime($end));

        $pdf = Pdf::loadView('app.karyawan_absensi.laporanpdf', compact('laporan', 'sakit', 'cuti', 'masuk', 'start_date', 'end_date'));

        return $pdf->download("Laporan Karyawan Tanggal " . date('d-m-Y'));
    }
}
