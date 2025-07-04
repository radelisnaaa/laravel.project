<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void
{
    Schema::table('events', function (Blueprint $table) {
        // Tambahkan kolom baru
        if (!Schema::hasColumn('events', 'start_time')) {
            $table->dateTime('start_time')->nullable();
        }
        if (!Schema::hasColumn('events', 'end_time')) {
            $table->dateTime('end_time')->nullable();
        }
    });
}

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['start_time', 'end_time']);
        });

        Schema::table('events', function (Blueprint $table) {
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
        });
    }
};
