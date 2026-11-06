<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class SettingController extends Controller
{
    /**
     * تعريف التابات المدعومة وبياناتها الوصفية
     */
    public const TABS = [
        'branding' => [
            'key' => 'branding',
            'name' => 'الهوية والشعار',
            'short_name' => 'الهوية والشعار',
            'badge' => 'Logo & Favicon',
            'description' => 'شعار الموقع، الأيقونة المفضلة (Favicon)، اسم المحل والمدينة والشعار اللفظي.',
        ],
        'seo' => [
            'key' => 'seo',
            'name' => 'محركات البحث (SEO)',
            'short_name' => 'محركات البحث',
            'badge' => 'Google & Meta',
            'description' => 'وصف الموقع لمحركات البحث، الكلمات المفتاحية، كروت المشاركة، وأكواد Google.',
        ],
        'social' => [
            'key' => 'social',
            'name' => 'وسائل التواصل الاجتماعي',
            'short_name' => 'وسائل التواصل',
            'badge' => 'Social Accounts',
            'description' => 'حسابات التواصل الظاهرة في الفوتر والمرتبطة بملف السكيما التابع لمحركات البحث.',
        ],
        'contact' => [
            'key' => 'contact',
            'name' => 'الاتصال والطوارئ',
            'short_name' => 'بيانات الاتصال',
            'badge' => '24/7 Lines',
            'description' => 'خط الطوارئ السريع 24 ساعة، الهاتف الثابت، رقم الواتساب، والبريد الإلكتروني.',
        ],
        'coverage' => [
            'key' => 'coverage',
            'name' => 'نطاق التغطية الميدانية',
            'short_name' => 'نطاق التغطية',
            'badge' => 'Service Areas',
            'description' => 'أحياء ونطاق التغطية للورش المتنقلة ونص شريط التنبيهات العلوي.',
        ],
        'location' => [
            'key' => 'location',
            'name' => 'العنوان والخرائط والملاحة',
            'short_name' => 'العنوان والخريطة',
            'badge' => 'GPS & Embed',
            'description' => 'العنوان الفعلي، إحداثيات GPS، رابط اتجاهات خرائط قوقل، وتضمين الخريطة.',
        ],
        'stats' => [
            'key' => 'stats',
            'name' => 'إحصائيات وأرقام الثقة',
            'short_name' => 'أرقام الثقة',
            'badge' => 'Trust Numbers',
            'description' => 'سنوات الخبرة، سرعة الوصول، العملاء المخدومين، وعدد الفنيين المرخصين.',
        ],
    ];

    /**
     * عرض صفحة الإعدادات مع تحديد التاب النشط
     */
    public function index(Request $request, ?string $tab = null): View
    {
        $activeTab = $tab ?? $request->query('tab', 'branding');
        if (! array_key_exists($activeTab, self::TABS)) {
            $activeTab = 'branding';
        }

        $tabs = self::TABS;
        $settings = Setting::all()->groupBy('group');

        return view('admin.settings.index', compact('activeTab', 'tabs', 'settings'));
    }

    /**
     * معالجة وحفظ بيانات تاب محدد بشكل مستقل تماماً
     */
    public function updateTab(Request $request, string $tab): RedirectResponse
    {
        if (! array_key_exists($tab, self::TABS)) {
            return redirect()->route('admin.settings.index')
                ->with('error', 'التبويب المطلوب غير متوفر.');
        }

        switch ($tab) {
            case 'branding':
                return $this->updateBrandingTab($request);

            case 'seo':
                return $this->updateSeoTab($request);

            case 'social':
                return $this->updateSocialTab($request);

            case 'contact':
                return $this->updateContactTab($request);

            case 'coverage':
                return $this->updateCoverageTab($request);

            case 'location':
                return $this->updateLocationTab($request);

            case 'stats':
                return $this->updateStatsTab($request);
        }

        return redirect()->route('admin.settings.index', ['tab' => $tab]);
    }

    /**
     * حفظ تاب الهوية والشعار
     */
    protected function updateBrandingTab(Request $request): RedirectResponse
    {
        $request->validate([
            'site_logo_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:3072',
            'site_favicon_file' => 'nullable|mimes:ico,png,svg,jpg,jpeg,webp|max:1024',
            'site_name' => 'required|string|max:100',
            'city_name' => 'required|string|max:50',
            'site_tagline' => 'nullable|string|max:255',
            'site_logo' => 'nullable|string|max:500',
            'site_favicon' => 'nullable|string|max:500',
        ], [
            'site_logo_file.image' => 'يجب أن يكون ملف الشعار صورة صالحة.',
            'site_logo_file.max' => 'يجب ألا يتجاوز حجم ملف الشعار 3 ميجابايت.',
            'site_favicon_file.max' => 'يجب ألا يتجاوز حجم ملف الأيقونة 1 ميجابايت.',
            'site_name.required' => 'اسم المحل / المركز مطلوب.',
            'city_name.required' => 'المدينة الرئيسية مطلوبة.',
        ]);

        // الشعار الرئيسي
        if ($request->boolean('remove_site_logo')) {
            Setting::set('site_logo', '', 'branding', 'شعار الموقع الرئيسي');
        } elseif ($request->hasFile('site_logo_file')) {
            $path = $request->file('site_logo_file')->store('branding', 'public');
            Setting::set('site_logo', Storage::url($path), 'branding', 'شعار الموقع الرئيسي');
        } elseif ($request->has('site_logo')) {
            Setting::set('site_logo', $request->input('site_logo') ?? '', 'branding', 'شعار الموقع الرئيسي');
        }

        // أيقونة التبويب Favicon
        if ($request->boolean('remove_site_favicon')) {
            Setting::set('site_favicon', '', 'branding', 'أيقونة الموقع (Favicon)');
        } elseif ($request->hasFile('site_favicon_file')) {
            $path = $request->file('site_favicon_file')->store('branding', 'public');
            Setting::set('site_favicon', Storage::url($path), 'branding', 'أيقونة الموقع (Favicon)');
        } elseif ($request->has('site_favicon')) {
            Setting::set('site_favicon', $request->input('site_favicon') ?? '', 'branding', 'أيقونة الموقع (Favicon)');
        }

        Setting::set('site_name', $request->input('site_name', 'مفاتيح الإبداع'), 'branding', 'اسم المحل / المركز');
        Setting::set('city_name', $request->input('city_name', 'جدة'), 'branding', 'المدينة الرئيسية');
        Setting::set('site_tagline', $request->input('site_tagline') ?? '', 'branding', 'الشعار اللفظي');

        return redirect()->route('admin.settings.index', ['tab' => 'branding'])
            ->with('success', 'تم حفظ إعدادات الهوية والشعار بنجاح وتحديث كافة واجهات الموقع.');
    }

    /**
     * حفظ تاب محركات البحث والظهور الرقمي SEO
     */
    protected function updateSeoTab(Request $request): RedirectResponse
    {
        $request->validate([
            'og_image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'og_image' => 'nullable|string|max:500',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:1000',
            'seo_alternate_name' => 'nullable|string|max:255',
            'seo_robots' => ['nullable', 'string', Rule::in(['index, follow', 'noindex, nofollow'])],
            'google_site_verification' => 'nullable|string|max:255',
            'google_analytics_id' => 'nullable|string|max:100',
        ], [
            'og_image_file.image' => 'يجب أن تكون صورة المشاركة ملف صورة صالح.',
            'og_image_file.max' => 'يجب ألا يتجاوز حجم صورة المشاركة 4 ميجابايت.',
        ]);

        if ($request->boolean('remove_og_image')) {
            Setting::set('og_image', '', 'seo', 'صورة المشاركة الافتراضية');
        } elseif ($request->hasFile('og_image_file')) {
            $path = $request->file('og_image_file')->store('seo', 'public');
            Setting::set('og_image', Storage::url($path), 'seo', 'صورة المشاركة الافتراضية');
        } elseif ($request->has('og_image')) {
            Setting::set('og_image', $request->input('og_image') ?? '', 'seo', 'صورة المشاركة الافتراضية');
        }

        Setting::set('meta_description', $request->input('meta_description') ?? '', 'seo', 'وصف الموقع لمحركات البحث');
        Setting::set('meta_keywords', $request->input('meta_keywords') ?? '', 'seo', 'الكلمات المفتاحية لموقع الويب');
        Setting::set('seo_alternate_name', $request->input('seo_alternate_name') ?? '', 'seo', 'الاسم البديل في السكيما');
        Setting::set('seo_robots', $request->input('seo_robots', 'index, follow'), 'seo', 'توجيهات أرشفة روبوتات البحث');
        Setting::set('google_site_verification', $request->input('google_site_verification') ?? '', 'seo', 'رمز التحقق من Google Search Console');
        Setting::set('google_analytics_id', $request->input('google_analytics_id') ?? '', 'seo', 'معرف Google Analytics 4');

        return redirect()->route('admin.settings.index', ['tab' => 'seo'])
            ->with('success', 'تم حفظ إعدادات محركات البحث (SEO) والظهور الرقمي بنجاح.');
    }

    /**
     * حفظ تاب وسائل التواصل الاجتماعي
     */
    protected function updateSocialTab(Request $request): RedirectResponse
    {
        $request->validate([
            'social_twitter' => 'nullable|url|max:255',
            'social_instagram' => 'nullable|url|max:255',
            'social_tiktok' => 'nullable|url|max:255',
            'social_telegram' => 'nullable|url|max:255',
            'social_snapchat' => 'nullable|url|max:255',
            'social_facebook' => 'nullable|url|max:255',
            'social_youtube' => 'nullable|url|max:255',
            'social_linkedin' => 'nullable|url|max:255',
        ], [
            'social_twitter.url' => 'يرجى إدخال رابط صحيح لمنصة X (تويتر).',
            'social_instagram.url' => 'يرجى إدخال رابط صحيح لحساب انستغرام.',
            'social_tiktok.url' => 'يرجى إدخال رابط صحيح لحساب تيك توك.',
            'social_telegram.url' => 'يرجى إدخال رابط صحيح لقناة أو حساب تيليجرام.',
            'social_snapchat.url' => 'يرجى إدخال رابط صحيح لحساب سناب شات.',
            'social_facebook.url' => 'يرجى إدخال رابط صحيح لصفحة فيسبوك.',
            'social_youtube.url' => 'يرجى إدخال رابط صحيح لقناة يوتيوب.',
            'social_linkedin.url' => 'يرجى إدخال رابط صحيح لصفحة لينكد إن.',
        ]);

        $socialAccounts = [
            'social_twitter' => 'حساب منصة X (تويتر)',
            'social_instagram' => 'حساب انستغرام',
            'social_tiktok' => 'حساب تيك توك',
            'social_telegram' => 'قناة أو حساب تيليجرام',
            'social_snapchat' => 'حساب سناب شات',
            'social_facebook' => 'حساب فيسبوك',
            'social_youtube' => 'قناة يوتيوب',
            'social_linkedin' => 'صفحة لينكد إن',
        ];

        foreach ($socialAccounts as $key => $label) {
            Setting::set($key, $request->input($key) ?? '', 'social', $label);
        }

        return redirect()->route('admin.settings.index', ['tab' => 'social'])
            ->with('success', 'تم حفظ حسابات وروابط وسائل التواصل بنجاح وتحديث الفوتر فوراً.');
    }

    /**
     * حفظ تاب أرقام الاتصال وخطوط الطوارئ
     */
    protected function updateContactTab(Request $request): RedirectResponse
    {
        $request->validate([
            'emergency_phone' => 'required|string|max:30',
            'phone' => 'nullable|string|max:30',
            'whatsapp' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:100',
        ], [
            'emergency_phone.required' => 'رقم خط الطوارئ السريع (24 ساعة) مطلوب.',
            'email.email' => 'يرجى إدخال بريد إلكتروني صحيح.',
        ]);

        Setting::set('emergency_phone', $request->input('emergency_phone'), 'contact', 'خط الطوارئ 24/7');
        Setting::set('phone', $request->input('phone') ?? '', 'contact', 'رقم الهاتف الرئيسي');
        Setting::set('whatsapp', $request->input('whatsapp') ?? '', 'contact', 'رقم الواتساب');
        Setting::set('email', $request->input('email') ?? '', 'contact', 'البريد الإلكتروني');

        return redirect()->route('admin.settings.index', ['tab' => 'contact'])
            ->with('success', 'تم حفظ أرقام الاتصال وخطوط الطوارئ بنجاح.');
    }

    /**
     * حفظ تاب نطاق التغطية والخدمات الميدانية
     */
    protected function updateCoverageTab(Request $request): RedirectResponse
    {
        $request->validate([
            'coverage_areas' => 'nullable|string|max:4000',
            'coverage_note' => 'nullable|string|max:255',
        ]);

        Setting::set('coverage_areas', $request->input('coverage_areas') ?? '', 'coverage', 'أحياء ونطاق التغطية');
        Setting::set('coverage_note', $request->input('coverage_note') ?? '', 'coverage', 'ملاحظة تغطية شريط الطوارئ');

        return redirect()->route('admin.settings.index', ['tab' => 'coverage'])
            ->with('success', 'تم حفظ نطاق التغطية والخدمات الميدانية بنجاح.');
    }

    /**
     * حفظ تاب العنوان والخرائط والملاحة
     */
    protected function updateLocationTab(Request $request): RedirectResponse
    {
        $request->validate([
            'address' => 'nullable|string|max:255',
            'working_hours' => 'nullable|string|max:255',
            'map_directions_url' => 'nullable|url|max:500',
            'map_latitude' => 'nullable|string|max:50',
            'map_longitude' => 'nullable|string|max:50',
            'google_map_embed' => 'nullable|string|max:2000',
        ], [
            'map_directions_url.url' => 'رابط الملاحة المباشر يجب أن يكون رابط إنترنت صالح (URL).',
        ]);

        Setting::set('address', $request->input('address') ?? '', 'location', 'العنوان الفعلي');
        Setting::set('working_hours', $request->input('working_hours') ?? '', 'location', 'ساعات العمل');
        Setting::set('map_directions_url', $request->input('map_directions_url') ?? '', 'location', 'رابط الملاحة المباشر');
        Setting::set('map_latitude', $request->input('map_latitude') ?? '', 'location', 'خط العرض (Latitude)');
        Setting::set('map_longitude', $request->input('map_longitude') ?? '', 'location', 'خط الطول (Longitude)');
        Setting::set('google_map_embed', $request->input('google_map_embed') ?? '', 'location', 'رابط تضمين خريطة قوقل');

        return redirect()->route('admin.settings.index', ['tab' => 'location'])
            ->with('success', 'تم حفظ بيانات العنوان وموقع الخريطة والاتجاهات بنجاح.');
    }

    /**
     * حفظ تاب أرقام وإحصائيات الثقة
     */
    protected function updateStatsTab(Request $request): RedirectResponse
    {
        $request->validate([
            'years_experience' => 'nullable|string|max:50',
            'arrival_time' => 'nullable|string|max:50',
            'happy_clients' => 'nullable|string|max:50',
            'team_size' => 'nullable|string|max:50',
            'google_review_rating' => 'nullable|string|max:10',
            'google_reviews_count' => 'nullable|string|max:30',
            'google_reviews_url' => 'nullable|url|max:255',
            'google_reviews_subtitle' => 'nullable|string|max:255',
            'reviews_title' => 'nullable|string|max:255',
            'reviews_description' => 'nullable|string|max:500',
        ]);

        Setting::set('years_experience', $request->input('years_experience') ?? '', 'stats', 'سنوات الخبرة');
        Setting::set('arrival_time', $request->input('arrival_time') ?? '', 'stats', 'سرعة الوصول للطوارئ');
        Setting::set('happy_clients', $request->input('happy_clients') ?? '', 'stats', 'العملاء المخدومين');
        Setting::set('team_size', $request->input('team_size') ?? '', 'stats', 'عدد الفنيين');
        Setting::set('google_review_rating', $request->input('google_review_rating') ?? '4.9', 'stats', 'تقييم قوقل العام');
        Setting::set('google_reviews_count', $request->input('google_reviews_count') ?? '185+', 'stats', 'إجمالي تقييمات قوقل');
        Setting::set('google_reviews_url', $request->input('google_reviews_url') ?? '', 'stats', 'رابط صفحة التقييمات على خرائط Google');
        Setting::set('google_reviews_subtitle', $request->input('google_reviews_subtitle') ?? '', 'stats', 'النص التوضيحي لتقييمات قوقل');
        Setting::set('reviews_title', $request->input('reviews_title') ?? '', 'stats', 'عنوان قسم التقييمات');
        Setting::set('reviews_description', $request->input('reviews_description') ?? '', 'stats', 'وصف قسم التقييمات');

        return redirect()->route('admin.settings.index', ['tab' => 'stats'])
            ->with('success', 'تم حفظ إحصائيات وأرقام الثقة وإعدادات التقييمات بنجاح.');
    }

    /**
     * الطريقة العامة للتوافق مع الاختبارات السابقة والتحديث الشامل
     */
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'site_logo_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:3072',
            'site_favicon_file' => 'nullable|mimes:ico,png,svg,jpg,jpeg,webp|max:1024',
            'og_image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
        ], [
            'site_logo_file.image' => 'يجب أن يكون ملف الشعار صورة صالحة.',
            'site_logo_file.max' => 'يجب ألا يتجاوز حجم ملف الشعار 3 ميجابايت.',
            'site_favicon_file.max' => 'يجب ألا يتجاوز حجم ملف الأيقونة 1 ميجابايت.',
            'og_image_file.image' => 'يجب أن تكون صورة المشاركة ملف صورة صالح.',
            'og_image_file.max' => 'يجب ألا يتجاوز حجم صورة المشاركة 4 ميجابايت.',
        ]);

        // 1. Site Logo
        if ($request->boolean('remove_site_logo')) {
            Setting::set('site_logo', '', 'branding', 'شعار الموقع الرئيسي');
        } elseif ($request->hasFile('site_logo_file')) {
            $path = $request->file('site_logo_file')->store('branding', 'public');
            Setting::set('site_logo', Storage::url($path), 'branding', 'شعار الموقع الرئيسي');
        } elseif ($request->has('site_logo')) {
            Setting::set('site_logo', $request->input('site_logo') ?? '', 'branding', 'شعار الموقع الرئيسي');
        }

        // 2. Favicon
        if ($request->boolean('remove_site_favicon')) {
            Setting::set('site_favicon', '', 'branding', 'أيقونة الموقع (Favicon)');
        } elseif ($request->hasFile('site_favicon_file')) {
            $path = $request->file('site_favicon_file')->store('branding', 'public');
            Setting::set('site_favicon', Storage::url($path), 'branding', 'أيقونة الموقع (Favicon)');
        } elseif ($request->has('site_favicon')) {
            Setting::set('site_favicon', $request->input('site_favicon') ?? '', 'branding', 'أيقونة الموقع (Favicon)');
        }

        // 3. OG Image (Social Share Image)
        if ($request->boolean('remove_og_image')) {
            Setting::set('og_image', '', 'seo', 'صورة المشاركة الافتراضية');
        } elseif ($request->hasFile('og_image_file')) {
            $path = $request->file('og_image_file')->store('seo', 'public');
            Setting::set('og_image', Storage::url($path), 'seo', 'صورة المشاركة الافتراضية');
        } elseif ($request->has('og_image')) {
            Setting::set('og_image', $request->input('og_image') ?? '', 'seo', 'صورة المشاركة الافتراضية');
        }

        $inputs = $request->except([
            '_token',
            '_method',
            'site_logo_file',
            'site_favicon_file',
            'og_image_file',
            'remove_site_logo',
            'remove_site_favicon',
            'remove_og_image',
            'site_logo',
            'site_favicon',
            'og_image',
        ]);

        foreach ($inputs as $key => $value) {
            Setting::set($key, $value);
        }

        return redirect()->route('admin.settings.index')->with('success', 'تم حفظ إعدادات الموقع بنجاح وتحديث الواجهة مباشرة.');
    }
}
