<?php

namespace App\Http\Controllers;

use App\Exports\ProdukTitipanExport;
use App\Models\ProdukTitipan;
use App\Http\Requests\StoreProdukTitipanRequest;
use App\Http\Requests\UpdateProdukTitipanRequest;
use App\Imports\MenuTypeImport;
use App\Imports\ProdukTitipanImport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Client\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProdukTitipanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('app.titipan.index');
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
    public function store(StoreProdukTitipanRequest $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(ProdukTitipan $produkTitipan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProdukTitipan $produkTitipan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProdukTitipanRequest $request, ProdukTitipan $produkTitipan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($produkTitipan)
    {
        $produkTitipan = ProdukTitipan::findOrFail($produkTitipan);

        $produkTitipan->delete();

        return redirect()
            ->route('titipan.index')
            ->withSuccess(__('crud.common.removed'));
    }

    public function export()
    {
        return Excel::download(new ProdukTitipanExport, 'titipan.xlsx');
    }

    public function exportpdf()
    {
        $data = ProdukTitipan::all();
        $pdf = Pdf::loadView('livewire.t-o.pdf', compact('data'));
        return $pdf->download('titipan.pdf');
    }

    public function import()
    {

        Excel::import(new ProdukTitipanImport(), request()->file('file'));
        return redirect(route('titipan.index'))->with('success', 'Berhasil di Import');
    }
}
