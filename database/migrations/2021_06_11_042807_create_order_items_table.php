<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->comment('Customer ID');
            $table->unsignedInteger('order_id')->comment('Order ID');
            $table->string('title');
            $table->string('sku');
            $table->string('image_url')->nullable();
            $table->unsignedInteger('quantity_ordered');
            $table->unsignedInteger('quantity_shipped');
            $table->decimal('item_price', 12, 2);
            $table->char('currency_code', 16);
            $table->decimal('fee', 12, 2)->nullable();
            $table->decimal('shipping_cost', 12, 2)->nullable();
            $table->timestamps();

            $table->index(['order_id'], 'idx_order_id');
            $table->unique(['order_id', 'sku'], 'uq_order_item');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
