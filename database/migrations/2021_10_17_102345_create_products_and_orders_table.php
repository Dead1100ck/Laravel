<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsAndOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_and_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->delete('cascade')->update('cascade');
            $table->foreignId('order_id')->constrained()->delete('cascade')->update('cascade');
            $table->integer('count');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_and_orders');
    }
}
