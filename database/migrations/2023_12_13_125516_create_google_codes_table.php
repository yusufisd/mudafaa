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
        Schema::create('google_codes', function (Blueprint $table) {
            $table->id();
            $table->longText('adsense')->nullable();
            $table->longText('adverds')->nullable();
            $table->longText('news')->nullable();
            $table->longText('google_code')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('google_codes');
    }
};
