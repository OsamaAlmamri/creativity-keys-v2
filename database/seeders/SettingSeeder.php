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
            ['key' => 'site_name', 'value' => 'مفتاح باب البستان', 'group' => 'general', 'label' => 'اسم المحل / المركز', 'type' => 'text'],
            ['key' => 'site_tagline', 'value' => 'قص وبرمجة المفاتيح الذكية وفتح الأقفال على مدار 24 ساعة', 'group' => 'general', 'label' => 'الشعار التعريفي', 'type' => 'text'],
            ['key' => 'city_name', 'value' => 'جدة', 'group' => 'general', 'label' => 'المدينة الرئيسية', 'type' => 'text'],
            ['key' => 'coverage_areas', 'value' => 'الروضة • السلامة • الزهراء • الشاطئ • الحمراء • المروة • الصفا • أبحر', 'group' => 'general', 'label' => 'نطاق وأحياء التغطية الميدانية', 'type' => 'textarea'],
            ['key' => 'coverage_note', 'value' => 'ورش متنقلة وفنيون مرخصون لجميع أحياء ومناطق جدة', 'group' => 'general', 'label' => 'ملاحظة تغطية شريط الطوارئ', 'type' => 'text'],
            ['key' => 'meta_description', 'value' => 'محل ومختبر مفتاح باب البستان: خدمات نسخ وقص وبرمجة مفاتيح السيارات، فتح الأبواب المقفلة للطوارئ 24 ساعة، صيانة وتركيب الأقفال الذكية وفتح الخزنات في جدة.', 'group' => 'general', 'label' => 'وصف الموقع لمحركات البحث', 'type' => 'textarea'],

            // الاتصال وموقع الخريطة
            ['key' => 'phone', 'value' => '0551234567', 'group' => 'contact', 'label' => 'رقم الهاتف الرئيسي', 'type' => 'text'],
            ['key' => 'emergency_phone', 'value' => '0559998877', 'group' => 'contact', 'label' => 'خط الطوارئ 24/7', 'type' => 'text'],
            ['key' => 'whatsapp', 'value' => '966551234567', 'group' => 'contact', 'label' => 'رقم الواتساب (مع الرمز الدولي)', 'type' => 'text'],
            ['key' => 'email', 'value' => 'info@keyshop-sa.com', 'group' => 'contact', 'label' => 'البريد الإلكتروني', 'type' => 'text'],
            ['key' => 'address', 'value' => 'جدة - طريق الملك عبد العزيز - حي الشاطئ', 'group' => 'contact', 'label' => 'العنوان الفعلي', 'type' => 'text'],
            ['key' => 'working_hours', 'value' => 'خدمة الطوارئ والورشة المتنقلة: 24/7 | المعرض: السبت إلى الخميس 8:00 ص - 11:30 م (الجمعة 4:00 م - 11:30 م)', 'group' => 'contact', 'label' => 'ساعات العمل', 'type' => 'textarea'],
            ['key' => 'map_directions_url', 'value' => '', 'group' => 'contact', 'label' => 'رابط اتجاهات قوقل ماب المباشر', 'type' => 'text'],
            ['key' => 'map_latitude', 'value' => '21.543333', 'group' => 'contact', 'label' => 'خط العرض (Latitude)', 'type' => 'text'],
            ['key' => 'map_longitude', 'value' => '39.172778', 'group' => 'contact', 'label' => 'خط الطول (Longitude)', 'type' => 'text'],
            ['key' => 'google_map_embed', 'value' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d118804.8142784534!2d39.172778!3d21.543333!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x15c3d01fb1137e59%3A0xe059579737b118db!2sJeddah%20Saudi%20Arabia!5e0!3m2!1sen!2ssa!4v1700000000000!5m2!1sen!2ssa', 'group' => 'contact', 'label' => 'رابط تضمين خريطة قوقل', 'type' => 'textarea'],

            // الإحصائيات ومعلومات الثقة
            ['key' => 'years_experience', 'value' => '15+', 'group' => 'stats', 'label' => 'سنوات الخبرة', 'type' => 'text'],
            ['key' => 'happy_clients', 'value' => '18,500+', 'group' => 'stats', 'label' => 'عميل تم خدمتهم', 'type' => 'text'],
            ['key' => 'certified_techs', 'value' => '12 فني معتمد', 'group' => 'stats', 'label' => 'فريق الفنيين', 'type' => 'text'],
            ['key' => 'arrival_time', 'value' => '15 - 25 دقيقة', 'group' => 'stats', 'label' => 'متوسط وقت الوصول للطوارئ', 'type' => 'text'],

            // نبذة من نحن
            ['key' => 'about_title', 'value' => 'أكثر من 15 عاماً من الريادة في عالم الأقفال والمفاتيح المشفرة بجدة', 'group' => 'about', 'label' => 'عنوان من نحن', 'type' => 'text'],
            ['key' => 'about_story', 'value' => 'تأسس مركز "مفتاح باب البستان" ليقدم مفهوماً عصرياً متطوراً لخدمات المفاتيح وفتح الأقفال. نمتلك أحدث ما توصلت إليه التكنولوجيا الإيطالية والألمانية في أجهزة قص المفاتيح بالليزر وبرمجة كمبيوتر السيارات.\n\nسواء واجهت موقفاً طارئاً بإغلاق باب منزلك أو سيارتك، أو فقدت مفاتيحك المشفرة، أو رغبت في ترقية أمان منزلك بنظام أقفال ذكي، فريقنا المعتمد على أهبة الاستعداد لخدمتك في ورش متنقلة مجهزة بأعلى المعايير.', 'group' => 'about', 'label' => 'نص من نحن', 'type' => 'textarea'],

            // الثيم والمظهر
            ['key' => 'theme_preset', 'value' => 'amber', 'group' => 'theme', 'label' => 'نمط لون السمة', 'type' => 'text'],
            ['key' => 'theme_custom_color', 'value' => '#f59e0b', 'group' => 'theme', 'label' => 'اللون المخصص', 'type' => 'text'],
            ['key' => 'theme_mode', 'value' => 'dark', 'group' => 'theme', 'label' => 'وضع المظهر الافتراضي', 'type' => 'text'],
            ['key' => 'theme_visitor_toggle', 'value' => '1', 'group' => 'theme', 'label' => 'السماح للزوار بتبديل الوضع', 'type' => 'boolean'],
            ['key' => 'theme_font', 'value' => 'Cairo', 'group' => 'theme', 'label' => 'نوع الخط العربي', 'type' => 'text'],
            ['key' => 'theme_radius', 'value' => 'medium', 'group' => 'theme', 'label' => 'نمط حواف الأزرار والبطاقات', 'type' => 'text'],
            ['key' => 'show_emergency_ticker', 'value' => '1', 'group' => 'theme', 'label' => 'إظهار شريط الطوارئ العلوي', 'type' => 'boolean'],
            ['key' => 'show_header_contact_buttons', 'value' => '1', 'group' => 'theme', 'label' => 'إظهار أزرار اتصال الهيدر', 'type' => 'boolean'],
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
