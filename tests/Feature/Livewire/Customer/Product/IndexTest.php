<?php

use App\Livewire\Customer\Product\Index;
use App\Models\Product;
use App\Models\User;
use Livewire\Livewire;

it('list products', function () {
    $products = Product::factory(10)->create();
    $user = User::factory()->createOne();

    $livewire = Livewire::actingAs($user)->test(Index::class);
    $this->assertEquals($livewire->products, Product::all());
    $products->each(function ($product) use ($livewire) {
        $livewire->assertSee($product->name);
    });
});

it('add product to cart and dispatch buy-product event', function () {
    $product = Product::factory()->createOne();
    $user = User::factory()->createOne();

    Livewire::actingAs($user)
        ->test(Index::class)
        ->call('buy', $product)
        ->assertDispatched('add-product-to-cart');

    $this->assertDatabaseHas('carts', [
        'product_id' => $product->id,
        'user_id' => $user->id,
        'quantity' => 1
    ]);
});

it('update quantity product quantity to cart when dispatch buy-product event', function () {
    $product = Product::factory()->createOne();
    $user = User::factory()->createOne();

    $livewire = Livewire::actingAs($user)
        ->test(Index::class)
        ->call('buy', $product)
        ->assertDispatched('add-product-to-cart');

    $this->assertDatabaseHas('carts', [
        'product_id' => $product->id,
        'user_id' => $user->id,
        'quantity' => 1
    ]);

    $livewire->call('buy', $product)->assertDispatched('add-product-to-cart');
    $this->assertDatabaseHas('carts', [
        'product_id' => $product->id,
        'user_id' => $user->id,
        'quantity' => 2
    ]);
});
