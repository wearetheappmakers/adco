<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeavePolicyChildTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_policy_child', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('policy_id')->unsigned()->nullable();
            $table->foreign('policy_id')->references('id')->on('leave_policy')->onDelete('cascade');
             $table->integer('leave_type_id')->unsigned()->nullable();
            $table->foreign('leave_type_id')->references('id')->on('leave_type')->onDelete('cascade');
            $table->string('day')->nullable();
            $table->string('is_extendable')->nullable();

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
        Schema::dropIfExists('leave_policy_child');
    }
}
