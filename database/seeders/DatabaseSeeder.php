<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'User',
            'email' => 'user@user.com',
            'password' => Hash::make('12345678'),
            'role' => 'customer',
        ]);
        User::factory()->create([
            'name' => 'User2',
            'email' => 'user2@user.com',
            'password' => Hash::make('12345678'),
            'role' => 'customer',
        ]);
        
        // User::factory()->create([
        //     'name' => 'contractor',
        //     'email' => 'contractor@contractor.com',
        //     'password' => Hash::make('12345678'),
        //     'role' => 'contractor',
        // ]);
        // User::factory()->create([
        //     'name' => 'contractor2',
        //     'email' => 'contractor2@contractor.com',
        //     'password' => Hash::make('12345678'),
        //     'role' => 'contractor',
        // ]);
        // User::factory()->create([
        //     'name' => 'contractor3',
        //     'email' => 'contractor3@contractor.com',
        //     'password' => Hash::make('12345678'),
        //     'role' => 'contractor',
        // ]);

        //category sub_category seeder call
        $this->call(CategorySubCategorySeeder::class);
    }
}
