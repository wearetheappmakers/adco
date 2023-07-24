<div class="kt-portlet__foot">
	<div class="row">
		{{-- <div class="form-group col-lg-2">
			<label>Year <span style="color : red;">*</span></label>
			<input type="text"  name="month_year" id="month_year" class="form-control" placeholder="Select Year">
		</div> --}}
		<div class="form-group col-lg-2">
			<label>Name<span style="color : red;">*</span></label>
			<input type="text"  name="name" id="name" class="form-control" placeholder="Enter Name" required>
		</div>
		<div class="form-group col-lg-1">
			<label>Monday</label>
			<div class="kt-checkbox-inline">
				<label class="kt-checkbox">
					<input type="checkbox" class="mon" id="mon" name="mon" value="Monday">
					<span></span>
				</label><br><br>
				<div id="mon_type" style="display: none !important;">
					<label>Type</label> 
					<select name="mon_type" class="form-control" id="mon_type">
						<option value="0">Select</option>
						<option value="1">Full Day</option>
						<option value="2">First Half</option>
						<option value="3">Secound Half</option>					
					</select>
				</div>
			</div>
		</div>
		<div class="form-group col-lg-1">
			<label>Tuesday</label>
			<div class="kt-checkbox-inline">
				<label class="kt-checkbox">
					<input type="checkbox" class="tue" id="tue" name="tue" value="Tuesday">
					<span></span>
				</label><br><br>
				<div id="tue_type" style="display: none !important;">
					<label>Type</label> 
					<select name="tue_type" class="form-control changes" id="tue_type">
						<option value="0">Select</option>
						<option value="1">Full Day</option>
						<option value="2">First Half</option>
						<option value="3">Secound Half</option>					
					</select>
				</div>
			</div>
		</div>
		<div class="form-group col-lg-1">
			<label>Wednesday</label>
			<div class="kt-checkbox-inline">
				<label class="kt-checkbox">
					<input type="checkbox" class="wed" id="wed" name="wed" value="Wednesday">
					<span></span>
				</label><br><br>
				<div id="wed_type" style="display: none !important;">
					<label>Type</label> 
					<select name="wed_type" class="form-control changes" id="wed_type">
						<option value="0">Select</option>
						<option value="1">Full Day</option>
						<option value="2">First Half</option>
						<option value="3">Secound Half</option>					
					</select>
				</div>
			</div>
		</div>
		<div class="form-group col-lg-1">
			<label>Thursday</label>
			<div class="kt-checkbox-inline">
				<label class="kt-checkbox">
					<input type="checkbox" class="thu" id="thu" name="thu" value="Thursday">
					<span></span>
				</label><br><br>
				<div id="thu_type" style="display: none !important;">
					<label>Type</label> 
					<select name="thu_type" class="form-control changes" id="thu_type">
						<option value="0">Select</option>
						<option value="1">Full Day</option>
						<option value="2">First Half</option>
						<option value="3">Secound Half</option>					
					</select>
				</div>
			</div>
		</div>
		<div class="form-group col-lg-1">
			<label>Friday</label>
			<div class="kt-checkbox-inline">
				<label class="kt-checkbox">
					<input type="checkbox" class="fri" id="fri" name="fri" value="Friday">
					<span></span>
				</label><br><br>
				<div id="fri_type" style="display: none !important;">
					<label>Type</label> 
					<select name="fri_type" class="form-control changes" id="fri_type">
						<option value="0">Select</option>
						<option value="1">Full Day</option>
						<option value="2">First Half</option>
						<option value="3">Secound Half</option>					
					</select>
				</div>
			</div>
		</div>
		<div class="form-group col-lg-1">
			<label>Saturday</label>
			<div class="kt-checkbox-inline">
				<label class="kt-checkbox">
					<input type="checkbox" class="sat" id="sat" name="sat" value="Saturday">
					<span></span>
				</label><br><br>
				<div id="sat_type" style="display: none !important;">
					<label>Type</label> 
					<select name="sat_type" class="form-control changes" id="sat_type">
						<option value="0">Select</option>
						<option value="1">Full Day</option>
						<option value="2">First Half</option>
						<option value="3">Secound Half</option>					
					</select>
				</div>
			</div>
		</div>
		<div class="form-group col-lg-1">
			<label>Sunday</label>
			<div class="kt-checkbox-inline">
				<label class="kt-checkbox">
					<input type="checkbox" class="sun" id="sun" name="sun" value="Sunday">
					<span></span>
				</label><br><br>
				<div id="sun_type" style="display: none !important;">
					<label>Type</label> 
					<select name="sun_type" class="form-control changes" id="sun_type">
						<option value="0">Select</option>
						<option value="1">Full Day</option>
						<option value="2">First Half</option>
						<option value="3">Secound Half</option>					
					</select>
				</div>
			</div>
		</div>
	</div>
</div>

{{-- <script type="text/javascript">
	$('#month_year').datepicker({

		minViewMode: 'years',
		autoclose: true,
		format: 'yyyy'
	});
</script> --}}

<script type="text/javascript">
	setInterval(getdatas, 1000);
	function getdatas()
	{
		$('.mon').each(function(){
			var data = $(this).val();
			if(data === "Monday"){
				$("#mon_type").toggle(this.checked);
			}
		});
		$('.tue').each(function(){
			var data = $(this).val();
			if(data === "Tuesday"){
				$("#tue_type").toggle(this.checked);
			}
		});
		$('.wed').each(function(){
			var data = $(this).val();
			if(data === "Wednesday"){
				$("#wed_type").toggle(this.checked);
			}
		});
		$('.thu').each(function(){
			var data = $(this).val();
			if(data === "Thursday"){
				$("#thu_type").toggle(this.checked);
			}
		});
		$('.fri').each(function(){
			var data = $(this).val();
			if(data === "Friday"){
				$("#fri_type").toggle(this.checked);
			}
		});
		$('.sat').each(function(){
			var data = $(this).val();
			if(data === "Saturday"){
				$("#sat_type").toggle(this.checked);
			}
		});
		$('.sun').each(function(){
			var data = $(this).val();
			if(data === "Sunday"){
				$("#sun_type").toggle(this.checked);
			}
		});
	}
</script>
