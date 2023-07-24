@extends('main')
@section('content')

<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
    <br>
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">        
        <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        BSR
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">
                            <!-- <a href="{{ route('salesorder.index') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="flaticon2-back-1"></i>
                                Back
                            </a> -->

                            @if($bsr)
                            <button style="background: white;" title="BSR" onclick="getpdf('{{$data->id}}')" id="pdf_{{$data->id}}" class="btn btn-sm btn-clean btn-icon btn-icon-md pdf4">
                                <i style="color: black;" class="fas fa-print"></i>
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <meta name="csrf-token" content="{{ csrf_token() }}" />

            <div class="kt-portlet__foot">
            	<form class="kt-form kt-form--label-right add_form" id="add_form" >
            		@csrf
                    <div class="row">
                       <input type="hidden" name="so_id" value="{{$data->id}}">
                       <div class="form-group col-lg-3">
                        <label>1. Customer </label>
                        <input type="hidden" name="customer_id" value="{{$data->customer_id}}">
                        <select class="form-control select2" id="customers_id" name="customer_id" disabled>
                            <option value="">Select Customer</option>
                            @foreach($customer as $admin)
                            <option value="{{$admin->id}}" @if($admin->id == $data->customer_id) selected @endif>{{$admin->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <?php
                    $customers = App\Customer::where('id',$data->customer_id)->first();
                    ?>
                    <div class="form-group col-lg-3">
                        <label>2. Mobile No. </label>
                        <input type="text" name="mobile_no" readonly value="{{$customers->number}}" class="form-control">
                    </div>

                    <div class="form-group col-lg-3">
                        <label>3. Address </label>
                        <input type="text" name="address" readonly  value="{{$customers->address}}" class="form-control" readonly>
                    </div>

                    <div class="form-group col-lg-3">
                        <label>No. </label>
                        <input type="number" name="no" @if(isset($bsr)) value="{{$bsr->no}}" @endif placeholder="No." class="form-control" >
                    </div>

                    <div class="form-group col-lg-3">
                        <label>SCF No. </label>
                        <input type="number" name="scf_no" @if(isset($bsr)) value="{{$bsr->scf_no}}" @endif placeholder="SCF No" class="form-control" >
                    </div>

                    <div class="form-group col-lg-3">
                        <label>SCF Date </label>
                        <input type="date" name="scf_date" @if(isset($bsr)) value="{{$bsr->scf_date}}" @endif class="form-control" >
                    </div>

                    <div class="form-group col-lg-3">
                        <label>Complaint Reported Date </label>
                        <input type="date" name="complaint_date" @if(isset($bsr)) value="{{$bsr->complaint_date}}" @endif class="form-control" >
                    </div>


                    @if(isset($bsr))
                    <div class="form-group col-lg-3">
                        <label>4. Call Source</label>
                        <div class="kt-checkbox-inline">
                            <label class="kt-checkbox">
                                <input type="checkbox" name="call_source1" value="1"  @if($bsr->call_source1 == 1) checked @endif > Customer
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="call_source2" value="2"  @if($bsr->call_source2 == 2) checked @endif> Dealer
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="call_source3" value="3"  @if($bsr->call_source3 == 3) checked @endif> OED  
                                <span></span>
                            </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <label class="kt-checkbox">
                                <input type="checkbox" name="call_source4" value="4"  @if($bsr->call_source4 == 4) checked @endif>   Call Center
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="call_source5" value="5"  @if($bsr->call_source5 == 5) checked @endif> ARBL
                                <span></span>
                            </label>
                        </div>

                    </div>
                    @else
                    <div class="form-group col-lg-3">
                        <label>4. Call Source</label>
                        <div class="kt-checkbox-inline">
                            <label class="kt-checkbox">
                                <input type="checkbox" name="call_source1" value="1" > Customer
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="call_source2" value="2"> Dealer
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="call_source3" value="3"> OED  
                                <span></span>
                            </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <label class="kt-checkbox">
                                <input type="checkbox" name="call_source4" value="4" >   Call Center
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="call_source5" value="5"> ARBL
                                <span></span>
                            </label>
                        </div>

                    </div>

                    @endif


                    <div class="form-group col-lg-3">
                        <label>5. Dealer Name </label>
                        <input type="text" name="dealer_name" @if(isset($bsr)) value="{{$bsr->dealer_name}}" @endif  class="form-control" placeholder="Dealer Name">
                    </div>

                    <div class="form-group col-lg-3">
                        <label>6. Location </label>
                        <input type="text" name="location" @if(isset($bsr)) value="{{$bsr->location}}" @endif  class="form-control" placeholder="Location">
                    </div>

                    @if(isset($bsr))
                    <div class="form-group col-lg-3">
                        <label>7. Type Of Service Call</label>
                        <div class="kt-checkbox-inline">
                            <label class="kt-checkbox">
                                <input type="checkbox" name="service_call1" value="1" @if($bsr->service_call1 == 1) checked @endif> First Time
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="service_call2" value="2"  @if($bsr->service_call2 == 2) checked @endif> Repeated
                                <span></span>
                            </label>

                        </div>

                    </div>
                    @else
                    <div class="form-group col-lg-3">
                        <label>7. Type Of Service Call</label>
                        <div class="kt-checkbox-inline">
                            <label class="kt-checkbox">
                                <input type="checkbox" name="service_call1" value="1" > First Time
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="service_call2" value="2" > Repeated
                                <span></span>
                            </label>

                        </div>

                    </div>
                    @endif


                    <div class="form-group col-lg-3">
                        <label>8. Date of Previous Replacement(if any) </label>
                        <input type="date" name="replace_date" @if(isset($bsr)) value="{{$bsr->replace_date}}" @endif class="form-control" placeholder="">
                    </div>

                    @if(isset($bsr))
                    <div class="form-group col-lg-3">
                        <label>9. Segment</label>
                        <div class="kt-checkbox-inline">
                            <label class="kt-checkbox">
                                <input type="checkbox" name="segment1" value="1" @if($bsr->segment1 == 1) checked @endif> OEM
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="segment2" value="2"  @if($bsr->segment2 == 2) checked @endif > After Market
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="segment3" value="3"  @if($bsr->segment3 == 3) checked @endif> Institutional
                                <span></span>
                            </label>

                        </div>

                    </div>
                    @else
                    <div class="form-group col-lg-3">
                        <label>9. Segment</label>
                        <div class="kt-checkbox-inline">
                            <label class="kt-checkbox">
                                <input type="checkbox" name="segment1" value="1" > OEM
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="segment2" value="2" > After Market
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="segment3" value="3"> Institutional
                                <span></span>
                            </label>

                        </div>

                    </div>
                    @endif

                    @if(isset($bsr))
                    <div class="form-group col-lg-3">
                        <label>10. Battery Type</label>
                        <div class="kt-checkbox-inline">
                            <label class="kt-checkbox">
                                <input type="checkbox" name="battery_type1" value="1"  @if($bsr->battery_type1 == 1) checked @endif> Two Wheeler
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="battery_type2" value="2"  @if($bsr->battery_type2 == 2) checked @endif> Authomotive
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="battery_type3" value="3"  @if($bsr->battery_type3 == 3) checked @endif> Tubular
                                <span></span>
                            </label>

                        </div>

                    </div>
                    @else
                    <div class="form-group col-lg-3">
                        <label>10. Battery Type</label>
                        <div class="kt-checkbox-inline">
                            <label class="kt-checkbox">
                                <input type="checkbox" name="battery_type1" value="1" > Two Wheeler
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="battery_type2" value="2" > Authomotive
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="battery_type3" value="3" > Tubular
                                <span></span>
                            </label>

                        </div>

                    </div>
                    @endif
                    @php 
                    $child = App\SoChild::where('so_id',$data->id)->get();

                    @endphp
                    @if(isset($bsr))
                    <div class="form-group col-lg-3">
                        <label>11. Part No. </label>
                        <select class="form-control select2" id="part_no" name="part_no" required>
                            <option value="">Select Serial No</option>
                            @foreach($child as $admin)
                            <option value="{{$admin->return_serial_id}}" @if($admin->return_serial_id == $bsr->part_no) selected @endif>{{$admin->return_serial_id}}</option>
                            @endforeach

                        </select>
                    </div>
                    @else
                    <div class="form-group col-lg-3">
                        <label>11. Part No. </label>
                        <select class="form-control select2" id="part_no" name="part_no">
                            <option value="">Select Serial No</option>
                            @foreach($child as $admin)
                            <option value="{{$admin->return_serial_id}}">{{$admin->return_serial_id}}</option>
                            @endforeach

                        </select>
                    </div>
                    @endif


                    <div class="form-group col-lg-1">
                        <label>12. Warranty </label><br>
                        <div style="display: inline-flex;">
                            FR<input type="number" name="warranty" @if(isset($bsr)) value="{{$bsr->warranty}}" @endif  class="form-control" placeholder="FR">
                        </div> 
                    <!-- + PR 
                        <input type="number" name="warranty1" style="width:40% !important;"  class="form-control" placeholder=""> Months -->
                    </div>

                    <div class="form-group col-lg-2">
                        <label style="display: none !important;">12. Warranty </label><br>
                        <div style="display: inline-flex;">
                            + PR <input type="number" name="warranty1" @if(isset($bsr)) value="{{$bsr->warranty1}}" @endif   class="form-control" placeholder="PR">  
                            Months
                        </div>

                    </div> 

                    <div class="form-group col-lg-3">
                        <label>13. Batt.SI.No. </label>
                        <input type="text"  name="batt_si_no" @if(isset($bsr)) value="{{$bsr->batt_si_no}}" @endif  class="form-control capbatt" placeholder="Batt.SI.No.">
                    </div> 

                    <div class="form-group col-lg-3">
                        <label>14. Date Of Sale</label>
                        <input type="date"  name="date_of_sale"  value="{{$data->date_of_sale}}"  readonly  class="form-control" placeholder="">
                    </div> 

                    <div class="form-group col-lg-3">
                        <label>15. Mfg. M/Y. </label>
                        <input type="month"  name="mfg_date" @if(isset($bsr)) value="{{$bsr->mfg_date}}" @endif  class="form-control" placeholder="">
                    </div> 

                    <div class="form-group col-lg-3">
                        <label>16. TSF/WR No. </label>
                        <input type="number"  name="tsf_no" @if(isset($bsr)) value="{{$bsr->tsf_no}}" @endif  class="form-control" placeholder="TSF/WR No.">
                    </div>  

                    <div class="form-group col-lg-3">
                        <label>16. TSF/WR Date. </label>
                        <input type="date"  name="tsf_date" @if(isset($bsr)) value="{{$bsr->tsf_date}}" @endif  class="form-control" placeholder="">
                    </div> 

                    @if(isset($bsr))
                    <div class="form-group col-lg-3">
                        <label>17. TSF/WR Created By</label>
                        <div class="kt-checkbox-inline">
                            <label class="kt-checkbox">
                                <input type="checkbox" name="tsf_created_by1" value="1" @if($bsr->tsf_created_by1 == 1) checked @endif > Dealer
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="tsf_created_by2" value="2" @if($bsr->tsf_created_by2 == 2) checked @endif> Franchisee
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="tsf_created_by3" value="3" @if($bsr->tsf_created_by3 == 3) checked @endif> Customer
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="tsf_created_by4" value="4" @if($bsr->tsf_created_by4 == 4) checked @endif> ARBL
                                <span></span>
                            </label>

                        </div>

                    </div>
                    @else
                    <div class="form-group col-lg-3">
                        <label>17. TSF/WR Created By</label>
                        <div class="kt-checkbox-inline">
                            <label class="kt-checkbox">
                                <input type="checkbox" name="tsf_created_by1" value="1" > Dealer
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="tsf_created_by2" value="2"> Franchisee
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="tsf_created_by3" value="3" > Customer
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="tsf_created_by4" value="4" > ARBL
                                <span></span>
                            </label>

                        </div>

                    </div>
                    @endif

                    <div class="form-group col-lg-3">
                        <label>18. Lead Time. </label>
                        <input type="time"  name="lead_time" @if(isset($bsr)) value="{{$bsr->lead_time}}" @endif class="form-control" placeholder="">
                    </div>


                    @if(isset($bsr))
                    <div class="form-group col-lg-3">
                        <label>19. Warranty Status</label>
                        <div class="kt-checkbox-inline">
                            <label class="kt-checkbox">
                                <input type="checkbox" name="warranty_status1" value="1" @if($bsr->warranty_status1 == 1) checked @endif> FR
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="warranty_status2" value="2" @if($bsr->warranty_status2 == 2) checked @endif> PR
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="warranty_status3" value="3" @if($bsr->warranty_status3 == 3) checked @endif> USD
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="warranty_status4" value="4" @if($bsr->warranty_status4 == 4) checked @endif> OW
                                <span></span>
                            </label>

                        </div>

                    </div>
                    @else
                    <div class="form-group col-lg-3">
                        <label>19. Warranty Status</label>
                        <div class="kt-checkbox-inline">
                            <label class="kt-checkbox">
                                <input type="checkbox" name="warranty_status1" value="1" > FR
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="warranty_status2" value="2" > PR
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="warranty_status3" value="3" > USD
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="warranty_status4" value="4"> OW
                                <span></span>
                            </label>

                        </div>

                    </div>
                    @endif

                    <div class="form-group col-lg-3">
                        <label>20. Nature Of Problem </label>
                        <input type="text"  name="nature_problem" @if(isset($bsr)) value="{{$bsr->nature_problem}}" @endif class="form-control" placeholder="Nature Of Problem">
                    </div> 

                    <div class="form-group col-lg-3">
                        <label>21. OCV </label>
                        <input type="text"  name="ocv" @if(isset($bsr)) value="{{$bsr->ocv}}" @endif  class="form-control" placeholder="OCV">
                    </div>

                    @if(isset($bsr))
                    <div class="form-group col-lg-3">
                        <label>22. Standby Provided</label>
                        <div class="kt-checkbox-inline">
                            <label class="kt-checkbox">
                                <input type="checkbox" name="standby_provided1" value="1"  @if($bsr->standby_provided1 == 1) checked @endif> Yes
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="standby_provided2" value="2"  @if($bsr->standby_provided2== 2) checked @endif> No
                                <span></span>
                            </label>

                        </div>

                    </div>
                    @else
                    <div class="form-group col-lg-3">
                        <label>22. Standby Provided</label>
                        <div class="kt-checkbox-inline">
                            <label class="kt-checkbox">
                                <input type="checkbox" name="standby_provided1" value="1" > Yes
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="standby_provided2" value="2" > No
                                <span></span>
                            </label>

                        </div>

                    </div>
                    @endif


                    @if(isset($bsr))
                    <div class="form-group col-lg-3">
                        <label>23. Physical Condition of Battery(on Receipt)</label>
                        <div class="kt-checkbox-inline">
                            <label class="kt-checkbox">
                                <input type="checkbox" name="physical_condition1" value="1"  @if($bsr->physical_condition1 == 1) checked @endif> Good
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="physical_condition2" value="2" @if($bsr->physical_condition2 == 2) checked @endif> Damage
                                <span></span>
                            </label>

                        </div>

                    </div>
                    @else
                    <div class="form-group col-lg-3">
                        <label>23. Physical Condition of Battery(on Receipt)</label>
                        <div class="kt-checkbox-inline">
                            <label class="kt-checkbox">
                                <input type="checkbox" name="physical_condition1" value="1" > Good
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="physical_condition2" value="2" > Damage
                                <span></span>
                            </label>

                        </div>

                    </div>
                    @endif

                    @if(isset($bsr))
                    <div class="form-group col-lg-12">
                        <label>24. Attended Place</label>
                        <div class="kt-checkbox-inline">
                            <label class="kt-checkbox">
                                <input type="checkbox" name="attended_place1" value="1" @if($bsr->attended_place1 == 1) checked @endif> Franchisee
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="attended_place2" value="2" @if($bsr->attended_place2 == 2) checked @endif> S-HUB
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="attended_place3" value="3" @if($bsr->attended_place3 == 3) checked @endif> Dealer
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="attended_place4" value="4" @if($bsr->attended_place4 == 4) checked @endif> OED
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="attended_place5" value="5" @if($bsr->attended_place5 == 5) checked @endif> Road Side Assistance
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="attended_place6" value="6" @if($bsr->attended_place6 == 6) checked @endif> Door Step Service
                                <span></span>
                            </label>

                        </div>

                    </div>
                    @else
                    <div class="form-group col-lg-12">
                        <label>24. Attended Place</label>
                        <div class="kt-checkbox-inline">
                            <label class="kt-checkbox">
                                <input type="checkbox" name="attended_place1" value="1" > Franchisee
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="attended_place2" value="2"> S-HUB
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="attended_place3" value="3" > Dealer
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="attended_place4" value="4" > OED
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="attended_place5" value="5" > Road Side Assistance
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="attended_place6" value="6"> Door Step Service
                                <span></span>
                            </label>

                        </div>

                    </div>
                    @endif

                    @if(isset($bsr))
                    <div class="form-group col-lg-12">
                        <label>25. Proof Of Warranty</label>
                        <div class="kt-checkbox-inline">
                            <label class="kt-checkbox">
                                <input type="checkbox" name="proof_of_warranty1" value="1" @if($bsr->proof_of_warranty1 == 1) checked @endif> Warranty Card
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="proof_of_warranty2" value="2" @if($bsr->proof_of_warranty2 == 2) checked @endif> TSF-ACS
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="proof_of_warranty3" value="3" @if($bsr->proof_of_warranty3 == 3) checked @endif> WR-DSM
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="proof_of_warranty4" value="4" @if($bsr->proof_of_warranty4 == 4) checked @endif> Franchisee Invoice
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="proof_of_warranty5" value="5" @if($bsr->proof_of_warranty5 == 5) checked @endif> Dealer's Invoice
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="proof_of_warranty6" value="6" @if($bsr->proof_of_warranty6  == 6) checked @endif> OED Claim Form
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="proof_of_warranty7" value="7" @if($bsr->proof_of_warranty7 == 7) checked @endif> Veh.Inv/Insu./RC
                                <span></span>
                            </label>

                        </div>

                    </div>
                    @else
                    <div class="form-group col-lg-12">
                        <label>25. Proof Of Warranty</label>
                        <div class="kt-checkbox-inline">
                            <label class="kt-checkbox">
                                <input type="checkbox" name="proof_of_warranty1" value="1" > Warranty Card
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="proof_of_warranty2" value="2"> TSF-ACS
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="proof_of_warranty3" value="3" > WR-DSM
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="proof_of_warranty4" value="4" > Franchisee Invoice
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="proof_of_warranty5" value="5" > Dealer's Invoice
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="proof_of_warranty6" value="6"> OED Claim Form
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="proof_of_warranty7" value="7" > Veh.Inv/Insu./RC
                                <span></span>
                            </label>

                        </div>

                    </div>
                    @endif



                    @if(isset($bsr))
                    <div class="form-group col-lg-12">
                        <label>26. Application</label>
                        <div class="kt-checkbox-inline">
                            <label class="kt-checkbox">
                                <input type="checkbox" name="application1" value="1" @if($bsr->application1 == 1) checked @endif> Scooter
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="application2" value="2" @if($bsr->application2 == 2) checked @endif> Motorbike
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="application3" value="3" @if($bsr->application3 == 3) checked @endif> Car
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="application4" value="4" @if($bsr->application4 == 4) checked @endif> SUV/MUV/MPV
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="application5" value="5" @if($bsr->application5 == 5) checked @endif> LCV/HCV/BUS
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="application6" value="6" @if($bsr->application6 == 6) checked @endif> Tractor
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="application7" value="7" @if($bsr->application7 == 7) checked @endif> SPV
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="application8" value="8" @if($bsr->application8 == 8) checked @endif> Genset
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="application9" value="9" @if($bsr->application9 == 9) checked @endif> Home UPS
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="application10" value="10" @if($bsr->application10 == 10) checked @endif> E-Rickshaw
                                <span></span>
                            </label>

                        </div>

                    </div>
                    @else
                    <div class="form-group col-lg-12">
                        <label>26. Application</label>
                        <div class="kt-checkbox-inline">
                            <label class="kt-checkbox">
                                <input type="checkbox" name="application1" value="1" > Scooter
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="application2" value="2" > Motorbike
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="application3" value="3" > Car
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="application4" value="4" > SUV/MUV/MPV
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="application5" value="5" > LCV/HCV/BUS
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="application6" value="6" > Tractor
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="application7" value="7" > SPV
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="application8" value="8" > Genset
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="application9" value="9" > Home UPS
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="application10" value="10" > E-Rickshaw
                                <span></span>
                            </label>

                        </div>

                    </div>
                    @endif

                    <div class="form-group col-lg-3">
                        <label>a. Make </label>
                        <input type="text"  name="make" @if(isset($bsr)) value="{{$bsr->make}}" @endif  class="form-control" placeholder="Make">
                    </div>

                    <div class="form-group col-lg-3">
                        <label>b. Model/Capacity </label>
                        <input type="text"  name="model_capacity" @if(isset($bsr)) value="{{$bsr->model_capacity}}" @endif  class="form-control" placeholder="Model/Capacity">
                    </div>

                    @if(isset($bsr))
                    <div class="form-group col-lg-3">
                        <label>c. Fuel Type</label>
                        <div class="kt-checkbox-inline">
                            <label class="kt-checkbox">
                                <input type="checkbox" name="fuel_type1" value="1" @if($bsr->fuel_type1 == 1) checked @endif> Petrol
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="fuel_type2" value="2" @if($bsr->fuel_type2 == 2) checked @endif> Diesel
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="fuel_type3" value="3" @if($bsr->fuel_type3 == 3) checked @endif> CNG
                                <span></span>
                            </label>

                        </div>

                    </div>
                    @else
                    <div class="form-group col-lg-3">
                        <label>c. Fuel Type</label>
                        <div class="kt-checkbox-inline">
                            <label class="kt-checkbox">
                                <input type="checkbox" name="fuel_type1" value="1"> Petrol
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="fuel_type2" value="2" > Diesel
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="fuel_type3" value="3"> CNG
                                <span></span>
                            </label>

                        </div>

                    </div>
                    @endif

                    <div class="form-group col-lg-3">
                        <label>d. Veh. Mfg </label>
                        <input type="text"  name="veh_mfg" id="veh_mfg" @if(isset($bsr)) value="{{$bsr->veh_mfg}}"  @endif  class="form-control" placeholder="Veh. Mfg">
                    </div>

                    @if(isset($bsr))
                    <div class="form-group col-lg-3">
                        <label>e. Usage</label>
                        <div class="kt-checkbox-inline">
                            <label class="kt-checkbox">
                                <input type="checkbox" name="usage1" value="1" @if($bsr->usage1 == 1) checked @endif> Personal
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="usage2" value="2" @if($bsr->usage2 == 2) checked @endif> Commercial
                                <span></span>
                            </label>


                        </div>

                    </div>
                    @else
                    <div class="form-group col-lg-3">
                        <label>e. Usage</label>
                        <div class="kt-checkbox-inline">
                            <label class="kt-checkbox">
                                <input type="checkbox" name="usage1" value="1" > Personal
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox" name="usage2" value="2"> Commercial
                                <span></span>
                            </label>


                        </div>

                    </div>
                    @endif

                    <div class="form-group col-lg-3">
                        <label>f. Vehicle Reg. No. </label>
                        <input type="number"  name="vehicle_no" id="vehicle_no" @if(isset($bsr)) value="{{$bsr->vehicle_no}}" @endif   class="form-control" placeholder="Vehicle Reg. No.">
                    </div>

                    <div class="form-group col-lg-3">
                        <label>g. KMS Used. </label>
                        <input type="text"  name="kms_used" id="kms_used" @if(isset($bsr)) value="{{$bsr->kms_used}}" @endif  class="form-control" placeholder="KMS Used.">
                    </div>






               <!--  <div class="form-group col-lg-3">
                    <label>Status</label>
                    <input type="hidden" name="id" id="id" value="{{$data->id}}">
                    <select class="form-control" name="bsr_status" onchange="status(this)" id="bsr_status" required>
                        <option value="">Select</option>
                        <option value="1" @if($data->bsr_status == 1) selected @endif>Pending</option>
                        <option value="2" @if($data->bsr_status == 2) selected @endif>Completed</option>

                    </select>
                </div> -->


            </div>

            <div class="kt-form__actions">
              <center>
                 <button type="button" class="btn btn-brand submit_basic" id="submit_basic" >Submit</button>
                 <a href="{{ route('salesorder.index') }}"><button type="button" class="btn btn-outline-secondary">Cancel</button></a>
             </center>
         </div>

     </form>


 </div>


</div>

</div>



</div>



@stop
@push('scripts')
<script type="text/javascript">


  function getpdf(id,name,invoiceno)
  {
    var parent = $('#pdf_'+id);           

    parent.attr('disabled',true);

    parent.html('<i class="fa fa-spinner fa-spin"></i>');

    $.ajax({
        type: "POST",
        url: "{{ route('pdf') }}",
        data: {
            '_token': $('input[name="_token"]').val(),
            'id': id
        },
        xhrFields: {
            responseType: 'blob'
        },
        success: function(blob) {
            parent.attr('disabled',false);

            parent.html('<i style="color: black;" class="fas fa-print"></i >');

            var link=document.createElement('a');
            link.href=window.URL.createObjectURL(blob);
            link.download= id+'BSR.pdf';
            link.click();
        }
    });
}




</script>

<script>
    $(function() {
        $('.capbatt').keyup(function() {
            this.value = this.value.toLocaleUpperCase();
        });
    });
</script> 

<script type="text/javascript">
    $(document).ready(function() {
        $("#submit_basic").on("click", function(e) {
          e.preventDefault();
          console.log('djn');
          if ($(".add_form").valid()) {
            $.ajax({
              type: "POST",
              url: "{{ route('bsr.store') }}",
              data: new FormData($('.add_form')[0]),
              processData: false,
              contentType: false,
              success: function(data) {
                if (data.status === 'success') {

                  window.location="{{ route('salesorder.index') }}";


                  toastr["success"]("Bsr Added Successfully", "Success");
              } else if (data.status === 'error') {
                  location.reload();
                  toastr["error"]("Something went wrong", "Error");
              }
          },
      });
        } else {
            e.preventDefault();
        }
    });
    });


    $('#veh_mfg').datepicker({

        minViewMode: 'years',
        autoclose: true,
        format: 'yyyy'
    });

</script>
@endpush
