@extends('main')
@section('content')

<style type="text/css">
	.kt-widget24{
		background-color: #FFFFFF;
		box-shadow:0 0 5px 0 rgba(0, 0, 0, 0.1) ;
		-webkit-box-shadow:0 0 5px 0 rgba(0, 0, 0, 0.1) ;
		position: relative;
		overflow: hidden;
	}
	.kt-widget24 .kt-widget24__icon {
		font-size: 120px;
		position: absolute;
		line-height: 120px;
		right: 0;
		color: rgba(0, 0, 0, 0.05);
		bottom: 0;
		margin-bottom: -24px;
		z-index: 0;
	}
	.kt-widget24 .kt-widget24__details {
		position: relative;
		z-index: 1; 
	}
	body {
		background: #F3F4F6;
	}
	.kt-widget24 .kt-widget24__details .kt-widget24__info .kt-widget24__title {
		color: #000000 !important;
		margin: 0;
		font-size: 16px;
	}
	.kt-widget24 .kt-widget24__details .kt-widget24__stats {
		padding-left:0;
	}
	.kt-widget24 .kt-widget24__details .view-more a {
		background-color: #000000;
		color: #ffffff;
		height: 30px;
		width: 30px;
		border-radius: 30px;
		text-align: center;
		display: flex;
		align-items: center;
		justify-content: center;
	}	
	.kt-widget24.yello-box {
		background-color:#FFF4DE;
		border: 1px solid #FFA800;
	}
	.kt-widget24.yello-box .kt-widget24__details .view-more a {
		background-color: #FFA800;
	}
	.kt-widget24.yello-box .kt-widget24__details .kt-widget24__stats {
		color:#FFA800;
	}
	.kt-widget24.lightblue-box {
		background-color:#E1F0FF;
		border: 1px solid #3699FF;
	} 
	.kt-widget24.lightblue-box .kt-widget24__details .kt-widget24__stats {
		color:#3699FF;
	}
	.kt-widget24.lightblue-box .kt-widget24__details .view-more a {
		background-color: #3699FF;
	}
	.kt-widget24.red-box {
		background-color:#FFE2E5;
		border: 1px solid #F64E60;
	}
	.kt-widget24.red-box .kt-widget24__details .kt-widget24__stats {
		color:#F64E60;
	}
	.kt-widget24.red-box .kt-widget24__details .view-more a {
		background-color: #F64E60;
	}
	.kt-widget24.lightgreen-box {
		background-color:#c9f7f5;
		border: 1px solid #1BC5BD;
	}
	.kt-widget24.lightgreen-box .kt-widget24__details .kt-widget24__stats {
		color:#1BC5BD;
	}
	.kt-widget24.lightgreen-box .kt-widget24__details .view-more a {
		background-color: #1BC5BD;
	}
	.kt-widget24.purple-box {
		background-color:#EEE5FF;
		border: 1px solid #8950FC;
	}
	.kt-widget24.purple-box .kt-widget24__details .kt-widget24__stats {
		color:#8950FC;
	}
	.kt-widget24.purple-box .kt-widget24__details .view-more a {
		background-color: #8950FC;
	}
	.kt-widget24.dark-box {
		background-color:#EBEDF3;
		border: 1px solid #181C32;
	}
	.kt-widget24.dark-box .kt-widget24__details .kt-widget24__stats {
		color:#181C32;
	}
	.kt-widget24.dark-box .kt-widget24__details .view-more a {
		background-color: #181C32;
	}
	.kt-widget24.pink-box {
		background-color: #CFF5CF;
		border: 1px solid #4B7502;
	}
	.kt-widget24.pink-box .kt-widget24__details .kt-widget24__stats {
		color:#4B7502;
	}
	.kt-widget24.pink-box .kt-widget24__details .view-more a {
		background-color: #4B7502;
	}
	.kt-widget24.gray-box {
		background-color:#d4edda;
		border: 1px solid #155724 ;
	}
	.kt-widget24.gray-box .kt-widget24__details .kt-widget24__stats {
		color:#155724;
	}
	.kt-widget24.gray-box .kt-widget24__details .view-more a {
		background-color: #155724;
	}
	.kt-portlet .kt-portlet__head .kt-portlet__head-label .kt-portlet__head-title {
		color: #000000;
		font-size: 16px;
	}
	.kt-portlet .kt-portlet__head .kt-portlet__head-label .kt-portlet__head-title i{
		color: #BC3043; 
		font-size: 20px;
		margin-right: 5px;
	}
	.table th, .table td {
		font-size: 14px;
		padding: 15px;
		font-weight: 400;
	}

	
	.eventClass
	{
		color: #000 !important;
		background-color: #d5dbeb !important;
		border: 1px solid #d5dbeb !important;
		
	}
	.eventClass i
	{
		color: black!important;
		padding: 5px !important;
		/*margin-left: 2px !important;*/
		
	}
	.eventClass1
	{
		color: #000 !important;
		background-color: #d5dbeb !important;
		border: 1px solid #d5dbeb !important;
		
	}
	.eventClass1 i
	{
		color: black!important;
		padding: 5px !important;
		/*margin-left: 2px !important;*/
		
	}

