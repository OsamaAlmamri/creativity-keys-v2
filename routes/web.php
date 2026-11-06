<?php

use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\ServiceCategoryController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ThemeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManageController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - الموقع التعريفي لمحل المفاتيح
|--------------------------------------------------------------------------
*/

Route::get('/migrate', [ManageController::class, 'migrate']);
Route::get('/artisan/{common}', [ManageController::class, 'artisan']);
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('services.show');
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

/*
|--------------------------------------------------------------------------
| SEO 301 Permanent Redirects for Legacy URLs
| تحويلات دائمة للروابط القديمة من النسخة v1 للحفاظ على أرشفة محركات البحث
|--------------------------------------------------------------------------
*/
Route::get('/contact', function () {
    return redirect('/#contact', 301);
});
Route::get('/blog', function () {
    return redirect()->route('articles.index', [], 301);
});
Route::get('/article/{slug}', function (string $slug) {
    return redirect()->route('articles.show', ['slug' => $slug], 301);
});
Route::get('/category/{slug?}', function () {
    return redirect()->route('articles.index', [], 301);
});
Route::get('/tag/{slug?}', function () {
    return redirect()->route('articles.index', [], 301);
});
Route::get('/page/{slug?}', function () {
    return redirect('/', 301);
});

/*
|--------------------------------------------------------------------------
| Admin Auth Routes - تسجيل دخول لوحة التحكم
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // مسارات لوحة التحكم المحمية
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // إدارة الخدمات وأصنافها
        Route::resource('service-categories', ServiceCategoryController::class)->except(['show'])->names('service-categories');
        Route::resource('services', AdminServiceController::class)->names('services');

        // إدارة المقالات والنصائح
        Route::resource('articles', AdminArticleController::class)->except(['show'])->names('articles');
        Route::patch('articles/{article}/toggle', [AdminArticleController::class, 'toggle'])->name('articles.toggle');

        // إدارة معرض الصور
        Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
        Route::post('/gallery', [GalleryController::class, 'store'])->name('gallery.store');
        Route::put('/gallery/{gallery}', [GalleryController::class, 'update'])->name('gallery.update');
        Route::delete('/gallery/{gallery}', [GalleryController::class, 'destroy'])->name('gallery.destroy');

        // إدارة التقييمات
        Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
        Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
        Route::put('/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
        Route::patch('/reviews/{review}/toggle', [ReviewController::class, 'toggleApproval'])->name('reviews.toggle');
        Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

        // إدارة رسائل واستفسارات العملاء
        Route::get('/messages', [ContactMessageController::class, 'index'])->name('messages.index');
        Route::get('/messages/{message}', [ContactMessageController::class, 'show'])->name('messages.show');
        Route::patch('/messages/{message}/read', [ContactMessageController::class, 'markAsRead'])->name('messages.read');
        Route::post('/messages/{message}/notes', [ContactMessageController::class, 'updateNotes'])->name('messages.notes');
        Route::delete('/messages/{message}', [ContactMessageController::class, 'destroy'])->name('messages.destroy');

        // إدارة إعدادات المحل مقسمة إلى تابات مستقلة
        Route::get('/settings/{tab?}', [SettingController::class, 'index'])
            ->whereIn('tab', ['branding', 'seo', 'social', 'contact', 'coverage', 'location', 'stats'])
            ->name('settings.index');
        Route::post('/settings/{tab}', [SettingController::class, 'updateTab'])
            ->whereIn('tab', ['branding', 'seo', 'social', 'contact', 'coverage', 'location', 'stats'])
            ->name('settings.update-tab');
        Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');

        // إدارة المظهر والثيم والهوية البصرية
        Route::get('/theme', [ThemeController::class, 'index'])->name('theme.index');
        Route::post('/theme', [ThemeController::class, 'update'])->name('theme.update');
        Route::post('/theme/reset', [ThemeController::class, 'reset'])->name('theme.reset');

        // إدارة المستخدمين والصلاحيات (للمدير العام فقط)
        Route::middleware('admin:admin')->group(function () {
            Route::get('/users', [UserController::class, 'index'])->name('users.index');
            Route::post('/users', [UserController::class, 'store'])->name('users.store');
            Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
            Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        });
    });
});
