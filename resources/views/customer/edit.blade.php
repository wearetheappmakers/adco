<div class="kt-portlet__foot">
	<div class="row">

		@if(Auth::user()->role == 1)
		<div class="form-group col-lg-2">
			<label>Branch <span style="color : red;">*</span></label>
			<select class="form-control select2" id="branch_id" name="branch_id" required>
				<option value="">Select</option>
				@foreach($branch as $admin)
				<option value="{{$admin->id}}" @if($admin->id == $data->branch_id) selected @endif>{{$admin->name}}</option>
				@endforeach
			</select>
		</div>
		@endif

		<div class="form-group col-lg-2">
			<label>Name <span style="color : red;">*</span></label>
			<input type="text" id="name" name="name" value="{{$data->name}}" placeholder="Enter Name" class="form-control" required>
		</div>

		<div class="form-group col-lg-2">
			<label>Number <span style="color : red;">*</span></label>
			<input type="number" id="number" name="number" value="{{$data->number}}" placeholder="Enter Number" class="form-control" required>
		</div>

		<div class="form-group col-lg-2">
			<label>Email </label>
			<input type="email" id="email" name="email" value="{{$data->email}}" placeholder="Enter Email" class="form-control">
		</div>

		<div class="form-group col-lg-3">
			<label>Address</label>
			<textarea id="address" name="address" placeholder="Enter Address" class="form-control" rows="3" cols="50">{{$data->address}}</textarea>
		</div>

	</div>
</div>