<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Transaction;
use Illuminate\Http\Request;

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
}
