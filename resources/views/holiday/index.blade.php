@extends('main')
@section('content')

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<br>
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label">
				
				<h3 class="kt-portlet__head-title">
					Holiday
				</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">					
						{{-- &nbsp; --}}
						<form id="userimportform" enctype="multipart/form-data">
							@csrf
						<a href="{{route('weekoff.index')}}" class="btn btn-brand btn-elevate btn-icon-sm">
							<i class="flaticon-event-calendar-symbol"></i>
							Weekoff
						</a>
						
                        @if(Auth::user()->role == 1)
						<a href="{{route('holiday.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
							<i class="la la-plus"></i>
							Add Holiday
						</a>
						@endif

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
							<th>Name</th>
							<th>Date</th>
                        	@if(Auth::user()->role == 1)
							<th>Action</th>
							@endif
						</tr>
					</thead>
				</table>
			</div>
		</div>
		@include('layouts.multiple_action', array(
			'table_name' => 'holiday',
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

				ajax: "{{ route('holiday.index') }}",

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
					data: "date",
				},
                @if(Auth::user()->role == 1)
				{
					orderable: false,
					searchable: false,
					'data': 'action',
				},
				@endif
				]
			});

		});

	</script>
	@endpush