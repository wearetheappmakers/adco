<div class="kt-portlet__foot">
	<div class="row">
		@if(Auth::user()->role == 1)
		<div class="form-group col-lg-2">
			<label>Role <span class="requied_field" style="color : red;">*</span></label>
			<select class="form-control select2" id="role" name="role" onchange="onchageDiv()" required>
				<option value="">Select Role</option>
				<option value="2" @if($data->role == 2) selected @endif>Branch</option>
				<option value="3" @if($data->role == 3) selected @endif>Employee</option>
			</select>
		</div>

		<div class="form-gro col-lg-2" id="branch_id" style="display:none !important;">
			<label>Branch </label><br>
			<select class="form-control select2" id="branch_id" name="branch_id" style="width:100%;">
				<option value="">Select Branch</option>
				@foreach($branch as $admin)
				<option value="{{$admin->id}}" @if($admin->id == $data->branch_id) selected @endif>{{$admin->name}}</option>
				@endforeach
			</select>
		</div>
		@endif
		
		<div class="form-group col-lg-2">
			<label>Name <span class="requied_field" style="color : red;">*</span></label>
			<input type="text" name="name" value="{{$data->name}}" placeholder="Enter Name" class="form-control" required>
		</div>

		<div class="form-group col-lg-2">
			<label>Number <span class="requied_field" style="color : red;">*</span></label>
			<input type="tel" name="number" value="{{$data->number}}" minlength="10" maxlength="10" placeholder="Enter Number" class="form-control" required>
		</div>

		<div class="form-group col-lg-2">
			<label>Email <span class="requied_field" style="color : red;">*</span></label>
			<input type="email" name="email" value="{{$data->email}}" autocomplete="off" placeholder="Enter Email Id" class="form-control" required>
		</div>

		<div class="form-group col-lg-2">
			<label>Password</label>
			<input type="text" class="form-control" required value="{{$data->showpasssword}}" readonly>
		</div>

		<div class="form-group col-lg-2">
			<label>New Password</label>
			<input type="text" name="password" placeholder="Enter New Password" class="form-control">
			<span>If you want to change password else keep it as blank.</span>

		</div>

	</div>
</div>

<script type="text/javascript">
	onchageDiv();
	function onchageDiv()
	{
		var value = $("#role").val();
		if (value == "3") {
			$("#branch_id").show();
		}
		else {
			$("#branch_id").hide();
		}
	}
</script>

