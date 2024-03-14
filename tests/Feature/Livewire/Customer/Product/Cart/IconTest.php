<?php

use App\Livewire\Customer\Product\Cart\Icon;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Icon::class)
        ->assertStatus(200);
});
