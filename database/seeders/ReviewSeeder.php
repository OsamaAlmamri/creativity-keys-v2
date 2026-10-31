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
                'client_name' => 'عبدالعزيز العتيبي',
                'client_title' => 'حي النرجس، الرياض',
                'rating' => 5,
                'comment' => 'تجربة ممتازة جداً! انقفل علي باب الشقة الساعة 2 بالليل وخلال 20 دقيقة وصلني الفني. فك الباب باحترافية وبدون أي خدش في الباب أو القفل وسعرهم كان معقول جداً مقارنة بالسوق.',
                'service_rendered' => 'فتح باب شقة طوارئ',
                'is_approved' => true,
                'sort_order' => 1,
            ],
            [
                'client_name' => 'م. فهد القحطاني',
                'client_title' => 'حي الملقا، الرياض',
                'rating' => 5,
                'comment' => 'ضاعت مفاتيح سيارتي اللكزس بالكامل وما كان عندي نسخة احتياطية. تواصلت معهم وجاء الفني بالسيارة المتنقلة وقص مفتاح ليزر وبرمج البصمة في مكاني خلال ساعة وحدة بس. شغل احترافي ومطابق للوكالة.',
                'service_rendered' => 'برمجة بصمة سيارة لكزس',
                'is_approved' => true,
                'sort_order' => 2,
            ],
            [
                'client_name' => 'د. سارة المنصور',
                'client_title' => 'حي حطين، الرياض',
                'rating' => 5,
                'comment' => 'ركبوا لي قفل ذكي لباب الفيلا بالبصمة والجوال. شرحوا لي كل التفاصيل والبرمجة وكانوا قمة في الأخلاق والالتزام بالمواعيد، والآن البيت أمان ومرتاحة بدون هم المفاتيح.',
                'service_rendered' => 'تركيب قفل ذكي بالبصمة',
                'is_approved' => true,
                'sort_order' => 3,
            ],
            [
                'client_name' => 'خالد السبيعي',
                'client_title' => 'حي الياسمين، الرياض',
                'rating' => 5,
                'comment' => 'خزنة الشركة علقت وما قبلت الرقم السري. جا المهندس المختص وفتحها دون أي تلف وأعاد ضبط الكود بحرص وسرية عالية. أنصح بالتعامل معهم بشدة.',
                'service_rendered' => 'فتح وصيانة خزنة إلكترونية',
                'is_approved' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($reviews as $review) {
            Review::updateOrCreate(
                ['client_name' => $review['client_name'], 'service_rendered' => $review['service_rendered']],
                $review
            );
        }
    }
}
