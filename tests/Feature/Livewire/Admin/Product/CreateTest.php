<?php

use App\Livewire\Admin\Product\Create;
use Illuminate\Http\Testing\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

function fakeFile(int $size = null): File
{
    $file = UploadedFile::fake()->image('image.jpg');
    if ($size) {
        $file->size($size);
    }

    return $file;
}

it('should have stored the file', function () {
    Storage::fake('public');

    $file = fakeFile();

    Livewire::test(Create::class)
        ->set('form.name', 'Product 1')
        ->set('form.price', 200)
        ->set('form.image', $file)
        ->call('store')
        ->assertStatus(200);

    Storage::disk('public')->assertExists('products/' . $file->hashName());
});

it('should have stored the product in the database', function () {
    Storage::fake('public');

    $file = fakeFile();

    Livewire::test(Create::class)
        ->set('form.name', 'Product 1')
        ->set('form.description', 'Product description')
        ->set('form.price', 200)
        ->set('form.image', $file)
        ->call('store')
        ->assertStatus(200);

    $this->assertDatabaseHas('products', [
        'name' => 'Product 1',
        'price' => 200,
        'image' => asset('products/' . $file->hashName()),
        'description' => 'Product description'
    ]);
});

it('should reset the component attributes', function () {
    Storage::fake('public');

    $livewire = Livewire::test(Create::class)
        ->set('form.name', 'Product 1')
        ->set('form.price', 200)
        ->set('form.image', fakeFile())
        ->call('store')
        ->assertStatus(200);

    expect($livewire->form->name)->toBeEmpty();
    expect($livewire->form->price)->toBeEmpty();
    expect($livewire->form->image)->toBeEmpty();
    expect($livewire->form->description)->toBeEmpty();
});

test('validate if name is required', function () {
    Storage::fake('public');

    Livewire::test(Create::class)
        ->call('store')
        ->assertHasErrors(['form.name' => ['required']]);
});

test('validate if price is required', function () {
    Storage::fake('public');

    Livewire::test(Create::class)
        ->call('store')
        ->assertHasErrors(['form.price' => ['required']]);
});

test('validate if minimum price must be 1', function () {
    Storage::fake('public');

    Livewire::test(Create::class)
        ->set('form.price', 0)
        ->call('store')
        ->assertHasErrors(['form.price' => ['min']]);
});

test('validate if image is a image and max size', function () {
    Storage::fake('public');

    Livewire::test(Create::class)
        ->set('form.image', fakeFile(size: 1025))
        ->call('store')
        ->assertHasErrors(['form.image' => ['max']]);
});

test('validate if description is nullable', function () {
    Storage::fake('public');

    Livewire::test(Create::class)
        ->set('form.name', 'Product 1')
        ->set('form.price', 200)
        ->set('form.image', fakeFile())
        ->call('store')
        ->assertHasNoErrors();
});