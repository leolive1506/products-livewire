<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customer = User::factory()->create([
            'name' => 'Customer',
            'email' => 'customer@gmail.com',
        ]);
        $admin = User::factory()->create([
            'name' => 'Leonardo',
            'email' => 'leonardolivelopes2@gmail.com',
        ]);

        UserRole::factory()->create([
            'user_id' => $customer->id,
            'role' => 'CUSTOMER',
        ]);

        UserRole::factory()->create([
            'user_id' => $admin->id,
            'role' => 'ADMIN',
        ]);
    }
}
