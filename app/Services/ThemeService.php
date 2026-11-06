<?php

namespace App\Services;

use App\Models\Setting;

class ThemeService
{
    /**
     * Preset color configurations.
     *
     * @return array<string, array{name: string, 300: string, 400: string, 500: string, 600: string, 700: string, rgb: string, description: string}>
     */
    public static function presetColors(): array
    {
        return [
            'amber' => [
                'name' => 'الذهبي النحاسي (الأصلي)',
                '300' => '#fcd34d',
                '400' => '#fbbf24',
                '500' => '#f59e0b',
                '600' => '#d97706',
                '700' => '#b45309',
                'rgb' => '245, 158, 11',
                'description' => 'اللون الكلاسيكي الفخم المعتمد لمحلات المفاتيح والأقفال النحاسية.',
            ],
            'sage' => [
                'name' => 'أخضر الميرمية والزيتوني (مفاتيح الإبداع)',
                '300' => '#c0cfb2',
                '400' => '#a5ba95',
                '500' => '#588157',
                '600' => '#4a6b53',
                '700' => '#3a5a40',
                'rgb' => '88, 129, 87',
                'description' => 'الثيم الأندلسي الهادئ المعتمد في مفاتيح الإبداع بدرجات الميرمية والزيتوني الفخم (Sage & Olive).',
            ],
            'blue' => [
                'name' => 'الأزرق الملكي التقني',
                '300' => '#93c5fd',
                '400' => '#60a5fa',
                '500' => '#3b82f6',
                '600' => '#2563eb',
                '700' => '#1d4ed8',
                'rgb' => '59, 130, 246',
                'description' => 'يعكس الأمان المطلق والاحترافية الموثوقة والتقنية الحديثة.',
            ],
            'emerald' => [
                'name' => 'الأخضر الزمردي',
                '300' => '#6ee7b7',
                '400' => '#34d399',
                '500' => '#10b981',
                '600' => '#059669',
                '700' => '#047857',
                'rgb' => '16, 185, 129',
                'description' => 'يرمز للسلامة والحلول السريعة والحيوية والهدوء النفسي للعميل.',
            ],
            'red' => [
                'name' => 'الأحمر القرمزي (طوارئ)',
                '300' => '#fca5a5',
                '400' => '#f87171',
                '500' => '#ef4444',
                '600' => '#dc2626',
                '700' => '#b91c1c',
                'rgb' => '239, 68, 68',
                'description' => 'يعبر عن السرعة القصوى وخدمات الإنقاذ والطوارئ على مدار 24 ساعة.',
            ],
            'indigo' => [
                'name' => 'البنفسجي الإنديجو الذكي',
                '300' => '#a5b4fc',
                '400' => '#818cf8',
                '500' => '#6366f1',
                '600' => '#4f46e5',
                '700' => '#4338ca',
                'rgb' => '99, 102, 241',
                'description' => 'طابع عصري متقدم يواكب أحدث الأقفال الذكية والبرمجة الإلكترونية.',
            ],
            'purple' => [
                'name' => 'الأرجواني الملكي الفاخر',
                '300' => '#d8b4fe',
                '400' => '#c084fc',
                '500' => '#a855f7',
                '600' => '#9333ea',
                '700' => '#7e22ce',
                'rgb' => '168, 85, 247',
                'description' => 'لمسة فاخرة تميز موقعك بتصميم فريد واستثنائي في السوق.',
            ],
            'orange' => [
                'name' => 'البرتقالي الناري الحيوي',
                '300' => '#fdba74',
                '400' => '#fb923c',
                '500' => '#f97316',
                '600' => '#ea580c',
                '700' => '#c2410c',
                'rgb' => '249, 115, 22',
                'description' => 'طاقة عالية وديناميكية لافتة للانتباه تعزز سرعة اتخاذ القرار.',
            ],
        ];
    }

