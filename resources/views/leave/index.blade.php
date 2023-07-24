@extends('main')
@section('content')

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<br>
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label">
				
				<h3 class="kt-portlet__head-title">
					Leave
				</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">					
						{{-- &nbsp; --}}
						<form id="userimportform" enctype="multipart/form-data">
							@csrf

							<input type="file" style="display:none;" name="gst_excel" id="gstinputfile">

						</form>
					

							<a href="{{route('leave.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
								<i class="la la-plus"></i>
								Add Leave
							</a>
						
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
							<th>Location</th>
							<th>User</th>
							@endif
							@if(Auth::user()->role == 2)
							<th>User</th>
							@endif
							<th>status</th>
							<th>Action</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
		@include('layouts.multiple_action', array(
			'table_name' => 'leave',
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

				ajax: "{{ route('leave.index') }}",

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
					data: "branch.name",
				},
				{
					orderable: true,
					searchable: true,
					data: "employees.name",
				},
				@endif
				@if(Auth::user()->role == 2)
				{
					orderable: true,
					searchable: true,
					data: "employees.name",
				},
				@endif
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


		$('.gstimport').on('click', function() {
				$('#gstinputfile').trigger('click');
			});
		$('#gstinputfile').change(function(e) {
				$('.gst_upload').prop('disabled', true);
				$('.gst_upload').find('.la-spin').removeClass('d-none');
			if($("#userimportform").valid()){
				$.ajax({
					type:"POST",
					url:"{{ route('gst_import') }}",
					data: new FormData($('#userimportform')[0]),
					processData: false,
					contentType:false,

					success: function(data){
						if(data.status==='success'){
							alert('success')
							window.location.reload();
						}else if(data.status==='error'){
							// toastr["error"]("Unsuccessfull", "Error");
							location.reload();
						}
					}
				});
			}else{
				e.preventDefault();
			}
		});


	function status($this,id)
	{
		var status = $($this).val();
		if(status == 2)
		{
			var url = '{{route('leave.edit',":id")}}';
			url = url.replace(':id', id);
			window.location.href = url;
		}
		else
		{
	
		$.ajax({

			type: 'POST',
			url: '{{ route("leave.status") }}',
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
}


	</script>
	@endpush