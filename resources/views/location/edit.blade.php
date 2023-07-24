<div class="kt-portlet__foot">
	<div class="row">
		
		
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

