<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::dropIfExists('transactions.orders');
        Schema::create('transactions.orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('master.users');
            $table->integer('total_price');
            $table->string('status');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions.orders');
    }
};
