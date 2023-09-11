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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('title');
            $table->string('category');
            $table->integer('author');
            $table->string('short_description');
            $table->longText('description');
            $table->string('link');
            $table->string('ticket_link')->nullable();
            $table->string('subscribe_form')->nullable();
            $table->timestamp('start_time')->useCurrent();
            $table->timestamp('finish_time')->useCurrent();
            $table->integer('country_id');
            $table->string('city');
            $table->string('address');
            $table->string('phone');
            $table->string('email');
            $table->integer('status')->default(1);
            $table->string('website')->nullable();
            $table->string('map')->nullable();
            $table->string('seo_title');
            $table->string('seo_description');
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
        Schema::dropIfExists('activities');
    }
};
