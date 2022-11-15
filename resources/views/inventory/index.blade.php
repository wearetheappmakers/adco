@extends('main')
@section('content')

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<br>
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label">
				
				<h3 class="kt-portlet__head-title">
					Inventory
				</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">					
						{{-- &nbsp; --}}
						<form id="userimportform" enctype="multipart/form-data">
							@csrf
						</form>
						
					</div>
				</div>
			</div>
		</div>
		<div class="kt-portlet__body">
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
							<th>Serial No.</th>
							<th>Used</th>
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


			$('#datatable_rows').DataTable({

				processing: true,
				serverSide: true,
				searchable: true,
				scrollX: true,
				stateSave: true,
				columnDefs: [{
					orderable: false,
					targets: -1,
				}],

				ajax: "{{ route('inventory') }}",

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
					data: "used",
				},
				]
			});

		});

	</script>
	@endpush