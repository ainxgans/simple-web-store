<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::dropIfExists('transactions.carts');
        Schema::create('transactions.carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('master.products');
            $table->foreignId('user_id')->constrained('master.users');
            $table->integer('qty');
            $table->integer('price');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions.carts');
    }
};
