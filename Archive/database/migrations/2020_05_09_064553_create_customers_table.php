<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('cname');//compulsory //[required]
            $table->string('mobile1');//compulsory //[required]
            $table->string('email')->nullable();
            $table->string('firm')->nullable();
            $table->string('panno')->nullable();
            $table->string('gstno')->nullable();
            $table->string('gst_state_code')->nullable();
            $table->double('total_outstanding', 15, 2)->nullable()->default(0.00);
            $table->string('full_address')->nullable();
            $table->string('city')->nullable();
            $table->string('pincode')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('record_created_by')->nullable();
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
        Schema::dropIfExists('customers');
    }
}