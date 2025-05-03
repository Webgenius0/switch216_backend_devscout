<?php

namespace Database\Seeders;

use App\Models\City;
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
            'name' => 'Admin',
            'email' => 'dev-helal@dev-helal.com',
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
        

        //category sub_category seeder call
        $this->call(SystemSettingSeeder::class);
        $this->call(CategorySubCategorySeeder::class);
        $this->call(CarBrandSeeder::class);
        $this->call(CitySeeder::class);
    }
}
