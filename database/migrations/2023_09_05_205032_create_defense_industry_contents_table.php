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
        Schema::create('defense_industry_contents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image');
            $table->longText('multiple_image');
            $table->integer('category_id');
            $table->integer('defense_id');
            $table->longText('countries');
            $table->longText('companies');
            $table->longText('origin');
            $table->string('tags');
            $table->string('link');
            $table->integer('read_time')->default(3);
            $table->integer('national')->default(1);
            $table->integer('author');
            $table->integer('status')->default(1);
            $table->string('short_description');
            $table->longText('description');
            $table->string('seo_title');
            $table->string('seo_description');
            $table->integer('view_counter')->default(0);
            $table->string('seo_key');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('defense_industry_contents');
    }
};
