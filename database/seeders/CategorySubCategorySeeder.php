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
                'thumbnail' => 'category_images/home.jpg',
                'description' => 'Home maintenance and repair services.',
                'sub_categories' => [
                    ['name' => 'Buy a Home', 'thumbnail' => 'category_images/real_estate/Buy.png', 'description' => 'Buy services.'],
                    ['name' => 'Rent a Home', 'thumbnail' => 'category_images/real_estate/Rent.png', 'description' => 'Rent services.'],
                    ['name' => 'Others', 'thumbnail' => 'category_images/real_estate/others.png', 'description' => 'Real estate others services.'],
                ]
            ],
            [
                'name' => 'Restaurant',
                'thumbnail' => 'category_images/food.jpg',
                'description' => 'Food services.',
                'sub_categories' => [
                    ['name' => 'Local Cuisine', 'thumbnail' => 'category_images/food/local_cuisine.png', 'description' => 'Food local cuisine services.'],
                    ['name' => 'Snaks', 'thumbnail' => 'category_images/food/snaks.png', 'description' => 'Food snaks services.'],
                    ['name' => 'Pizza', 'thumbnail' => 'category_images/food/pizza.png', 'description' => 'Food pizza services.'],
                    ['name' => 'Others', 'thumbnail' => 'category_images/food/others.png', 'description' => 'Food others services.'],
                ]
            ],
            [
                'name' => 'Car',
                'thumbnail' => 'category_images/vehicle.jpg',
                'description' => 'Vehicle services.',
                'sub_categories' => [
                    ['name' => 'Rent a Car', 'thumbnail' => 'category_images/vehicle/rent_a_car.png', 'description' => 'Rent a car services.'],
                    ['name' => 'Buy a Car', 'thumbnail' => 'category_images/vehicle/buy_a_car.png', 'description' => 'Buy a car services.'],
                    ['name' => 'Others', 'thumbnail' => 'category_images/vehicle/others.png', 'description' => 'Other vehicle services.'],
                ]
            ],
            [
                'name' => 'Repair',
                'thumbnail' => 'category_images/repair.jpg',
                'description' => 'General Repair services.',
                'sub_categories' => [
                    ['name' => 'Light Bulb Replacement', 'thumbnail' => 'category_images/repair/light_bulb_replacement.png', 'description' => 'Light bulb replacement services.'],
                    ['name' => 'Carpentry Works', 'thumbnail' => 'category_images/repair/carpentry_works.png', 'description' => 'Carpentry works services.'],
                    ['name' => 'Small Door Installation', 'thumbnail' => 'category_images/repair/door_installation.png', 'description' => 'Small door installation services.'],
                    ['name' => 'Others', 'thumbnail' => 'category_images/repair/others.png', 'description' => 'Other repair services.'],
                ]
            ],
            [
                'name' => 'Beauty and Wellness',
                'thumbnail' => 'category_images/beauty_and_wellness.jpg',
                'description' => 'Beauty and wellness services.',
                'sub_categories' => [
                    ['name' => 'Spa Services', 'thumbnail' => 'category_images/beauty_and_wellness/spa_services.png', 'description' => 'Spa services.'],
                    ['name' => 'Massage Therapy', 'thumbnail' => 'category_images/beauty_and_wellness/massage_therapy.png', 'description' => 'Massage therapy services.'],
                    ['name' => 'Hair Services', 'thumbnail' => 'category_images/beauty_and_wellness/hair_services.png', 'description' => 'Hair services.'],
                    ['name' => 'Nail Services', 'thumbnail' => 'category_images/beauty_and_wellness/nail_services.png', 'description' => 'Nail services.'],
                    ['name' => 'Skin Care', 'thumbnail' => 'category_images/beauty_and_wellness/skin_care.png', 'description' => 'Skin care services.'],
                    ['name' => 'Others', 'thumbnail' => 'category_images/beauty_and_wellness/others.png', 'description' => 'Other beauty and wellness services.'],
                ]
            ],
            [
                'name' => 'Education and Childcare',
                'thumbnail' => 'category_images/education_and_childcare.jpg',
                'description' => 'Education and childcare services.',
                'sub_categories' => [
                    ['name' => 'Tutoring and Lessons', 'thumbnail' => 'category_images/education_and_childcare/tutoring_lessons.png', 'description' => 'Tutoring and lessons services.'],
                    ['name' => 'Childcare and Daycare', 'thumbnail' => 'category_images/education_and_childcare/childcare_daycare.png', 'description' => 'Childcare and daycare services.'],
                    ['name' => 'Language Lessons', 'thumbnail' => 'category_images/education_and_childcare/language_lessons.png', 'description' => 'Language lessons services.'],
                    ['name' => 'Sports and Fitness Lessons', 'thumbnail' => 'category_images/education_and_childcare/sports_fitness_lessons.png', 'description' => 'Sports and fitness lessons services.'],
                    ['name' => 'Music Lessons', 'thumbnail' => 'category_images/education_and_childcare/music_lessons.png', 'description' => 'Music lessons services.'],
                    ['name' => 'Others', 'thumbnail' => 'category_images/education_and_childcare/others.png', 'description' => 'Other education and childcare services.'],
                ]
            ],
            [
                'name' => 'IT Service',
                'thumbnail' => 'category_images/it_service.jpg',
                'description' => 'IT service installation and maintenance.',
                'sub_categories' => [
                    ['name' => 'Network Installation', 'thumbnail' => 'category_images/it_service/network_installation.png', 'description' => 'Network installation services.'],
                    ['name' => 'Computer Hardware Installation', 'thumbnail' => 'category_images/it_service/computer_hardware_installation.png', 'description' => 'Computer hardware installation services.'],
                    ['name' => 'Software Installation', 'thumbnail' => 'category_images/it_service/software_installation.png', 'description' => 'Software installation services.'],
                    ['name' => 'Data Recovery', 'thumbnail' => 'category_images/it_service/data_recovery.png', 'description' => 'Data recovery services.'],
                    ['name' => 'System Testing and Maintenance', 'thumbnail' => 'category_images/it_service/system_testing.png', 'description' => 'System testing and maintenance services.'],
                    ['name' => 'Others', 'thumbnail' => 'category_images/it_service/others.png', 'description' => 'Other IT service services.'],
                ]
            ],
            [
                'name' => 'Furniture',
                'thumbnail' => 'category_images/furniture.jpg',
                'description' => 'Furniture assembly and installation.',
                'sub_categories' => [
                    ['name' => 'Living Room Furniture', 'thumbnail' => 'category_images/furniture/living_room_furniture.png', 'description' => 'Living room furniture services.'],
                    ['name' => 'Bedroom Furniture', 'thumbnail' => 'category_images/furniture/bedroom_furniture.png', 'description' => 'Bedroom furniture services.'],
                    ['name' => 'Dining Room Furniture', 'thumbnail' => 'category_images/furniture/dining_room_furniture.png', 'description' => 'Dining room furniture services.'],
                    ['name' => 'Office Furniture', 'thumbnail' => 'category_images/furniture/office_furniture.png', 'description' => 'Office furniture services.'],
                    ['name' => 'Outdoor Furniture', 'thumbnail' => 'category_images/furniture/outdoor_furniture.png', 'description' => 'Outdoor furniture services.'],
                    ['name' => 'Others', 'thumbnail' => 'category_images/furniture/others.png', 'description' => 'Other furniture services.'],
                ]
            ],
            [
                'name' => 'Party Event',
                'thumbnail' => 'category_images/party_event.jpg', // Image filename
                'description' => 'All kinds of party event services.',
                'sub_categories' => [
                    ['name' => 'Event Organizer', 'thumbnail' => 'category_images/party_event/event_organizer.png', 'description' => 'Event organizing services.'],
                    ['name' => 'Birthday Party Organizer', 'thumbnail' => 'category_images/party_event/birthday_party_organizer.png', 'description' => 'Birthday party organizing services.'],
                    ['name' => 'Wedding Organizer', 'thumbnail' => 'category_images/party_event/wedding_organizer.png', 'description' => 'Wedding organizing services.'],
                    ['name' => 'Others', 'thumbnail' => 'category_images/party_event/others.png', 'description' => 'Other party event services.'],
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
