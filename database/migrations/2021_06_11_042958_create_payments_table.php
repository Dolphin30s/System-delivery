<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('user_id');
            $table->decimal('price', 12, 2);
            $table->decimal('delivery_fee', 12, 2);
            $table->decimal('total', 12, 2);
            $table->string('type');
            $table->json('data')->nullable();
            $table->tinyInteger('status');
            $table->timestamps();

            $table->index(['user_id'], 'idx_user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
