@extends('main')
@section('content')

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <br>
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">

                <h3 class="kt-portlet__head-title">
                    Leave View
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">                  
                        {{-- &nbsp; --}}
                        <form id="userimportform" enctype="multipart/form-data">
                            @csrf

                            <input type="file" style="display:none;" name="gst_excel" id="gstinputfile">

                        </form>


                        <a href="{{route('leave.index')}}" class="btn btn-brand btn-elevate btn-icon-sm">
                           
                            Back
                        </a>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="row">
               

                <div class="form-group col-sm-2">
                    @php $branch = App\User::where('role',2)->get(); @endphp
                    <label>Location</label>

                    <select name="branch_id" class="form-control" disabled onchange="getEmployee(this)">
                        <option value="">Select</option>
                        @foreach($branch as $br)
                        <option value="{{$br->id}}" @if($br->id == $data->branch_id) selected @endif>{{$br->name}}</option>
                        @endforeach
                    </select>
                </div>

                @php $employees = App\User::where('branch_id',$data->branch_id)->where('role',3)->get(); @endphp
                <div class="form-group col-sm-2" >
                    <label>User</label>
                    <select name="employee_id" class="form-control" id="employee_id" disabled>
                        <option value="">Select User</option>
                        @foreach($employees as $emp)
                        <option value="{{$emp->id}}" @if($emp->id == $data->employee_id) selected @endif>{{$emp->name}}</option>
                        @endforeach
                    </select>
                </div>

               

               

                <div class="form-group col-lg-2">
                    <label>Reason:</label>
                    <input type="text" class="form-control remark" placeholder="Enter Remark" value="{{$data->remark}}" id="remark" name="remark" readonly>
                </div>

                <div class="form-group col-sm-2">
                    @php $leavetype = App\LeaveType::get(); @endphp
                    <label>Leave Type</label>

                      

                    <select name="leave_types" class="form-control" disabled >

                        <option value="">Select</option>
                        @foreach($leavetype as $br)
                        <option value="{{$br->id}}" @if($br->id == $data->leave_types) selected @endif>{{$br->name}}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            @if(isset($leavechild))
            @foreach($leavechild as $key => $value)
            <div class="master_clone_div row">
                <div class="form-group col-lg-2">
                    <label>Date</label>
                    <input type="date" name="date[]" value="{{$value->date}}" class="form-control date" readonly>
                </div>
                <div class="form-group col-lg-2">
                    <label>Duration:</label>
                    <select name="duration[]" class="form-control duration" value="{{$value->duration}}" disabled>
                        <option value="">Select</option>
                        <option value="1" @if($value->duration == 1) selected @endif>Full day</option>
                        <option value="2" @if($value->duration == 2) selected @endif>First Half</option>
                        <option value="3" @if($value->duration == 3) selected @endif>Second Half</option>
                    </select>
                </div>
                <div class="form-group col-lg-2">
                    <label>Approved Duration:</label>
                    <select name="approved_duration[]" class="form-control approved_duration" value="{{$value->duration}}" disabled>
                        <option value="">Select</option>
                        <option value="Full day" @if($value->approved_duration === 'Full day') selected @endif>Full day</option>
                        <option value="First Half" @if($value->approved_duration === 'First Half') selected @endif>First Half</option>
                        <option value="Second Half" @if($value->approved_duration === 'Second Half') selected @endif>Second Half</option>
                    </select>
                </div>
              
            </div>
            @endforeach
            @endif


        </div>
    </div>
</div>  
@stop






