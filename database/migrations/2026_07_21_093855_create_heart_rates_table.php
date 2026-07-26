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
        Schema::create('heart_rates', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->foreignId('device_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->unsignedSmallInteger('bpm');

            $table->unsignedTinyInteger('spo2');

            $table->decimal('body_temperature', 4, 1);

            $table->timestamp('recorded_at');

            $table->timestamps();

            $table->index('recorded_at');

            $table->decimal('air_quality', 8, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('heart_rates');
    }
};