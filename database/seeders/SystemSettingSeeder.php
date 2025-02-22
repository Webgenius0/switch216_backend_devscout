<?php

namespace Database\Seeders;

use App\Models\SystemSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SystemSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SystemSetting::create([
            'title' => 'Switch',
            'system_name' => 'Switch',
            'email' => 'switch@business.com',
            'contact_number' => '+91-80-65652545',
            'company_open_hour' => '10:00 - 18:00',
            'copyright_text' => '© 2023 Holzbau, All right reserved',
            'logo' => 'uploads/logos/1739942834-1739942834-light-logo.png',
            'favicon' => 'uploads/favicons/1739942834-1739942834-light-favicon.ico',
            'address' => 'Morocco Town',
            'description' => 'Effortlessly manage and organize chats, tasks, and files in one central location with Qoterra chat management solutions.',
        ]);
    }
}
