<?php

namespace App\Livewire\Admin\Product;

use App\Models\Product;
use Livewire\Component;
use \Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    #[Validate(['required', 'string'])]
    public string $name = '';

    #[Validate(['required', 'numeric', 'min:1'])]
    public float|null $price = null;

    #[Validate(['nullable', 'string'])]
    public string $description = '';

    #[Validate(['required', 'image', 'max:1024'])]
    public $image;

    public function render(): View
    {
        return view('livewire.admin.product.create');
    }

    public function store()
    {

        $this->validate();
        
        DB::transaction(function () {
            Product::query()->create([
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
                'image' => asset($this->image->store('products', 'public'))
            ]);

            $this->reset('name', 'price', 'image', 'description');
        });
    }
}
