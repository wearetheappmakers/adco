<div class="kt-portlet__body">
    <div class="row">
        @if(Auth::user()->role == 1)

        <div class="form-group col-sm-2">
            @php $branch = App\User::where('role',2)->get(); @endphp
            <label>Location</label>
            <a style="background: white; height: 2px !important" target="_blank" href="{{route('location.create')}}" title="Add" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                <i class="flaticon2-plus-1"></i>
            </a>

            <select name="branch_id" class="form-control" id="branch_id" required onchange="getEmployee(this)">

                <option value="">Select</option>
                @foreach($branch as $br)
                <option value="{{$br->id}}">{{$br->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-sm-2" >
            <label>User</label>
            <a style="background: white; height: 2px !important" target="_blank" href="{{route('user.create')}}" title="Add" class="btn btn-sm btn-clean btn-icon btn-icon-md" >
                <i class="flaticon2-plus-1"></i>
            </a>
            <select name="employee_id" class="form-control" id="employee_id" onchange="getReport()">
                <option value="">Select User</option>
            </select>
        </div>
        @endif

        @if (Auth::user()->role == 2)

        <div class="form-group col-lg-2">
            @php $employees = App\User::where('branch_id',Auth::user()->id)->where('role',3)->get(); @endphp
            <label>Select User</label> 
            <select name="employee_id" class="form-control" id="employee_id" onchange="getReport()">
                <option value="">Select User</option>
                @foreach($employees as $emp)
                <option value="{{$emp->id}}">{{$emp->name}}</option>
                @endforeach
            </select>
        </div>
        @endif

        @if (Auth::user()->role == 3)

        <div class="form-group col-lg-2">
            @php $employees = App\User::where('branch_id',Auth::user()->id)->where('role',3)->get(); @endphp
            <label>Select User</label> 
            <input type="hidden" name="employee_id" value="{{Auth::user()->id}}" id="employee_id">
           <input type="text" name="employee_id" id="employee_id" value="{{Auth::user()->name}}" class="form-control" readonly>
        </div>
        @endif

          <div class="form-group col-sm-2">
            @php $leavetype = App\LeaveType::get(); @endphp
            <label>Leave Type</label>
            <a style="background: white; height: 2px !important" target="_blank" href="{{route('leavetype.create')}}" title="Add" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                <i class="flaticon2-plus-1"></i>
            </a>

            <select name="leave_types" class="form-control" required >

                <option value="">Select</option>
                @foreach($leavetype as $br)
                <option value="{{$br->id}}">{{$br->name}}</option>
                @endforeach
            </select>
        </div>
        
        <div class="form-group col-lg-2">
            <label>Reason:</label>
            <input type="text" class="form-control remark" placeholder="Enter Remark" id="remark" name="remark" required>
        </div>

    </div>
         <div class="report_data col-lg-4">
               
        </div>
    <div class="master_clone_div row">
        <div class="form-group col-lg-2">
            <label>Date</label>
            <input type="date" name="date[]" class="form-control date" required>
        </div>
        <div class="form-group col-lg-2">
            <label>Duration:</label>
            <select name="duration[]" class="form-control duration" required>
                <option value="">Select</option>
                <option value="1">Full day</option>
                <option value="2">First Half</option>
                <option value="3">Second Half</option>
            </select>
        </div>
        <div class="form-group col-md-2" style="display: inline-flex;margin-top: 25px;">
            <button type="button" id="add_more" class="btn btn-sm btn-clean btn-icon btn-icon-md add_more">
                <span class="fa fa-plus"></span>
            </button>&nbsp;&nbsp;
            <button type="button" id="remove" class="btn btn-sm btn-clean btn-icon btn-icon-md remove" style="display: none;">
                <span class="fa fa-minus"></span>
            </button>
        </div>
    </div>
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
                  getReport();
            }
        });

    }

      getReport();
    function getReport()
    {
        var id = $('#employee_id').val();
        var branch_id = $('#branch_id').val();

        @if(Auth::user()->role == 2)
        branch_id = '{{Auth::user()->id}}';
        @endif

        $.ajax({

            type: "POST",
            url: '{{route('leave.getEmployee.report')}}',
            data: {
                'id': id,
                'branch_id': branch_id,
                '_token': '{{csrf_token()}}'
            },

            success: function (data)
            {
                console.log(data);
                $('.report_data').empty();
                $('.report_data').html(data);
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
