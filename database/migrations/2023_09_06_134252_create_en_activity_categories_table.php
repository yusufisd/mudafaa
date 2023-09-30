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
        Schema::create('en_activity_categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('link');
            $table->integer('queue');
            $table->string('color_code');
            $table->integer('status')->default(1);
            $table->integer('activity_id');
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
        Schema::dropIfExists('en_activity_categories');
    }
};
