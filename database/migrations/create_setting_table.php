<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {

            $table->id();

            $table->string('app_name')->default('Nadimax Admin');

            $table->string('company_name')->nullable();

            $table->string('email')->nullable();

            $table->string('phone')->nullable();

            $table->text('address')->nullable();

            $table->string('logo')->nullable();

            $table->string('favicon')->nullable();

            $table->string('timezone')->default('Asia/Jakarta');

            $table->string('language')->default('id');

            $table->string('theme')->default('light');

            $table->timestamps();

        });
    }
        public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};