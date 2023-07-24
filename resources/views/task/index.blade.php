@extends('main')
@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}" />

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<br>
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label">
				
				<h3 class="kt-portlet__head-title">
					Task
				</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">					
						{{-- &nbsp; --}}
						<form id="userimportform" enctype="multipart/form-data">
							@csrf

							<a href="{{route('task.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
								<i class="la la-plus"></i>
								Add Task
							</a>
						</form>
						
					</div>
				</div>
			</div>
		</div>
		<div class="kt-portlet__body">

			<div class="row">
				<div class="form-group col-lg-2">
					<label>Assigned By</label> 
					<select name="assigned_by" class="form-control changes select2 assigned_by" id="assigned_by">
						<option value="">Select</option>
						@foreach($assignedby as $sub)
						<option value="{{$sub->id}}">{{$sub->name}}</option>
						@endforeach
					</select>
				</div>
				@if(Auth::user()->role == 1)
				<div class="form-group col-lg-2">
					<label>Assigned Location</label> 
					<select name="assigned_to_branch" class="form-control changes select2 assigned_to_branch" id="assigned_to_branch" onchange="getemployee(this)">
						<option value="">Select Branch</option>
						@foreach($location as $sub)
						<option value="{{$sub->id}}">{{$sub->name}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group col-lg-2">
					<label>Assigned Employee</label>
					<select class="form-control select2 changes" id="assigned_to_employee" name="assigned_to_employee">
						<option value="">Select</option>
					</select>
				</div>
				@endif
				
				@if(!(Auth::user()->role == 1))
				<div class="form-group col-lg-2">
					<label>Assigned Employee</label>
					<select class="form-control select2 changes" id="assigned_to_employee" name="assigned_to_employee">
						<option value="">Select</option>
						@foreach($employee as $datas)
						<option value="{{$datas->id}}">{{$datas->name}}</option>
						@endforeach
					</select>
				</div>
				@endif
			</div>

			<div id="kt_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4">
				<table class="table table-striped table-bordered table-hover table-checkable datatable" id="datatable_rows">
					@csrf
					<thead>
						<tr>
							<th>#</th>
							<th>Title</th>
							<th>Assigned By</th>
							@if(Auth::user()->role == 1)
							<th>Location</th>
							@endif
							<th>Assigned Employee</th>
							<th>Priority</th>
							<th>Start Date</th>
							<th>Due Date</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
		@include('layouts.multiple_action', array(
			'table_name' => 'task',
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
					url:'{{ route('task.index') }}',
					data: function(d) {
						d.assigned_by= $('#assigned_by').val()
						d.assigned_to_branch= $('#assigned_to_branch').val()
						d.assigned_to_employee = $('#assigned_to_employee').val()
					}
				},

				columns: [
				{
					orderable: false,
					searchable: true,
					data: "id"
				},
				{
					orderable: false,
					searchable: true,
					data: "title",
				},
				{
					orderable: false,
					searchable: true,
					data: "assignedby",
				},
				@if(Auth::user()->role == 1)
				{
					orderable: false,
					searchable: true,
					data: "location",
				},
				@endif
				{
					orderable: false,
					searchable: true,
					data: "employee",
				},
				{
					orderable: false,
					searchable: true,
					data: "priority",
				},
				{
					orderable: false,
					searchable: true,
					data: "start_date",
				},
				{
					orderable: false,
					searchable: true,
					data: "due_date",
				},
				{
					orderable: false,
					searchable: true,
					data: "dropdown",
				},
				{
					orderable: false,
					searchable: false,
					'data': 'action',
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

				url: '{{ route("task.status") }}',

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


		function getemployee($this){

			var assigned_to_branch = $($this).val();
			var id = $(this).data('id');
			$.ajax({
				type:"POST",
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:"{{ route('getemployee') }}",
				data: {
					'assigned_to_branch': assigned_to_branch
				},
				success: function(data){
					console.log(data.data);
					$('#assigned_to_employee').html(data.data);                            
				}
			});

		};

	</script>
	@endpush