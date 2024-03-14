<?php

namespace App\Livewire\Admin\Product;

use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.admin.product.index');
    }

    #[Computed()]
    public function products()
    {
        return Product::all();
    }
}
