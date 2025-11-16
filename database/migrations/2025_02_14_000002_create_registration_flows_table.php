<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasTable('registration_flows')) {
            return;
        }

        Schema::create('registration_flows', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['lomba', 'sertifikasi']);
            $table->unsignedInteger('sequence')->default(1);
            $table->string('title');
            $table->text('description');
            $table->string('link')->nullable();
            $table->timestamps();

            $table->index(['type', 'sequence']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registration_flows');
    }
};
