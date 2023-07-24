@extends('main')
@section('content')


<meta name="csrf-token" content="{{ csrf_token() }}" />

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<br>
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label">
				
				<h3 class="kt-portlet__head-title">
					Report Serial No. 
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

				<?php $serial = App\StockChild::get(); 
				if(Auth::user()->role == 2)
					{
						$serial = App\StockChild::where('user_id',Auth::user()->id)->get();
					}
					elseif (Auth::user()->role == 3) {
						$serial = App\StockChild::where('user_id',Auth::user()->branch_id)->get();
					}
					?>

				<div class="form-group col-lg-2">
					<label>Serial No </label> 
					<select name="serial_no" class="form-control changes select2 serial_no" id="serial_no" onchange="getdata(this)" >
						<option value="">Select</option>
						@foreach($serial as $sub)
						<option value="{{$sub->id}}">{{$sub->serial_no}}</option>
						@endforeach
					</select>
				</div>

				
				<div class="col-sm-1">
					<br>
					<!-- <button type="submit" class="btn btn-brand btn-elevate btn-icon-sm">
						<i class="la la-download"></i>
						Export
					</button> -->
				</div>

			</div>

			<div class="form-group" id="tableData">

			</div>
		</form>
			<!-- <div id="kt_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4">
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
							<th>New Serial No.</th>							
						</tr>
					</thead>
				</table>
			</div> -->
		</div>
		<!-- @include('layouts.multiple_action', array(
			'table_name' => 'stock_child',
			'is_orderby'=>'',
			'folder_name'=>'',
			'action' => array('change-status-1' => _('Active'), 'change-status-0' => _('Inactive'))
			)) -->
		</div>
	</div>	
@stop
<script type="text/javascript">

  function getdata($this)
    {
        var serial_no = $($this).val();
        var id = $($this).data('id');
       
            $.ajax({

                type: 'POST',

                url: '{{route('report.getdata')}}',

                data: {
                    serial_no: serial_no,
                    _token: '{{ csrf_token()}}',
                },

                cache: false,
                success: function (data)
                {
                    console.log(data.datas);
                   
                    $('#tableData').html('');
                    $('#tableData').html(data.data);
                }

            });
       
    }
		
</script>