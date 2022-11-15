 <meta name="csrf-token" content="{{ csrf_token() }}" />

 <div class="kt-portlet__foot">
 	<div class="row">
        <div class="form-group" id="type">
            <label>Type</label>
            <div class="kt-radio-list">
                <label class="kt-radio">
                    <input type="radio" id="type" name="type"  value="1"> Direct Sales
                    <span></span>
                </label>
                <label class="kt-radio">
                    <input type="radio" id="type" name="type" value="2"> FOC 
                    <span></span>
                </label>
                <label class="kt-radio">
                    <input type="radio" id="type" name="type" value="3"> Pro Rata Warranty
                    <span></span>
                </label>
            </div>           
        </div>
    </div>

    <div class="row">
        @if(Auth::user()->role == 1)
        <div class="form-group col-lg-2">
            <label>Branch <span style="color : red;">*</span></label>
            <select class="form-control select2" id="branch_id" name="branch_id" onchange="getcustomer(this)" required>
             <option value="">Select Branch</option>
             @foreach($branch as $datas)
             <option value="{{$datas->id}}">{{$datas->name}}</option>
             @endforeach
         </select>
     </div>
     <div class="form-group col-lg-2" style="display: none" id="customer">
        <label>Customer <span style="color : red;">*</span></label>
        <select class="form-control select2" id="customer_id" name="customer_id" required>
         <option value="">Select Customer</option>
     </select>
    </div>

    @else

    <div class="form-group col-lg-2" >
        <label>Customers <span style="color : red;">*</span></label>
        <select  class="form-control select2" id="customers_id" style="width: 100%" name="customer_id" required>
            <option value="">Select Customer</option>
            @foreach($customer as $datas)
            <option value="{{$datas->id}}">{{$datas->name}}</option>
            @endforeach
        </select>
    </div>

    @endif

     @php
        $orderno = App\So::where('order_no','like','ADCO-%')->latest()->first();
        if(isset($orderno))
        {
            $no = explode('-',$orderno['order_no']);
            $no = $no[1] + 1;
            $order_no = 'ADCO-'.$no;
        }
        else
        {
            $order_no = 'ADCO-1';
        }
        @endphp
        <div class="form-group col-lg-2">
            <label>Order No. </label>
            <input type="text" name="order_no" readonly placeholder="Order Number" value="{{$order_no}}" class="form-control" required>
        </div>

    <div class="form-group col-lg-2">
        <label>Remarks</label>
        <input type="text" id="remarks" name="remarks" placeholder="Enter Remarks" class="form-control">
    </div>

    <div class="form-group col-lg-2">
        <label>Payment Mode<span style="color : red;">*</span></label>
        <select class="form-control select2" id="payment_mode" name="payment_mode" required>
            <option value="">Select</option>
            <option value="1">Online</option>
            <option value="2">Cash</option>
        </select>
    </div>

    <div class="form-group col-lg-2" style="display: none;" id="date_of_sale">
        <label>Date Of Sale</label>
        <input type="date" id="date_of_sale" name="date_of_sale" class="form-control">
    </div>

    <div class="form-group col-lg-2">
        <label>Vehicle Number</label>
        <input type="text" id="vehicle_no" name="vehicle_no" placeholder="Enter Vehicle Number" class="form-control">
    </div>

</div>

<div class="row" style="display: none" id="clone">
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

<div class="row">
    <div class="form-group col-lg-8">
        <table cellspacing="0" border="0" class="table table-bordered  from">
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th>Serial No.</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <tr class="cloneThis">
                    <td>
                        <button type="button" id="addtime" class="btn btn-sm btn-icon btn-icon-md btn-clean addtime "><i class="fa fa-plus" style="font-size:0.8rem !important"></i></button>
                    </td>
                    <td>
                        <button  type="button" id="minus" class="btn btn-sm btn-icon btn-icon-md btn-clean remove "><i class="fa fa-minus" style="font-size:0.8rem !important;"></i></button>
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


 $('input[type=radio][name=type]').change(function(){

            var data = $(this).val();
            console.log(data);
            if(data == 1){
                $('#customer').show();
                $('#date_of_sale').show();
                $('#clone').show();
            }
            else if(data == 2){
                $('#customer').hide();
                $('#date_of_sale').hide();
                $('#clone').hide();
            }
            else
            {
                $('#customer').show();
                $('#date_of_sale').show();
                $('#clone').show();
            }
          
        });
</script>