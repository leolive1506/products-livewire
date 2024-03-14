<?php

namespace App\Livewire\Customer\Product\Cart;

use App\Models\Cart;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class Icon extends Component
{
    public function render()
    {
        return view('livewire.customer.product.cart.icon');
    }

    #[On('add-product-to-cart')]
    #[Computed()]
    public function productsAmount()
    {
        return Cart::count();
    }
}