    /**
     * Supported Arabic Fonts.
     *
     * @return array<string, array{name: string, description: string, sample: string}>
     */
    public static function supportedFonts(): array
    {
        return [
            'Cairo' => [
                'name' => 'خط كايرو (Cairo)',
                'description' => 'خط هندسي عربي حديث وعصري فائق الاتزان والوضوح.',
                'sample' => 'مفاتيح الإبداع لقص وبرمجة الأقفال الذكية',
            ],
            'Tajawal' => [
                'name' => 'خط تجوال (Tajawal)',
                'description' => 'خط عربي ناعم وانسيابي معاصر ومريح جداً للعين.',
                'sample' => 'مفاتيح الإبداع لقص وبرمجة الأقفال الذكية',
            ],
            'Alexandria' => [
                'name' => 'خط الإسكندرية (Alexandria)',
                'description' => 'خط عربي هندسي رصين وقوي مستوحى من الحداثة والتكنولوجيا.',
                'sample' => 'مفاتيح الإبداع لقص وبرمجة الأقفال الذكية',
            ],
            'Almarai' => [
                'name' => 'خط المراعي (Almarai)',
                'description' => 'خط عملي واضح جداً ومناسب للمؤسسات والشركات الاحترافية.',
                'sample' => 'مفاتيح الإبداع لقص وبرمجة الأقفال الذكية',
            ],
        ];
    }

    /**
     * Get active color palette based on current settings.
     *
     * @return array{300: string, 400: string, 500: string, 600: string, 700: string, rgb: string}
     */
    public static function getActiveColors(): array
    {
        $preset = Setting::get('theme_preset', 'amber');
        $presets = static::presetColors();

        if ($preset === 'custom') {
            $hex = Setting::get('theme_custom_color', '#f59e0b');
            $rgb = static::hexToRgb($hex);

            return [
                '300' => static::adjustColorLightness($hex, 36),
                '400' => static::adjustColorLightness($hex, 18),
                '500' => $hex,
                '600' => static::adjustColorLightness($hex, -18),
                '700' => static::adjustColorLightness($hex, -36),
                'rgb' => "{$rgb['r']}, {$rgb['g']}, {$rgb['b']}",
            ];
        }

        return $presets[$preset] ?? $presets['amber'];
    }

    /**
     * Helper to lighten or darken a HEX color.
     */
    public static function adjustColorLightness(string $hex, int $percent): string
    {
        $rgb = static::hexToRgb($hex);

        $adjust = function ($channel) use ($percent) {
            if ($percent > 0) {
                // Lighten
                return (int) round($channel + (255 - $channel) * ($percent / 100));
            } else {
                // Darken
                return (int) round($channel * (1 + $percent / 100));
            }
        };

        $r = max(0, min(255, $adjust($rgb['r'])));
        $g = max(0, min(255, $adjust($rgb['g'])));
        $b = max(0, min(255, $adjust($rgb['b'])));

        return sprintf('#%02x%02x%02x', $r, $g, $b);
    }

    /**
     * Helper to convert HEX to RGB.
     *
     * @return array{r: int, g: int, b: int}
     */
    public static function hexToRgb(string $hex): array
    {
        $hex = ltrim($hex, '#');

        if (strlen($hex) === 3) {
            $hex = $hex[0].$hex[0].$hex[1].$hex[1].$hex[2].$hex[2];
        }

        if (strlen($hex) !== 6) {
            return ['r' => 245, 'g' => 158, 'b' => 11];
        }

        return [
            'r' => hexdec(substr($hex, 0, 2)),
            'g' => hexdec(substr($hex, 2, 2)),
            'b' => hexdec(substr($hex, 4, 2)),
        ];
    }

    /**
     * Reset all theme settings to defaults.
     */
    public static function resetToDefaults(): void
    {
        $defaults = [
            'theme_preset' => 'amber',
            'theme_custom_color' => '#f59e0b',
            'theme_mode' => 'dark',
            'theme_visitor_toggle' => '1',
            'theme_font' => 'Cairo',
            'theme_radius' => 'medium',
            'show_emergency_ticker' => '1',
            'show_header_contact_buttons' => '1',
            'show_floating_buttons' => '1',
            'show_home_articles' => '1',
            'header_style' => 'sticky',
        ];

        foreach ($defaults as $key => $val) {
            Setting::set($key, $val, 'theme');
        }
    }
}
