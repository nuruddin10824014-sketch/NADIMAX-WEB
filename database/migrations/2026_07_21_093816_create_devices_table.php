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
        Schema::create('devices', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();

            $table->string('device_name');

            $table->string('device_code')->unique();

            $table->string('serial_number')->unique();

            $table->string('firmware')->default('1.0.0');

            $table->integer('battery')->default(100);

            $table->integer('signal_strength')->default(100);

            $table->enum('status', [
                'Online',
                'Offline',
                'Maintenance'
            ])->default('Offline');

            $table->timestamp('last_sync')->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};