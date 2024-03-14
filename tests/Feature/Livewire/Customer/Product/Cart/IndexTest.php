<?php

use App\Livewire\Customer\Product\Cart\Index;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Livewire\Livewire;

it('list product by customer', function () {
    $user = User::factory()->createOne();
    Cart::factory()->createOne([
        'product_id' => Product::factory()->createOne(),
        'user_id' => $user->id
    ]);

    $cart = Cart::with('product')->user($user->id)->get();
    $livewire = Livewire::actingAs($user)->test(Index::class);
    $this->assertEquals($livewire->cart, $cart);
});

it('add quantity product', function () {
    $user = User::factory()->createOne();
    $product = Product::factory()->createOne();
    $cart = Cart::factory()->createOne([
        'product_id' => $product,
        'user_id' => $user->id,
        'quantity' => 1
    ]);

    Livewire::actingAs($user)
        ->test(Index::class)
        ->call('add', $cart);

    $this->assertDatabaseHas('carts', [
        'product_id' => $product->id,
        'user_id' => $user->id,
        'quantity' => 2
    ]);
});

it('decrease quantity product', function () {
    $user = User::factory()->createOne();
    $product = Product::factory()->createOne();

    $cart = Cart::factory()->createOne([
        'product_id' => $product,
        'user_id' => $user->id,
        'quantity' => 2
    ]);

    $livewire = Livewire::actingAs($user)
        ->test(Index::class)
        ->call('decrease', $cart);

    $this->assertDatabaseHas('carts', [
        'product_id' => $product->id,
        'user_id' => $user->id,
        'quantity' => 1
    ]);

    $livewire->call('decrease', $cart);

    $this->assertDatabaseHas('carts', [
        'product_id' => $product->id,
        'user_id' => $user->id,
        'quantity' => 1
    ]);
});

it('removed product from cart', function () {
    $user = User::factory()->createOne();
    $product = Product::factory()->createOne();

    $cart = Cart::factory()->createOne([
        'product_id' => $product,
        'user_id' => $user->id,
    ]);

    Livewire::actingAs($user)
        ->test(Index::class)
        ->call('remove', $cart);

    $this->assertDatabaseMissing('carts', [
        'product_id' => $product->id,
        'user_id' => $user->id
    ]);
});
