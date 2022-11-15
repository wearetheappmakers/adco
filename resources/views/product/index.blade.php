@extends('main')
@section('content')

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<br>
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label">
				
				<h3 class="kt-portlet__head-title">
					Product
				</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">					
						{{-- &nbsp; --}}
						<form id="productimportform" enctype="multipart/form-data">
							@csrf
							<input type="file" style="display:none;" name="product_excel" id="productinputfile">
						</form>

						<button class="btn btn-brand btn-elevate btn-icon-sm productimportbtn">
							<i class="la la-upload"></i>
							Import
							<i class="la la-spinner la-spin d-none"></i>
						</button>

						<a href="{{route('product.export')}}" class="btn btn-brand btn-elevate btn-icon-sm">
							<i class="la la-download"></i>
							Sample
						</a>

						<a href="{{route('product.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
							<i class="la la-plus"></i>
							Add Product
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
							<th width="5%">#</th>
							<th>Name</th>
							<th>Action</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
		@include('layouts.multiple_action', array(
			'table_name' => 'products',
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


			$('.productimportbtn').on('click', function() {
				$('#productinputfile').trigger('click');
			});
			$('#productinputfile').change(function(e) {
				$('.product_upload').prop('disabled', true);
				$('.product_upload').find('.la-spin').removeClass('d-none');
				e.preventDefault();
				$.ajax({
					type:"POST",
					url:"{{ route('product.import') }}",
					data: new FormData($('#productimportform')[0]),
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
				return false;
			});


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

				ajax: "{{ route('product.index') }}",

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
					orderable: false,
					searchable: false,
					'data': 'action',
				},
				]
			});

		});

	</script>
	@endpush