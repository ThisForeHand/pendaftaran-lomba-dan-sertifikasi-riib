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
        if (Schema::hasTable('lomba_registrations') && ! Schema::hasColumn('lomba_registrations', 'email')) {
            Schema::table('lomba_registrations', function (Blueprint $table) {
                $table->string('email')->after('nim')->nullable();
            });
        }

        if (Schema::hasTable('sertifikasi_registrations') && ! Schema::hasColumn('sertifikasi_registrations', 'email')) {
            Schema::table('sertifikasi_registrations', function (Blueprint $table) {
                $table->string('email')->after('nip')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('lomba_registrations') && Schema::hasColumn('lomba_registrations', 'email')) {
            Schema::table('lomba_registrations', function (Blueprint $table) {
                $table->dropColumn('email');
            });
        }

        if (Schema::hasTable('sertifikasi_registrations') && Schema::hasColumn('sertifikasi_registrations', 'email')) {
            Schema::table('sertifikasi_registrations', function (Blueprint $table) {
                $table->dropColumn('email');
            });
        }
    }
};
