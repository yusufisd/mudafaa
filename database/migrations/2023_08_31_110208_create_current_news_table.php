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
        Schema::create('current_news', function (Blueprint $table) {
            $table->id();
            $table->date('live_time');
            $table->string('image');
            $table->string('mobil_image')->nullable();
            $table->integer('author_id');
            $table->string('category_id');
            $table->string('title');
            $table->integer('headline')->default(1);
            $table->integer('read_time')->default(3);
            $table->longText('short_description');
            $table->longText('description');
            $table->integer('status')->default(1);
            $table->string('link');
            $table->string('seo_title');
            $table->longText('seo_description');
            $table->string('seo_key');
            $table->integer('view_counter')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('current_news');
    }
};
