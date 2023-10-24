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
        Schema::create('en_abouts', function (Blueprint $table) {
            $table->id();
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
            $table->string('title')->nullable();
            $table->string('link')->nullable();
            $table->longText('description')->nullable();
            $table->string('seo_title');
            $table->longText('seo_description');
            $table->string('seo_key');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('en_abouts');
    }
};
