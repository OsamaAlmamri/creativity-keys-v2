<?php

namespace Database\Seeders;

use App\Models\GalleryItem;
use Illuminate\Database\Seeder;

class GalleryItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'title' => 'برمجة واستخراج ريموت وبصمة سيارة حديثة',
                'category' => 'مفاتيح سيارات',
                'image_url' => 'https://images.unsplash.com/photo-1617814076367-b759c7d7e738?auto=format&fit=crop&w=800&q=80',
                'description' => 'قص ليزر مطابق للوكالة وبرمجة شريحة مشفرة في الموقع',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'تركيب قفل ذكي بيومتري بالبصمة لباب فيلا رئيسي',
                'category' => 'أقفال ذكية',
                'image_url' => 'https://images.unsplash.com/photo-1558002038-1055907df827?auto=format&fit=crop&w=800&q=80',
                'description' => 'قفل أمني ذكي مع خاصية التحكم عبر تطبيق الهاتف والواي فاي',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'ماكينة قص وقوالب الليزر الرقمية الإيطالية',
                'category' => 'أجهزة ومعدات',
                'image_url' => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?auto=format&fit=crop&w=800&q=80',
                'description' => 'أعلى دقة تصنيع ونسخ للمفاتيح دون أي هامش خطأ',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'فتح قفل باب مغلق لطوارئ شقة سكنية',
                'category' => 'طوارئ وفتح أبواب',
                'image_url' => 'https://images.unsplash.com/photo-1582139329536-e7284fece509?auto=format&fit=crop&w=800&q=80',
                'description' => 'فتح أمني بدون كسر أو تجريح للباب أو الدهان',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'title' => 'صيانة وبرمجة قفل خزنة تجوري أمنية',
                'category' => 'خزنات وتجوري',
                'image_url' => 'https://images.unsplash.com/photo-1544717305-2782549b5136?auto=format&fit=crop&w=800&q=80',
                'description' => 'فك تشفير إلكتروني وإعادة ضبط الأرقام السرية لشركة تجارية',
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'title' => 'تشكيلة مفاتيح مخصصة وماستر كي للمباني',
                'category' => 'أجهزة ومعدات',
                'image_url' => 'https://images.unsplash.com/photo-1589829545856-d10d557cf95f?auto=format&fit=crop&w=800&q=80',
                'description' => 'مفاتيح نحاسية عالية المقاومة مصنعة وفق المعايير الألمانية',
                'is_active' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($items as $item) {
            GalleryItem::updateOrCreate(
                ['title' => $item['title']],
                $item
            );
        }
    }
}
