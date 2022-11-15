 <meta name="csrf-token" content="{{ csrf_token() }}" />

 <div class="kt-portlet__foot">
 	<div class="row">

        @if(Auth::user()->role == 1)
 		<div class="form-group col-lg-2">
 			<label>Branch <span style="color : red;">*</span></label>
 			<select class="form-control select2" id="branch_id" name="branch_id" onchange="getcustomer(this)" disabled>

 				<option value="">Select Branch</option>
                @foreach($branch as $admin)
                <option value="{{$admin->id}}" @if($admin->id == $data->branch_id) selected @endif>{{$admin->name}}</option>
                @endforeach

 			</select>
 		</div>

 		<div class="form-group col-lg-2">
 			<label>Customer <span style="color : red;">*</span></label>
 			<select class="form-control select2" id="customer_id" name="customer_id" disabled>
 				<option value="">Select Customer</option>
                @foreach($customer as $admin)
                <option value="{{$admin->id}}" @if($admin->id == $data->customer_id) selected @endif>{{$admin->name}}</option>
                @endforeach
            </select>
        </div>
        @endif

        <div class="form-group col-lg-2" @if(Auth::user()->role == 2 || Auth::user()->role == 3) style="display: block;" @else style="display: none;" @endif>
            <label>Customer <span style="color : red;">*</span></label>
            <select class="form-control select2" id="customers_id" name="customer_id" disabled>
                <option value="">Select Customer</option>
                    @foreach($customer as $admin)
                    <option value="{{$admin->id}}" @if($admin->id == $data->customer_id) selected @endif>{{$admin->name}}</option>
                    @endforeach
            </select>
        </div>

 		<div class="form-group col-lg-2">
 			<label>Remarks</label>
 			<input type="text" id="remarks" name="remarks" value="{{$data->remarks}}" placeholder="Enter Remarks" class="form-control">
 		</div>

    </div>

    <div class="row">
        <div class="form-group col-lg-8">
            <table cellspacing="0" border="0" class="table table-bordered  from">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Category</th>
                        <th>Product</th>
                        <th>Serial No.</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($child as $key=>$value)
                    <tr class="fordelete">
                        <td></td>

                        <td>
                            <button  type="button" id="old_remove" data-value="{{$value->id}}" class="btn btn-sm btn-icon btn-icon-md btn-clean old_remove "><i class="fa fa-minus" style="font-size:0.8rem !important;"></i></button>
                        </td>
                        <td>
                            <input type="hidden" name="hidden_id[]" value="{{$value->id}}" class="form-control ">
                            <select class="form-control old_category_id" id="old_category_id_0" name="old_category_id[]" onchange="getproduct(this)" data-id = "{{$value->id}}" disabled>
                                <option value="">Select</option>
                                    @foreach($category as $admin)
                                    <option value="{{$admin->id}}" @if($admin->id == $value->category_id) selected @endif>{{$admin->name}}</option>
                                    @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="form-control old_product_id" id="old_product_id_0" name="old_product_id[]" onchange="getserial(this)" data-id = "{{$value->id}}" disabled>
                                <option value="">Select</option>
                                    @foreach($product as $admin)
                                    <option value="{{$admin->id}}" @if($admin->id == $value->product_id) selected @endif>{{$admin->name}}</option>
                                    @endforeach                            
                            </select>
                        </td>
                        <td>
                            <select class="form-control old_serial_id" id="old_serial_id_0" name="old_serial_id[]" onchange="getprice(this)" data-id = "{{$value->id}}" disabled>
                                <option value="">Select</option>                               
                                    @foreach($stockchild as $admin)
                                    <option value="{{$admin->id}}" @if($admin->id == $value->serial_id) selected @endif>{{$admin->serial_no}}</option>
                                    @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="text" name="old_price[]" value="{{$value->price}}" id="old_price_0" class="form-control old_price" placeholder="Price" data-id = "{{$value->id}}" readonly>
                        </td>
                    </tr>
                    @endforeach

                    <tr class="cloneThis">
                        <td>
                            <button type="button" id="addtime" class="btn btn-sm btn-icon btn-icon-md btn-clean addtime "><i class="fa fa-plus" style="font-size:0.8rem !important"></i></button>
                        </td>
                        <td>
                            <button  type="button" id="minus" class="btn btn-sm btn-icon btn-icon-md btn-clean remove "><i class="fa fa-minus" style="font-size:0.8rem !important;"></i></button>
                        </td>
                        <td>
                            <select class="form-control category_id" id="category_id_0" name="category_id[]" onchange="getproduct(this)" data-id = "0">
                                <option value="">Select</option>                               
                                @foreach($category as $datas)
                                <option value="{{$datas->id}}">{{$datas->name}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="form-control product_id" id="product_id_0" name="product_id[]" onchange="getserial(this)" data-id = "0">
                                <option value="">Select</option>                               

                            </select>
                        </td>
                        <td>
                            <select class="form-control serial_id" id="serial_id_0" name="serial_id[]" onchange="getprice(this)" data-id = "0">
                                <option value="">Select</option>                               

                            </select>
                        </td>
                        <td>
                            <input type="text" name="price[]" id="price_0" class="form-control price" placeholder="Price" data-id = "0" readonly>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

<script type="text/javascript">
  function getcustomer($this){

     var branch_id = $($this).val();
     var id = $(this).data('id');
     $.ajax({
        type:"POST",
        headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
       url:"{{ route('getcustomer') }}",
       data: {
           'branch_id': branch_id
       },
       success: function(data){
           console.log(data.data);
           $('#customer_id').html(data.data);                            
       }
   });

 };


 $(document).on('click','.old_remove',function()
    {
        var clone = $('.fordelete').length;        
        var id = $(this).data('value');
        var url = "{{ route('sochild.delate',":rowid") }}";
        url = url.replace(':rowid',id);
        var obj = $(this);
        $.ajax({
            type: "GET",
            url: url,
            processData: false,
            contentType: false,
            success: function(data)
            {
                if (data.status === 'success')
                {
                    location.reload();

                } else if (data.status === 'error')
                {
                    location.reload();
                }
            }
        });
    });


 var count = 0;
    $(document).on('click','.addtime',function() {
    count++;    
        var length = $('.cloneThis').length;
        // if(!(length >= 6))
        // {               
            var $row = $(this).closest('.cloneThis');
            var $clone = $row.clone();
            $clone.find('.category_id').val('').attr('data-id',count).attr('id','category_id_'+count);
            $clone.find('.product_id').val('').attr('data-id',count).attr('id','product_id_'+count);
            $clone.find('.serial_id').val('').attr('data-id',count).attr('id','serial_id_'+count);
            $clone.find('.price').val('').attr('data-id',count).attr('id','price_'+count);
            $row.after($clone);
        // }
    });

    $(document).on('click','#minus',function(){
        var clone = $('.cloneThis').length;
        if (clone != 1) {
            var obj = $(this).closest('.cloneThis');
            obj.remove();
        }
    });


    function getproduct($this){

     var category_id = $($this).val();
     var id = $($this).data('id');
     $.ajax({
        type:"POST",
        headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
       url:"{{ route('getproduct') }}",
       data: {
           'category_id': category_id
       },
       success: function(data){
           $('#product_id_'+id).html(data);                            
       }
   });

 };


 function getserial($this){

     var product_id = $($this).val();
     var id = $($this).data('id');
     $.ajax({
        type:"POST",
        headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
       url:"{{ route('getserial') }}",
       data: {
           'product_id': product_id
       },
       success: function(data){
           $('#serial_id_'+id).html(data);                            
       }
   });

 };


 function getprice($this){

     var serial_id = $($this).val();
     console.log(serial_id);
     var id = $($this).data('id');
     $.ajax({
        type:"POST",
        headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
       url:"{{ route('getprice') }}",
       data: {
           'serial_id': serial_id
       },
       success: function(data){
           $('#price_'+id).val(data);                            
       }
   });

 };
</script>