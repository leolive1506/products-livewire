<?php

use App\Livewire\Customer\Product\Cart\Icon;
use App\Models\Product;
use App\Models\User;
use Livewire\Livewire;

it('update quantity cart', function () {
    $product = Product::factory()->createOne();
    $product2 = Product::factory()->createOne();
    $user = User::factory()->createOne();

    $livewire = Livewire::actingAs($user)->test(Icon::class);
    $livewire->dispatch('add-product-to-cart', $product)
        ->assertSee("1");
    $livewire->dispatch('add-product-to-cart', $product2)
        ->assertSee("2");
});
