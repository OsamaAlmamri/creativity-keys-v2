<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reviews = [
            [
                'client_name' => 'أبو خالد',
                'client_title' => 'عميل معتمد • تقييم Google',
                'rating' => 5,
                'comment' => 'خدمة ممتازة وسريعة، نسخوا لي مفتاح السيارة في دقائق وبجودة عالية جداً. تعامل راقٍ وأسعار مناسبة.',
                'service_rendered' => 'برمجة ونسخ مفتاح سيارة',
                'is_approved' => true,
                'sort_order' => 1,
            ],
            [
                'client_name' => 'سارة العتيبي',
                'client_title' => 'عميلة معتمدة • تقييم Google',
                'rating' => 5,
                'comment' => 'ركبت قفل ذكي للمنزل، الفني محترف وشرح لي طريقة الاستخدام بالتفصيل. خدمة تستحق الثقة.',
                'service_rendered' => 'تركيب قفل ذكي للمنزل',
                'is_approved' => true,
                'sort_order' => 2,
            ],
            [
                'client_name' => 'محمد الحربي',
                'client_title' => 'عميل معتمد • تقييم Google',
                'rating' => 5,
                'comment' => 'اتصلت بهم لحالة طارئة ليلاً ووصلوا بسرعة وفتحوا الباب بأمان دون أي تلف. شكراً لكم.',
                'service_rendered' => 'فتح باب طوارئ ليلاً بدون كسر',
                'is_approved' => true,
                'sort_order' => 3,
            ],
            [
                'client_name' => 'عبدالله القحطاني',
                'client_title' => 'عميل معتمد • تقييم Google',
                'rating' => 5,
                'comment' => 'أسعار منافسة ودقة في العمل. أصبحت عميلاً دائماً لهم لنسخ مفاتيح المحل.',
                'service_rendered' => 'نسخ وتفصيل مفاتيح محلات',
                'is_approved' => true,
                'sort_order' => 4,
            ],
            [
                'client_name' => 'نورة السالم',
                'client_title' => 'عميلة معتمدة • تقييم Google',
                'rating' => 5,
                'comment' => 'جهاز متطور لبرمجة المفاتيح الإلكترونية، حلّوا مشكلة مفتاح سيارتي التي عجزت عنها جهات أخرى.',
                'service_rendered' => 'برمجة كمبيوتر ومفتاح إلكتروني',
                'is_approved' => true,
                'sort_order' => 5,
            ],
            [
                'client_name' => 'فيصل الدوسري',
                'client_title' => 'عميل معتمد • تقييم Google',
                'rating' => 5,
                'comment' => 'احترافية عالية ومواعيد دقيقة، ركبوا أقفال الأبواب بأمان شديد. تجربة ممتازة بشكل عام.',
                'service_rendered' => 'تركيب وصيانة أقفال أبواب',
                'is_approved' => true,
                'sort_order' => 6,
            ],
        ];

        // تنظيف التقييمات السابقة وحقن التقييمات الحقيقية الموثقة من قوقل
        Review::truncate();

        foreach ($reviews as $review) {
            Review::create($review);
        }
    }
}
