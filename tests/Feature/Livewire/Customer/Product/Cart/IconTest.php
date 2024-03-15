<?php

use App\Livewire\Customer\Product\Cart\Icon;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Livewire\Livewire;

it('update quantity cart', function () {
    $product = Product::factory()->createOne();
    $product2 = Product::factory()->createOne();
    $user = User::factory()->createOne();
    
    $cart = Livewire::actingAs($user)->test(Icon::class);

    Cart::factory()->createOne([
        'product_id' => $product->id,
        'user_id' => $user->id
    ]);

    $cart->dispatch('add-product-to-cart');
    expect($cart->productsAmount)->toEqual(Cart::user($user->id)->count());


    Cart::factory()->createOne([
        'product_id' => $product2->id,
        'user_id' => $user->id
    ]);

    $cart->dispatch('add-product-to-cart');
    expect($cart->productsAmount)->toEqual(Cart::user($user->id)->count());
});

it('products in the cart of the logged in user only', function () {
    $user1 = User::factory()->has(Cart::factory())->createOne();
    $user2 = User::factory()->has(Cart::factory())->createOne();
    
    $cart = Livewire::actingAs($user1)->test(Icon::class);
    $cart->dispatch('add-product-to-cart');
    expect($cart->productsAmount)->toEqual(Cart::user($user1->id)->count());


    $cart = Livewire::actingAs($user2)->test(Icon::class);
    $cart->dispatch('add-product-to-cart');
    expect($cart->productsAmount)->toEqual(Cart::user($user2->id)->count());
});