<?php

namespace App\Livewire\Admin\Product;

use App\Livewire\Forms\Admin\Product\CreateForm;
use Livewire\Component;
use \Illuminate\Contracts\View\View;
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
        $this->form->create();

        return redirect()->route('admin.product.index')
            ->with('notify', [
                'content' => 'Save with success',
                'type' => 'success'
            ]);
    }
}
