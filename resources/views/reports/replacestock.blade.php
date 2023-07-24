@extends('main')
@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}" />

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<br>
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label">
				
				<h3 class="kt-portlet__head-title">
					Replace Stock
				</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">					
						
					</div>
				</div>
			</div>
		</div>
		<div class="kt-portlet__body">
			<form action="{{ route('replacestock.export') }}" method="POST">
				@csrf
			<div class="row">

				<div class="form-group col-lg-2">
						<label>From Date</label>

						<input type="date" name="from_date" id="from_date" class="form-control changes">

					</div>
					<div class="form-group col-lg-2">

						<label>To Date</label>

						<input type="date" name="to_date" id="to_date" class="form-control changes">


					</div>

				@if(Auth::user()->role == 1)
				<div class="form-group col-lg-2">
					<label>Branch </label> 
					<select name="branch_id" class="form-control changes select2" id="branch_id">
						<option value="">Select Branch</option>
						@foreach($branch as $sub)
						<option value="{{$sub->id}}">{{$sub->name}}</option>
						@endforeach
					</select>
				</div>
				@endif

				<div class="form-group col-lg-2">
					<label>Category </label> 
					<select name="category_id" class="form-control changes select2 category_id" id="category_id" onchange="getproduct(this)">
						<option value="">Select</option>
						@foreach($category as $sub)
						<option value="{{$sub->id}}">{{$sub->name}}</option>
						@endforeach
					</select>
				</div>

				<div class="form-group col-lg-2">
					<label>Product </label> 
					<select name="product_id" class="form-control changes select2 product_id" id="product_id">
						<option value="">Select</option>
						
					</select>
				</div>
				<div class="col-sm-1">
					<br>
					<button type="submit" class="btn btn-brand btn-elevate btn-icon-sm">
						<i class="la la-download"></i>
						Export
					</button>
				</div>

			</div>
		</form>
			<div id="kt_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4">
				<table class="table table-striped table-bordered table-hover table-checkable datatable" id="datatable_rows">
					@csrf
					<thead>
						<tr>
							<th>#</th>
							@if(Auth::user()->role == 1)
							<th>Branch</th>
							@endif
							<th>Category</th>
							<th>Product</th>
							<th>Price</th>
							<th>Return Serial No.</th>
							<th>Replace Serial No.</th>							
						</tr>
					</thead>
				</table>
			</div>
		</div>
		@include('layouts.multiple_action', array(
			'table_name' => 'stock_child',
			'is_orderby'=>'',
			'folder_name'=>'',
			'action' => array('change-status-1' => _('Active'), 'change-status-0' => _('Inactive'))
			))
		</div>
	</div>	
	@stop
	@push('scripts')
	<script>

		$(document).ready(function() {


			var oTable = $('#datatable_rows').DataTable({


				processing: true,
				serverSide: true,
				searchable: true,
				scrollX: true,
				stateSave: true,
				columnDefs: [{
					orderable: false,
					targets: -1,
				}],



				ajax: {
					url:'{{ route('replacestock') }}',
					data: function(d) {
						d.from_date = $('#from_date').val()
						d.to_date = $('#to_date').val()
						d.branch_id= $('#branch_id').val()
						d.category_id= $('#category_id').val()
						d.product_id= $('#product_id').val()

					}
				},

				columns: [
				{
					orderable: true,
					searchable: true,
					data: "id"
				},
				@if(Auth::user()->role == 1)
				{
					orderable: true,
					searchable: true,
					data: "stocks.users.name"
				},
				@endif
				{
					orderable: true,
					searchable: true,
					data: "stocks.categorys.name"
				},
				{
					orderable: true,
					searchable: true,
					data: "stocks.products.name"
				},
				{
					orderable: true,
					searchable: true,
					data: "price",
				},
				{
					orderable: true,
					searchable: true,
					data: "serial_no",
				},
				{
					orderable: true,
					searchable: true,
					data: "replaced",
				},
				
				]
			});

			$('.changes').change(function(){

				oTable.draw();

			});

		});


		function getproduct($this){

			var category_id = $($this).val();
			var id = $($this).data('id');
			$.ajax({
				type:"POST",
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:"{{ route('returnstock.getproduct') }}",
				data: {
					'category_id': category_id
				},
				success: function(data){
					console.log(data.data);
					$('#product_id').html(data);

				}
			});

		};


	</script>
	@endpush