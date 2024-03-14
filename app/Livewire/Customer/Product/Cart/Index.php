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

    #[Computed()]
    public function total(): float
    {
        $total = 0;
        $this->cart->each(function (Cart $cart) use (&$total) {
            $total += $cart->product->price * $cart->quantity;
        });

        return $total;
    }

    public function add(Cart $cart): Cart
    {
        $cart->update([
            'quantity' => $cart->quantity + 1
        ]);

        $this->cart();
        $this->dispatch('notify', content: 'Add with Success', type: 'success');

        return $cart;
    }

    public function decrease(Cart $cart): Cart
    {
        if ($cart->quantity > 1) {
            $cart->update([
                'quantity' => $cart->quantity - 1
            ]);
        }

        $this->cart();
        $this->dispatch('notify', content: 'Decrease with Success', type: 'success');
        return $cart;
    }

    public function remove(Cart $cart): void
    {
        $cart->delete();
        $this->cart();
        $this->dispatch('notify', content: 'Removed with Success', type: 'success');
    }
}
