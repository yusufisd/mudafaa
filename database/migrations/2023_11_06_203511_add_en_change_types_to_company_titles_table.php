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
            DB::statement('ALTER TABLE en_company_titles MODIFY COLUMN icon INT(11)');
            DB::statement('ALTER TABLE en_company_titles MODIFY COLUMN title INT(11)');
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('en_company_titles', function (Blueprint $table) {
            DB::statement('ALTER TABLE en_company_titles MODIFY COLUMN icon VARCHAR(255)');
            DB::statement('ALTER TABLE en_company_titles MODIFY COLUMN title VARCHAR(255)');
        
        });
    }
};
