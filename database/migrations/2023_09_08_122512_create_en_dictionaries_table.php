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
        Schema::create('en_dictionaries', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image')->nullable();
            $table->longText('description');
            $table->string('link');
            $table->string('author');
            $table->date('live_date');
            $table->string('seo_title');
            $table->string('seo_description');
            $table->string('seo_key');
            $table->integer('status')->default(1);
            $table->integer('dictionary_id');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('en_dictionaries');
    }
};
