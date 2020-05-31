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
            $table->string('p_name', 255)->nullable();
            $table->string('unit_name', 100)->nullable();
            $table->string('p_type', 100)->nullable(); // Goods or Service
            $table->string('hsn_sac_code', 100)->nullable(); // GST HSN or SAC Code
            $table->tinyInteger('istaxable')->nullable(); //
            $table->tinyInteger('isactive')->nullable(); //
            $table->bigInteger('taxrate_id')->unsigned()->nullable();
            $table->double('price', 20, 8)->nullable()->default(0.00);
            $table->timestamps();
            $table->foreign('taxrate_id')->references('id')->on('taxrates')->onDelete('cascade')->onUpdate('cascade');
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