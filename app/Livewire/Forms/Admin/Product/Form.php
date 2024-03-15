<?php

namespace App\Livewire\Forms\Admin\Product;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Form as LivewireForm;

class Form extends LivewireForm
{
    #[Validate(['required', 'string'])]
    public string $name = '';

    #[Validate(['required', 'numeric', 'min:1'])]
    public float|null|string $price = null;

    #[Validate(['nullable', 'string'])]
    public string $description = '';

    #[Validate(['required', 'image', 'max:1024'])]
    public $image;

    public function create()
    {
        $this->validate();
        
        DB::transaction(function () {
            Product::query()->create([
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
                'image' => asset($this->image->store('products', 'public'))
            ]);
        });

        $this->reset();
    }
}