</style>
@php

if(Auth::user()->role == 1)
{
	$today_stock = App\StockChild::whereDate('created_at', date('Y-m-d'))->count();
	$today_direct_so = App\So::whereDate('created_at', date('Y-m-d'))->where('type',1)->count();
	$today_foc_so = App\So::whereDate('created_at', date('Y-m-d'))->where('type',2)->count();
	$today_pro_so = App\So::whereDate('created_at', date('Y-m-d'))->where('type',3)->count();
	$total_category = App\Category::count();
	$total_product = App\Product::count();
	$total_user = App\User::count();
	$total_branch = App\User::where('role',2)->count();
	$total_stock = App\StockChild::count();
}
elseif(Auth::user()->role == 2)
{
	$today_stock = App\StockChild::whereDate('created_at', date('Y-m-d'))->where('user_id',Auth::user()->id)->count();
	$today_direct_so = App\So::whereDate('created_at', date('Y-m-d'))->where('branch_id',Auth::user()->id)->where('type',1)->count();
	$today_foc_so = App\So::whereDate('created_at', date('Y-m-d'))->where('branch_id',Auth::user()->id)->where('type',2)->count();
	$today_pro_so = App\So::whereDate('created_at', date('Y-m-d'))->where('branch_id',Auth::user()->id)->where('type',3)->count();
	$total_category = App\Category::count();
	$total_product = App\Product::count();
	$total_user = App\User::count();
	$total_branch = App\User::where('role',2)->count();
	$total_stock = App\StockChild::where('user_id',Auth::user()->id)->count();

}
else
{
	$branch = App\User::where('id',Auth::user()->id)->value('branch_id');
	$today_stock = App\StockChild::whereDate('created_at', date('Y-m-d'))->where('user_id',$branch)->count();
	$today_direct_so = App\So::whereDate('created_at', date('Y-m-d'))->where('branch_id',$branch)->where('type',1)->count();
	$today_foc_so = App\So::whereDate('created_at', date('Y-m-d'))->where('branch_id',$branch)->where('type',2)->count();
	$today_pro_so = App\So::whereDate('created_at', date('Y-m-d'))->where('branch_id',$branch)->where('type',3)->count();
	$total_category = App\Category::count();
	$total_product = App\Product::count();
	$total_user = App\User::count();
	$total_branch = App\User::where('role',2)->count();
	$total_stock = App\StockChild::where('user_id',Auth::user()->branch_id)->count();

}


@endphp

<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css">

