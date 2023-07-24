<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role')->comment('1=admin,2=branch,3=employee')->nullable();
            $table->integer('branch_id')->nullable();
            $table->string('email')->unique();
            $table->string('name')->nullable();
            $table->string('number')->nullable();
            $table->string('password')->nullable();
            $table->string('showpasssword')->nullable();
            $table->integer('status')->default(1);
            $table->integer('leave_policy_id')->nullable();
            $table->integer('weekoff_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert([
            'role' => "1",
            'name' => "Admin",
            'number' => "0123456789",
            'email' => 'admin@adco.com',
            'password' => bcrypt('admin@123'),
            'showpasssword' => 'admin@123',
            'status' => '1',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
