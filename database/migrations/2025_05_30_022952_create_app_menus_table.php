<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('app_menus', function (Blueprint $table) {
            $table->id();
            $table->string('menu_key')->unique();
            $table->string('menu_name');
            $table->string('menu_description')->nullable();
            $table->string('menu_status');
            $table->unsignedBigInteger('application_id');
            $table->unsignedBigInteger('modul_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('app_menus');
    }
};
