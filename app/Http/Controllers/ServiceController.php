<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Setting;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ServiceController extends Controller
{
    public function index(): RedirectResponse
    {
        return redirect('/#services');
    }

    public function show(string $slug): View
    {
        $service = Service::where('slug', $slug)
            ->where('is_active', true)
            ->with(['category', 'featuresList', 'faqs', 'pricingTiers'])
            ->firstOrFail();

        $relatedServices = Service::where('is_active', true)
            ->where('id', '!=', $service->id)
            ->orderBy('sort_order')
            ->take(5)
            ->get();

        $settings = Setting::all()->pluck('value', 'key');
        $cityName = $settings['city_name'] ?? 'جدة';

        // Structured Schema: BreadcrumbList
        $breadcrumbsSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                [
                    '@type' => 'ListItem',
                    'position' => 1,
                    'name' => 'الرئيسية',
                    'item' => route('home'),
                ],
                [
                    '@type' => 'ListItem',
                    'position' => 2,
                    'name' => 'الخدمات',
                    'item' => url('/#services'),
                ],
                [
                    '@type' => 'ListItem',
                    'position' => 3,
                    'name' => $service->title,
                    'item' => route('services.show', $service->slug),
                ],
            ],
        ];

        // Structured Schema: Service
        $serviceSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'Service',
            'name' => $service->title,
            'description' => $service->meta_description ?? $service->short_description,
            'provider' => [
                '@type' => 'Locksmith',
                'name' => $settings['site_name'] ?? 'محل مفاتيح الإبداع',
                'telephone' => $settings['emergency_phone'] ?? '0568191921',
                'url' => route('home'),
            ],
            'areaServed' => [
                '@type' => 'City',
                'name' => $cityName,
            ],
            'offers' => [
                '@type' => 'Offer',
                'price' => $service->price_starting_at ? preg_replace('/[^0-9]/', '', $service->price_starting_at) : '100',
                'priceCurrency' => 'SAR',
            ],
        ];

        // Structured Schema: FAQPage (if faqs exist)
        $faqSchema = null;
        if ($service->faqs->isNotEmpty()) {
            $faqSchema = [
                '@context' => 'https://schema.org',
                '@type' => 'FAQPage',
                'mainEntity' => $service->faqs->map(function ($faq) {
                    return [
                        '@type' => 'Question',
                        'name' => $faq->question,
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => $faq->answer,
                        ],
                    ];
                })->toArray(),
            ];
        }

        return view('services.show', compact(
            'service',
            'relatedServices',
            'settings',
            'cityName',
            'breadcrumbsSchema',
            'serviceSchema',
            'faqSchema'
        ));
    }
}
