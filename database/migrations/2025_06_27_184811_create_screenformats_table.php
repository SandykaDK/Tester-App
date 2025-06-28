<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('screenformats', function (Blueprint $table) {
            $table->id();
            $table->string('id_scr_format')->unique();
            $table->string('scr_name');
            $table->unsignedBigInteger('menu_id')->nullable();
            $table->string('scr_version');
            $table->string('scr_description')->nullable();
            $table->timestamps();

            $table->foreign('menu_id')->references('id')->on('app_menus')->onDelete('set null');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('screenformats');
    }
};
