<?php

namespace App\Livewire\Customer\Product;

use App\Models\Cart;
use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.customer.product.index');
    }

    #[Computed]
    public function products()
    {
        return Product::all();
    }

    public function buy(Product $product)
    {
        $cart = Cart::firstOrCreate([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
        ]);

        $cart->update(['quantity' => $cart->quantity + 1]);

        $this->dispatch('add-product-to-cart', $product);
    }
}
