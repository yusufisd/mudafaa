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
        Schema::create('en_defense_industry_contents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image');
            $table->longText('multiple_image');
            $table->integer('category_id');
            $table->integer('defense_id');
            $table->string('short_description');
            $table->longText('description');
            $table->integer('content_id');
            $table->integer('read_time')->default(3);
            $table->integer('status')->default(1);
            $table->string('seo_title');
            $table->string('tags');
            $table->string('link');
            $table->string('seo_description');
            $table->string('seo_key');
            $table->integer('view_counter')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('en_defense_industry_contents');
    }
};
