<?php

namespace App\Http\Controllers;

use App\Models\AbsensiKaryawan;
use App\Http\Requests\StoreAbsensiKaryawanRequest;
use App\Http\Requests\UpdateAbsensiKaryawanRequest;

class AbsensiKaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('app.absensiKaryawan.index');
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
    public function store(StoreAbsensiKaryawanRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AbsensiKaryawan $absensiKaryawan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AbsensiKaryawan $absensiKaryawan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAbsensiKaryawanRequest $request, AbsensiKaryawan $absensiKaryawan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($absensiKaryawan)
    {
        $absensiKaryawan = AbsensiKaryawan::findOrFail($absensiKaryawan);

        $absensiKaryawan->delete();

        return redirect()
            ->route('absensi.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
