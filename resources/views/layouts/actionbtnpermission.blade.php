<?php
$edit = route($route.'.edit',$id);
?>

<?php
$show = route($route.'.show',$id);
?>
<?php $status = DB::table('so')->where('id',$id)->value('status');?>
<?php $type = DB::table('so')->where('id',$id)->value('type');?>

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

@if($type != 1)
<a style="background: white;" href="{{ route('bsr.create', $id)}}" title="BSR" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i style="color: black;" class="flaticon2-plus-1"></i></a>&nbsp;&nbsp;
@endif

<a href="{{ $show }}" title="View details" style="background: white;" class="btn btn-sm btn-clean btn-icon btn-icon-md">
    <i style="color: black;" class="flaticon-eye"></i>
</a>&nbsp;&nbsp;

<button @if($status != 2) style="background: white; display: block; display: inline-flex;" @else style="background: white; display: none;" @endif title="Delete" data-id="{{$id}}" class="btn btn-sm btn-clean btn-icon btn-icon-md delete-record">
    <i style="color: red;" class="la la-trash">
    </i>
@endif
{{-- End --}}



@if(Auth::user()->role == 1)
@if(!($route === 'salesorder'))
<button style="background: white;" title="Delete" data-id="{{$id}}" class="btn btn-sm btn-clean btn-icon btn-icon-md delete-record">
    <i style="color: red;" class="la la-trash">
    </i>
</button>
@endif
@endif

<script type="text/javascript">
    function getpdf(id,name,invoiceno)
    {
        var parent = $('#pdf_'+id);           

        parent.attr('disabled',true);

        parent.html('<i class="fa fa-spinner fa-spin"></i>');

        $.ajax({
            type: "POST",
            url: "{{ route('pdf') }}",
            data: {
                '_token': $('input[name="_token"]').val(),
                'id': id
            },
            xhrFields: {
                responseType: 'blob'
            },
            success: function(blob) {
                parent.attr('disabled',false);

                parent.html('<i style="color: black;" class="fas fa-print"></i >');

                var link=document.createElement('a');
                link.href=window.URL.createObjectURL(blob);
                link.download= id+'BSR.pdf';
                link.click();
            }
        });
    }
</script>