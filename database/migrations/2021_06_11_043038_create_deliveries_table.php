<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('order_id');
            $table->string('tracking_number');
            $table->tinyInteger('shipping_status');
            $table->decimal('longitude', 12);
            $table->decimal('latitude', 12);
            $table->dateTime('datetime');
            $table->json('history')->nullable();
            $table->timestamps();

            $table->index(['order_id'], 'idx_order_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deliveries');
    }
}
