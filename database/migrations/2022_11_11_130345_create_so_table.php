<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('so', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('branch_id')->nullable()->unsigned();
            $table->foreign('branch_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('customer_id')->nullable()->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->string('remarks')->nullable();
            $table->string('order_no')->nullable();
            $table->string('type')->nullable();
            $table->string('payment_mode')->nullable();
            $table->string('date_of_sale')->nullable();
            $table->string('replace_date')->nullable();
            $table->string('vehicle_no')->nullable();
            $table->string('total')->nullable();
            $table->string('brs_status')->default(1);
            $table->integer('status')->default(1)->comment('1=pending,2=complete');
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
        Schema::dropIfExists('so');
    }
}
