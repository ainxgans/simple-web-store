<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        DB::statement('DROP TABLE IF EXISTS master.products CASCADE');
        Schema::dropIfExists('master.products');
        Schema::create('master.products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->integer('price');
            $table->integer('stock');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('transactions.carts', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
        });

        Schema::table('transactions.order_items', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
        });
        Schema::dropIfExists('master.products');
    }
};
