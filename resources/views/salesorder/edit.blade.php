 <meta name="csrf-token" content="{{ csrf_token() }}" />

 <div class="kt-portlet__foot">
    <div class="row">
        <div class="form-group" id="type" disabled>
            <label>Type</label>

            <div class="kt-radio-list">
                <label class="kt-radio">
                    <input type="hidden" name="type" value="{{$data->type}}">
                    <input type="radio" disabled id="type" name="type"  value="1"  @if($data->type == 1) checked @endif > Direct Sales
                    <span></span>
                </label>
                <label class="kt-radio">
                    <input type="radio" disabled id="type" name="type" value="2"  @if($data->type == 2) checked @endif> FOC 
                    <span></span>
                </label>
                <label class="kt-radio">
                    <input type="radio" disabled id="type" name="type" value="3"  @if($data->type == 3) checked @endif> Pro Rata Warranty
                    <span></span>
                </label>
            </div>           
        </div>
    </div>
    <div class="row">

        @if(Auth::user()->role == 1)
        <div class="form-group col-lg-2">
            <label>Location <span style="color : red;">*</span></label>
            <input type="hidden" name="branch_id" value="{{$data->branch_id}}">
            <select class="form-control select2" id="branch_id" name="branch_id" onchange="getcustomer(this)" disabled>

               <option value="">Select Location</option>
               @foreach($branch as $admin)
               <option value="{{$admin->id}}" @if($admin->id == $data->branch_id) selected @endif>{{$admin->name}}</option>
               @endforeach

           </select>
       </div>

       <div class="form-group col-lg-2" >
        <label>Customer</label>

        <select class="form-control select2" id="customer_id" name="customer_id" disabled>
           <option value="">Select Customer</option>
           @foreach($customer as $admin)
           <option value="{{$admin->id}}" @if($admin->id == $data->customer_id) selected @endif>{{$admin->name}}</option>
           @endforeach
       </select>
   </div>
   @endif

   @if(Auth::user()->role != 1)
   <div class="form-group col-lg-2">
    <label>Customer </label>
    <select class="form-control select2" id="customers_id" name="customer_id" disabled>
        <option value="">Select Customer</option>
        @foreach($customer as $admin)
        <option value="{{$admin->id}}" @if($admin->id == $data->customer_id) selected @endif>{{$admin->name}}</option>
        @endforeach
    </select>
</div>
@endif
<div class="form-group col-lg-2">
    <label>Order No. </label>
    <input type="text" name="order_no" readonly placeholder="Order Number" value="{{$data->order_no}}" class="form-control" readonly>
</div>

<div class="form-group col-lg-2">
    <label>Remarks</label>
    <input type="text" id="remarks" name="remarks" value="{{$data->remarks}}" placeholder="Enter Remarks" class="form-control">
</div>
<div class="form-group col-lg-2" id="payment_mode" @if($data->type == 1 || $data->type ==3) style="display: block;" @else style="display: none;" @endif>
    <label>Payment Mode</label><br/>
    <select class="form-control select2" style="width: 100%" id="payment_mode" name="payment_mode">
        <option value="">Select</option>
        <option value="1" @if($data->payment_mode == 1) selected @endif>Online</option>
        <option value="2" @if($data->payment_mode == 2) selected @endif>Cash</option>
    </select>
</div>

<div class="form-group col-lg-2" @if($data->type == 1) style="display: block;" @else style="display: none;" @endif id="date_of_sale">
    <label>Date Of Sale</label>
    <input type="date" id="date_of_sale" name="date_of_sale" value="{{$data->date_of_sale}}" class="form-control">
</div>
<div class="form-group col-lg-2" @if($data->type == 2 || $data->type == 3) style="display: block;" @else style="display: none;" @endif id="replace_date">
    <label>Replace Date</label>
    <input type="date" id="replace_date" value="{{$data->replace_date}}" name="replace_date" class="form-control">
</div>

<div class="form-group col-lg-2">
    <label>Vehicle Number</label>
    <input type="text" id="vehicle_no" name="vehicle_no" value="{{$data->vehicle_no}}" placeholder="Enter Vehicle Number" class="form-control">
</div>

</div>

