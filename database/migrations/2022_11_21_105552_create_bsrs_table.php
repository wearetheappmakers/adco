<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBsrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bsrs', function (Blueprint $table) {
            $table->increments('id');
             $table->integer('so_id')->nullable()->unsigned();
            $table->foreign('so_id')->references('id')->on('so')->onDelete('cascade');
            $table->integer('customer_id')->nullable()->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->string('mobile_no')->nullable();
            $table->string('address')->nullable();
            $table->integer('call_source')->nullable();
            $table->integer('call_source1')->nullable();
            $table->integer('call_source2')->nullable();
            $table->integer('call_source3')->nullable();
            $table->integer('call_source4')->nullable();
            $table->integer('call_source5')->nullable();
            $table->string('dealer_name')->nullable();
            $table->string('location')->nullable();
            $table->string('service_call')->nullable();
            $table->integer('service_call1')->nullable();
            $table->integer('service_call2')->nullable();
            $table->string('replace_date')->nullable();
            $table->string('complain_date')->nullable();
            $table->string('segment')->nullable();
            $table->integer('segment1')->nullable();
            $table->integer('segment2')->nullable();
            $table->integer('segment3')->nullable();
            $table->string('battery_type')->nullable();
            $table->integer('battery_type1')->nullable();
            $table->integer('battery_type2')->nullable();
            $table->integer('battery_type3')->nullable();
            $table->string('part_no')->nullable();
            $table->string('warranty')->nullable();
            $table->string('batt_si_no')->nullable();
            $table->string('date_of_sale')->nullable();
            $table->string('mfg_date')->nullable();
            $table->string('tsf_no')->nullable();
            $table->string('tsf_date')->nullable();
            $table->string('tsf_created_by')->nullable();
            $table->integer('tsf_created_by1')->nullable();
            $table->integer('tsf_created_by2')->nullable();
            $table->integer('tsf_created_by3')->nullable();
            $table->integer('tsf_created_by4')->nullable();
            $table->string('lead_time')->nullable();
            $table->string('warranty_status')->nullable();
            $table->integer('warranty_status1')->nullable();
            $table->integer('warranty_status2')->nullable();
            $table->integer('warranty_status3')->nullable();
            $table->integer('warranty_status4')->nullable();
            $table->string('nature_problem')->nullable();
            $table->string('ocv')->nullable();
            $table->string('standby_provided')->nullable();
            $table->integer('standby_provided1')->nullable();
            $table->integer('standby_provided2')->nullable();
            $table->string('physical_condition')->nullable();
            $table->integer('physical_condition1')->nullable();
            $table->integer('physical_condition2')->nullable();
            $table->string('attended_place')->nullable();
            $table->integer('attended_place1')->nullable();
            $table->integer('attended_place2')->nullable();
            $table->integer('attended_place3')->nullable();
            $table->integer('attended_place4')->nullable();
            $table->integer('attended_place5')->nullable();
            $table->integer('attended_place6')->nullable();
            $table->string('proof_of_warranty')->nullable();
            $table->integer('proof_of_warranty1')->nullable();
            $table->integer('proof_of_warranty2')->nullable();
            $table->integer('proof_of_warranty3')->nullable();
            $table->integer('proof_of_warranty4')->nullable();
            $table->integer('proof_of_warranty5')->nullable();
            $table->integer('proof_of_warranty6')->nullable();
            $table->integer('proof_of_warranty7')->nullable();
            $table->string('application')->nullable();
            $table->integer('application1')->nullable();
            $table->integer('application2')->nullable();
            $table->integer('application3')->nullable();
            $table->integer('application4')->nullable();
            $table->integer('application5')->nullable();
            $table->integer('application6')->nullable();
            $table->integer('application7')->nullable();
            $table->integer('application8')->nullable();
            $table->integer('application9')->nullable();
            $table->integer('application10')->nullable();
            $table->string('make')->nullable();
            $table->string('model_capacity')->nullable();
            $table->string('fuel_type')->nullable();
            $table->integer('fuel_type1')->nullable();
            $table->integer('fuel_type2')->nullable();
            $table->integer('fuel_type3')->nullable();
            $table->string('veh_mfg')->nullable();
            $table->string('usage')->nullable();
            $table->integer('usage1')->nullable();
            $table->integer('usage2')->nullable();
            $table->string('vehicle_no')->nullable();
            $table->string('kms_used')->nullable();
            $table->string('warranty1')->nullable();
            $table->string('bettery_type')->nullable();
            $table->string('bsr_status')->nullable();
            $table->integer('no')->nullable();
            $table->integer('scf_no')->nullable();
            $table->string('scf_date')->nullable();
            $table->string('complaint_date')->nullable();
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
        Schema::dropIfExists('bsrs');
    }
}
