{!! '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
    <!-- الصفحة الرئيسية للموقع -->
    <url>
        <loc>{{ route('home') }}</loc>
        <lastmod>{{ $latestDate }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>

    <!-- أرشيف المقالات والنصائح -->
    <url>
        <loc>{{ route('articles.index') }}</loc>
        <lastmod>{{ $latestDate }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>

    <!-- خدمات المحل الفنية المتميزة -->
    @if(isset($services))
    @foreach($services as $service)
    <url>
        <loc>{{ route('services.show', $service->slug) }}</loc>
        <lastmod>{{ $service->updated_at->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
        @if($service->image_url)
        <image:image>
            <image:loc>{{ url($service->image_url) }}</image:loc>
            <image:title>{{ $service->title }}</image:title>
        </image:image>
        @endif
    </url>
    @endforeach
    @endif

    <!-- المقالات المنشورة -->
    @foreach($articles as $article)
    <url>
        <loc>{{ route('articles.show', $article->slug) }}</loc>
        <lastmod>{{ $article->updated_at->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
        @if($article->image_url)
        <image:image>
            <image:loc>{{ $article->image_url }}</image:loc>
            <image:title>{{ $article->title }}</image:title>
        </image:image>
        @endif
    </url>
    @endforeach
</urlset>
