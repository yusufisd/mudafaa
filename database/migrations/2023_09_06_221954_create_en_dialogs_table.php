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
        Schema::create('en_dialogs', function (Blueprint $table) {
            $table->id();
            $table->string('soran');
            $table->string('cevaplayan');
            $table->string('soru');
            $table->string('cevap');
            $table->string('interview_id');
            $table->string('dialog_id');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('en_dialogs');
    }
};
