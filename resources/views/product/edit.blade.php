<div class="kt-portlet__foot">
	
	<h6><b>Main Details</b></h6><hr>
	<div class="row">
		<div class="form-group col-lg-2">
			<label>Category <span style="color : red;">*</span></label>
			<a style="background: white; height: 2px !important" target="_blank" href="{{route('category.create')}}" title="Add" class="btn btn-sm btn-clean btn-icon btn-icon-md">
				<i class="flaticon2-plus-1"></i>
			</a>
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
			<label>Alias</label>
			<input type="text" id="alias" name="alias" value="{{$data->alias}}" placeholder="Enter Alias" class="form-control">
		</div>
		<div class="form-group col-lg-2">
			<label>Model Code</label>
			<input type="text" id="model_code" name="model_code" value="{{$data->model_code}}" placeholder="Enter Name" class="form-control">
		</div>
		<div class="form-group col-lg-2">
			<label>GST <span style="color : red;">*</span></label>
			<a style="background: white; height: 2px !important" target="_blank" href="{{route('gst.create')}}" title="Add" class="btn btn-sm btn-clean btn-icon btn-icon-md">
				<i class="flaticon2-plus-1"></i>
			</a>
			<select class="form-control select2" id="gst_id" name="gst_id" required>
				<option value="">Select</option>
				@foreach($gst as $admin)
				<option value="{{$admin->id}}" @if($admin->id == $data->gst_id) selected @endif>{{$admin->name}}</option>
				@endforeach
			</select>
		</div>
		<div class="form-group col-lg-2">
			@php $group = App\Group::get(); @endphp
			<label>Group Name</label>
			<a style="background: white; height: 2px !important" target="_blank" href="{{route('group.create')}}" title="Add" class="btn btn-sm btn-clean btn-icon btn-icon-md">
				<i class="flaticon2-plus-1"></i>
			</a>
			<select class="form-control select2" id="group_name" name="group_name">
				<option value="">Select</option>
				@foreach($group as $datas)
				<option value="{{$datas->id}}" @if($datas->id == $data->group_name) selected @endif>{{$datas->name}}</option>
				@endforeach
			</select>
		</div>
	</div>

	<h6><b>Stock Options</b></h6><hr>
	<div class="row">
		<div class="form-group col-lg-2">
			<label>Stock Required</label>
			<select class="form-control" id="stock_required" name="stock_required">
				<option value="1" @if($data->stock_required == 1) selected @endif>Yes</option>
				<option value="2" @if($data->stock_required == 2) selected @endif>No</option>
			</select>
		</div>
		<div class="form-group col-lg-2">
			<label>Price List</label>
			<select class="form-control" id="price_list" name="price_list">
				<option value="1" @if($data->price_list == 1) selected @endif>Yes</option>
				<option value="2" @if($data->price_list == 2) selected @endif>No</option>
			</select>
		</div>
		<div class="form-group col-lg-2">
			<label>Locationwise Stock</label>
			<select class="form-control" id="locationwise_stock" name="locationwise_stock">
				<option value="1" @if($data->locationwise_stock == 1) selected @endif>Yes</option>
				<option value="2" @if($data->locationwise_stock == 2) selected @endif>No</option>
			</select>
		</div>
		<div class="form-group col-lg-2">
			<label>Serial No. Stock</label>
			<select class="form-control" id="serialno_stock" name="serialno_stock">
				<option value="1" @if($data->serialno_stock == 1) selected @endif>Yes</option>
				<option value="2" @if($data->serialno_stock == 2) selected @endif>No</option>
			</select>
		</div>
		<div class="form-group col-lg-2">
			<label>TCS</label>
			<select class="form-control" id="tcs" name="tcs">
				<option value="1" @if($data->tcs == 1) selected @endif>Yes</option>
				<option value="2" @if($data->tcs == 2) selected @endif>No</option>
			</select>
		</div>
	</div>

	<h6><b>Rate</b></h6><hr>
	<div class="row">
		<div class="form-group col-lg-2">
			<label>Purchase Rate</label>
			<input type="text" id="purchase_rate" name="purchase_rate" value="{{$data->purchase_rate}}" placeholder="Enter Purchase Rate" class="form-control">
		</div>
		<div class="form-group col-lg-2">
			<label>Sales Rate</label>
			<input type="text" id="sales_rate" name="sales_rate" value="{{$data->sales_rate}}" placeholder="Enter Sales Rate" class="form-control">
		</div>
		<div class="form-group col-lg-2">
			<label>Tax Paid Rate</label>
			<input type="text" id="tax_paid_rate" name="tax_paid_rate" value="{{$data->tax_paid_rate}}" placeholder="Tex Paid Rate" class="form-control">
		</div>
	</div>

	<h6><b>Unit Name</b></h6><hr>
	<div class="row">
		<div class="form-group col-lg-2">
			<label>Sale</label>
			<a style="background: white; height: 2px !important" target="_blank" href="{{route('unit.create')}}" title="Add" class="btn btn-sm btn-clean btn-icon btn-icon-md">
				<i class="flaticon2-plus-1"></i>
			</a>
			<select class="form-control select2" id="sale" name="sale">
				<option value="">Select</option>
				@foreach($unit as $admin)
				<option value="{{$admin->id}}" @if($admin->id == $data->sale) selected @endif>{{$admin->name}}</option>
				@endforeach
			</select>
		</div>
		<div class="form-group col-lg-2">
			<label>Purchase</label>
			<a style="background: white; height: 2px !important" target="_blank" href="{{route('unit.create')}}" title="Add" class="btn btn-sm btn-clean btn-icon btn-icon-md">
				<i class="flaticon2-plus-1"></i>
			</a>
			<select class="form-control select2" id="purchase" name="purchase">
				<option value="">Select</option>
				@foreach($unit as $admin)
				<option value="{{$admin->id}}" @if($admin->id == $data->purchase) selected @endif>{{$admin->name}}</option>
				@endforeach
			</select>
		</div>
		<div class="form-group col-lg-2">
			<label>GST Unit(UQC)</label>
			<a style="background: white; height: 2px !important" target="_blank" href="{{route('unit.create')}}" title="Add" class="btn btn-sm btn-clean btn-icon btn-icon-md">
				<i class="flaticon2-plus-1"></i>
			</a>
			<select class="form-control select2" id="gst_unit" name="gst_unit">
				<option value="">Select</option>
				@foreach($unit as $admin)
				<option value="{{$admin->id}}" @if($admin->id == $data->gst_unit) selected @endif>{{$admin->name}}</option>
				@endforeach
			</select>
		</div>
	</div>

	<h6><b>Opening Stock</b></h6><hr>
	<div class="row">
		<div class="form-group col-lg-2">
			<label>Quantity</label>
			<input type="number" id="quantity" name="quantity" value="{{$data->quantity}}" placeholder="Quantity" class="form-control">
		</div>
		<div class="form-group col-lg-2">
			<label>Amount</label>
			<input type="number" id="amount" name="amount" value="{{$data->amount}}" placeholder="Amount" class="form-control">
		</div>
	</div>
</div>