<?php

use App\Livewire\Admin\Product\Edit;
use App\Models\Product;
use Illuminate\Http\Testing\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Livewire\Features\SupportTesting\Testable;

function edit($product = []): Testable
{
    return Livewire::test(Edit::class, ['product' => Product::factory()->createOne($product)]);
}

it('should have updated the product in the database', function () {
    Storage::fake('public');

    $file = fakeFile();

    edit()
        ->set('form.name', 'Product 1')
        ->set('form.description', 'Product description')
        ->set('form.price', 200)
        ->set('form.image', $file)
        ->call('update')
        ->assertStatus(200);

    $product = Product::first();

    $this->assertDatabaseHas('products', [
        'id' => $product->id,
        'name' => 'Product 1',
        'price' => 200,
        'image' => asset('products/' . $file->hashName()),
        'description' => 'Product description'
    ]);

    Storage::disk('public')->assertExists('products/' . $file->hashName());
});

it('should have deleted old image the product', function () {
    Storage::fake('public');

    $file = fakeFile();

    $livewire = edit(product: ['image' => fakeFile()->store('products', 'public')]);
    $product = $livewire->product;

    $livewire
        ->set('form.name', 'Product 1')
        ->set('form.description', 'Product description')
        ->set('form.price', 200)
        ->set('form.image', $file)
        ->call('update')
        ->assertStatus(200);

    Storage::disk('public')->assertMissing($product->image);
    Storage::disk('public')->assertExists('products/' . $file->hashName());
});

it('should reset the component attributes', function () {
    Storage::fake('public');

    $livewire = edit()
        ->set('form.name', 'Product 1')
        ->set('form.price', 200)
        ->set('form.image', fakeFile())
        ->call('update')
        ->assertStatus(200);

    expect($livewire->form->name)->toBeEmpty();
    expect($livewire->form->price)->toBeEmpty();
    expect($livewire->form->image)->toBeEmpty();
    expect($livewire->form->description)->toBeEmpty();
});

test('validate if name is required', function () {
    Storage::fake('public');

    edit()
        ->set('form.name', '')
        ->call('update')
        ->assertHasErrors(['form.name' => ['required']]);
});

test('validate if price is required', function () {
    Storage::fake('public');

    edit()
        ->set('form.price', null)
        ->call('update')
        ->assertHasErrors(['form.price' => ['required']]);
});

test('validate if minimum price must be 1', function () {
    Storage::fake('public');

    edit()
        ->set('form.price', 0)
        ->call('update')
        ->assertHasErrors(['form.price' => ['min']]);
});

test('validate if image is a image and max size', function () {
    Storage::fake('public');

    edit()
        ->set('form.image', fakeFile(size: 1025))
        ->call('update')
        ->assertHasErrors(['form.image' => ['max']]);
});

test('validate if description is nullable', function () {
    Storage::fake('public');

    edit()
        ->set('form.name', 'Product 1')
        ->set('form.price', 200)
        ->set('form.image', fakeFile())
        ->call('update')
        ->assertHasNoErrors();
});
