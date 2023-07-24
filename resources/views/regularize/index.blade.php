@extends('main')
@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}" />

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<br>
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label">
				
				<h3 class="kt-portlet__head-title">
					Regularization 
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
			<form action="#" method="POST">
				@csrf
			<div class="row">

				

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
							@if(!(Auth::user()->role == 3))
							<th>Employee</th>
							@endif
							<th>Date</th>
							<th>Attendance</th>
							<th>Type</th>
							<th>Reason</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
		@include('layouts.multiple_action', array(
			'table_name' => 'regularize',
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
					url:'{{ route('regularize.index') }}',
					data: function(d) {
						
						d.branch_id= $('#branch_id').val()
						
					}
				},

				columns: [
				{
					orderable: false,
					searchable: true,
					data: "id"
				},
				@if(Auth::user()->role == 1)
				{
					orderable: false,
					searchable: true,
					data: "branchs.name"
				},
				@endif
				@if(Auth::user()->role != 3)
				{
					orderable: false,
					searchable: true,
					data: "users.name"
				},
				@endif
				{
					orderable: false,
					searchable: true,
					data: "date"
				},
				{
					orderable: false,
					searchable: true,
					data: "attendance"
				},				
				{
					orderable: false,
					searchable: true,
					data: "type",
				},
				{
					orderable: false,
					searchable: true,
					data: "reason",
				},
				{
					orderable: false,
					searchable: true,
					data: "dropdown",
				},
				{
					orderable: false,
					searchable: true,
					data: "action",
				},
						
				]
			});

			$('.changes').change(function(){

				oTable.draw();

			});

		});


		function status($this,id)
		{
			var status = $($this).val();
			$.ajax({

				type: 'POST',

				url: '{{ route("regularize.status") }}',

				data: {
					'_token': '{{ csrf_token() }}',
					id: id,
					status: status,
				},

				dataType: 'json',

				success: function(data) {

					if (data.status == 'success') {
						toastr["success"]("Status Changed successfully", "Success");
						location.reload();
					} 
					else 
					{
						toastr["error"]("Something went wrong!", "Error");
						location.reload();
					}

				}

			});

		}


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