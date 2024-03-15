<?php

namespace App\Livewire\Admin\Product;

use App\Livewire\Forms\Admin\Product\Form;
use App\Models\Product;
use Livewire\Component;
use \Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    public Form $form;

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
