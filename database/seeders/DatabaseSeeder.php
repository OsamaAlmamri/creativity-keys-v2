<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // مستخدم المدير العام (Full Admin)
        User::updateOrCreate(
            ['email' => 'admin@keyshop.com'],
            [
                'name' => 'المدير العام',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'phone' => '0551234567',
                'is_active' => true,
            ]
        );

        // مستخدم المشرف (Manager)
        User::updateOrCreate(
            ['email' => 'manager@keyshop.com'],
            [
                'name' => 'مشرف الفرع',
                'password' => Hash::make('password123'),
                'role' => 'manager',
                'phone' => '0559998877',
                'is_active' => true,
            ]
        );

        $this->call([
            SettingSeeder::class,
            ServiceCategorySeeder::class,
            ServiceSeeder::class,
            GalleryItemSeeder::class,
            ReviewSeeder::class,
            ContactMessageSeeder::class,
            ArticleSeeder::class,
        ]);
    }
}
