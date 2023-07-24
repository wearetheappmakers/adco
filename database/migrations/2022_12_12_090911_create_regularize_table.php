<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegularizeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regularize', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('attendance_id')->nullable()->unsigned();
            $table->foreign('attendance_id')->references('id')->on('attendance')->onDelete('cascade');
            $table->integer('branch_id')->nullable()->unsigned();
            $table->foreign('branch_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('employee_id')->nullable()->unsigned();
            $table->foreign('employee_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('attendance')->nullable();
            $table->string('date')->nullable();
            $table->string('time')->nullable();
            $table->string('type')->nullable();
            $table->string('reason')->nullable();
            $table->string('status')->default("Pending");
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
        Schema::dropIfExists('regularize');
    }
}
