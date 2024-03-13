<?php

namespace App\Http\Controllers;

use App\Exports\ListTransactionExport;
use App\Models\Booking;
use App\Models\Laporan;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('view-any', Transaction::class);
        return view('app.transaction.index');
    }


    public function laporan()
    {
        $this->authorize('view-any', Laporan::class);
        return view('app.transaction.laporan');
    }


    public function notaFaktur($id)
    {
        $data = Transaction::findOrFail($id);

        return view('app.transaction.invoice', compact('data'));
    }

    public function listTransaksi()
    {
        $this->authorize('view-any', Transaction::class);

        $transactions = Transaction::latest()->get();

        return view('app.transaction.list', compact('transactions'));
    }

    public function show($id)
    {
        $this->authorize('view-any', Transaction::class);

        $transaction = Transaction::findOrFail($id);

        return view('app.transaction.show', compact('transaction'));
    }

    public function exportpdf()
    {

        $data = Transaction::latest()->get();

        $pdf = Pdf::loadView('app.transaction.pdf', compact('data'));

        return $pdf->download('transaction.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(new ListTransactionExport, date('Ymd') . ' transaksi.xlsx');
    }
}
