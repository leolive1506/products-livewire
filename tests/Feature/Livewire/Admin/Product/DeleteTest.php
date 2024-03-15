<?php

use App\Livewire\Admin\Product\Delete;
use App\Models\Cart;
use App\Models\Product;
use Livewire\Livewire;

it('should delete the product and related items', function () {
    $product = Product::factory()->has(Cart::factory())->createOne();

    Livewire::test(Delete::class, ['product' => $product])
        ->call('destroy')
        ->assertStatus(200);

    $this->assertDatabaseMissing('products', [
        'id' => $product->id,
    ]);

    $this->assertDatabaseMissing('carts', [
        'product_id' => $product->id,
    ]);
});

it('should dispatch event update-list-products', function () {
    Livewire::test(Delete::class, ['product' => Product::factory()->createOne()])
        ->call('destroy')
        ->assertDispatched('update-list-products')
        ->assertDispatched('notify')
        ->assertStatus(200);
});
