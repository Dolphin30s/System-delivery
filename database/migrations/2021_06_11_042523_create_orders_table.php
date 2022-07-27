<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->comment('Customer ID');
            $table->tinyInteger('order_status');
            $table->integer('number_shipped')->default(0);
            $table->decimal('order_total', 12, 2);
            $table->char('currency_code', 16);
            $table->unsignedInteger('address_id');
            $table->unsignedInteger('payment_id');
            $table->dateTime('purchase_date');
            $table->timestamps();

            $table->index(['user_id'], 'idx_user_id');
            $table->index(['order_status'], 'idx_order_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
