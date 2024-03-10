<?php

namespace App\Exports;

use App\Models\Transaction;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ListTransactionExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Transaction::all()->map(function ($transaction) {
            return [
                'No Faktur' => $transaction->id,
                'Tanggal' => $transaction->date,
                'Total Harga' => $transaction->total_price,
                'Metode Pembayaran' => $transaction->payment_method,
                'Keterangan' => $transaction->keterangan,
                'Nama Pelanggan' => $transaction->customer->name,
            ];
        });
    }

    /**
     * Customize the headers for the export.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'No Faktur',
            'Tanggal',
            'Total Harga',
            'Metode Pembayaran',
            'Keterangan',
            'Nama Pelanggan',
        ];
    }
}
