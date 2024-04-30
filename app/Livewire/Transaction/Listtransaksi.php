<?php

namespace App\Livewire\Transaction;

use App\Models\Menu;
use App\Models\Transaction;
use Livewire\Component;
use Livewire\WithPagination;

class Listtransaksi extends Component
{
    use WithPagination;

    public $tanggal, $metode_pembayaran, $menu;
    public $transactions = [];

    public function cek()
    {
        if ($this->metode_pembayaran === 'Pilih Filter') {
            $this->metode_pembayaran = null;
        }

        if ($this->menu === 'Pilih Menu') {
            $this->menu = null;
        }

        $query = Transaction::query();


        if ($this->tanggal) {
            $query->whereDate('date', $this->tanggal);
        }


        if ($this->metode_pembayaran != null) {
            $query->where('payment_method', $this->metode_pembayaran);
        }


        if ($this->menu) {
            $query->whereHas('transactionDetails', function ($query) {
                $query->where('menu_id', $this->menu);
            });
        }

        $this->transactions = $query->get();
        // $this->dispatch('reinitialize-datatable');
    }


    public function mount()
    {
        $this->transactions = Transaction::latest()->get();
    }

    public function render()
    {


        $list_menu = Menu::pluck('name', 'id');


        return view('livewire.transaction.listtransaksi', compact('list_menu'));
    }
}
