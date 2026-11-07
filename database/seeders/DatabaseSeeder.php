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
            ['email' => 'admin@creativity-keys.com'],
            [
                'name' => 'إدارة مفتاح الإبداع',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'phone' => '0543075802',
                'is_active' => true,
            ]
        );

        // حساب احتياطي إضافي للإدارة
        User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'المدير العام',
                'password' => Hash::make('admin123456'),
                'role' => 'admin',
                'phone' => '0543075802',
                'is_active' => true,
            ]
        );

        // مستخدم المشرف وفني الطوارئ (Manager)
        User::updateOrCreate(
            ['email' => 'manager@creativity-keys.com'],
            [
                'name' => 'مشرف فرع جدة',
                'password' => Hash::make('password123'),
                'role' => 'manager',
                'phone' => '0543075802',
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
