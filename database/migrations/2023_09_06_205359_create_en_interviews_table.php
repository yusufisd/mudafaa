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
        Schema::create('en_interviews', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image');
            $table->longText('short_description');
            $table->longText('description');
            $table->integer('author');
            $table->string('link');
            $table->date('live_time');
            $table->integer('read_time')->default(3);
            $table->integer('interview_id');
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
        Schema::dropIfExists('en_interviews');
    }
};
