<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('test_cases', function (Blueprint $table) {
            $table->id();
            $table->string('test_key')->unique();
            $table->unsignedBigInteger('app_key')->nullable();
            $table->unsignedBigInteger('modul_key')->nullable();
            $table->unsignedBigInteger('menu_key')->nullable();
            $table->string('test_scenario');
            $table->string('test_data');
            $table->string('test_step');
            $table->string('expected_result');
            $table->string('result');
            $table->string('status');
            $table->string('test_date');
            $table->unsignedBigInteger('pic_dev')->nullable();
            $table->foreign('app_key')->references('id')->on('applications')->onDelete('set null');
            $table->foreign('modul_key')->references('id')->on('app_moduls')->onDelete('set null');
            $table->foreign('menu_key')->references('id')->on('app_menus')->onDelete('set null');
            $table->foreign('pic_dev')->references('id')->on('developers')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('test_cases');
    }
};
