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
        Schema::create('title__icons', function (Blueprint $table) {
            $table->id();
            $table->string('title_tr');
            $table->string('icon_tr');
            $table->string('title_en');
            $table->string('icon_en');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('title__icons');
    }
};
