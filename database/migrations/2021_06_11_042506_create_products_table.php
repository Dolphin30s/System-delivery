<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('sku');
            $table->integer('restaurant_id');
            $table->integer('category_id');
            $table->string('image_url')->nullable();
            $table->decimal('price', 12, 2);
            $table->char('currency_code', 16);
            $table->integer('stock');
            $table->text('description')->nullable();
            $table->timestamps();

            $table->index(['restaurant_id'], 'idx_restaurant_id');
            $table->index(['category_id'], 'idx_category_id');
            $table->unique(['restaurant_id', 'category_id', 'sku'], 'uq_order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
