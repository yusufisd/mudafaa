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
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('description');
            $table->string('link');
            $table->string('image');
            $table->date('live_date');
            $table->integer('category_id');
            $table->integer('author');
            $table->string('youtube');
            $table->integer('read_time')->default(2);
            $table->integer('view_counter')->default(0);
            $table->string('seo_title');
            $table->string('seo_description');
            $table->string('seo_key');
            $table->integer('status')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
