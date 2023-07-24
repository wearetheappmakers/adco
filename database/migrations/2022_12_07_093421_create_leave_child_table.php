<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaveChildTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_child', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('leave_id')->unsigned()->nullable();
            $table->foreign('leave_id')->references('id')->on('leave')->onDelete('cascade');
            $table->string('date')->nullable();
            $table->string('duration')->nullable();
            $table->string('approved_duration')->nullable();
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
        Schema::dropIfExists('leave_child');
    }
}
