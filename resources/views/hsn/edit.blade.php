<div class="kt-portlet__foot">
	<div class="row">
		<div class="form-group col-lg-3">
			<label>GST</label>
			<a style="background: white; height: 2px !important" target="_blank" href="{{route('gst.create')}}" title="Add" class="btn btn-sm btn-clean btn-icon btn-icon-md">
				<i class="flaticon2-plus-1"></i>
			</a>
			<select class="form-control" id="gst_id" name="gst_id" required>
				<option value="">Select</option>
				@foreach($gst as $admin)
				<option value="{{$admin->id}}" @if($admin->id == $data->gst_id) selected @endif>{{$admin->name}}</option>
				@endforeach
			</select>
		</div>

		<div class="form-group col-lg-3">
			<label>HSN Code <span style="color : red;">*</span></label>
			<input type="text" id="name" name="name" placeholder="Enter HSN Code" value="{{$data->name}}" class="form-control" required>
		</div>
		<div class="form-group col-lg-3">
			<label>Name Of Print</label>
			<input type="text" id="name_of_print" value="{{$data->name_of_print}}" name="name_of_print" placeholder="Enter Name of Print" class="form-control" >
		</div>
		<div class="form-group col-lg-3">
			<label>Fix Rate</label>
			
			<select class="form-control" name="fix_rate" id="fix_rate" >
				
				<option value="1" @if($data->fix_rate == 1) selected @endif>Yes</option>
				<option value="2"  @if($data->fix_rate == 2) selected @endif>No</option>
				
				
				
			</select>
		
		</div>
		<div class="form-group col-lg-3">
			<label>RCP</label>
			<input type="number" id="rcp" name="rcp" value="{{$data->rcp}}" placeholder="Enter RCP" class="form-control" >
		</div>
		<div class="form-group col-lg-3">
			<label>FSP</label>
			<input type="number" id="fsp" name="fsp" value="{{$data->fsp}}" placeholder="Enter FSP" class="form-control" >
		</div>
		<div class="form-group col-lg-3">
			<label>Rack No</label>
			<input type="number" id="rack_no" name="rack_no" value="{{$data->rack_no}}" placeholder="Enter Rack No" class="form-control" >
		</div>
		<div class="form-group col-lg-3">
			<label>MRP</label>
			<input type="number" id="mrp" name="mrp" value="{{$data->mrp}}" placeholder="Enter MRP" class="form-control" >
		</div>
	</div>
</div>