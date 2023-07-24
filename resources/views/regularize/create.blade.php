<div class="kt-portlet__foot">

	<div class="row">
		<input type="hidden" name="attendance_id" value="{{$data->id}}">

		@if(Auth::user()->role == 1)
		<div class="form-group col-lg-2">
			<label>Branch</label>
			<select class="form-control select2" disabled>
				<option value="">Select</option>
				@foreach($user as $admin)
				<option value="{{$admin->id}}" @if($admin->id == $data->branch_id) selected @endif>{{$admin->name}}</option>
				@endforeach
			</select>
		</div>
		@endif

		@if(Auth::user()->role != 3)
		<div class="form-group col-lg-2">
			<label>User</label>
			<select class="form-control select2" disabled>
				<option value="">Select</option>
				@foreach($user as $admin)
				<option value="{{$admin->id}}" @if($admin->id == $data->employee_id) selected @endif>{{$admin->name}}</option>
				@endforeach
			</select>
		</div>
		@endif

		<div class="form-group col-lg-2">
			<label>Date</label>		
			<input type="date" class="form-control" value="{{$data->date}}" readonly>
		</div>
		<div class="form-group col-lg-2">
			<label>Time</label>
			<input type="time" class="form-control" value="{{$data->time}}" readonly>
		</div>
		<div class="form-group col-lg-2">
			<label>Attandance</label>
			<input type="text" class="form-control" value="{{$data->attendance}}" readonly>
		</div>

		<div class="form-group col-lg-2">
			<label>Type</label>
			<select class="form-control" id="type" name="type">
				<option value="Present">Present</option>
				<option value="Week Off">Week Off</option>
				<option value="Leave">Leave</option>
				<option value="Half Day">Half Day</option>
			</select>
		</div>
		<div class="form-group col-lg-2">
			<label>Reason</label>
			<input type="text" name="reason" class="form-control" placeholder="Reason">
		</div>					
	</div>
</div>