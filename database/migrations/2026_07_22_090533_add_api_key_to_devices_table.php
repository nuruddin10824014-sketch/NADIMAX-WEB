<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('devices', function (Blueprint $table) {

            $table->string('api_key')
                  ->nullable()
                  ->after('device_code');

            $table->string('ip_address')
                  ->nullable()
                  ->after('status');

        });
    }

    public function down(): void
    {
        Schema::table('devices', function (Blueprint $table) {

            $table->dropColumn([
                'api_key',
                'ip_address'
            ]);

        });
    }
};