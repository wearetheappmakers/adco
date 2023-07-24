<div class="kt-portlet__body">
    <div class="row">
        @if(Auth::user()->role == 1)

        <div class="form-group col-sm-2">
            @php $branch = App\User::where('role',2)->get(); @endphp
            <label>Location</label>
            <a style="background: white; height: 2px !important" target="_blank" href="{{route('location.create')}}" title="Add" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                <i class="flaticon2-plus-1"></i>
            </a>

            <select name="branch_id" class="form-control" required onchange="getEmployee(this)">

                <option value="">Select</option>
                @foreach($branch as $br)
                <option value="{{$br->id}}" @if($br->id == $data->branch_id) selected @endif>{{$br->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-sm-2" >
            @php $employees = App\User::where('branch_id',$data->branch_id)->where('role',3)->get(); @endphp
            <label>User</label>
            <a style="background: white; height: 2px !important" target="_blank" href="{{route('user.create')}}" title="Add" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                <i class="flaticon2-plus-1"></i>
            </a>
            <select name="employee_id" class="form-control" id="employee_id">
                <option value="">Select User</option>
                @foreach($employees as $emp)
                <option value="{{$emp->id}}" @if($emp->id == $data->employee_id) selected @endif>{{$emp->name}}</option>
                @endforeach
            </select>
        </div>
        @endif

        @if (Auth::user()->role == 2)

        <div class="form-group col-lg-2">
            @php $employees = App\User::where('branch_id',Auth::user()->id)->where('role',3)->get(); @endphp
            <label>Select User</label> 
            <select name="employee_id" class="form-control" id="employee_id">
                <option value="">Select User</option>
                @foreach($employees as $emp)
                <option value="{{$emp->id}}" @if($emp->id == $data->employee_id) selected @endif>{{$emp->name}}</option>
                @endforeach
            </select>
        </div>
        @endif

         
        
        <div class="form-group col-lg-2">
            <label>Name:</label>
            <input type="text" class="form-control name" value="{{$data->name}}" placeholder="Enter Name" id="name" name="name" required>
        </div>
         <div class="form-group col-lg-2">
            <label>Number:</label>
            <input type="number" class="form-control number" value="{{$data->number}}" placeholder="Enter Number" id="number" name="number">
        </div>
         <div class="form-group col-lg-2">
            <label>Email:</label>
            <input type="text" class="form-control email" value="{{$data->email}}" placeholder="Enter Email" id="email" name="email">
        </div>
        <div class="form-group col-lg-2">
            <label>Email:</label>
          <input type="file" name="image" id="image" value="{{ $data->image }}"  class="form-control">
               @if($data->image)
               <img src="{{ asset('/lead/'.$data->image) }}" height="70px" width="70px">

               @endif
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
            }
        });

    }
  
</script>
