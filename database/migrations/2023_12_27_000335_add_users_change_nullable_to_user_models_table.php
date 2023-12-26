<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('user_models', function (Blueprint $table) {
            $table->string('phone')->nullable(true)->change();
            $table->longText('description')->nullable(true)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_models', function (Blueprint $table) {
            $table->string('phone')->nullable(false)->change();
            $table->longText('description')->nullable(false)->change();
        });
    }
};
