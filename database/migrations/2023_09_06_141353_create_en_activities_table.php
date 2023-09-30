<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('en_activities', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('short_description');
            $table->integer('category');
            $table->integer('author');
            $table->longText('description');
            $table->string('seo_title');
            $table->string('seo_description');
            $table->string('link');
            $table->integer('status')->default(1);
            $table->string('seo_key');
            $table->integer('seo_statu')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('en_activities');
    }
};
