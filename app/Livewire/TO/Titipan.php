<?php

namespace App\Livewire\TO;

use App\Models\ProdukTitipan;
use Livewire\Component;

class Titipan extends Component
{
    public function render()
    {
        $produkTitipan = ProdukTitipan::all();

        return view('livewire.t-o.titipan', compact('produkTitipan'));
    }
}
