@extends('main')
@section('content')

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<br>
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label">
				
				<h3 class="kt-portlet__head-title">
					HSN
				</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">					
						{{-- &nbsp; --}}
						<form id="userimportform" enctype="multipart/form-data">
							@csrf

							<input type="file" style="display:none;" name="hsn_excel" id="hsninputfile">

						</form>
						<button type="submit" class="btn btn-brand btn-elevate btn-icon-sm hsnimport">
							<i class="la la-upload"></i>
							Import
						</button>

						<a href="{{route('hsn_export')}}" class="btn btn-brand btn-elevate btn-icon-sm">
							<i class="la la-download"></i>
							Export
						</a>


						<a href="{{route('hsn.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
							<i class="la la-plus"></i>
							Add HSN
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
							<th>GST</th>
							<th>Name</th>
							<th>Action</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
		@include('layouts.multiple_action', array(
			'table_name' => 'hsn',
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

				ajax: "{{ route('hsn.index') }}",

				columns: [
				{
					orderable: true,
					searchable: true,
					data: "id"
				},
				{
					orderable: true,
					searchable: true,
					data: "gsts.name"
				},
				{
					orderable: true,
					searchable: true,
					data: "name",
				},
				{
					orderable: false,
					searchable: false,
					'data': 'action',
				},
				]
			});

		});




		$('.hsnimport').on('click', function() {
				$('#hsninputfile').trigger('click');
			});
		$('#hsninputfile').change(function(e) {
				$('.hsn_upload').prop('disabled', true);
				$('.hsn_upload').find('.la-spin').removeClass('d-none');
			if($("#userimportform").valid()){
				$.ajax({
					type:"POST",
					url:"{{ route('hsn_import') }}",
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

	</script>
	@endpush