<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create([
            'role' => 'admin',
            'is_active' => true,
        ]);
    }

    public function test_public_articles_index_displays_published_articles(): void
    {
        $published = Article::factory()->create([
            'title' => 'مقال مفاتيح سيارات منشور',
            'is_published' => true,
        ]);

        $draft = Article::factory()->create([
            'title' => 'مقال مسودة مخفي',
            'is_published' => false,
        ]);

        $response = $this->get(route('articles.index'));

        $response->assertStatus(200);
        $response->assertSee('مقال مفاتيح سيارات منشور');
        $response->assertDontSee('مقال مسودة مخفي');
    }

    public function test_public_article_details_page_loads_and_increments_views(): void
    {
        $article = Article::factory()->create([
            'title' => 'كيفية فتح أبواب السيارات الحديثة',
            'slug' => 'how-to-unlock-modern-cars',
            'content' => 'محتوى تفصيلي مفيد جداً للقارئ',
            'views_count' => 10,
            'is_published' => true,
        ]);

        $response = $this->get(route('articles.show', $article->slug));

        $response->assertStatus(200);
        $response->assertSee('كيفية فتح أبواب السيارات الحديثة');
        $response->assertSee('محتوى تفصيلي مفيد جداً للقارئ');
        $this->assertEquals(11, $article->fresh()->views_count);
    }

    public function test_draft_article_returns_404_on_public_show_page(): void
    {
        $draft = Article::factory()->create([
            'slug' => 'draft-article-slug',
            'is_published' => false,
        ]);

        $response = $this->get(route('articles.show', $draft->slug));

        $response->assertStatus(404);
    }

    public function test_admin_can_create_update_toggle_and_delete_article(): void
    {
        // 1. Store
        $createResponse = $this->actingAs($this->admin)->post(route('admin.articles.store'), [
            'title' => 'مقال جديد عن الأقفال الذكية',
            'category' => 'أقفال ذكية',
            'excerpt' => 'مقدمة المقال عن الأقفال',
            'content' => 'المحتوى الكامل للمقال هنا بالتفصيل',
            'image_url' => 'https://images.unsplash.com/photo-test',
            'read_time' => '4 دقائق قراءة',
            'is_published' => 1,
        ]);

        $createResponse->assertRedirect(route('admin.articles.index'));
        $this->assertDatabaseHas('articles', ['title' => 'مقال جديد عن الأقفال الذكية']);

        $article = Article::where('title', 'مقال جديد عن الأقفال الذكية')->first();

        // 2. Update
        $updateResponse = $this->actingAs($this->admin)->put(route('admin.articles.update', $article), [
            'title' => 'مقال محدث عن الأقفال الذكية المتطورة',
            'category' => 'أقفال ذكية',
            'excerpt' => 'مقدمة محدثة',
            'content' => 'محتوى محدث',
            'is_published' => 1,
        ]);

        $updateResponse->assertRedirect(route('admin.articles.index'));
        $this->assertDatabaseHas('articles', ['title' => 'مقال محدث عن الأقفال الذكية المتطورة']);

        // 3. Toggle publish
        $toggleResponse = $this->actingAs($this->admin)->patch(route('admin.articles.toggle', $article));
        $toggleResponse->assertSessionHas('success');
        $this->assertFalse($article->fresh()->is_published);

        // 4. Delete
        $deleteResponse = $this->actingAs($this->admin)->delete(route('admin.articles.destroy', $article));
        $deleteResponse->assertRedirect(route('admin.articles.index'));
        $this->assertDatabaseMissing('articles', ['id' => $article->id]);
    }

    public function test_admin_articles_index_renders_accessible_title_and_actions(): void
    {
        $article = Article::factory()->create([
            'title' => 'مقال تجريبي واضح العنوان',
        ]);

        $response = $this->actingAs($this->admin)->get(route('admin.articles.index'));
        $response->assertStatus(200);

        // Title has article-title class with dark text in light mode
        $response->assertSee('article-title', false);
        $response->assertSee('مقال تجريبي واضح العنوان');

        // Actions container has btn-delete and confirm data attributes
        $response->assertSee('btn-delete', false);
        $response->assertSee('data-confirm-title="تأكيد حذف المقال"', false);
        $response->assertSee('data-item-name="مقال تجريبي واضح العنوان"', false);
    }
}
