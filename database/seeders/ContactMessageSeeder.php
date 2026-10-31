<?php

namespace Database\Seeders;

use App\Models\ContactMessage;
use Illuminate\Database\Seeder;

class ContactMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $messages = [
            [
                'name' => 'محمد الشمري',
                'phone' => '0501112233',
                'service_needed' => 'برمجة واستخراج مفاتيح السيارات والبصمات',
                'city_district' => 'جدة - حي الروضة',
                'is_emergency' => true,
                'message' => 'السلام عليكم، فقدت مفتاح سيارتي كامري 2023 وأنا واقف بمواقف السوق. أحتاج فني يجي للموقع في أسرع وقت ممكن.',
                'is_read' => false,
                'notes' => null,
            ],
            [
                'name' => 'سلطان الدوسري',
                'phone' => '0554445566',
                'service_needed' => 'توريد وتركيب الأقفال الذكية والإلكترونية',
                'city_district' => 'جدة - حي الشاطئ',
                'is_emergency' => false,
                'message' => 'مرحباً، أود الاستفسار عن أفضل نوع قفل ذكي لباب خشب خارجي مع خاصية البصمة والتطبيق وسعر التركيب.',
                'is_read' => true,
                'notes' => 'تم التواصل معه عبر الواتساب وإرسال الكتالوج',
            ],
        ];

        foreach ($messages as $msg) {
            ContactMessage::create($msg);
        }
    }
}
