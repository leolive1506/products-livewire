<?php

namespace App\Livewire\Customer\Product\Cart;

use App\Models\Cart;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.customer.product.cart.index');
    }

    #[Computed()]
    public function cart(): Collection
    {
        return Cart::with('product')->user(auth()->id())->get();
    }

    public function add(Cart $cart): Cart
    {
        $cart->update([
            'quantity' => $cart->quantity + 1
        ]);

        return $cart;
    }

    public function decrease(Cart $cart): Cart
    {
        if ($cart->quantity > 1) {
            $cart->update([
                'quantity' => $cart->quantity - 1
            ]);
        }

        return $cart;
    }

    public function remove(Cart $cart): void
    {
        $cart->delete();
    }
}
