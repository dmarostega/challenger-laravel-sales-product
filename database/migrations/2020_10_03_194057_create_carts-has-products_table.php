<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsHasProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts_has_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cart_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity');
            $table->softDeletes();

            $table->timestamps();

            $table->foreign('cart_id')->references('id')->on('carts')->onDelete('CASCADE');;
            $table->foreign('product_id')->references('id')->on('products')->onDelete('CASCADE');;

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carts_has_products', function (Blueprint $table) {
            $table->dropForeign('cart_id');
            $table->dropForeign('product_id');
        });
        Schema::dropIfExists('carts_has_products');
    }
}
