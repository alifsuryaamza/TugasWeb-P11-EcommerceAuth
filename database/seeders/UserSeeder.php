<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin Toko',
            'email' => 'admin@example.com',
            'password' => 'password',
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Editor Toko',
            'email' => 'editor@example.com',
            'password' => 'password',
            'role' => 'editor',
        ]);

        $buyers = collect([
            User::factory()->create([
                'name' => 'Pembeli Demo',
                'email' => 'user@example.com',
                'password' => 'password',
                'role' => 'user',
            ]),
        ])->merge(User::factory(10)->create());

        $buyers->each(fn ($buyer) => Address::factory()->for($buyer)->create());
    }
}