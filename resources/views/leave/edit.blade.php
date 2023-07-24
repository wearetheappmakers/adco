<div class="kt-portlet__body">
    <div class="row">
        @if(Auth::user()->role == 1)

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
            <select name="employee_id" class="form-control" disabled id="employee_id">
                <option value="">Select User</option>
                 @foreach($employees as $emp)
                <option value="{{$emp->id}}" @if($emp->id == $data->employee_id) selected @endif>{{$emp->name}}</option>
                @endforeach
            </select>
        </div>

        @elseif (Auth::user()->role == 2)

        <div class="form-group col-lg-2">
            @php $employees = App\User::where('branch_id',Auth::user()->id)->where('role',3)->get(); @endphp
            <label>Select User</label>
            <select name="employee_id" class="form-control" disabled id="employee_id">
                <option value="">Select User</option>
                @foreach($employees as $emp)
                <option value="{{$emp->id}}" @if($emp->id == $data->employee_id) selected @endif>{{$emp->name}}</option>
                @endforeach
            </select>
        </div>
        @endif
        
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
            <input type="hidden" name="child_id[]" value="{{$value->id}}">
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
            <select name="approved_duration[]" class="form-control approved_duration" value="{{$value->duration}}">
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





<script type="text/javascript">

    function getEmployee($this)
    {
        var branch_id = $($this).val();

        $.ajax({

            type: "POST",
            url: '{{route('leave.getemployee')}}',
            data: {
                'branch_id': branch_id,
                '_token': '{{csrf_token()}}'
            },

            success: function (data)
            {
                $('#employee_id').html('');
                $('#employee_id').html(data);
            }
        });

    }
    $(document).ready(function(){
        $(document).on('click','.add_more',function() {
            var $row = $(this).closest('.master_clone_div');
            var $clone = $row.clone();
            $clone.find('.date').val('');
            $clone.find('.duration').val('');
            $clone.find('#remove').css('display','block');
            $row.after($clone);
        });

        $(document).on('click','.remove',function(){
            var num_of_master_clone_div = $('.master_clone_div').length;
            if (num_of_master_clone_div != 1) {
                var obj = $(this).closest('.master_clone_div');
                obj.remove();
            }
        });
    });
</script>
