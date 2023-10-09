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
        Schema::create('interviews', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('title');
            $table->integer('author');
            $table->date('live_time');
            $table->string('youtube')->nullable();
            $table->longText('short_description');
            $table->integer('read_time')->default(3);
            $table->longText('description');
            $table->string('link');
            $table->string('seo_title');
            $table->longText('seo_description');
            $table->string('seo_key');
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('interviews');
    }
};
