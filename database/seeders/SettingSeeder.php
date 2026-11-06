<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // العام
            ['key' => 'site_name', 'value' => 'مفاتيح الإبداع', 'group' => 'general', 'label' => 'اسم المحل / المركز', 'type' => 'text'],
            ['key' => 'site_tagline', 'value' => 'قص وبرمجة مفاتيح السيارات وفتح الأقفال 24/7', 'group' => 'general', 'label' => 'الشعار التعريفي', 'type' => 'text'],
            ['key' => 'city_name', 'value' => 'جدة', 'group' => 'general', 'label' => 'المدينة الرئيسية', 'type' => 'text'],
            ['key' => 'coverage_areas', 'value' => 'ابحر • الهدى • النزلة • اليمانيه • حي الثغر • الجوهرة • الرحمة • البوادي • المروة • الصفاء • السامر • الواحه • الشروق • مريخ • الريان • الرحمانية • النزهه • الرحاب • عسفان • الرحيلي • الحمداينه • المرجان • الزهراء • البساتين • النهضه • الشاطئ • السلامه • الروضه • الجامعه • المنار • طيبه • الفلاح • الصاليحه • البشاير • الروابي • المتزهات • العدل • الأمير فواز الشمالي • الأمير فواز الجنوبي • الخمرة • السنابل • الفيصيله • مشرفه • العزيزية • مخطط الرياض • مخطط الزهور • مخطط العمرية • مخطط الصاله الشماليه • مخطط الخروج • مخطط الوفاء • مخطط الموسى • مخطط الحناكي • مخطط المشاعر • مخطط بحرة • حي التيسير • حي الوادي • حي الورود • حي النسيم • حي بريمان • حي الياقوت • حي الوزيرية • الزمرد • الرويس • ابرق • الفردوس • الفروسية • القوزين • الكرامة • اللؤلؤ • الرغامة • الفيحاء • السبيل • السروات • السرورية • القرينية • الشراع • الشفاء • الصحيفة • الصواري • الضاحيه • المحمدية • المسرة • المحجر • المليساء • النعيم • النخيل', 'group' => 'general', 'label' => 'نطاق وأحياء التغطية الميدانية', 'type' => 'textarea'],
            ['key' => 'coverage_note', 'value' => 'ورش متنقلة وفنيون مرخصون لجميع أحياء ومناطق ومخططات جدة على مدار 24 ساعة', 'group' => 'general', 'label' => 'ملاحظة تغطية شريط الطوارئ', 'type' => 'text'],
            ['key' => 'meta_description', 'value' => 'محل مفاتيح الإبداع بجدة: خبراء قص وبرمجة مفاتيح وريموتات السيارات الحديثة، فتح الأبواب والسيارات والخزانات المقفلة بدون كسر 24 ساعة، إلغاء نظام ماي كي وتصليح السويتشات.', 'group' => 'general', 'label' => 'وصف الموقع لمحركات البحث', 'type' => 'textarea'],

            // الهوية والشعار
            ['key' => 'site_logo', 'value' => '', 'group' => 'branding', 'label' => 'شعار الموقع الرئيسي', 'type' => 'text'],
            ['key' => 'site_favicon', 'value' => '', 'group' => 'branding', 'label' => 'أيقونة الموقع (Favicon)', 'type' => 'text'],

            // تحسين محركات البحث SEO والتواصل
            ['key' => 'meta_keywords', 'value' => 'مفاتيح الابداع جدة, برمجة مفاتيح سيارات جدة, فتح ابواب سيارات جدة, فتح اقفال منازل طوارئ, الغاء نظام ماي كي فورد, تصليح كوالين وسوتشات سيارات, عمل مفاتيح بدل فاقد جدة, نسخ مفاتيح مشفرة, صب مفاتيح جدة, نجار فتح اقفال 24 ساعة', 'group' => 'seo', 'label' => 'الكلمات المفتاحية لموقع الويب (Meta Keywords)', 'type' => 'textarea'],
            ['key' => 'og_image', 'value' => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?auto=format&fit=crop&w=1200&h=630&q=80', 'group' => 'seo', 'label' => 'صورة المشاركة الافتراضية (Social Share Image)', 'type' => 'text'],
            ['key' => 'seo_robots', 'value' => 'index, follow', 'group' => 'seo', 'label' => 'توجيهات محركات البحث (Robots Meta)', 'type' => 'text'],
            ['key' => 'seo_alternate_name', 'value' => 'محل وورشة مفاتيح الإبداع لقص وبرمجة المفاتيح وفتح الأقفال بجدة', 'group' => 'seo', 'label' => 'الاسم البديل في نتائج البحث والسكيما', 'type' => 'text'],
            ['key' => 'google_site_verification', 'value' => '', 'group' => 'seo', 'label' => 'رمز التحقق من Google Search Console', 'type' => 'text'],
            ['key' => 'google_analytics_id', 'value' => '', 'group' => 'seo', 'label' => 'معرف Google Analytics (GA4)', 'type' => 'text'],
            ['key' => 'social_twitter', 'value' => '', 'group' => 'seo', 'label' => 'حساب منصة X (تويتر)', 'type' => 'text'],
            ['key' => 'social_instagram', 'value' => '', 'group' => 'seo', 'label' => 'حساب انستغرام', 'type' => 'text'],
            ['key' => 'social_tiktok', 'value' => '', 'group' => 'seo', 'label' => 'حساب تيك توك', 'type' => 'text'],
            ['key' => 'social_snapchat', 'value' => '', 'group' => 'seo', 'label' => 'حساب سناب شات', 'type' => 'text'],
            ['key' => 'social_facebook', 'value' => '', 'group' => 'seo', 'label' => 'حساب فيسبوك', 'type' => 'text'],
            ['key' => 'social_youtube', 'value' => '', 'group' => 'seo', 'label' => 'قناة يوتيوب', 'type' => 'text'],
            ['key' => 'social_linkedin', 'value' => '', 'group' => 'seo', 'label' => 'صفحة لينكد إن', 'type' => 'text'],

            // الاتصال وموقع الخريطة
            ['key' => 'phone', 'value' => '0568191921', 'group' => 'contact', 'label' => 'رقم الهاتف الرئيسي', 'type' => 'text'],
            ['key' => 'emergency_phone', 'value' => '0568191921', 'group' => 'contact', 'label' => 'رقم هاتف الطوارئ السريع 24/7', 'type' => 'text'],
            ['key' => 'whatsapp', 'value' => '966568191921', 'group' => 'contact', 'label' => 'رقم الواتساب المباشر', 'type' => 'text'],
            ['key' => 'email', 'value' => 'info@creativity-keys.com', 'group' => 'contact', 'label' => 'البريد الإلكتروني الرسمي', 'type' => 'text'],
            ['key' => 'address', 'value' => 'المملكة العربية السعودية - جدة (ورش متنقلة بكافة الأحياء)', 'group' => 'contact', 'label' => 'العنوان الفعلي', 'type' => 'text'],
            ['key' => 'working_hours', 'value' => 'خدمة الطوارئ والورشة المتنقلة: 24/7 على مدار الساعة | المركز: السبت إلى الخميس 8:00 ص - 11:30 م (الجمعة 4:00 م - 11:30 م)', 'group' => 'contact', 'label' => 'ساعات العمل', 'type' => 'textarea'],
            ['key' => 'map_directions_url', 'value' => 'https://maps.google.com/?q=21.774671,39.093850', 'group' => 'contact', 'label' => 'رابط اتجاهات قوقل ماب المباشر', 'type' => 'text'],
            ['key' => 'map_latitude', 'value' => '21.774671', 'group' => 'contact', 'label' => 'خط العرض (Latitude)', 'type' => 'text'],
            ['key' => 'map_longitude', 'value' => '39.093850', 'group' => 'contact', 'label' => 'خط الطول (Longitude)', 'type' => 'text'],
            ['key' => 'google_map_embed', 'value' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3705.144421061136!2d39.09384988761156!3d21.77467086737399!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x15c163fae5e32031%3A0x678393f18d5d86a1!2z2YXZgdiq2KfYrSDYp9mE2KfYqNiv2KfYuQ!5e0!3m2!1sar!2sus!4v1751850259448!5m2!1sar!2sus', 'group' => 'contact', 'label' => 'رابط تضمين خريطة قوقل', 'type' => 'textarea'],

            // الإحصائيات ومعلومات الثقة
            ['key' => 'years_experience', 'value' => '15+', 'group' => 'stats', 'label' => 'سنوات الخبرة', 'type' => 'text'],
            ['key' => 'happy_clients', 'value' => '18,500+', 'group' => 'stats', 'label' => 'عميل تم خدمتهم', 'type' => 'text'],
            ['key' => 'certified_techs', 'value' => '12 فني معتمد', 'group' => 'stats', 'label' => 'فريق الفنيين', 'type' => 'text'],
            ['key' => 'arrival_time', 'value' => '15 - 25 دقيقة', 'group' => 'stats', 'label' => 'متوسط وقت الوصول للطوارئ', 'type' => 'text'],

            // نبذة من نحن
            ['key' => 'about_title', 'value' => 'محل مفاتيح الإبداع بجدة — اتصل نصل نتشرف بخدمتكم من أي مكان في جدة', 'group' => 'about', 'label' => 'عنوان من نحن', 'type' => 'text'],
            ['key' => 'about_story', 'value' => 'محل مفاتيح الإبداع هو وجهتك الأولى في جدة لكافة خدمات مفاتيح السيارات والمنازل والخزانات.\n\nنتميز بخبرة طويلة وفريق فنيين متنقل ومجهز بأحدث أجهزة الليزر الإيطالية والألمانية لقص المفاتيح المشفرة بدقة متناهية وبرمجة كمبيوتر وريموتات أحدث موديلات السيارات البصمة والعادية.\n\nنقدم خدمات فتح السيارات المقفلة وفك الأبواب والشقق بدون أي كسر أو خدش، مع الالتزام بأعلى معايير السرعة والأمان.\n\nشعارنا: هدفنا خدمتكم وغايتنا رضاكم — اتصل نصل أينما كنت في جدة 24/7.', 'group' => 'about', 'label' => 'نص من نحن', 'type' => 'textarea'],

            // الثيم والمظهر
            ['key' => 'theme_preset', 'value' => 'amber', 'group' => 'theme', 'label' => 'نمط لون السمة', 'type' => 'text'],
            ['key' => 'theme_custom_color', 'value' => '#f59e0b', 'group' => 'theme', 'label' => 'اللون المخصص', 'type' => 'text'],
            ['key' => 'theme_mode', 'value' => 'dark', 'group' => 'theme', 'label' => 'وضع المظهر الافتراضي', 'type' => 'text'],
            ['key' => 'theme_visitor_toggle', 'value' => '1', 'group' => 'theme', 'label' => 'السماح للزوار بتبديل الوضع', 'type' => 'boolean'],
            ['key' => 'theme_font', 'value' => 'Cairo', 'group' => 'theme', 'label' => 'نوع الخط العربي', 'type' => 'text'],
            ['key' => 'theme_radius', 'value' => 'medium', 'group' => 'theme', 'label' => 'نمط حواف الأزرار والبطاقات', 'type' => 'text'],
            ['key' => 'show_emergency_ticker', 'value' => '1', 'group' => 'theme', 'label' => 'إظهار شريط الطوارئ العلوي', 'type' => 'boolean'],
            ['key' => 'show_header_contact_buttons', 'value' => '0', 'group' => 'theme', 'label' => 'إظهار أزرار اتصال الهيدر', 'type' => 'boolean'],
            ['key' => 'show_floating_buttons', 'value' => '1', 'group' => 'theme', 'label' => 'إظهار أزرار الاتصال العائمة', 'type' => 'boolean'],
            ['key' => 'show_home_articles', 'value' => '1', 'group' => 'theme', 'label' => 'إظهار قسم المقالات بالرئيسية', 'type' => 'boolean'],
            ['key' => 'header_style', 'value' => 'sticky', 'group' => 'theme', 'label' => 'نمط شريط التنقل', 'type' => 'text'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
