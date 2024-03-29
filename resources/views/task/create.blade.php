<meta name="csrf-token" content="{{ csrf_token() }}" />

<div class="kt-portlet__foot">

	<div class="row">
		<div class="form-group col-lg-2">
			<label>Title <span style="color : red;">*</span></label>
			<input type="text" id="title" name="title" placeholder="Enter Title" class="form-control" required>
		</div>
		@if(Auth::user()->role == 1)
		<div class="form-group col-lg-2">
			<label>Assign To Location</label>
			<select class="form-control select2" id="assigned_to_branch" name="assigned_to_branch" onchange="getemployee(this)">
				<option value="">Select</option>
                @foreach($branch as $datas)
                <option value="{{$datas->id}}">{{$datas->name}}</option>
                @endforeach
            </select>
        </div>
		<div class="form-group col-lg-2">
			<label>Assign To Employee</label>
			<select class="form-control select2" id="assigned_to_employee" name="assigned_to_employee">
				<option value="">Select</option>
            </select>
        </div>
        @endif

		@if(!(Auth::user()->role == 1))
        <div class="form-group col-lg-2">
			<label>Assign To Employee</label>
			<select class="form-control select2" id="assigned_to_employee" name="assigned_to_employee">
				<option value="">Select</option>
				@foreach($employee as $datas)
                <option value="{{$datas->id}}">{{$datas->name}}</option>
                @endforeach
            </select>
        </div>
        @endif
		<div class="form-group col-lg-2">
			<label>Priority</label>
			<select  class="form-control" id="priority" style="width: 100%" name="priority" >
				<option value="">Select Priority</option>
				<option value="High">High</option>
				<option value="Medium">Medium</option>
				<option value="Low">Low</option>                
			</select>
		</div>
		<div class="form-group col-lg-2">
			<label>Start Date</label>
			<input type="date" id="start_date" name="start_date" class="form-control">
		</div>
		<div class="form-group col-lg-2">
			<label>Due Date</label>
			<input type="date" id="due_date" name="due_date" class="form-control">
		</div>
		{{-- <div class="form-group col-lg-2">
			<label>Time</label>
			<input type="time" id="time" name="time" class="form-control">
		</div> --}}
        <div class="form-group col-lg-2">
        	<label>Attachment</label>
        	<input type="file" name="attachment" id="attachment" class="form-control">
        </div>        
    </div>

    <div class="row">
    	<div class="form-group col-lg-6">
        	<div class="form-group">
        		<label>Description</label>
        		<textarea class="description form-control" name="description" id="description"></textarea>
        	</div>
        	<script type="text/javascript">
        		CKEDITOR.replace('description', {
        			filebrowserUploadMethod: 'form'
        		});
        	</script>
        </div>
    </div>
</div>


<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('.description').ckeditor();
	});
	$(".submit").click(function (event) {
		event.preventDefault();
		for ( instance in CKEDITOR.instances ) {
			CKEDITOR.instances.description.updateElement();
		}  
	})


	function getemployee($this){

        var assigned_to_branch = $($this).val();
        var id = $(this).data('id');
        $.ajax({
            type:"POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:"{{ route('getemployee') }}",
            data: {
                'assigned_to_branch': assigned_to_branch
            },
            success: function(data){
                console.log(data.data);
                $('#assigned_to_employee').html(data.data);                            
            }
        });

    };
</script>