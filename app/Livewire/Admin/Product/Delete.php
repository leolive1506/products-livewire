<?php

namespace App\Livewire\Admin\Product;

use App\Models\Product;
use Livewire\Component;

class Delete extends Component
{
    public Product $product;

    public function render()
    {
        return view('livewire.admin.product.delete');
    }

    public function mount(Product $product)
    {
        $this->product = $product;
    }

    public function destroy()
    {
        $this->product->delete();
        $this->dispatch('update-list-products');
        $this->dispatch('notify', type: 'success', content: 'Products deleted with success');
    }
}
