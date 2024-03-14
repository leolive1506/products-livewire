<?php

namespace App\Livewire\Customer\Product\Cart;

use App\Models\Cart;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Icon extends Component
{
    public function render()
    {
        return view('livewire.customer.product.cart.icon');
    }

    #[Computed()]
    public function productsAmount()
    {
        return Cart::count();
    }
}
