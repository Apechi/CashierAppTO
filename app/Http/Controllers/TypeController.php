<?php

namespace App\Http\Controllers;

use App\Exports\MenuTypeExport;
use App\Models\Type;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\TypeStoreRequest;
use App\Http\Requests\TypeUpdateRequest;
use App\Imports\MenuTypeImport;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $this->authorize('view-any', Type::class);


        $types = Type::latest()->get();

        return view('app.types.index', compact('types'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $this->authorize('create', Type::class);


        $categories = Category::pluck('name', 'id');

        return view('app.types.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TypeStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Type::class);

        $validated = $request->validated();

        $type = Type::create($validated);

        return redirect()
            ->route('types.index')
            ->withSuccess('Tipe Category Berhasil Di Tambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Type $type): View
    {
        $this->authorize('view', $type);

        return view('app.types.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Type $type)
    {
        $this->authorize('update', $type);


        $categories = Category::pluck('name', 'id');

        return view('app.types.edit', compact('type', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        TypeUpdateRequest $request,
        Type $type
    ): RedirectResponse {
        $this->authorize('update', $type);

        $validated = $request->validated();

        $type->update($validated);

        return redirect()
            ->route('types.edit', $type)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Type $type): RedirectResponse
    {
        $this->authorize('delete', $type);

        $type->delete();

        return redirect()
            ->route('types.index')
            ->withSuccess(__('crud.common.removed'));
    }

    public function exportExcel()
    {
        return Excel::download(new MenuTypeExport, date('Ymd') . ' tipe.xlsx');
    }

    public function exportpdf()
    {
        $data = Type::all();
        $pdf = Pdf::loadView('app.types.pdf', compact('data'));
        return $pdf->download('type.pdf');
    }

    public function import()
    {
        Excel::import(new MenuTypeImport(), request()->file('file'));
        return redirect(route('types.index'))->with('success', 'Berhasil di Import');
    }
}
