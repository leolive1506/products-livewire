<?php

namespace App\Livewire\Admin\Product;

use App\Livewire\Forms\Admin\Product\CreateForm;
use App\Models\Product;
use Livewire\Component;
use \Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    public CreateForm $form;

    public function render(): View
    {
        return view('livewire.admin.product.create');
    }

    public function store()
    {
        $this->validate();
        
        DB::transaction(function () {
            Product::query()->create([
                'name' => $this->form->name,
                'description' => $this->form->description,
                'price' => $this->form->price,
                'image' => asset($this->form->image->store('products', 'public'))
            ]);

            $this->form->reset();
        });

        return redirect()->route('admin.product.index')
            ->with('notify', [
                'content' => 'Save with success',
                'type' => 'success'
            ]);
    }
}
