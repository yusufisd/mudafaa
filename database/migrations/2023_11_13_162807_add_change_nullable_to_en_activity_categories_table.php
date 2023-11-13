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
        Schema::table('en_activity_categories', function (Blueprint $table) {
            DB::statement('ALTER TABLE `en_activity_categories` MODIFY `color_code` VARCHAR(255) NULL;');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('en_activity_categories', function (Blueprint $table) {
            DB::statement('ALTER TABLE `en_activity_categories` MODIFY `color_code` VARCHAR(255) NOT NULL;');

        });
    }
};
