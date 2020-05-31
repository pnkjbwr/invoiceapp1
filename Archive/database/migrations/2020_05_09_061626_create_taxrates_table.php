<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxratesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxrates', function (Blueprint $table) {
            $table->id();
            $table->double('tax_rate', 15, 8)->nullable()->default(0);
            $table->string('tax_name', 100)->nullable();
            $table->tinyInteger('isactive')->default(1); //active (1) or inactive (0)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taxrates');
    }
}