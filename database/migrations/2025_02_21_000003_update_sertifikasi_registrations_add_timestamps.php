<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('sertifikasi_registrations')) {
            return;
        }

        Schema::table('sertifikasi_registrations', function (Blueprint $table) {
            if (
                ! Schema::hasColumn('sertifikasi_registrations', 'created_at')
                && ! Schema::hasColumn('sertifikasi_registrations', 'updated_at')
            ) {
                $table->timestamps();

                return;
            }

            if (! Schema::hasColumn('sertifikasi_registrations', 'created_at')) {
                $table->timestamp('created_at')->nullable()->after('poster_path');
            }

            if (! Schema::hasColumn('sertifikasi_registrations', 'updated_at')) {
                $table->timestamp('updated_at')->nullable()->after('created_at');
            }
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('sertifikasi_registrations')) {
            return;
        }

        Schema::table('sertifikasi_registrations', function (Blueprint $table) {
            if (Schema::hasColumn('sertifikasi_registrations', 'created_at')) {
                $table->dropColumn('created_at');
            }

            if (Schema::hasColumn('sertifikasi_registrations', 'updated_at')) {
                $table->dropColumn('updated_at');
            }
        });
    }
};
