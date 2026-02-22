<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCountryPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('product_country_prices', function (Blueprint $table) {
        //     $table->id();
        //     $table->integer('product_id');
        //     $table->integer('country_id');
        //     $table->integer('user_id');
        //     $table->double('price' , 8 , 2);
        //     $table->double('price_after_discount' , 8 , 2)->nullable();
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('product_country_prices');
    }
}
