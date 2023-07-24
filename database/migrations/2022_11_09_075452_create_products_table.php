<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->nullable()->unsigned();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('alias')->nullable();
            $table->string('model_code')->nullable();
            $table->integer('gst_id')->nullable()->unsigned();
            $table->foreign('gst_id')->references('id')->on('gst')->onDelete('cascade');
            $table->string('group_name')->nullable();
            $table->integer('stock_required')->nullable();
            $table->integer('price_list')->nullable();
            $table->integer('locationwise_stock')->nullable();
            $table->integer('serialno_stock')->nullable();
            $table->integer('tcs')->nullable();
            $table->string('purchase_rate')->nullable();
            $table->string('sales_rate')->nullable();
            $table->string('tax_paid_rate')->nullable();
            $table->integer('sale')->nullable()->unsigned();
            $table->foreign('sale')->references('id')->on('unit')->onDelete('cascade');
            $table->integer('purchase')->nullable()->unsigned();
            $table->foreign('purchase')->references('id')->on('unit')->onDelete('cascade');
            $table->integer('gst_unit')->nullable()->unsigned();
            $table->foreign('gst_unit')->references('id')->on('unit')->onDelete('cascade');
            $table->string('quantity')->nullable();
            $table->string('amount')->nullable();
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
        Schema::dropIfExists('products');
    }
}
