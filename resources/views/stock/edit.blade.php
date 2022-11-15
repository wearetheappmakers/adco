 <meta name="csrf-token" content="{{ csrf_token() }}" />
 <div class="kt-portlet__foot">
 	<div class="row">
        @if(Auth::user()->role == 1)
              <div class="form-group col-lg-2">
                     <label>Branch</label>
                     <select class="form-control select2" id="user_id" name="user_id" disabled>
                            <option value="">Select Branch</option>
                            @foreach($user as $admin)
                            <option value="{{$admin->id}}" @if($admin->id == $data->user_id) selected @endif>{{$admin->name}}</option>
                            @endforeach
                     </select>
              </div>
              @endif

 		<div class="form-group col-lg-2">
 			<label>Category</label>
 			<select class="form-control select2" id="category_id" name="category_id" disabled>

 				<option value="">Select Category</option>
                            @foreach($category as $admin)
                            <option value="{{$admin->id}}" @if($admin->id == $data->category_id) selected @endif>{{$admin->name}}</option>
                            @endforeach

 			</select>
 		</div>

 		<div class="form-group col-lg-2">
 			<label>Product</label>
 			<select class="form-control select2" id="product_id" name="product_id" disabled>
 				<option value="">Select Product</option>
                            @foreach($product as $admin)
                            <option value="{{$admin->id}}" @if($admin->id == $data->product_id) selected @endif>{{$admin->name}}</option>
                            @endforeach
 			</select>
 		</div>

 		<div class="form-group col-lg-2">
 			<label>Number Of Product</label>
 			<input type="text" id="no_of_product" name="no_of_product" value="{{$data->no_of_product}}" placeholder="Enter No. Of Product" class="form-control" onchange="onchageDiv()" readonly>
 		</div>
       </div>
       @foreach($serial as $key => $value)
       <div class="row">

              <div class="form-group col-lg-2">
                <label>Price {{$key+1}}</label>
                <input type="text" id="price" name="price[]" value="{{$value->price}}" placeholder="Enter Price" class="form-control" readonly>
              </div>

              <div class="form-group col-lg-4">
                     <label>Serial Number {{$key+1}}</label>
                     <input type="hidden" name="child_id[]" value="{{ $value->id }}">

                     <input type="text" id="serial_no_{{$key}}" name="serial_no[]" value="{{$value->serial_no}}" placeholder="Enter Serial Number" class="form-control">
              </div>
       </div>
       @endforeach
 </div>


 <script type="text/javascript">

       function getproduct($this){

              var category_id = $($this).val();
              var id = $(this).data('id');
              $.ajax({
                     type:"POST",
                     headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                     url:"{{ route('stock.product') }}",
                     data: {
                            'category_id': category_id
                     },
                     success: function(data){
                            console.log(data.data);
                            $('#product_id').html(data.data);                            
                     }
              });

       };
</script>

