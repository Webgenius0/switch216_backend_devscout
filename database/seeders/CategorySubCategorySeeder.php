<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Category data with subcategories
        $categories = [
            [
                'name' => 'Real Estate',
                'thumbnail' => 'uploads/category/demo_pic.jpg',
                'description' => 'Home maintenance and repair services.',
                'sub_categories' => [
                    ['name' => 'Buy a Home', 'thumbnail' => 'uploads/category/demo_pic.jpg', 'description' => 'Buy services.'],
                    ['name' => 'Rent a Home', 'thumbnail' => 'uploads/category/demo_pic.jpg', 'description' => 'Rent services.'],
                    ['name' => 'Others Real Estate', 'thumbnail' => 'uploads/category/demo_pic.jpg', 'description' => 'Real estate others services.'],
                ]
            ],
            [
                'name' => 'Restaurant',
                'thumbnail' => 'uploads/category/demo_pic.jpg',
                'description' => 'Food services.',
                'sub_categories' => [
                    ['name' => 'Local Cuisine', 'thumbnail' => 'uploads/category/demo_pic.jpg', 'description' => 'Food local cuisine services.'],
                    ['name' => 'Snaks', 'thumbnail' => 'uploads/category/demo_pic.jpg', 'description' => 'Food snaks services.'],
                    ['name' => 'Pizza', 'thumbnail' => 'uploads/category/demo_pic.jpg', 'description' => 'Food pizza services.'],
                    ['name' => 'Others Restaurant', 'thumbnail' => 'uploads/category/demo_pic.jpg', 'description' => 'Food others services.'],
                ]
            ],
            [
                'name' => 'Car',
                'thumbnail' => 'uploads/category/demo_pic.jpg',
                'description' => 'Vehicle services.',
                'sub_categories' => [
                    ['name' => 'Rent a Car', 'thumbnail' => 'uploads/category/demo_pic.jpg', 'description' => 'Rent a car services.'],
                    ['name' => 'Buy a Car', 'thumbnail' => 'uploads/category/demo_pic.jpg', 'description' => 'Buy a car services.'],
                    ['name' => 'Others Car', 'thumbnail' => 'uploads/category/demo_pic.jpg', 'description' => 'Other vehicle services.'],
                ]
            ],
            [
                'name' => 'Repair',
                'thumbnail' => 'uploads/category/demo_pic.jpg',
                'description' => 'General Repair services.',
                'sub_categories' => [
                    ['name' => 'Light Bulb Replacement', 'thumbnail' => 'uploads/category/demo_pic.jpg', 'description' => 'Light bulb replacement services.'],
                    ['name' => 'Carpentry Works', 'thumbnail' => 'uploads/category/demo_pic.jpg', 'description' => 'Carpentry works services.'],
                    ['name' => 'Small Door Installation', 'thumbnail' => 'uploads/category/demo_pic.jpg', 'description' => 'Small door installation services.'],
                    ['name' => 'Others Repair', 'thumbnail' => 'uploads/category/demo_pic.jpg', 'description' => 'Other repair services.'],
                ]
            ],
            [
                'name' => 'Beauty and Wellness',
                'thumbnail' => 'uploads/category/demo_pic.jpg',
                'description' => 'Beauty and wellness services.',
                'sub_categories' => [
                    ['name' => 'Spa Services', 'thumbnail' => 'uploads/category/demo_pic.jpg', 'description' => 'Spa services.'],
                    ['name' => 'Massage Therapy', 'thumbnail' => 'uploads/category/demo_pic.jpg', 'description' => 'Massage therapy services.'],
                    ['name' => 'Hair Services', 'thumbnail' => 'uploads/category/demo_pic.jpg', 'description' => 'Hair services.'],
                    ['name' => 'Nail Services', 'thumbnail' => 'uploads/category/demo_pic.jpg', 'description' => 'Nail services.'],
                    ['name' => 'Skin Care', 'thumbnail' => 'uploads/category/demo_pic.jpg', 'description' => 'Skin care services.'],
                    ['name' => 'Others Beauty and Wellness', 'thumbnail' => 'uploads/category/demo_pic.jpg', 'description' => 'Other beauty and wellness services.'],
                ]
            ],
            [
                'name' => 'Education and Childcare',
                'thumbnail' => 'uploads/category/demo_pic.jpg',
                'description' => 'Education and childcare services.',
                'sub_categories' => [
                    ['name' => 'Tutoring and Lessons', 'thumbnail' => 'uploads/category/demo_pic.jpg', 'description' => 'Tutoring and lessons services.'],
                    ['name' => 'Childcare and Daycare', 'thumbnail' => 'uploads/category/demo_pic.jpg', 'description' => 'Childcare and daycare services.'],
                    ['name' => 'Language Lessons', 'thumbnail' => 'uploads/category/demo_pic.jpg', 'description' => 'Language lessons services.'],
                    ['name' => 'Sports and Fitness Lessons', 'thumbnail' => 'uploads/category/demo_pic.jpg', 'description' => 'Sports and fitness lessons services.'],
                    ['name' => 'Music Lessons', 'thumbnail' => 'uploads/category/demo_pic.jpg', 'description' => 'Music lessons services.'],
                    ['name' => 'Others Education and Childcare', 'thumbnail' => 'uploads/category/demo_pic.jpg', 'description' => 'Other education and childcare services.'],
                ]
            ],
            [
                'name' => 'IT Service',
                'thumbnail' => 'uploads/category/demo_pic.jpg',
                'description' => 'IT service installation and maintenance.',
                'sub_categories' => [
                    ['name' => 'Network Installation', 'thumbnail' => 'uploads/category/demo_pic.jpg', 'description' => 'Network installation services.'],
                    ['name' => 'Computer Hardware Installation', 'thumbnail' => 'uploads/category/demo_pic.jpg', 'description' => 'Computer hardware installation services.'],
                    ['name' => 'Software Installation', 'thumbnail' => 'uploads/category/demo_pic.jpg', 'description' => 'Software installation services.'],
                    ['name' => 'Data Recovery', 'thumbnail' => 'uploads/category/demo_pic.jpg', 'description' => 'Data recovery services.'],
                    ['name' => 'System Testing and Maintenance', 'thumbnail' => 'uploads/category/demo_pic.jpg', 'description' => 'System testing and maintenance services.'],
                    ['name' => 'Others IT Service', 'thumbnail' => 'uploads/category/demo_pic.jpg', 'description' => 'Other IT service services.'],
                ]
            ],
            [
                'name' => 'Furniture',
                'thumbnail' => 'uploads/category/demo_pic.jpg',
                'description' => 'Furniture assembly and installation.',
                'sub_categories' => [
                    ['name' => 'Living Room Furniture', 'thumbnail' => 'uploads/category/demo_pic.jpg', 'description' => 'Living room furniture services.'],
                    ['name' => 'Bedroom Furniture', 'thumbnail' => 'uploads/category/demo_pic.jpg', 'description' => 'Bedroom furniture services.'],
                    ['name' => 'Dining Room Furniture', 'thumbnail' => 'uploads/category/demo_pic.jpg', 'description' => 'Dining room furniture services.'],
                    ['name' => 'Office Furniture', 'thumbnail' => 'uploads/category/demo_pic.jpg', 'description' => 'Office furniture services.'],
                    ['name' => 'Outdoor Furniture', 'thumbnail' => 'uploads/category/demo_pic.jpg', 'description' => 'Outdoor furniture services.'],
                    ['name' => 'Others Furniture', 'thumbnail' => 'uploads/category/demo_pic.jpg', 'description' => 'Other furniture services.'],
                ]
            ],
            [
                'name' => 'Party Event',
                'thumbnail' => 'uploads/category/demo_pic.jpg', // Image filename
                'description' => 'All kinds of party event services.',
                'sub_categories' => [
                    ['name' => 'Event Organizer', 'thumbnail' => 'uploads/category/demo_pic.jpg', 'description' => 'Event organizing services.'],
                    ['name' => 'Birthday Party Organizer', 'thumbnail' => 'uploads/category/demo_pic.jpg', 'description' => 'Birthday party organizing services.'],
                    ['name' => 'Wedding Organizer', 'thumbnail' => 'uploads/category/demo_pic.jpg', 'description' => 'Wedding organizing services.'],
                    ['name' => 'Others Party Event', 'thumbnail' => 'uploads/category/demo_pic.jpg', 'description' => 'Other party event services.'],
                ]
            ],

        ];

        // Loop through the categories and subcategories
        foreach ($categories as $categoryData) {
            $category = DB::table('categories')->insertGetId([
                'name' => $categoryData['name'],
                'thumbnail' => $categoryData['thumbnail'],
                'description' => $categoryData['description'] ?? null,
            ]);

            foreach ($categoryData['sub_categories'] as $subCategoryData) {
                DB::table('sub_categories')->insert([
                    'category_id' => $category,
                    'name' => $subCategoryData['name'],
                    'thumbnail' => $subCategoryData['thumbnail'],
                    'description' => $subCategoryData['description'] ?? null,
                ]);
            }
        }
    }
}
