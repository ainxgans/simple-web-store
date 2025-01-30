<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::dropIfExists('transactions.transactions');
        Schema::create('transactions.transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('transactions.orders');
            $table->string('proof');
            $table->string('status');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions.transactions');
    }
};
