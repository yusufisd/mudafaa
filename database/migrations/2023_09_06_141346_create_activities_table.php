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
            $table->string('image')->nullable();
            $table->string('title');
            $table->integer('category');
            $table->integer('author');
            $table->longText('short_description');
            $table->longText('description');
            $table->string('link');
            $table->string('ticket_link')->nullable();
            $table->string('subscribe_form')->nullable();
            $table->date('start_time')->nullable();
            $table->time('start_clock')->nullable();
            $table->date('finish_time')->nullable();
            $table->time('finish_clock')->nullable();
            $table->integer('country_id')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->integer('status')->default(1);
            $table->string('website')->nullable();
            $table->string('map')->nullable();
            $table->string('seo_title');
            $table->longText('seo_description');
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
        Schema::dropIfExists('activities');
    }
};
