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
        Schema::create('defense_industry_categories', function (Blueprint $table) {
            $table->id();
            $table->integer('defense_id');
            $table->string('image')->nullable();
            $table->string('title');
            $table->string('link');
            $table->integer('queue');
            $table->integer('status')->default(1);
            $table->string('seo_title');
            $table->string('seo_description');
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
        Schema::dropIfExists('defense_industry_categories');
    }
};
