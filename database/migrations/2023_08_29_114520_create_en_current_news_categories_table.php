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
        Schema::create('en_current_news_categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('link');
            $table->integer('queue');
            $table->string('color_code')->nullable();
            $table->string('image')->nullable();
            $table->integer('category_id');
            $table->integer('status')->default(1);
            $table->string('seo_title');
            $table->string('seo_description');
            $table->longText('seo_key');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('en_current_news_categories');
    }
};
