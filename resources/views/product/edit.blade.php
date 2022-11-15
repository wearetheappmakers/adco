<div class="kt-portlet__foot">
	<div class="row">

		<div class="form-group col-lg-2">
			<label>Category <span style="color : red;">*</span></label>
			<select class="form-control select2" id="category_id" name="category_id" required>

				<option value="">Select</option>

				@foreach($category as $admin)
				<option value="{{$admin->id}}" @if($admin->id == $data->category_id) selected @endif>{{$admin->name}}</option>
				@endforeach

			</select>
		</div>

		<div class="form-group col-lg-2">
			<label>Name <span style="color : red;">*</span></label>
			<input type="text" id="name" name="name" value="{{$data->name}}" placeholder="Enter Name" class="form-control" required>
		</div>

		<div class="form-group col-lg-2">
			<label>Model Code <span style="color : red;">*</span></label>
			<input type="text" id="model_code" name="model_code" value="{{$data->model_code}}" placeholder="Enter Name" class="form-control">
		</div>
	</div>
</div>