<?php
$edit = route($route.'.edit',$id);
?>

<?php
$show = route($route.'.show',$id);
?>
<?php $status = DB::table('so')->where('id',$id)->value('status');?>

@if(!($route === 'salesorder'))
<a style="background: white;" href="{{ $edit }}" title="Edit details" class="btn btn-sm btn-clean btn-icon btn-icon-md">
	<i style="color: green;" class="la la-edit"></i>
</a>&nbsp;&nbsp;
@endif


{{-- Buttons For SO --}}
@if($route === 'salesorder')
<a href="{{ $edit }}" @if($status != 2) style="background: white; display: block; display: inline-flex;" @else style="background: white; display: none;" @endif title="Edit details" class="btn btn-sm btn-clean btn-icon btn-icon-md">
    <i style="color: green;" class="la la-edit"></i>
</a>&nbsp;&nbsp;

<a href="{{ $show }}" title="View details" style="background: white;" class="btn btn-sm btn-clean btn-icon btn-icon-md">
    <i style="color: black;" class="flaticon-eye"></i>
</a>&nbsp;&nbsp;
@endif
{{-- End --}}



@if(Auth::user()->role == 1)
<button style="background: white;" title="Delete" data-id="{{$id}}" class="btn btn-sm btn-clean btn-icon btn-icon-md delete-record">
    <i style="color: red;" class="la la-trash">
    </i>
</button>
@endif