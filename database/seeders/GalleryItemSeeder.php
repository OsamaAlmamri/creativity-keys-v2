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
                'title' => 'واجهة محل مفاتيح الإبداع في جدة',
                'category' => 'المركز والواجهة',
                'image_url' => '/images/store/800_6abfe27982073.jpg',
                'description' => 'المقر الرئيسي لخدمات قص وبرمجة المفاتيح وفتح الأقفال في جدة',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'تشكيلة ريموتات ومفاتيح السيارات الذكية',
                'category' => 'مفاتيح سيارات',
                'image_url' => '/images/store/800_6abfe2761228b.jpg',
                'description' => 'ريموتات وكروت بصمة أصلية لجميع موديلات وماركات السيارات',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'أجهزة برمجة مفاتيح السيارات المعتمدة',
                'category' => 'أجهزة ومعدات',
                'image_url' => '/images/store/800_6abfe27687c46.jpg',
                'description' => 'برمجيات متطورة للتعامل مع أحدث شفرات وأنظمة الحماية الإلكترونية',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'معدات قص وتفصيل المفاتيح بالليزر بدقة متناهية',
                'category' => 'أجهزة ومعدات',
                'image_url' => '/images/store/800_6abfe27712dff.jpg',
                'description' => 'ماكينات ليزر حديثة تضمن تطابقاً تاما مع مفتاح الوكالة الأصلي',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'title' => 'مفاتيح الأبواب والأقفال والكوالين المتنوعة',
                'category' => 'أقفال ومنازل',
                'image_url' => '/images/store/800_6abfe27785455.jpg',
                'description' => 'تشكيلة واسعة من مفاتيح المنازل والأقفال الماستر كي الآمنة',
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'title' => 'فحص وتصليح مفاتيح وسويتشات السيارات',
                'category' => 'مفاتيح سيارات',
                'image_url' => '/images/store/800_6abfe277f20d0.jpg',
                'description' => 'صيانة إلكترونية متخصصة لحل مشاكل عدم دوران السويتش ومفاتيح البصمة',
                'is_active' => true,
                'sort_order' => 6,
            ],
            [
                'title' => 'أجهزة برمجة البصمة والكمبيوتر الميدانية',
                'category' => 'برمجة بصمة',
                'image_url' => '/images/store/800_6abfe2786d850.jpg',
                'description' => 'أجهزة محمولة متطورة لتنفيذ البرمجة واستخراج بدل فاقد في موقعك',
                'is_active' => true,
                'sort_order' => 7,
            ],
            [
                'title' => 'طاولة العمل المجهزة بأدوات قص وبرمجة المفاتيح',
                'category' => 'أجهزة ومعدات',
                'image_url' => '/images/store/800_6abfe278e8be4.jpg',
                'description' => 'بيئة عمل احترافية تضمن سرعة الإنجاز ودقة التنفيذ في دقائق',
                'is_active' => true,
                'sort_order' => 8,
            ],
        ];

        GalleryItem::truncate();

        foreach ($items as $item) {
            GalleryItem::create($item);
        }
    }
}
