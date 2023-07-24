<div class="kt-portlet__body">
    <div class="form-group row">
        <div class="col-lg-2">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{$data->name}}" required>
        </div>
       
        <div class="form-group col-lg-2">
            <label>No. of days</label>
            <input type="number" class="form-control" name="no_of_days" id="no_of_days"  required readonly>
        </div>
    </div>
    <?php
    $data = App\LeaveType::get();
   
    ?>
    <div class="row">

       @foreach($data as $dtkey=>$dt)
        @if(isset($child[$dtkey]))
        @if($child[$dtkey]['leave_type_id'] == $dt['id'])
        <div class="form-group col-sm-2">
            <label>{{ucfirst($dt->name)}} Leave (Monthly)</label>
            <input type="hidden" name="child_id[]" value="{{$child[$dtkey]['id']}}">
            <input type="hidden" name="edit_type_id[]" class="form-control" value="{{$dt->id}}">
            <input type="text" name="edit_day[]" class="form-control days" value="{{$child[$dtkey]['day']}}">
        </div>
        <div class="col-lg-2">
            <label>Is Extendable</label><br>
            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info kt-switch--sm">
                <label>
                    <input type="checkbox" name="edit_is_extendable[]" value="1" @if($child[$dtkey]['is_extendable'] == 1) checked @endif>
                    <span></span>
                </label>
            </span>
        </div>
        @endif
        @else
        <div class="form-group col-sm-2">
            <label>{{ucfirst($dt->name)}} Leave (Monthly)</label>
            <input type="hidden" name="type_id[]" class="form-control" value="{{$dt->id}}">
            <input type="text" name="day[]" class="form-control days">
        </div>
        <div class="col-lg-2">
            <label>Is Extendable</label><br>
            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info kt-switch--sm">
                <label>
                    <input type="checkbox" name="is_extendable[]" value="1">
                    <span></span>
                </label>
            </span>
        </div>
        @endif
        @endforeach
    </div>
</div>

<script type="text/javascript">
    setInterval(getTotal,1000);
    function getTotal()
    {
        var total_days = 0;
        $('.days').each(function (i,val){
            var days = $(val).val();
            if(days == ''){days = 0}
                total_days = parseFloat(total_days) + parseFloat(days);
        })
        $('#no_of_days').val(total_days);
    }
</script>