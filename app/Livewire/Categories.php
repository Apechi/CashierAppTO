<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Categories extends Component
{

    use WithPagination;



    public $name = '';
    public $icon = '';
    public $categories_id = 0;


    public function resetField()
    {
        $this->name = '';
        $this->icon = '';
        $this->categories_id = '';
    }


    public function render()
    {
        $categories = Category::latest()->get();

        return view('livewire.categories', compact('categories'));
    }



    public function edit($id)
    {



        $categories = Category::findOrFail($id);

        $this->categories_id = $categories->id;
        $this->name = $categories->name;
        $this->icon = $categories->icon;
    }
}
