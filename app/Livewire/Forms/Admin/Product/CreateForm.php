<?php

namespace App\Livewire\Forms\Admin\Product;

use Livewire\Attributes\Validate;
use Livewire\Form;

class CreateForm extends Form
{
    #[Validate(['required', 'string'])]
    public string $name = '';

    #[Validate(['required', 'numeric', 'min:1'])]
    public float|null|string $price = null;

    #[Validate(['nullable', 'string'])]
    public string $description = '';

    #[Validate(['required', 'image', 'max:1024'])]
    public $image;
}