<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<br>
	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		@if(Auth::user()->role == 3)
		<div class="row">
			<div class="col-lg-3">
                <div class="kt-portlet kt-portlet--mobile card cardshadow">
                    <center>
                    	<br>
                        <div id="message"></div>
                        <br>
                        <a href="{{asset('assets/media/logos/user.png')}}" target="_blank">
                            <img src="{{asset('assets/media/logos/user.png')}}" width="180px" height="180px" style="border-radius: 50;border:1px solid #ddd">
                        </a>
                        <br>
                        <br>
                        <br>
                        {{-- <a href="{{route('admin.profile.view')}}" class="btn btn-brand btn-wide btn-bold btn-upper" style="width:70%">Profile</a> --}}
                    </center>
                </div>
            </div>
			<div class="col-lg-3 flip-card-click">
				<div class="flip-card-inner">
					<div class="kt-portlet kt-portlet--mobile cardshadow">
						<div class="kt-portlet__head kt-portlet__head--lg">
							<div class="kt-portlet__head-label">
								<span class="kt-portlet__head-icon">
									<i class="kt-font-brand flaticon2-line-chart" style="font-size:35px"></i>
								</span>
								<h3 class="kt-portlet__head-title" style="font-size:20px">
									My Attendance
								</h3>
							</div>
							<div class="kt-portlet__head-toolbar">
								<div class="kt-portlet__head-wrapper">
									<div class="kt-portlet__head-actions">
										<button id="punch" class="btn btn-warning btn-elevate btn-icon-sm" onclick="punch()" style="display: none;">
											<i class="la la-hand-pointer-o"></i>
											Punch
										</button>
										<button id="report" class="btn btn-warning btn-elevate btn-icon-sm" onclick="report()" style="">
											<i class="fa fa-list"></i>
											Report
										</button>
									</div>
								</div>
							</div>
						</div>
						<?php $missed = App\Attendance::where('employee_id',Auth::user()->id)->where('attendance','Missed')->count();
                            $present = App\Attendance::where('employee_id',Auth::user()->id)->where('attendance','Present')->count(); 
                            $half_days = App\Attendance::where('employee_id',Auth::user()->id)->whereIn('attendance',['First Half','Second Half'])->count();
                            $wo = App\Attendance::where('employee_id',Auth::user()->id)->whereIn('attendance',['Weekoff', 'Weekoff(First half)', 'Weekoff(Second half)'])->count();
                            $holiday = App\Attendance::where('employee_id',Auth::user()->id)->where('attendance','Holiday')->count();
                            $absent = App\Attendance::where('employee_id',Auth::user()->id)->where('attendance','Absent')->count(); 
                            $leave = App\Attendance::where('employee_id',Auth::user()->id)->where('attendance','Leave')->count();
                        ?>
						<div class="kt-portlet__body attendanceDiv" style="display: none;">
							<div id="kt_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4">
								<h4 style="color:gray">Present Days : {{$present}}</h4>
								<br>
								<table class="table table-striped- table-bordered table-hover table-checkable datatable" id="datatable_rows" width="100%">
									<input type="hidden" name="_token" value="gkEWQ5vZkTcoyRayfBnaBwejuB9vmLBnApnQEPBT">
									<thead>
										<tr>
											<td align="center">
												<span style="font-size:40px">{{$absent}}</span><br>
												Absent Days
											</td>
											<td align="center" style="color:red">
												<span style="font-size:40px">{{$half_days}}</span><br>
												Half Days
											</td>
											<td align="center" style="color:red">
												<span style="font-size:40px">{{$missed}}</span><br>
												Miss Punch Out
											</td>
										</tr>
										<tr>
											<td align="center">
												<span style="font-size:40px">{{$leave}}</span><br>
												Leave
											</td>
											<td align="center">
												<span style="font-size:40px">{{$holiday}}</span><br>
												Holiday
											</td>
											<td align="center">
												<span style="font-size:40px">{{$wo}}</span><br>
												Weekly Off
											</td>
										</tr>
									</thead>
								</table>
							</div>
						</div>
						<div class="kt-portlet__body punchDiv" style="">
							<div id="kt_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4">
								@php $punch_exist = App\Attendance::where('employee_id',Auth::user()->id)->where('date',date('Y-m-d'))->whereIn('attendance',['Present','Missed'])->exists(); @endphp

								<a @if($punch_exist) href="javascript:void(0)" disabled style="cursor:no-drop;background:#ddd;" @else href="{{route('punch.in')}}" @endif class="btn btn-primary" style="background:#ddd;" title="Click to Punch In"><i class="fa fa-walking" style="color:green;font-size: 40px;"></i><i class="la la-university" style="color:black;font-size: 80px;"></i></a>

								@php $punch_out_exist = App\Attendance::where('employee_id',Auth::user()->id)->where('date',date('Y-m-d'))->whereIn('attendance',['Present','Missed'])->where('punch_in','!=',null)->where('punch_out',null)->exists(); @endphp

								<a @if($punch_out_exist) href="{{route('punch.out')}}" @else href="javascript:void(0)" disabled style="cursor:no-drop;background:#ddd;float: right;" @endif class="btn btn-primary" style="background:#ddd;float: right;" title="Click to Punch Out"><i class="la la-university" style="color:black;font-size: 80px;"></i><i class="fa fa-walking" style="color:red;font-size: 40px;"></i></a>

							</div>
						</div>
					</div>
				</div>
			</div>

			  <div class="col-lg-3">
                <div class="kt-portlet kt-portlet--mobile cardshadow">
                    <div class="kt-portlet__head kt-portlet__head--lg">

                        <div class="kt-portlet__head-label">

                            <span class="kt-portlet__head-icon">

                                <i class="kt-font-brand fa fa-calendar-times" style="font-size:35px"></i>

                            </span>

                            <h3 class="kt-portlet__head-title" style="font-size:20px">

                                Leave Applied

                            </h3>

                        </div>
                    </div>
                    <div class="kt-portlet__body">

                        <div id="kt_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <h4 style="color:gray">{{date(' F - Y ')}}</h4>
                            <br>
                            <table class="table table-striped- table-bordered table-hover table-checkable datatable" id="datatable_rows" width="100%">

                                @csrf

                                <thead>

                                    <tr>
                                        <td align="center">
                                            @php
                                            $pending = App\Leave::where('employee_id',Auth::user()->id)->where('status',1)->count();
                                            $rejected = App\Leave::where('employee_id',Auth::user()->id)->where('status',3)->count();
                                            $approved = App\Leave::where('employee_id',Auth::user()->id)->where('status',2)->count();
                                            @endphp
                                            <span style="font-size:40px">{{$pending}}</span><br>
                                            Pending
                                        </td>
                                        <td align="center" style="color:red">
                                            <span style="font-size:40px">{{$rejected}}</span><br>
                                            Rejected
                                        </td>
                                        <td align="center" style="color:green">
                                            <span style="font-size:40px">{{$approved}}</span><br>
                                            Approved
                                        </td>
                                    </tr>

                                    <tr>
                                    </tr>

                                </thead>

                            </table>

                        </div>

                    </div>
                </div>
            </div>

                 <div class="col-lg-3">
                <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid cardshadow">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <span class="kt-portlet__head-icon">

                                <i class="kt-font-brand fa fa-calendar-times" style="font-size:35px"></i>

                            </span>
                            <h3 class="kt-portlet__head-title" style="font-size:20px">
                                Holidays
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body" style="height:170px;overflow: auto;">
                        @php
                        $holidays = App\Holiday::whereMonth('date',date('m'))->get();
                        @endphp
                        <!--begin::widget 12-->
                        <div class="kt-widget4">
                            @foreach($holidays as $hol)
                            <div class="kt-widget4__item">
                                <span class="kt-widget4__icon">
                                    <i class="flaticon-star kt-font-success"></i>
                                </span>
                                <a href="#" class="kt-widget4__title kt-widget4__title--light">
                                    {{$hol->name}}
                                </a>
                                <span class="kt-widget4__number kt-font-success">{{date('d-m-Y',strtotime($hol->date))}}</span>
                            </div>
                            @endforeach
                        </div>

                        <!--end::Widget 12-->
                    </div>
                </div>
            </div>
		</div>


		@endif
		<div class="row">

			<div class="col-md-3 col-lg-2">
				<div class="kt-widget24 yello-box">
					<div class="kt-widget24__icon">
						<i class="flaticon2-calendar-2"></i>
					</div>
					<div class="kt-widget24__details">
						<div class="kt-widget24__info">
							<h4 class="kt-widget24__title">
								Today's Stock
							</h4>
							<span class="kt-widget24__stats">
								{{$today_stock}}
							</span>
						</div>
                        {{-- <div class="view-more">
                            <a href="#"><i class="fas fa-chevron-right"></i></a>
                        </div> --}}
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-lg-2">
            	<div class="kt-widget24 pink-box">
            		<div class="kt-widget24__icon">
            			<i class="flaticon-truck"></i>
            		</div>
            		<div class="kt-widget24__details">
            			<div class="kt-widget24__info">
            				<h4 class="kt-widget24__title">
            					Today's Direct SO
            				</h4>
            				<span class="kt-widget24__stats">
            					{{$today_direct_so}}
            				</span>
            			</div>
                        {{-- <div class="view-more">
                            <a href="#"><i class="fas fa-chevron-right"></i></a>
                        </div> --}}
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-lg-2">
            	<div class="kt-widget24 red-box">
            		<div class="kt-widget24__icon">
            			<i class="flaticon2-gear"></i>
            		</div>
            		<div class="kt-widget24__details">
            			<div class="kt-widget24__info">
            				<h4 class="kt-widget24__title">
            					Today's FOC SO
            				</h4>
            				<span class="kt-widget24__stats">
            					{{$today_foc_so}}
            				</span>
            			</div>
                        {{-- <div class="view-more">
                            <a href="#"><i class="fas fa-chevron-right"></i></a>
                        </div> --}}
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-lg-2">
            	<div class="kt-widget24 red-box">
            		<div class="kt-widget24__icon">
            			<i class="flaticon2-gear"></i>
            		</div>
            		<div class="kt-widget24__details">
            			<div class="kt-widget24__info">
            				<h4 class="kt-widget24__title">
            					Today's Pro Rata Warranty SO
            				</h4>
            				<span class="kt-widget24__stats">
            					{{$today_pro_so}}
            				</span>
            			</div>
                        {{-- <div class="view-more">
                            <a href="#"><i class="fas fa-chevron-right"></i></a>
                        </div> --}}
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-lg-2">
            	<div class="kt-widget24 lightblue-box">
            		<div class="kt-widget24__icon">
            			<i class="flaticon2-menu-4"></i>
            		</div>
            		<div class="kt-widget24__details">
            			<div class="kt-widget24__info">
            				<h4 class="kt-widget24__title">
            					Total Product
            				</h4>
            				<span class="kt-widget24__stats">
            					{{$total_product}}
            				</span>
            			</div>
                        {{-- <div class="view-more">
                            <a href="#"><i class="fas fa-chevron-right"></i></a>
                        </div> --}}
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-lg-2">
            	<div class="kt-widget24 dark-box">
            		<div class="kt-widget24__icon">
            			<i class="flaticon2-layers-2"></i>
            		</div>
            		<div class="kt-widget24__details">
            			<div class="kt-widget24__info">
            				<h4 class="kt-widget24__title">
            					Total Category
            				</h4>
            				<span class="kt-widget24__stats">
            					{{$total_category}}
            				</span>
            			</div>
                        {{-- <div class="view-more">
                            <a href="#"><i class="fas fa-chevron-right"></i></a>
                        </div> --}}
                    </div>
                </div>
            </div>

        </div>

        <div class="row">

        	@if(Auth::user()->role == 1)
        	<div class="col-md-3 col-lg-2">
        		<div class="kt-widget24 purple-box">
        			<div class="kt-widget24__icon">
        				<i class="flaticon-user"></i>
        			</div>
        			<div class="kt-widget24__details">
        				<div class="kt-widget24__info">
        					<h4 class="kt-widget24__title">
        						Total User
        					</h4>
        					<span class="kt-widget24__stats">
        						{{$total_user}}
        					</span>
        				</div>
                        {{-- <div class="view-more">
                            <a href="#"><i class="fas fa-chevron-right"></i></a>
                        </div> --}}
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-lg-2">
            	<div class="kt-widget24 purple-box">
            		<div class="kt-widget24__icon">
            			<i class="flaticon2-group"></i>
            		</div>
            		<div class="kt-widget24__details">
            			<div class="kt-widget24__info">
            				<h4 class="kt-widget24__title">
            					Total Branch
            				</h4>
            				<span class="kt-widget24__stats">
            					{{$total_branch}}
            				</span>
            			</div>
                        {{-- <div class="view-more">
                            <a href="#"><i class="fas fa-chevron-right"></i></a>
                        </div> --}}
                    </div>
                </div>
            </div>

            @endif

            <div class="col-md-3 col-lg-2">
            	<div class="kt-widget24 yello-box">
            		<div class="kt-widget24__icon">
            			<i class="fas fa-tasks"></i>
            		</div>
            		<div class="kt-widget24__details">
            			<div class="kt-widget24__info">
            				<h4 class="kt-widget24__title">
            					Total Stock
            				</h4>
            				<span class="kt-widget24__stats">
            					{{$total_stock}}
            				</span>
            			</div>
                        {{-- <div class="view-more">
                            <a href="#"><i class="fas fa-chevron-right"></i></a>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
	function punch()
	{
		$('.punchDiv').show();
		$('.attendanceDiv').hide();
		$('#punch').hide();
		$('#report').show();
	}
	function report()
	{
		$('.punchDiv').hide();
		$('.attendanceDiv').show();
		$('#punch').show();
		$('#report').hide();
	}
</script>

<script>  
    var welcome;  
    var date = new Date();  
    var hour = date.getHours();  
    var minute = date.getMinutes();  
    var second = date.getSeconds();  
    if (minute < 10) {  
        minute = "0" + minute;  
    }  
    if (second < 10) {  
        second = "0" + second;  
    }  
    if (hour < 12) {  
        welcome = "Good Morning , " + '{{Auth::user()->name}} !';  
    } else if (hour < 17) {  
        welcome = "Good Afternoon , " + '{{Auth::user()->name}} !';  
    } else {  
        welcome = "Good Evening , " + '{{Auth::user()->name}} !';  
    }  
    $('#message').html("<center><h4>" + "<font color='black'>" + welcome + "</font></h4></center>");
</script>
@endsection