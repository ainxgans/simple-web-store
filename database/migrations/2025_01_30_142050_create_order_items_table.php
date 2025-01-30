<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::dropIfExists('transactions.order_items');
        Schema::create('transactions.order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('transactions.orders');
            $table->foreignId('product_id')->constrained('master.products');
            $table->integer('qty');
            $table->integer('price');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions.order_items');
    }
};
