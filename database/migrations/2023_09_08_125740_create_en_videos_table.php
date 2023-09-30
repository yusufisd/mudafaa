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
        Schema::create('en_videos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->string('link');
            $table->string('youtube');
            $table->string('seo_title');
            $table->string('image');
            $table->date('live_date');
            $table->integer('category_id');
            $table->integer('author');
            $table->string('seo_description');
            $table->string('seo_key');
            $table->integer('status')->default(1);
            $table->integer('video_id');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('en_videos');
    }
};
