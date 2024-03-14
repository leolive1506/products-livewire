<?php

use App\Livewire\Admin\Product\Index;
use App\Models\Product;
use App\Models\User;
use App\Models\UserRole;
use Livewire\Livewire;

it('renders successfully', function () {
    $products = Product::factory(10)->create();
    $user = User::factory()->createOne();
    UserRole::factory()->createOne(['role' => 'ADMIN', 'user_id' => $user->id]);

    $livewire = Livewire::actingAs($user)->test(Index::class);
    $this->assertEquals($livewire->products, Product::all());
    $products->each(function ($product) use ($livewire) {
        $livewire->assertSee($product->name);
        $livewire->assertSee($product->created_at->format('d/m/Y'));
    });
});

it('only admin see page', function () {
    $customer = User::factory()->createOne();
    UserRole::factory()->createOne(['role' => 'CUSTOMER', 'user_id' => $customer->id]);

    $this->actingAs($customer)->get(route('admin.product.index'))->assertForbidden();

    $admin = User::factory()->createOne();
    UserRole::factory()->createOne(['role' => 'ADMIN', 'user_id' => $admin->id]);

    $this->actingAs($admin)->get(route('admin.product.index'))->assertOk();
});

