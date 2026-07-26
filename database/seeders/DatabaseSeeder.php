<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

   public function run(): void
{
    Setting::firstOrCreate(
        ['app_name' => 'Nadimax Admin'],
        [
            'company_name' => 'Nadimax',
            'email' => 'admin@nadimax.com',
            'phone' => '081234567890',
            'address' => 'Indonesia',
            'timezone' => 'Asia/Jakarta',
            'language' => 'id',
            'theme' => 'light',
        ]
    );
}
}