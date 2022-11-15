@extends('main')
@section('content')

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<br>
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label">
				
				<h3 class="kt-portlet__head-title">
					Sales Order
				</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">					
						
						<a href="{{route('salesorder.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
							<i class="la la-plus"></i>
							Add SO
						</a>
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
						<th width="5%">#</th>
						<th>Branch</th>
						<th>Customer</th>
						<th>Remarks</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
	@include('layouts.multiple_action', array(
		'table_name' => 'so',
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

			ajax: "{{ route('salesorder.index') }}",

			columns: [
			{
				orderable: true,
				searchable: true,
				data: "id"
			},
			{
				orderable: true,
				searchable: true,
				data: "users.name",
			},
			{
				orderable: true,
				searchable: true,
				data: "customers.name",
			},
			{
				orderable: true,
				searchable: true,
				data: "remarks",
			},
			{
				orderable: true,
				searchable: true,
				data: "status",
			},
			{
				orderable: false,
				searchable: false,
				'data': 'action',
			},
			]
		});

	});



	function status($this,id)
	{
		var status = $($this).val();
		$.ajax({

			type: 'POST',
			url: '{{ route("salesorder.status") }}',
			data: {
				'_token': '{{ csrf_token() }}',
				id: id,
				status: status,
			},
			dataType: 'json',

			success: function(data) {
				if (data.status == 'success') {
					toastr["success"]("Status Changed Successfully", "Success");
					location.reload();
				} 
				else if (data.status == 'duplicate_serial') {
					toastr["warning"]("Duplicate Serial", "Warning");
					location.reload();
				} 

				else 
				{
					toastr["error"]("Something Went Wrong!", "Error");
					location.reload();
				}
			}
		});
	}

</script>
@endpush