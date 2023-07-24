<div class="kt-portlet__foot">
	<div class="row">
		
		<div class="form-group col-lg-2">
			<label>Name <span class="requied_field" style="color : red;">*</span></label>
			<input type="text" name="name" placeholder="Enter Name" class="form-control" required>
		</div>

		<div class="form-group col-lg-2">
			<label>Number <span class="requied_field" style="color : red;">*</span></label>
			<input type="tel" name="number" minlength="10" maxlength="10" placeholder="Enter Number" class="form-control" required>
		</div>


		<div class="form-group col-lg-2">
			<label>Email <span class="requied_field" style="color : red;">*</span></label>
			<input type="email" name="email" autocomplete="off" placeholder="Enter Email Id" class="form-control" required>
		</div>

		<div class="form-group col-lg-2">
			<label>Password <span class="requied_field" style="color : red;">*</span></label>
			<input type="password" name="password" autocomplete="off" placeholder="Enter Password" class="form-control" required>
		</div>
	</div>
	
</div>

<script type="text/javascript">

	$(function () {
			$("#role").change(function () {
				if ($(this).val() == "3") {
					$("#branch_id").show();

				} else {
					$("#branch_id").hide();
				}
			});
		});

</script>

