<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('app_moduls', function (Blueprint $table) {
            $table->id();
            $table->string('modul_key')->unique();
            $table->string('modul_name');
            $table->string('modul_description')->nullable();
            $table->string('modul_status');
            $table->unsignedBigInteger('application_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('app_moduls');
    }
};
