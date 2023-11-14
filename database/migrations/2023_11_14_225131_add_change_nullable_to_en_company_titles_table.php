<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('en_company_titles', function (Blueprint $table) {
            DB::statement('ALTER TABLE `en_company_titles` MODIFY `description` VARCHAR(255) NULL;');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('en_company_titles', function (Blueprint $table) {
            DB::statement('ALTER TABLE `en_company_titles` MODIFY `description` VARCHAR(255) NOT NULL;');
        });
    }
};
