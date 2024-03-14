<?php

namespace App\Livewire\Customer\Product;

use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Index extends Component
{
    #[Layout('layouts.app')] 
    public function render()
    {
        return view('livewire.customer.product.index');
    }

    #[Computed]
    public function products()
    {
        return Product::all();
    }
}
