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
            <div class="kt-portlet__body">
                <div id="kt_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">

                        @if(Auth::user()->role == 1)
                        <div class="form-group col-lg-2">
                            <label>Branch</label>
                            <select class="form-control select2" id="branch_id" name="branch_id" onchange="getcustomer(this)" disabled>

                                <option value="">Select Branch</option>
                                @foreach($branch as $admin)
                                <option value="{{$admin->id}}" @if($admin->id == $data->branch_id) selected @endif>{{$admin->name}}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="form-group col-lg-2">
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
                            <label>Customer</label>
                            <select class="form-control select2" id="customers_id" name="customer_id" disabled>
                                <option value="">Select Customer</option>
                                @foreach($customer as $admin)
                                <option value="{{$admin->id}}" @if($admin->id == $data->customer_id) selected @endif>{{$admin->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-2">
                            <label>Remarks</label>
                            <input type="text" id="remarks" name="remarks" value="{{$data->remarks}}" placeholder="Enter Remarks" class="form-control" readonly>
                        </div>

                    </div>

                    <div class="row">
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
                                            <input type="hidden" name="hidden_id[]" value="{{$value->id}}" class="form-control ">
                                            <select class="form-control old_category_id" id="old_category_id_0" name="old_category_id[]" onchange="getproduct(this)" data-id = "{{$value->id}}" disabled>
                                                <option value="">Select</option>
                                                @foreach($category as $admin)
                                                <option value="{{$admin->id}}" @if($admin->id == $value->category_id) selected @endif>{{$admin->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control old_product_id" id="old_product_id_0" name="old_product_id[]" onchange="getserial(this)" data-id = "{{$value->id}}" disabled>
                                                <option value="">Select</option>
                                                @foreach($product as $admin)
                                                <option value="{{$admin->id}}" @if($admin->id == $value->product_id) selected @endif>{{$admin->name}}</option>
                                                @endforeach                            
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control old_serial_id" id="old_serial_id_0" name="old_serial_id[]" onchange="getprice(this)" data-id = "{{$value->id}}" disabled>
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
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
            
        </div>
    </div>
</div>
@stop
@push('scripts')