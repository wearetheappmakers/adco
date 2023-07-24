@extends('main')
@section('content')

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<br>
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label">
				
				<h3 class="kt-portlet__head-title">
					Leave Policy
				</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">					
						
						
					

							<a href="{{route('leavepolicy.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
								<i class="la la-plus"></i>
								Add Leave Policy
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
							<th>Name</th>
							<th>No Of Days</th>
							
							<th>Action</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
		@include('layouts.multiple_action', array(
			'table_name' => 'leave_policy',
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

				ajax: "{{ route('leavepolicy.index') }}",

				columns: [
				{
					orderable: true,
					searchable: true,
					data: "id"
				},
				
				
				{
					orderable: true,
					searchable: true,
					data: "name",
				},

				{
					orderable: true,
					searchable: true,
					data: "no_of_days",
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