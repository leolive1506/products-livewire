<?php

namespace App\Livewire\Admin\Product;

use App\Livewire\Forms\Admin\Product\EditForm;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;
    public EditForm $form;
    public Product $product;
    
    public function render()
    {
        return view('livewire.admin.product.edit');
    }

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->form->setProduct($product);
    }

    public function update()
    {
        $this->form->save();

        return redirect()->route('admin.product.index')
            ->with('notify', [
                'content' => 'Update with success',
                'type' => 'success'
            ]);
    }
}
