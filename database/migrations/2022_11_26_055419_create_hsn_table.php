<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHsnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hsn', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('gst_id')->nullable()->unsigned();
            $table->foreign('gst_id')->references('id')->on('gst')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('name_of_print')->nullable();
            $table->integer('fix_rate')->nullable();
            $table->integer('rcp')->nullable();
            $table->integer('fsp')->nullable();
            $table->integer('rack_no')->nullable();
            $table->integer('mrp')->nullable();
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
        Schema::dropIfExists('hsns');
    }
}