<div class="row" id="clone" @if($data->type == 1) style="display: block;" @else style="display: none;" @endif>
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
                        <input type="hidden" name="edit_hidden_id[]" value="{{$value->id}}" class="form-control ">
                        
                        <select class="form-control old_category_id" id="old_category_id_{{$value->id}}" name="old_category_id[]"  onchange="editgetproduct(this)" data-id = "{{$value->id}}">
                            <option value="">Select</option>
                            @foreach($category as $admin)
                            <option value="{{$admin->id}}" @if($admin->id == $value->category_id) selected @endif>{{$admin->name}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <?php $product = App\Product::where('category_id',$value->category_id)->get(); ?>
                        <select class="form-control old_product_id" id="old_product_id_{{$value->id}}" name="old_product_id[]"  onchange="editgetserial(this)" data-id = "{{$value->id}}">
                            <option value="">Select</option>
                            @foreach($product as $admin)
                            <option value="{{$admin->id}}" @if($admin->id == $value->product_id) selected @endif>{{$admin->name}}</option>
                            @endforeach                            
                        </select>
                    </td>
                    <td>
                       
                       <?php $stockchild = App\StockChild::where('used',0)->where('product_id',$value->product_id)->get(); ?>
                        <select class="form-control old_serial_id" id="old_serial_id_{{$value->id}}" name="old_serial_id[]"  onchange="editgetprice(this)" data-id = "{{$value->id}}">
                            <option value="">Select</option>                               
                            @foreach($stockchild as $admin)
                            <option value="{{$admin->id}}" @if($admin->id == $value->serial_id) selected @endif>{{$admin->serial_no}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="text" name="old_price[]" value="{{$value->price}}" id="old_price_{{$value->id}}" class="form-control old_price" placeholder="Price" data-id ="{{$value->id}}" readonly>
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

<div class="row" @if($data->type == 2) style="display: block;" @else style="display: none;" @endif id="foc">
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
                    <th></th>

                </tr>
            </thead>
            <tbody>
                @if(isset($child))
                @foreach($child as $key=>$value)
                <tr class="edit_foc_cloneThis">
                    <td>

                    </td>
                    <td>
                        <button  type="button" id="edit_foc_minus" data-value="{{$value->id}}" class="btn btn-sm btn-icon btn-icon-md btn-clean edit_foc_minus "><i class="fa fa-minus" style="font-size:0.8rem !important;"></i></button>
                    </td>
                    <td>
                        <input type="hidden" name="edit_hidden_id" value="{{$value->id}}">
                       
                        <select class="form-control edit_foc_category_id" id="edit_foc_category_id_0" name="edit_foc_category_id[]"  onchange="editnewproduct(this)" data-id = "{{$value->id}}">
                            <option value="">Select</option>                               
                            @foreach($category as $datas)
                            <option value="{{$datas->id}}" @if($datas->id == $value->category_id) selected @endif>{{$datas->name}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <?php $product = App\Product::where('category_id',$value->category_id)->get(); ?>
                        <select class="form-control edit_foc_product_id" name="edit_foc_product_id[]" id="edit_foc_product_id_{{$value->id}}"  onchange="editoldserial(this)" data-id = "{{$value->id}}" >
                            <option value="">Select</option>
                            @foreach($product as $admin)
                            <option value="{{$admin->id}}" @if($admin->id == $value->product_id) selected @endif>{{$admin->name}}</option>
                            @endforeach                                

                        </select>
                    </td>
                    <td>
                        <?php $stockchild = App\StockChild::where('used',1)->where('product_id',$value->product_id)->get(); ?>
                         <input list="foc_serial_ids" class="form-control edit_foc_serial_id" name="edit_foc_serial_id[]" id="foc_serial_ids_{{$value->id}}" value="{{$value->return_serial_id}}" placeholder="Old Serial No." onchange="getprice(this)" data-id = "{{$value->id}}">
                        <datalist id="foc_serial_ids">
                             <option value="">Select</option>  
                            @foreach($stockchild as $admin)
                            <option value="{{$admin->serial_no}}"></option>
                            @endforeach                          
                        </datalist> 
                              

                       
                    </td>
                    <td>
                       <?php  $stockchild = App\StockChild::where('used',0)->where('product_id',$value->product_id)->get(); ?>
                        <select class="form-control edit_foc_new_serial_id" id="edit_foc_new_serial_id_{{$value->id}}" name="edit_foc_new_serial_id[]"  data-id = "{{$value->id}}" >
                            <option value="">Select</option>
                            @foreach($stockchild as $admin)
                            <option value="{{$admin->id}}" @if($admin->id == $value->serial_id) selected @endif>{{$admin->serial_no}}</option>
                            @endforeach 
                        </td>

                       
                        <td>
                            @if(isset($value->return_serial_id))
                         	{{-- <a href = "data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate($value->return_serial_id)) !!}" style="width:150px !important" style="position:absolute;width:150px !important;" download> Download</a> --}}

                            <a style="background: white;" href="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate($value->return_serial_id)) !!}" title="Download" class="btn btn-sm btn-clean btn-icon btn-icon-md" download><i style="color: black;" class="flaticon2-download-2"></i></a>&nbsp;&nbsp;

                        	<!-- <a href="/image/qrimage.png" download> Download</a> -->
                            <!--  <button  type="button" data-value="{{$value->id}}" id="download" class="btn btn-sm btn-icon btn-icon-md btn-clean download "><i class="flaticon-download" style="font-size:1.5rem !important;"></i></button> -->
                            @endif
                        </td>

                    </tr>

                    @endforeach
                    @endif
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
                             <input list="foc_serial_idss" class="form-control foc_serial_id" name="foc_serial_id[]" id="foc_serial_id_0" placeholder="Old Serial No."  onchange="getprice(this)" data-id = "0">
                            <datalist id="foc_serial_idss">
                                <option value="">Select</option>                               
                                
                            </datalist> 

                           
                        </td>
                        <td>
                            <select class="form-control foc_new_serial_id" id="foc_new_serial_id_0" name="foc_new_serial_id[]" data-id = "0">
                                <option value="">Select</option>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row"  @if($data->type == 3) style="display: block;" @else style="display: none;" @endif id="pro_rata_clone">
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
                            <th style="width:200px !important"></th>
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
                                <input type="hidden" name="edit_hidden_id[]" value="{{$value->id}}" class="form-control ">
                               
                                <select style="width:150px !important" class="form-control old_pro_category_id" id="old_pro_category_id_{{$value->id}}" name="old_pro_category_id[]" onchange="editprogetproduct(this)"  data-id = "{{$value->id}}" >
                                    <option value="">Select</option>
                                        @foreach($category as $datas)
                                        <option value="{{$datas->id}}" @if($datas->id == $value->category_id) selected @endif>{{$datas->name}}</option>
                                        @endforeach
                                </select>
                            </td>
                            <td>
                                <?php $product = App\Product::where('category_id',$value->category_id)->get(); ?>
                                <select style="width:150px !important" class="form-control old_pro_product_id" id="old_pro_product_id_{{$value->id}}" name="old_pro_product_id[]" onchange="editprogetserial(this)" data-id = "{{$value->id}}" >
                                    <option value="">Select</option>                               
                                    @foreach($product as $admin)
                                    <option value="{{$admin->id}}" @if($admin->id == $value->product_id) selected @endif>{{$admin->name}}</option>
                                    @endforeach   
                                </select>
                            </td>
                            <td>
                               
                               <?php $stockchild = App\StockChild::where('used',1)->where('return_id',0)->where('product_id',$value->product_id)->get(); ?>
                               <input  style="width:150px !important" list="d_pro_serial_ids" class="form-control old_pro_serial_id" name="old_pro_serial_id[]" id="old_pro_serial_id_{{$value->id}}" value="{{$value->return_serial_id}}" placeholder="Old Serial No." onchange="editgetdop(this)" data-id = "{{$value->id}}">
                               <datalist id="d_pro_serial_ids">
                                <option value="">Select</option> 
                                 @foreach($stockchild as $admin)
                                    <option value="{{$admin->serial_no}}"></option>
                                    @endforeach                              
                                
                                </datalist> 
                              <!--   <select style="width:200px !important" class="form-control old_pro_serial_id"   name="old_pro_serial_id[]">
                                    <option value="">Select</option>                               
                                   
                                </select> -->
                            </td>
                            <td>
                                <input style="width:150px !important" type="text" class="form-control old_pro_price"  id="old_pro_price_{{$value->id}}" name="old_pro_price[]" placeholder="Price" data-id = "{{$value->id}}" value="{{$value->price}}" readonly>
                            </td>
                            <td>
                                <input type="date" class="form-control old_pro_dop" value="{{$value->date_of_sale}}" id="old_pro_dop_{{$value->id}}" name="old_pro_dop[]" data-id = "{{$value->id}}" readonly>
                            </td>
                            <td>
                                <?php $stockchild = App\StockChild::where('used',0)->where('product_id',$value->product_id)->get();?>
                                <select style="width:200px !important" class="form-control old_pro_new_serial_id" id="old_pro_new_serial_id_{{$value->id}}" data-id = "{{$value->id}}" name="old_pro_new_serial_id[]">
                                    <option value="">Select</option>
                                    @foreach($stockchild as $admin)
                                    <option value="{{$admin->id}}" @if($admin->id == $value->serial_id) selected @endif>{{$admin->serial_no}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input style="width:150px !important" type="text" class="form-control old_pro_discount_id" id="old_pro_discount_id_{{$value->id}}" name="old_pro_discount_id[]" value="{{$value->discount}}" data-id = "{{$value->id}}" placeholder="Discount" readonly>
                            </td>
                            <td>
                                <input style="width:150px !important" type="text" class="form-control old_pro_discount_amount" id="old_pro_discount_amount_{{$value->id}}" name="old_pro_discount_amount[]" value="{{$value->discount_amount}}" data-id = "{{$value->id}}" placeholder="Discount Amount" readonly>
                            </td>
                            <td>
                                <input style="width:150px !important" type="text" class="form-control old_pro_amount" id="old_pro_amount_{{$value->id}}" name="old_pro_amount[]" value="{{$value->amount}}" data-id = "{{$value->id}}" placeholder="Amount" readonly>
                            </td>
                             <td>
                                @if(isset($value->return_serial_id))
                         	{{-- <a href = "data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate($value->return_serial_id)) !!}" style="width:150px !important" style="position:absolute;width:150px !important;" download> Download</a> --}}

                            <a style="background: white;" href="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate($value->return_serial_id)) !!}" title="Download" class="btn btn-sm btn-clean btn-icon btn-icon-md" download><i style="color: black;" class="flaticon2-download-2"></i></a>&nbsp;&nbsp;

                        	<!-- <a href="/image/qrimage.png" download> Download</a> -->
                            <!--  <button  type="button" data-value="{{$value->id}}" id="download" class="btn btn-sm btn-icon btn-icon-md btn-clean download "><i class="flaticon-download" style="font-size:1.5rem !important;"></i></button> -->
                            @endif
                        </td>

                        </tr>
                        @endforeach
                        <tr class="pro_rata_clone">
                            <td>
                                <button type="button" id="addtime" class="btn btn-sm btn-icon btn-icon-md btn-clean addtime "><i class="fa fa-plus" style="font-size:0.8rem !important"></i></button>
                            </td>
                            <td>
                                <button  type="button" id="pro_minus" class="btn btn-sm btn-icon btn-icon-md btn-clean remove "><i class="fa fa-minus" style="font-size:0.8rem !important;"></i></button>
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
                                <input list="d_pro_serial_id" class="form-control pro_old_serial_id" name="pro_old_serial_id[]" id="pro_old_serial_id_0" onchange="getdop(this)" placeholder="Old Serial No." data-id = "0">
                            <datalist id="d_pro_serial_id">
                                <option value="">Select</option>                               
                                
                            </datalist> 
                               <!--  <select style="width:200px !important" class="form-control pro_old_serial_id" id="pro_old_serial_id_0" name="pro_old_serial_id[]" data-id = "0" onchange="getdop(this)">
                                    <option value="">Select</option>                               

                                </select> -->
                            </td>
                            <td>
                                <input style="width:150px !important" type="text" class="form-control pro_old_price"  id="pro_old_price_0" name="pro_old_price[]" placeholder="Price" data-id = "0" readonly>
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

     $(document).on('click','.edit_foc_minus',function()
   {
    var clone = $('.edit_foc_cloneThis').length;        
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

     $(document).on('click','.download',function()
     {
        var clone = $('.edit_foc_cloneThis').length;        
        var id = $(this).data('value');
        var url = "{{ route('sochild.download',":rowid") }}";
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

    function editgetproduct($this){

       var old_category_id = $($this).val();
       var id = $($this).data('id');
       $.ajax({
        type:"POST",
        headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     },
     url:"{{ route('getproduct') }}",
     data: {
         'old_category_id': old_category_id
     },
     success: function(data){
         $('#old_product_id_'+id).html(data.data1);                            
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

  function editnewproduct($this){

     var edit_foc_category_id = $($this).val();
     // console.log(edit_foc_category_id);
     var id = $($this).data('id');
     console.log(id);
     $.ajax({
        type:"POST",
        headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
       url:"{{ route('newproduct') }}",
       data: {
           'edit_foc_category_id': edit_foc_category_id
       },
       success: function(data){
            console.log(data.data1);
           $('#edit_foc_product_id_'+id).html(data.data1);                            
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
       $('#foc_serial_idss').html(data.data); 
       $('#foc_new_serial_id_'+id).html(data.data1);                            

   }
});

};

 function editoldserial($this){

     var edit_foc_product_id = $($this).val();

     var id = $($this).data('id');
   // console.log(id);
   $.ajax({
    type:"POST",
    headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   },
   url:"{{ route('oldserial') }}",
   data: {
       'edit_foc_product_id': edit_foc_product_id
   },
   success: function(data){
       $('#foc_serial_ids').html(data.data3); 
       $('#edit_foc_new_serial_id_'+id).html(data.data4);                            

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

function editgetserial($this){

   var old_product_id = $($this).val();
   var id = $($this).data('id');
   $.ajax({
    type:"POST",
    headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
 },
 url:"{{ route('getserial') }}",
 data: {
     'old_product_id': old_product_id
 },
 success: function(data){
     $('#old_serial_id_'+id).html(data.data1);                            
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

function editgetprice($this){

   var old_serial_id = $($this).val();
   console.log(old_serial_id);
   var id = $($this).data('id');
   $.ajax({
    type:"POST",
    headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
 },
 url:"{{ route('getprice') }}",
 data: {
     'old_serial_id': old_serial_id
 },
 success: function(data){
     $('#old_price_'+id).val(data.data1);                            
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
    var old_amount =0;



    $('.price').each(function(){
        var val = $(this).val();
        if (val == '') { val = 0; }

        total_amount+= parseInt(val);
    });
    $('.old_price').each(function(){
        var val = $(this).val();
        if (val == '') { val = 0; }

        old_amount+= parseInt(val);
    });

    $('#total').val(total_amount + old_amount);
    console.log(total_amount);

}

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

$(document).on('click','#pro_minus',function(){
    var clone = $('.pro_rata_clone').length;
    if (clone != 1) {
        var obj = $(this).closest('.pro_rata_clone');
        obj.remove();
    }
});


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


function editprogetproduct($this){

    var old_pro_category_id = $($this).val();
    var id = $($this).data('id');
    $.ajax({
        type:"POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"{{ route('pro.getproduct') }}",
        data: {
            'old_pro_category_id': old_pro_category_id
        },
        success: function(data){
            $('#old_pro_product_id_'+id).html(data.data1);                            
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

function editprogetserial($this){

    var old_pro_product_id = $($this).val();
    var id = $($this).data('id');
    $.ajax({
        type:"POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"{{ route('pro.getserial') }}",
        data: {
            'old_pro_product_id': old_pro_product_id
        },
        success: function(data){
            $('#d_pro_serial_ids').html(data.data3);                            
            $('#old_pro_new_serial_id_'+id).html(data.data4);                            
                                       
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

function editgetdop($this){
    var replace_date = $('#replace_dates').val();

    var old_pro_serial_id = $($this).val();
    var id = $($this).data('id');
    $.ajax({
        type:"POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"{{ route('editgetdop') }}",
        data: {
            'replace_date':replace_date,
            'old_pro_serial_id': old_pro_serial_id
        },
        success: function(data){
            $('#old_pro_dop_'+id).val(data.data);                            
            $('#old_pro_price_'+id).val(data.data1); 

            $('#old_pro_discount_id_'+id).val(data.data2);                            
        }
    });

};

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

        var edit_total_amount =0;
     $('.old_pro_discount_id').each(function(){
        var id = $(this).data('id');
        var val = $(this).val();
        var edit_price = $('#old_pro_price_'+id).val();
        if (val == '') { val = 0; }
        if (edit_price == '') { edit_price =0; }

        var edit_discount_amount = edit_price*val/100;

        var edit_amount = edit_price - edit_discount_amount;
        $('#old_pro_discount_amount_'+id).val(edit_discount_amount);
        $('#old_pro_amount_'+id).val(edit_amount);

        edit_total_amount = edit_amount + edit_total_amount;

    });


    $('#pro_total_amount').val(total_amount + edit_total_amount);

}
</script>