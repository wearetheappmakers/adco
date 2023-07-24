<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('status')->nullable();
            $table->string('priority')->nullable();
            $table->string('start_date')->nullable();
            $table->string('due_date')->nullable();
            $table->string('time')->nullable();
            $table->integer('assigned_by')->nullable()->unsigned();
            $table->foreign('assigned_by')->references('id')->on('users')->onDelete('cascade');
            $table->integer('assigned_to_branch')->nullable()->unsigned();
            $table->foreign('assigned_to_branch')->references('id')->on('users')->onDelete('cascade');
            $table->integer('assigned_to_employee')->nullable()->unsigned();
            $table->foreign('assigned_to_employee')->references('id')->on('users')->onDelete('cascade');          
            $table->string('attachment')->nullable();
            $table->longText('description')->nullable();
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
        Schema::dropIfExists('task');
    }
}
