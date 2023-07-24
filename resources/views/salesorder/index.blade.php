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
							Add Sales Order
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
						@if(Auth::user()->role == 1)
						<th>Branch</th>
						@endif
						<th>Customer</th>
						<th>Remarks</th>
						<th>Status</th>
						<th>BSR Status</th>
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
   <div class="modal fade" id="completed" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Serial No</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="completedform" id="completedform" method="POST" action="{{route('bsr.completed')}}">
                <div class="modal-body">
                    @csrf
                  

                    <div class="row">

                        <div class="form-group col-lg-4">
                            <label>Serial No </label>
                            <input type="text" class="form-control completed_serial_no" id="completed_serial_no"  name="completed_serial_no" >
                            <input type="hidden" class="form-control" id="completed_id"  name="id" >
                            <input type="hidden" class="form-control" id="status_approve"  name="status" >
                        </div>

                        
                    </div>


                
                </div>




                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary submit" id="submit">Save changes</button>
                </div>
            </form>
        </div>



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
			@if(Auth::user()->role == 1)
			{
				orderable: true,
				searchable: true,
				data: "users.name",
			},
			@endif
			{
				orderable: true,
				searchable: true,
				data: "customer_id",
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
				orderable: true,
				searchable: true,
				data: "bsr_status",
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

	   function bsrstatus($this,id)
    {
        var status = $($this).val();
       
       

        if(status == 2)
        {

        

            $('#completed').modal('show');
            $('#completed_id').val(id);
            $('#status_approve').val(status);




        }
        
        else
        {
        $.ajax({

            type: 'POST',
            url: '{{ route("bsr.status") }}',
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