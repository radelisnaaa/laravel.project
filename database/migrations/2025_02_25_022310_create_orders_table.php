<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relasi ke users
            $table->foreignId('ticket_id')->constrained()->onDelete('cascade'); // Relasi ke tickets
            $table->integer('quantity'); // Jumlah tiket yang dibeli
            $table->integer('total_price'); // Total harga berdasarkan jumlah tiket
            $table->enum('status', ['pending', 'paid', 'cancelled'])->default('pending'); // Status pembayaran
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
