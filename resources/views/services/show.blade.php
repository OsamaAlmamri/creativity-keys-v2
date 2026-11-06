@extends('layouts.app')

@section('title', ($service->meta_title ?? $service->title) . ' | ' . ($settings['site_name'] ?? 'مفاتيح الإبداع'))
@section('meta_description', $service->meta_description ?? $service->short_description)
@section('keywords', $service->meta_keywords ?? ($service->title . ', مفاتيح ' . $cityName . ', قص وبرمجة مفاتيح, طوارئ 24 ساعة'))
@section('canonical', route('services.show', $service->slug))
@section('og_image', url($service->image_url))

@section('schema')
    <script type="application/ld+json">
        {!! json_encode($breadcrumbsSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
    </script>
    <script type="application/ld+json">
        {!! json_encode($serviceSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
    </script>
    @if(!empty($faqSchema))
    <script type="application/ld+json">
        {!! json_encode($faqSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
    </script>
    @endif
@endsection

@section('content')
<div class="relative overflow-hidden bg-[#FAF9F6] dark:bg-slate-950 min-h-screen text-slate-800 dark:text-slate-200">
    
    <!-- Ambient Background Lighting Orbs -->
    <div class="orb orb-sage"></div>
    <div class="orb orb-terracotta"></div>

    <!-- Service Hero Header -->
    <section class="relative pt-32 pb-16 lg:pt-36 lg:pb-20 border-b border-slate-200/80 dark:border-slate-800">
        <div class="max-w-7xl mx-auto px-5 sm:px-8">
            
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-2 text-xs sm:text-sm text-slate-500 dark:text-slate-400 mb-6 font-medium">
                <a href="{{ route('home') }}" class="hover:text-[#588157] transition-colors">الرئيسية</a>
                <span class="text-slate-300 dark:text-slate-700">/</span>
                <a href="{{ url('/#services') }}" class="hover:text-[#588157] transition-colors">الخدمات</a>
                <span class="text-slate-300 dark:text-slate-700">/</span>
                <span class="text-slate-900 dark:text-white font-bold truncate">{{ $service->title }}</span>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <!-- Text Details -->
                <div class="lg:col-span-8 space-y-4">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-[#C0CFB2]/40 text-[#3A5A40] dark:bg-slate-800 dark:text-emerald-400 text-xs font-bold">
                        <span class="w-2 h-2 rounded-full bg-[#588157] animate-pulse"></span>
                        <span>{{ $service->badge_text }}</span>
                    </div>

                    <h1 class="text-3xl sm:text-5xl lg:text-6xl font-bold text-slate-900 dark:text-white leading-[1.2] tracking-tight">
                        {{ $service->title }}
                    </h1>

                    <p class="text-base sm:text-lg text-slate-600 dark:text-slate-300 leading-relaxed max-w-3xl">
                        {{ $service->hero_subtitle ?? $service->short_description }}
                    </p>

                    <!-- Fast Action CTAs -->
                    <div class="pt-4 flex flex-wrap items-center gap-4">
                        <a 
                            href="tel:{{ $settings['emergency_phone'] ?? '0568191921' }}" 
                            class="inline-flex items-center justify-center gap-2.5 min-h-12 px-7 py-3 rounded-full bg-[#588157] hover:bg-[#3A5A40] text-white font-bold text-sm sm:text-base shadow-sm transition-all duration-300"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            <span>اتصل للخدمة:</span>
                            <span dir="ltr">{{ $settings['emergency_phone'] ?? '0568191921' }}</span>
                        </a>

                        <a 
                            href="https://wa.me/{{ $settings['whatsapp'] ?? '966568191921' }}?text={{ urlencode('مرحباً، أود الاستفسار وطلب خدمة: ' . $service->title) }}" 
                            target="_blank" 
                            rel="noopener noreferrer" 
                            class="inline-flex items-center justify-center gap-2.5 min-h-12 px-7 py-3 rounded-full bg-[#25D366] hover:bg-[#1EBE5D] text-white font-bold text-sm sm:text-base shadow-sm transition-all duration-300"
                        >
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                            <span>محادثة واتساب سريعة</span>
                        </a>
                    </div>
                </div>

                <!-- Visual Badge / Image -->
                <div class="lg:col-span-4 flex justify-center">
                    <div class="relative w-full max-w-sm rounded-[2rem] overflow-hidden glass-panel p-2 shadow-lg">
                        <img 
                            src="{{ $service->image_url }}" 
                            alt="{{ $service->title }}" 
                            class="w-full h-64 object-cover rounded-[1.6rem]"
                        >
                        <div class="absolute bottom-4 right-4 left-4 p-3 rounded-xl bg-white/90 dark:bg-slate-900/90 backdrop-blur-md border border-slate-200/80 dark:border-slate-800 flex items-center justify-between text-xs">
                            <span class="font-bold text-slate-900 dark:text-white">السرعة المعتمدة:</span>
                            <span class="text-[#588157] dark:text-emerald-400 font-bold">15 - 25 دقيقة بموقعك</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Main Content Section (Split into Content Column & Sticky Sidebar) -->
    <section class="py-16 px-5 sm:px-8">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
            
            <!-- Main Content Area (8 Cols) -->
            <div class="lg:col-span-8 space-y-12 min-w-0">
                
                <!-- 1. Detailed Overview & Value Narrative -->
                <article class="glass-panel rounded-[2.2rem] p-6 sm:p-9 shadow-sm space-y-6">
                    <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 dark:text-white">
                        {{ $service->overview_title ?? 'تفاصيل ونظرة عامة على الخدمة' }}
                    </h2>
                    
                    <div class="text-slate-600 dark:text-slate-300 leading-8 text-base sm:text-lg space-y-4 whitespace-pre-line">
                        {{ $service->overview_content ?? $service->full_description }}
                    </div>

                    @if(!empty($service->features))
                        <div class="pt-6 border-t border-slate-200/80 dark:border-slate-800">
                            <h3 class="text-sm font-bold uppercase tracking-wider text-slate-900 dark:text-white mb-4">
                                أبرز مزايا الخدمة لدينا:
                            </h3>
                            <ul class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm text-slate-700 dark:text-slate-300">
                                @foreach($service->features as $item)
                                    <li class="flex items-center gap-2.5">
                                        <svg class="w-5 h-5 text-[#588157] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                        <span>{{ $item }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </article>

                <!-- 2. Sub-Features / Types / Problem Solving Cards Grid -->
                @if($service->featuresList->isNotEmpty())
                    <div class="space-y-6">
                        <div class="flex items-center justify-between">
                            <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 dark:text-white">
                                {{ $service->features_title ?? 'أنواع وخيارات الخدمة' }}
                            </h2>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            @foreach($service->featuresList as $feat)
                                <div class="glass-panel rounded-[2rem] p-6 flex flex-col justify-between transition-all duration-300 hover:shadow-md">
                                    <div>
                                        <div class="flex items-center justify-between gap-3 mb-4">
                                            <div class="w-12 h-12 rounded-full bg-[#C0CFB2]/40 text-[#588157] dark:bg-slate-800 dark:text-emerald-400 flex items-center justify-center">
                                                @if($feat->icon === 'battery')
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                                                @elseif($feat->icon === 'cpu-chip')
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/></svg>
                                                @elseif($feat->icon === 'lock-open')
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"/></svg>
                                                @elseif($feat->icon === 'wrench')
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"/></svg>
                                                @elseif($feat->icon === 'clock')
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                @else
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                                @endif
                                            </div>

                                            @if($feat->badge)
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-[#C0CFB2]/30 text-[#3A5A40] dark:bg-slate-800 dark:text-emerald-400 text-xs font-bold">
                                                    {{ $feat->badge }}
                                                </span>
                                            @endif
                                        </div>

                                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2 leading-snug">
                                            {{ $feat->title }}
                                        </h3>

                                        <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                                            {{ $feat->description }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- 3. Work Process / Execution Steps -->
                @if(!empty($service->steps))
                    <div class="space-y-6">
                        <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 dark:text-white">
                            {{ $service->process_title ?? 'خطوات تنفيذ الخدمة' }}
                        </h2>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            @foreach($service->steps as $step)
                                <div class="glass-panel rounded-[2rem] p-6 relative">
                                    <div class="flex items-center gap-3 mb-3">
                                        <span class="w-8 h-8 rounded-full bg-[#588157] text-white flex items-center justify-center font-bold text-sm shrink-0">
                                            {{ $step['step'] ?? $loop->iteration }}
                                        </span>
                                        <h3 class="text-base font-bold text-slate-900 dark:text-white">
                                            {{ $step['title'] }}
                                        </h3>
                                    </div>
                                    <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed pr-11">
                                        {{ $step['desc'] ?? '' }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- 4. Pricing Tiers Table Matching Competitor Design -->
                @if($service->pricingTiers->isNotEmpty())
                    <div class="space-y-6">
                        <div class="flex items-center justify-between">
                            <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 dark:text-white">
                                {{ $service->pricing_title ?? 'الأسعار والعروض التقديرية' }}
                            </h2>
                        </div>

                        <div class="glass-panel rounded-[2.2rem] overflow-hidden p-6 sm:p-8">
                            <div class="overflow-x-auto">
                                <table class="w-full text-right border-collapse">
                                    <thead>
                                        <tr class="border-b border-slate-200/80 dark:border-slate-800 text-xs sm:text-sm font-bold text-slate-400 uppercase">
                                            <th class="py-3 px-4">نوع الخدمة / السيارة</th>
                                            <th class="py-3 px-4 text-left">السعر التقديري</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-200/60 dark:divide-slate-800/80 text-sm">
                                        @foreach($service->pricingTiers as $tier)
                                            <tr class="hover:bg-slate-500/5 transition-colors">
                                                <td class="py-4 px-4">
                                                    <span class="font-bold text-slate-900 dark:text-white block">{{ $tier->name }}</span>
                                                    @if($tier->note)
                                                        <span class="text-xs text-slate-500 dark:text-slate-400 mt-0.5 block">{{ $tier->note }}</span>
                                                    @endif
                                                </td>
                                                <td class="py-4 px-4 text-left font-mono font-bold text-[#588157] dark:text-emerald-400 whitespace-nowrap">
                                                    {{ $tier->price }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            @if($service->pricing_note)
                                <p class="mt-6 text-xs text-slate-500 dark:text-slate-400 leading-relaxed pt-4 border-t border-slate-200/80 dark:border-slate-800">
                                    {{ $service->pricing_note }}
                                </p>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- 5. Frequently Asked Questions (FAQ) with Accordion -->
                @if($service->faqs->isNotEmpty())
                    <div class="space-y-6">
                        <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 dark:text-white">
                            الأسئلة الشائعة حول {{ $service->title }} (FAQ)
                        </h2>

                        <div class="space-y-4">
                            @foreach($service->faqs as $faq)
                                <details class="group glass-panel rounded-[1.8rem] p-6 [&_summary::-webkit-details-marker]:hidden transition-all duration-300">
                                    <summary class="flex items-center justify-between gap-4 cursor-pointer font-bold text-base sm:text-lg text-slate-900 dark:text-white select-none">
                                        <span>{{ $faq->question }}</span>
                                        <span class="w-8 h-8 rounded-full bg-[#C0CFB2]/40 text-[#588157] flex items-center justify-center shrink-0 group-open:rotate-180 transition-transform duration-300">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                        </span>
                                    </summary>
                                    <p class="mt-4 text-sm sm:text-base text-slate-600 dark:text-slate-300 leading-relaxed pt-3 border-t border-slate-200/80 dark:border-slate-800">
                                        {{ $faq->answer }}
                                    </p>
                                </details>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>

            <!-- Sticky Sidebar Area (4 Cols) -->
            <aside class="lg:col-span-4 space-y-6 lg:sticky lg:top-28">
                
                <!-- Quick Emergency / Contact Card (matching competitor screenshot) -->
                @if($service->is_emergency)
                    <div class="rounded-[2.2rem] bg-gradient-to-br from-red-600 to-rose-700 text-white p-7 shadow-xl space-y-4">
                        <div class="w-12 h-12 rounded-2xl bg-white/20 flex items-center justify-center text-white">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        </div>
                        <h3 class="text-xl font-bold">حالة طوارئ مستعجلة؟</h3>
                        <p class="text-sm text-red-100 leading-relaxed">
                            نصلك في أي حي من أحياء {{ $cityName }} خلال 15 إلى 25 دقيقة لفتح سيارتك أو منزلك فوراً وبأمان.
                        </p>
                        <a 
                            href="tel:{{ $settings['emergency_phone'] ?? '0568191921' }}" 
                            class="w-full inline-flex items-center justify-center gap-2 py-3.5 px-6 rounded-full bg-white text-red-700 font-black text-sm shadow-md hover:bg-red-50 transition-colors"
                        >
                            <span>اتصل فوراً:</span>
                            <span dir="ltr">{{ $settings['emergency_phone'] ?? '0568191921' }}</span>
                        </a>
                    </div>
                @else
                    <div class="glass-panel rounded-[2.2rem] p-7 space-y-4 shadow-sm">
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white">طلب وحجز موعد للخدمة</h3>
                        <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                            تفضل بزيارة معرضنا في {{ $cityName }} أو اطلب سيارة الخدمة المتنقلة لتصلك عند بيتك أو عملك.
                        </p>
                        <a 
                            href="tel:{{ $settings['emergency_phone'] ?? '0568191921' }}" 
                            class="w-full inline-flex items-center justify-center gap-2 py-3.5 px-6 rounded-full bg-[#588157] text-white font-bold text-sm shadow-sm hover:bg-[#3A5A40] transition-colors"
                        >
                            <span>اتصل الآن:</span>
                            <span dir="ltr">{{ $settings['emergency_phone'] ?? '0568191921' }}</span>
                        </a>
                    </div>
                @endif

                <!-- Coverage Areas Widget Matching Competitor Design -->
                <div class="glass-panel rounded-[2.2rem] p-6 space-y-4 shadow-sm">
                    <h3 class="text-base font-bold text-slate-900 dark:text-white flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#588157]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span>تغطية الخدمة في {{ $cityName }}</span>
                    </h3>
                    
                    <p class="text-xs text-slate-500 dark:text-slate-400">
                        سياراتنا المتنقلة مجهزة لتغطية كافة الأحياء والمخططات:
                    </p>

                    <div class="grid grid-cols-2 gap-2 text-xs text-slate-700 dark:text-slate-300">
                        <div class="flex items-center gap-1.5"><span class="text-[#588157]">›</span> حي الروضة</div>
                        <div class="flex items-center gap-1.5"><span class="text-[#588157]">›</span> حي السلامة</div>
                        <div class="flex items-center gap-1.5"><span class="text-[#588157]">›</span> حي الشاطئ</div>
                        <div class="flex items-center gap-1.5"><span class="text-[#588157]">›</span> أبحر الشمالية والجنوبية</div>
                        <div class="flex items-center gap-1.5"><span class="text-[#588157]">›</span> حي المروة</div>
                        <div class="flex items-center gap-1.5"><span class="text-[#588157]">›</span> حي الصفا</div>
                        <div class="flex items-center gap-1.5"><span class="text-[#588157]">›</span> حي النعيم</div>
                        <div class="flex items-center gap-1.5"><span class="text-[#588157]">›</span> حي الزهراء</div>
                    </div>
                </div>

                <!-- Related Services Links -->
                <div class="glass-panel rounded-[2.2rem] p-6 space-y-4 shadow-sm">
                    <h3 class="text-base font-bold text-slate-900 dark:text-white">
                        خدمات أخرى قد تهمك
                    </h3>
                    
                    <ul class="space-y-2 text-sm">
                        @foreach($relatedServices as $rel)
                            <li>
                                <a 
                                    href="{{ route('services.show', $rel->slug) }}" 
                                    class="flex items-center justify-between p-2.5 rounded-xl hover:bg-slate-500/10 transition-colors group"
                                >
                                    <span class="text-slate-700 dark:text-slate-300 group-hover:text-[#588157] font-medium truncate">
                                        {{ $rel->title }}
                                    </span>
                                    <svg class="w-4 h-4 text-slate-400 group-hover:text-[#588157] group-hover:-translate-x-1 transition-transform rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

            </aside>

        </div>
    </section>

</div>
@endsection
