<?php

namespace App\Livewire\Forms\Admin\Product;

use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Form as LivewireForm;

class EditForm extends LivewireForm
{
    public ?Product $product;

    #[Validate(['required', 'string'])]
    public string $name = '';

    #[Validate(['required', 'numeric', 'min:1'])]
    public float|null|string $price = null;

    #[Validate(['nullable', 'string'])]
    public string $description = '';

    #[Validate(['nullable', 'image', 'max:1024'])]
    public $image;

    public function setProduct(Product $product)
    {
        $this->product = $product;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->price = $product->price;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price
        ];

        if ($this->image instanceof UploadedFile) {
            Storage::disk('public')->delete(str_replace(env('APP_URL'), '', $this->product->image));
            $data['image'] = asset($this->storeImg());
        }

        $this->product->update($data);
        $this->reset();
    }

    private function storeImg(): string
    {
        return $this->image->store('products', 'public');
    }

}
