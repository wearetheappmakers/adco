<style type="text/css">
    datalist {
  display: none;
}
</style>
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
            <label>Location <span style="color : red;">*</span></label>
            <a style="background: white; height: 2px !important" target="_blank" href="{{route('location.create')}}" title="Add" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                <i class="flaticon2-plus-1"></i>
            </a>
            <select class="form-control select2" id="branch_id" name="branch_id" onchange="getcustomer(this)" required>
                <option value="">Select Location</option>
                @foreach($branch as $datas)
                <option value="{{$datas->id}}">{{$datas->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-lg-2">
            <label>Customer </label>
            <a style="background: white; height: 2px !important" target="_blank" href="{{route('customer.create')}}" title="Add" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                <i class="flaticon2-plus-1"></i>
            </a>
            <select class="form-control select2" style="width: 100%" id="customer_id" name="customer_id" required>
                <option value="">Select Customer</option>
            </select>
        </div>

        @else

        <div class="form-group col-lg-2"  >
            <label>Customer</label>
            <a style="background: white; height: 2px !important" target="_blank" href="{{route('customer.create')}}" title="Add" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                <i class="flaticon2-plus-1"></i>
            </a>
            <select  class="form-control select2" id="customers_id" style="width: 100%" name="customer_id" required >
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

        <div class="form-group col-lg-2" id="payment_mode" style="display: none;">
            <label>Payment Mode</label><br/>
            <select class="form-control select2" style="width: 100%" id="payment_mode" name="payment_mode">
                <option value="">Select</option>
                <option value="1">Online</option>
                <option value="2">Cash</option>
            </select>
        </div>

        <div class="form-group col-lg-2" style="display: none;" id="date_of_sale">
            <label>Date Of Sale</label>
            <input type="date" id="date_of_sale" name="date_of_sale" value="{{date('Y-m-d')}}" class="form-control">
        </div>

        <div class="form-group col-lg-2" style="display: none;" id="replace_date" >
            <label>Replace Date</label>
            <input type="date" id="replace_dates" name="replace_date" value="{{date('Y-m-d')}}" class="form-control">
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
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Total</td>
                        <td>
                            <input type="text" name="total" id="total" class="form-control total"  data-id = "0" readonly>
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row" style="display: none;" id="foc">
        <div class="form-group col-lg-8">
            <table cellspacing="0" border="0" class="table table-bordered  from">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Category</th>
                        <th>Product</th>
                        <th>Old Serial No.</th>
                        <th>New Serial No.</th>

                    </tr>
                </thead>
                <tbody>
                    <tr class="foc_cloneThis">
                        <td>
                            <button type="button" id="foc_addtime" class="btn btn-sm btn-icon btn-icon-md btn-clean foc_addtime "><i class="fa fa-plus" style="font-size:0.8rem !important"></i></button>
                        </td>
                        <td>
                            <button  type="button" id="foc_minus" class="btn btn-sm btn-icon btn-icon-md btn-clean foc_remove "><i class="fa fa-minus" style="font-size:0.8rem !important;"></i></button>
                        </td>
                        <td>
                            <select class="form-control foc_category_id" id="foc_category_id_0" name="foc_category_id[]" onchange="newproduct(this)" data-id = "0">
                                <option value="">Select</option>                               
                                @foreach($category as $datas)
                                <option value="{{$datas->id}}">{{$datas->name}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="form-control foc_product_id" id="foc_product_id_0" name="foc_product_id[]" onchange="oldserial(this)" data-id = "0">
                                <option value="">Select</option>                               

                            </select>
                        </td>
                        <td>
                             <input list="foc_serial_ids" class="form-control foc_serial_id" name="foc_serial_id[]" id="foc_serial_id_0" onchange="getprice(this)" placeholder="Old Serial No." data-id = "0">
                            <datalist  id="foc_serial_ids"  >
                                <option value="">Select</option>                               

                            </datalist>
                        </td>
                        <td>
                            <select class="form-control foc_new_serial_id" id="foc_new_serial_id_0" name="foc_new_serial_id[]" data-id = "0">
                                <option value="">Select</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row" style="display: none" id="pro_rata_clone">
        <div class="form-group col-lg-12" style="overflow: auto !important">
            <table cellspacing="0" border="0" class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width:200px !important"></th>
                        <th style="width:200px !important"></th>
                        <th style="width:200px !important">Category</th>
                        <th style="width:200px !important">Product</th>
                        <th style="width:200px !important">Old Serial No.</th>
                        <th style="width:200px !important">Price</th>
                        <th style="width:200px !important">Date Of Sale</th>
                        <th style="width:200px !important">New Serial No.</th>
                        <th style="width:200px !important">Discount</th>
                        <th style="width:200px !important">Discount Amount</th>
                        <th style="width:200px !important">Amount</th>
                    </tr>                
                </thead>
                <tbody>
                    <tr class="pro_rata_clone">
                        <td>
                            <button type="button" id="addtime" class="btn btn-sm btn-icon btn-icon-md btn-clean addtime "><i class="fa fa-plus" style="font-size:0.8rem !important"></i></button>
                        </td>
                        <td>
                            <button  type="button" id="minus" class="btn btn-sm btn-icon btn-icon-md btn-clean remove "><i class="fa fa-minus" style="font-size:0.8rem !important;"></i></button>
                        </td>
                        <td>
                            <select style="width:150px !important" class="form-control pro_category_id" id="pro_category_id_0" name="pro_category_id[]" data-id = "0" onchange="progetproduct(this)">
                                <option value="">Select</option>                               
                                @foreach($category as $datas)
                                <option value="{{$datas->id}}">{{$datas->name}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select style="width:150px !important" class="form-control pro_product_id" id="pro_product_id_0" name="pro_product_id[]" data-id = "0" onchange="progetserial(this)">
                                <option value="">Select</option>                               

                            </select>
                        </td>
                    
                             <td>
                                <input style="width:200px !important" list="d_pro_serial_id" class="form-control pro_old_serial_id" name="pro_old_serial_id[]" id="pro_old_serial_id_0" placeholder="Old Serial No." onchange="getdop(this)" data-id = "0">
                            <datalist id="d_pro_serial_id">
                                <option value="">Select</option>                               
                                
                            </datalist> 
                               <!--  <select style="width:200px !important" class="form-control pro_old_serial_id" id="pro_old_serial_id_0" name="pro_old_serial_id[]" data-id = "0" onchange="getdop(this)">
                                    <option value="">Select</option>                               

                                </select> -->
                           <!--  <select style="width:200px !important" class="form-control pro_old_serial_id" id="pro_old_serial_id_0" name="pro_old_serial_id[]" data-id = "0" onchange="getdop(this)">
                                <option value="">Select</option>                               

                            </select> -->
                            </td>
                        
                        <td>

                            <input style="width:150px !important" type="text" class="form-control pro_old_price" id="pro_old_price_0" name="pro_old_price[]" placeholder="Price" data-id = "0" readonly>
                        </td>
                        <td>
                            <input type="date" class="form-control pro_dop"  id="pro_dop_0" name="pro_dop[]" data-id = "0" readonly>
                        </td>
                        <td>
                            <select style="width:200px !important" class="form-control pro_new_serial_id" id="pro_new_serial_id_0" name="pro_new_serial_id[]" data-id = "0" >
                                <option value="">Select</option>                               

                            </select>
                        </td>
                        <td>
                            <input style="width:150px !important" type="text" class="form-control pro_discount_id" id="pro_discount_id_0" name="pro_discount_id[]" data-id = "0" placeholder="Discount" readonly>
                        </td>
                        <td>
                            <input style="width:150px !important" type="text" class="form-control pro_discount_amount" id="pro_discount_amount_0" name="pro_discount_amount[]" data-id = "0" placeholder="Discount Amount" readonly>
                        </td>
                        <td>
                            <input style="width:150px !important" type="text" class="form-control pro_amount" id="pro_amount_0" name="pro_amount[]" data-id = "0" placeholder="Amount" readonly>
                        </td>
                    </tr>
                    <tr>

                        <td colspan="10" style="text-align: right;">
                            <b>TOTAL</b>
                        </td>
                        <td>                
                            <input type="text" class="form-control pro_total_amount" id="pro_total_amount" name="pro_total_amount" data-id = "0" placeholder="Total Amount" readonly>        
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

    var count = 0;
    $(document).on('click','.foc_addtime',function() {
        count++;    
        var length = $('.foc_cloneThis').length;
// if(!(length >= 6))
// {               
    var $row = $(this).closest('.foc_cloneThis');
    var $clone = $row.clone();
    $clone.find('.foc_category_id').val('').attr('data-id',count).attr('id','foc_category_id_'+count);
    $clone.find('.foc_product_id').val('').attr('data-id',count).attr('id','foc_product_id_'+count);
    $clone.find('.foc_serial_id').val('').attr('data-id',count).attr('id','foc_serial_id_'+count);
    $clone.find('.foc_new_serial_id').val('').attr('data-id',count).attr('id','foc_new_serial_id_'+count);
    $clone.find('.foc_price').val('').attr('data-id',count).attr('id','foc_price_'+count);
    $row.after($clone);
// }
});

    $(document).on('click','#foc_minus',function(){
        var clone = $('.foc_cloneThis').length;
        if (clone != 1) {
            var obj = $(this).closest('.foc_cloneThis');
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
                $('#product_id_'+id).html(data.data);                            

            }
        });

    };

    function newproduct($this){

        var foc_category_id = $($this).val();
        var id = $($this).data('id');
        $.ajax({
            type:"POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:"{{ route('newproduct') }}",
            data: {
                'foc_category_id': foc_category_id
            },
            success: function(data){

                $('#foc_product_id_'+id).html(data.data);                            
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
                $('#serial_id_'+id).html(data.data);                            
            }
        });

    };

    function oldserial($this){

        var foc_product_id = $($this).val();

        var id = $($this).data('id');
// console.log(id);
$.ajax({
    type:"POST",
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url:"{{ route('oldserial') }}",
    data: {
        'foc_product_id': foc_product_id
    },
    success: function(data){
        $('#foc_serial_ids').html(data.data); 
        console.log(data.data);
        $('#foc_new_serial_id_'+id).html(data.data1);                            

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
            $('#price_'+id).val(data.data);                            
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
        $('#foc').hide();
        $('#payment_mode').show();
        $('#replace_date').hide();
        $('#pro_rata_clone').hide();

    }
    else if(data == 2){
        $('#customer').hide();
        $('#date_of_sale').hide();
        $('#clone').hide();
        $('#foc').show();
        $('#payment_mode').hide();
        $('#replace_date').show();
       


        $('#pro_rata_clone').hide();

    }
    else if(data == 3){
        $('#customer').hide();
        $('#date_of_sale').hide();
        $('#clone').hide();
        $('#foc').hide();
        $('#payment_mode').show();
        $('#replace_date').show();
        $('#pro_rata_clone').show();

    }
    else
    {
        $('#customer').show();
        $('#date_of_sale').show();
        $('#clone').show();
        $('#foc').hide();
        $('#payment_mode').show();
        $('#replace_date').hide();
        $('#pro_rata_clone').hide();

    }

});

setInterval(gettotal, 1000);
function gettotal()
{

    var total_amount = 0;



    $('.price').each(function(){
        var val = $(this).val();
        if (val == '') { val = 0; }

        total_amount+= parseInt(val);
    });

    $('#total').val(total_amount);
    console.log(total_amount);

}


function progetproduct($this){

    var pro_category_id = $($this).val();
    var id = $($this).data('id');
    $.ajax({
        type:"POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"{{ route('pro.getproduct') }}",
        data: {
            'pro_category_id': pro_category_id
        },
        success: function(data){
            $('#pro_product_id_'+id).html(data.data);                            
        }
    });

};

function progetserial($this){

    var pro_product_id = $($this).val();
    var id = $($this).data('id');
    $.ajax({
        type:"POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"{{ route('pro.getserial') }}",
        data: {
            'pro_product_id': pro_product_id
        },
        success: function(data){
            $('#d_pro_serial_id').html(data.data);                            
            $('#pro_new_serial_id_'+id).html(data.data1);                            
                                       
        }
    });

};

function getdop($this){
    var replace_date = $('#replace_dates').val();

    var pro_old_serial_id = $($this).val();
    var id = $($this).data('id');
    $.ajax({
        type:"POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"{{ route('getdop') }}",
        data: {
            'replace_date':replace_date,
            'pro_old_serial_id': pro_old_serial_id
        },
        success: function(data){
            $('#pro_dop_'+id).val(data.data);                            
            $('#pro_old_price_'+id).val(data.data1); 

            $('#pro_discount_id_'+id).val(data.data2);                            
        }
    });

};


var count = 0;
$(document).on('click','.addtime',function() {
    count++;    
    var length = $('.pro_rata_clone').length;

    var $row = $(this).closest('.pro_rata_clone');
    var $clone = $row.clone();
    $clone.find('.pro_category_id').val('').attr('data-id',count).attr('id','pro_category_id_'+count);
    $clone.find('.pro_product_id').val('').attr('data-id',count).attr('id','pro_product_id_'+count);
    $clone.find('.pro_old_serial_id').val('').attr('data-id',count).attr('id','pro_old_serial_id_'+count);
    $clone.find('.pro_old_price').val('').attr('data-id',count).attr('id','pro_old_price_'+count);
    $clone.find('.pro_dop').val('').attr('data-id',count).attr('id','pro_dop_'+count);
    $clone.find('.pro_new_serial_id').val('').attr('data-id',count).attr('id','pro_new_serial_id_'+count);
    $clone.find('.pro_discount_id').val('').attr('data-id',count).attr('id','pro_discount_id_'+count);
    $clone.find('.pro_discount_value').val('').attr('data-id',count).attr('id','pro_discount_value_'+count);
    $clone.find('.pro_discount_amount').val('').attr('data-id',count).attr('id','pro_discount_amount_'+count);
    $clone.find('.pro_amount').val('').attr('data-id',count).attr('id','pro_amount_'+count);
    $row.after($clone);

});

$(document).on('click','#minus',function(){
    var clone = $('.pro_rata_clone').length;
    if (clone != 1) {
        var obj = $(this).closest('.pro_rata_clone');
        obj.remove();
    }
});



setInterval(progettotal, 1000);
function progettotal()
{   
    var discount_amount = 0;
    var total_amount = 0;
    var amount = 0;
       


    $('.pro_discount_id').each(function(){
        var id = $(this).data('id');
        var val = $(this).val();
        var price = $('#pro_old_price_'+id).val();
        if (val == '') { val = 0; }
        if (price == '') { price =0; }

        discount_amount = price*val/100;

        amount = price - discount_amount;
        $('#pro_discount_amount_'+id).val(discount_amount);
        $('#pro_amount_'+id).val(amount);

        total_amount = amount + total_amount;

    });


    $('#pro_total_amount').val(total_amount);

}

</script>