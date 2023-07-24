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
                        View Sales Order
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">
                            <a href="{{ route('salesorder.index') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="flaticon2-back-1"></i>
                                Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <meta name="csrf-token" content="{{ csrf_token() }}" />

            <div class="kt-portlet__foot">
                <div class="row">
                    <div class="form-group" id="type" disabled>
                        <label>Type</label>

                        <div class="kt-radio-list">
                            <label class="kt-radio">
                                <input type="hidden" name="type" value="{{$data->type}}">
                                <input type="radio" disabled id="type" name="type"  value="1"  @if($data->type == 1) checked @endif > Direct Sales
                                <span></span>
                            </label>
                            <label class="kt-radio">
                                <input type="radio" disabled id="type" name="type" value="2"  @if($data->type == 2) checked @endif> FOC 
                                <span></span>
                            </label>
                            <label class="kt-radio">
                                <input type="radio" disabled id="type" name="type" value="3"  @if($data->type == 3) checked @endif> Pro Rata Warranty
                                <span></span>
                            </label>
                        </div>           
                    </div>
                </div>
                <div class="row">

                    @if(Auth::user()->role == 1)
                    <div class="form-group col-lg-2">
                        <label>Branch <span style="color : red;">*</span></label>
                        <input type="hidden" name="branch_id" value="{{$data->branch_id}}">
                        <select class="form-control select2" id="branch_id" name="branch_id" onchange="getcustomer(this)" disabled>

                         <option value="">Select Branch</option>
                         @foreach($branch as $admin)
                         <option value="{{$admin->id}}" @if($admin->id == $data->branch_id) selected @endif>{{$admin->name}}</option>
                         @endforeach

                     </select>
                 </div>

                 <div class="form-group col-lg-2" @if($data->type == 1) style="display: block;" @else style="display: none;" @endif id="customer">
                    <label>Customer</label>

                    <select class="form-control select2" id="customer_id" name="customer_id" disabled>
                     <option value="">Select Customer</option>
                     @foreach($customer as $admin)
                     <option value="{{$admin->id}}" @if($admin->id == $data->customer_id) selected @endif>{{$admin->name}}</option>
                     @endforeach
                 </select>
             </div>
             @endif

             <div class="form-group col-lg-2" @if(Auth::user()->role == 2 || Auth::user()->role == 3) style="display: block;" @else style="display: none;" @endif>
                <label>Customer </label>
                <select class="form-control select2" id="customers_id" name="customer_id" disabled>
                    <option value="">Select Customer</option>
                    @foreach($customer as $admin)
                    <option value="{{$admin->id}}" @if($admin->id == $data->customer_id) selected @endif>{{$admin->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-lg-2">
                <label>Order No. </label>
                <input type="text" name="order_no" readonly placeholder="Order Number" value="{{$data->order_no}}" class="form-control" readonly>
            </div>

            <div class="form-group col-lg-2">
                <label>Remarks</label>
                <input type="text" id="remarks" name="remarks" value="{{$data->remarks}}" placeholder="Enter Remarks" class="form-control" readonly>
            </div>
            <div class="form-group col-lg-2" id="payment_mode" @if($data->type == 1 || $data->type ==3) style="display: block;" @else style="display: none;" @endif>
                <label>Payment Mode</label><br/>
                <select class="form-control select2" style="width: 100%" id="payment_mode" name="payment_mode" disabled>
                    <option value="">Select</option>
                    <option value="1" @if($data->payment_mode == 1) selected @endif>Online</option>
                    <option value="2" @if($data->payment_mode == 2) selected @endif>Cash</option>
                </select>
            </div>

            <div class="form-group col-lg-2" @if($data->type == 1) style="display: block;" @else style="display: none;" @endif id="date_of_sale">
                <label>Date Of Sale</label>
                <input type="date" id="date_of_sale" name="date_of_sale" value="{{$data->date_of_sale}}" class="form-control" readonly>
            </div>
            <div class="form-group col-lg-2" @if($data->type == 2 || $data->type == 3) style="display: block;" @else style="display: none;" @endif id="replace_date">
                <label>Replace Date</label>
                <input type="date" id="replace_date" value="{{$data->replace_date}}" name="replace_date" readonly class="form-control">
            </div>

            <div class="form-group col-lg-2">
                <label>Vehicle Number</label>
                <input type="text" id="vehicle_no" name="vehicle_no" readonly value="{{$data->vehicle_no}}" placeholder="Enter Vehicle Number" class="form-control">
            </div>

        </div>

        <div class="row" id="clone" @if($data->type == 1) style="display: block;" @else style="display: none;" @endif>
            <div class="form-group col-lg-8">
                <table cellspacing="0" border="0" class="table table-bordered  from">
                    <thead>
                        <tr>
                           
                            <th>Category</th>
                            <th>Product</th>
                            <th>Serial No.</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($child as $key=>$value)
                        <tr class="fordelete">
                          
                            <td>
                                <input type="hidden" name="edit_hidden_id[]" value="{{$value->id}}" class="form-control ">

                                <select class="form-control old_category_id" id="old_category_id_0" name="old_category_id[]"  onchange="getproduct(this)" data-id = "{{$value->id}}" disabled>
                                    <option value="">Select</option>
                                    @foreach($category as $admin)
                                    <option value="{{$admin->id}}" @if($admin->id == $value->category_id) selected @endif>{{$admin->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>

                                <select class="form-control old_product_id" id="old_product_id_0" name="old_product_id[]"  onchange="getserial(this)" data-id = "{{$value->id}}" disabled>
                                    <option value="">Select</option>
                                    @foreach($product as $admin)
                                    <option value="{{$admin->id}}" @if($admin->id == $value->product_id) selected @endif>{{$admin->name}}</option>
                                    @endforeach                            
                                </select>
                            </td>
                            <td>

                                <select class="form-control old_serial_id" id="old_serial_id_0" name="old_serial_id[]"  onchange="getprice(this)" data-id = "{{$value->id}}" disabled>
                                    <option value="">Select</option>                               
                                    @foreach($stockchild as $admin)
                                    <option value="{{$admin->id}}" @if($admin->id == $value->serial_id) selected @endif>{{$admin->serial_no}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="text" name="old_price[]" value="{{$value->price}}" id="old_price_0" class="form-control old_price" placeholder="Price" data-id = "{{$value->id}}" readonly>
                            </td>
                        </tr>
                        @endforeach

                        <tr>
                            <td></td>
                            <td></td>
                            <td>Total</td>
                            <td>
                                <input type="text" name="total" id="total"  class="form-control total"  data-id = "0" value="{{$data->total}}" readonly>
                            </td>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row" @if($data->type == 2) style="display: block;" @else style="display: none;" @endif id="foc">
            <div class="form-group col-lg-8">
                <table cellspacing="0" border="0" class="table table-bordered  from">
                    <thead>
                        <tr>
                            
                            <th>Category</th>
                            <th>Product</th>
                            <th>Old Serial No.</th>
                            <th>New Serial No.</th>

                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($child))
                        @foreach($child as $key=>$value)
                        <tr class="edit_foc_cloneThis">
                           
                            <td>
                                <input type="hidden" name="edit_hidden_id" value="{{$value->id}}">

                                <select class="form-control edit_foc_category_id" id="edit_foc_category_id_0" name="edit_foc_category_id[]"  onchange="newproduct(this)" data-id = "{{$value->id}}" disabled>
                                    <option value="">Select</option>                               
                                    @foreach($category as $datas)
                                    <option value="{{$datas->id}}" @if($datas->id == $value->category_id) selected @endif>{{$datas->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>

                                <select class="form-control edit_foc_product_id" name="edit_foc_product_id[]" id="edit_foc_product_id_0"  onchange="oldserial(this)" data-id = "0" disabled>
                                    <option value="">Select</option>
                                    @foreach($product as $admin)
                                    <option value="{{$admin->id}}" @if($admin->id == $value->product_id) selected @endif>{{$admin->name}}</option>
                                    @endforeach                                

                                </select>
                            </td>
                            <td>
                                <input type="text" class="form-control edit_foc_serial_id" readonly value="{{$value->return_serial_id}}" name="return_serial_id">
                               <!--  <select class="form-control edit_foc_serial_id" id="edit_foc_serial_id_0" name="edit_foc_serial_id[]"  onchange="getprice(this)" data-id = "0" disabled >
                                    <option value="">Select</option>  
                                    @foreach($stockchild as $admin)
                                    <option value="{{$admin->serial_no}}" @if($admin->id == $value->return_serial_id) selected @endif>{{$admin->serial_no}}</option>
                                    @endforeach                             

                                </select> -->
                            </td>
                            <td>

                                <select class="form-control edit_foc_new_serial_id" id="edit_foc_new_serial_id_0" name="edit_foc_new_serial_id[]"  data-id = "0" disabled >
                                    <option value="">Select</option>
                                    @foreach($stockchild as $admin)
                                    <option value="{{$admin->id}}" @if($admin->id == $value->serial_id) selected @endif>{{$admin->serial_no}}</option>
                                    @endforeach 
                                </td>
                            </tr>

                            @endforeach
                            @endif
                          
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row"  @if($data->type == 3) style="display: block;" @else style="display: none;" @endif id="pro_rata_clone">
                    <div class="form-group col-lg-12" style="overflow: auto !important">
                        <table cellspacing="0" border="0" class="table table-bordered">
                            <thead>
                                <tr>
                                    
                                    <th style="width:200px !important">Category</th>
                                    <th style="width:200px !important">Product</th>
                                    <th style="width:200px !important">Old Serial No.</th>
                                    <th style="width:200px !important">Price</th>
                                    <th style="width:200px !important">Date Of Sale</th>
                                    <th style="width:200px !important">New Serial No.</th>
                                    <th style="width:200px !important">Discount</th>
                                    <th style="width:200px !important">Discount Amount</th>
                                    <th style="width:200px !important">Amount</th>
                                </tr>                
                            </thead>
                            <tbody>
                                @foreach($child as $key=>$value)
                                <tr class="fordelete">
                                    
                                    <td>
                                        <input type="hidden" name="edit_hidden_id[]" value="{{$value->id}}" class="form-control ">

                                        <select style="width:150px !important" class="form-control old_pro_category_id" id="old_pro_category_id_{{$value->id}}" name="old_pro_category_id[]"  data-id = "{{$value->id}}" disabled >
                                            <option value="">Select</option>
                                            @foreach($category as $datas)
                                            <option value="{{$datas->id}}" @if($datas->id == $value->category_id) selected @endif>{{$datas->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>

                                        <select style="width:150px !important" class="form-control old_pro_product_id" id="old_pro_product_id_{{$value->id}}" name="old_pro_product_id[]" disabled data-id = "{{$value->id}}" >
                                            <option value="">Select</option>                               
                                            @foreach($product as $admin)
                                            <option value="{{$admin->id}}" @if($admin->id == $value->product_id) selected @endif>{{$admin->name}}</option>
                                            @endforeach   
                                        </select>
                                    </td>
                                    <td>

                                        <input type="text"  style="width:200px !important" class="form-control old_pro_serial_id"  value="{{$value->return_serial_id}}" name="return_serial_id" readonly>
                                       <!--  <select style="width:200px !important" class="form-control old_pro_serial_id" id="old_pro_serial_id_{{$value->id}}" data-id = "{{$value->id}}" disabled name="old_pro_serial_id[]">
                                            <option value="">Select</option>                               
                                            @foreach($stockchild as $admin)
                                            <option value="{{$admin->serial_no}}" @if($admin->id == $value->return_serial_id) selected @endif>{{$admin->serial_no}}</option>
                                            @endforeach
                                        </select> -->
                                    </td>
                                    <td>
                                        <input style="width:150px !important" type="text" class="form-control old_pro_price"  id="old_pro_price_{{$value->id}}" name="old_pro_price[]" placeholder="Price" data-id = "{{$value->id}}" value="{{$value->price}}" readonly>
                                    </td>
                                    <td>
                                        <input type="date" class="form-control old_pro_dop" value="{{$value->date_of_sale}}" id="old_pro_dop_{{$value->id}}" name="old_pro_dop[]" data-id = "{{$value->id}}" readonly>
                                    </td>
                                    <td>

                                        <select style="width:200px !important" class="form-control old_pro_new_serial_id" id="old_pro_new_serial_id_{{$value->id}}" data-id = "{{$value->id}}" name="old_pro_new_serial_id[]" disabled>
                                            <option value="">Select</option>
                                            @foreach($stockchild as $admin)
                                            <option value="{{$admin->id}}" @if($admin->id == $value->serial_id) selected @endif>{{$admin->serial_no}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input style="width:150px !important" type="text" class="form-control old_pro_discount_id" id="old_pro_discount_id_{{$value->id}}" name="old_pro_discount_id[]" value="{{$value->discount}}" data-id = "{{$value->id}}" placeholder="Discount" readonly>
                                    </td>
                                    <td>
                                        <input style="width:150px !important" type="text" class="form-control old_pro_discount_amount" id="old_pro_discount_amount_{{$value->id}}" name="old_pro_discount_amount[]" value="{{$value->discount_amount}}" data-id = "{{$value->id}}" placeholder="Discount Amount" readonly>
                                    </td>
                                    <td>
                                        <input style="width:150px !important" type="text" class="form-control old_pro_amount" id="old_pro_amount_{{$value->id}}" name="old_pro_amount[]" value="{{$value->amount}}" data-id = "{{$value->id}}" placeholder="Amount" readonly>
                                    </td>
                                </tr>
                                @endforeach
                               
                            <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Total</td>
                            <td>
                                <input type="text" name="total" id="total" value="{{$data->total}}"  class="form-control total"  data-id = "0" readonly>
                            </td>

                        </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>


            
        </div>
    </div>
</div>
@stop
@push('scripts')
