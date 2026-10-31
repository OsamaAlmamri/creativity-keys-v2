<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Database\Seeder;

class ServiceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'مفاتيح وبرمجة السيارات',
                'slug' => 'automotive-keys',
                'icon' => 'car-key',
                'description' => 'قص وبرمجة بصمات وريموتات جميع موديلات السيارات الحديثة واستخراج الأكواد',
                'sort_order' => 1,
            ],
            [
                'name' => 'فتح أقفال وأبواب الطوارئ',
                'slug' => 'emergency-lockout',
                'icon' => 'lock-open',
                'description' => 'فتح أبواب الفلل والشقق والمنازل بدون أي كسر أو خدش بأدوات أوروبية',
                'sort_order' => 2,
            ],
            [
                'name' => 'الأقفال الذكية والبيومترية',
                'slug' => 'smart-locks',
                'icon' => 'cpu-chip',
                'description' => 'توريد وتركيب أحدث كوالين البصمة والبطاقة وتطبيقات الهواتف الذكية للمنازل',
                'sort_order' => 3,
            ],
            [
                'name' => 'خزنات وتجوري أمني',
                'slug' => 'safes-vaults',
                'icon' => 'shield-check',
                'description' => 'فتح وصيانة الخزائن الحديدية والرقمية وتغيير الشفرات السرية بحرفية وسرية تامة',
                'sort_order' => 4,
            ],
            [
                'name' => 'نسخ وقص المفاتيح والماستر كي',
                'slug' => 'key-duplication',
                'icon' => 'key',
                'description' => 'نسخ فوري فائق الدقة لجميع المفاتيح الكمبيوتر والأسطوانية وأنظمة Master Key',
                'sort_order' => 5,
            ],
            [
                'name' => 'الورشة المتنقلة للطوارئ 24/7',
                'slug' => 'mobile-workshop',
                'icon' => 'truck',
                'description' => 'سيارات مجهزة بأحدث أجهزة الليزر والبرمجة تصل لموقعك في جدة لخدمتك فوراً',
                'sort_order' => 6,
            ],
        ];

        foreach ($categories as $catData) {
            $category = ServiceCategory::updateOrCreate(
                ['slug' => $catData['slug']],
                $catData
            );

            // Link existing services by slug keywords if available
            if ($catData['slug'] === 'automotive-keys') {
                Service::where('slug', 'car-keys-programming')->update(['category_id' => $category->id]);
            } elseif ($catData['slug'] === 'emergency-lockout') {
                Service::where('slug', 'emergency-door-unlocking')->update(['category_id' => $category->id]);
            } elseif ($catData['slug'] === 'smart-locks') {
                Service::where('slug', 'smart-locks-installation')->update(['category_id' => $category->id]);
            } elseif ($catData['slug'] === 'safes-vaults') {
                Service::where('slug', 'safe-opening-and-repairs')->update(['category_id' => $category->id]);
            } elseif ($catData['slug'] === 'key-duplication') {
                Service::where('slug', 'key-cutting-and-master-key')->update(['category_id' => $category->id]);
            } elseif ($catData['slug'] === 'mobile-workshop') {
                Service::where('slug', 'emergency-mobile-locksmith')->update(['category_id' => $category->id]);
            }
        }
    }
}
