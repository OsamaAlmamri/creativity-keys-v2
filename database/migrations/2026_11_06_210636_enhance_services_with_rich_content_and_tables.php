<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->string('badge')->nullable()->after('price_starting_at');
            $table->string('hero_subtitle')->nullable()->after('badge');
            $table->string('overview_title')->nullable()->after('full_description');
            $table->text('overview_content')->nullable()->after('overview_title');
            $table->string('features_title')->nullable()->after('overview_content');
            $table->string('process_title')->nullable()->after('features_title');
            $table->json('steps')->nullable()->after('process_title');
            $table->string('pricing_title')->nullable()->after('steps');
            $table->string('pricing_note')->nullable()->after('pricing_title');
            $table->string('meta_title')->nullable()->after('sort_order');
            $table->text('meta_description')->nullable()->after('meta_title');
            $table->string('meta_keywords')->nullable()->after('meta_description');
        });

        Schema::create('service_features', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained('services')->cascadeOnDelete();
            $table->string('title');
            $table->text('description');
            $table->string('icon')->nullable();
            $table->string('badge')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('service_faqs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained('services')->cascadeOnDelete();
            $table->string('question');
            $table->text('answer');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('service_pricing_tiers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained('services')->cascadeOnDelete();
            $table->string('name');
            $table->string('price');
            $table->string('note')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_pricing_tiers');
        Schema::dropIfExists('service_faqs');
        Schema::dropIfExists('service_features');

        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn([
                'badge',
                'hero_subtitle',
                'overview_title',
                'overview_content',
                'features_title',
                'process_title',
                'steps',
                'pricing_title',
                'pricing_note',
                'meta_title',
                'meta_description',
                'meta_keywords',
            ]);
        });
    }
};
