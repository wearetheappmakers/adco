<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeekoffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weekoff', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('mon')->nullable();
            $table->integer('mon_type')->default(0)->comment('1=Full Day, 2=First Half, 3=Secound Half');
            $table->string('tue')->nullable();
            $table->integer('tue_type')->default(0)->comment('1=Full Day, 2=First Half, 3=Secound Half');
            $table->string('wed')->nullable();
            $table->integer('wed_type')->default(0)->comment('1=Full Day, 2=First Half, 3=Secound Half');
            $table->string('thu')->nullable();
            $table->integer('thu_type')->default(0)->comment('1=Full Day, 2=First Half, 3=Secound Half');
            $table->string('fri')->nullable();
            $table->integer('fri_type')->default(0)->comment('1=Full Day, 2=First Half, 3=Secound Half');
            $table->string('sat')->nullable();
            $table->integer('sat_type')->default(0)->comment('1=Full Day, 2=First Half, 3=Secound Half');
            $table->string('sun')->nullable();
            $table->integer('sun_type')->default(0)->comment('1=Full Day, 2=First Half, 3=Secound Half');
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
        Schema::dropIfExists('weekoff');
    }
}
