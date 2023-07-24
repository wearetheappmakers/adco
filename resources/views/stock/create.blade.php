 <meta name="csrf-token" content="{{ csrf_token() }}" />
 <div class="kt-portlet__foot">
 	<div class="row">

        @if(Auth::user()->role == 1)
              <div class="form-group col-lg-2">
                     <label>Location <span style="color : red;">*</span></label>
                     <a style="background: white; height: 2px !important" target="_blank" href="{{route('location.create')}}" title="Add" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                        <i class="flaticon2-plus-1"></i>
                    </a>
                     <select class="form-control select2" id="user_id" name="user_id" required>
                            <option value="">Select Location</option>
                            @foreach($user as $datas)
                            <option value="{{$datas->id}}">{{$datas->name}}</option>
                            @endforeach
                     </select>
              </div>
              @endif

 		<div class="form-group col-lg-2">
 			<label>Category <span style="color : red;">*</span></label>
            @if(Auth::user()->role == 1)
            <a style="background: white; height: 2px !important" target="_blank" href="{{route('category.create')}}" title="Add" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                <i class="flaticon2-plus-1"></i>
            </a>
            @endif
 			<select class="form-control select2" id="category_id" name="category_id" onchange="getproduct(this)" required>
 				<option value="">Select Category</option>
 				@foreach($category as $datas)
 				<option value="{{$datas->id}}">{{$datas->name}}</option>
 				@endforeach
 			</select>
 		</div>

 		<div class="form-group col-lg-2">
 			<label>Product <span style="color : red;">*</span></label>
            @if(Auth::user()->role == 1)
            <a style="background: white; height: 2px !important" target="_blank" href="{{route('product.create')}}" title="Add" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                <i class="flaticon2-plus-1"></i>
            </a>
            @endif
 			<select class="form-control select2" id="product_id" name="product_id" required>
 				<option value="">Select Product</option>
 			</select>
 		</div>

        <div class="form-group col-lg-2">
            <label>Price <span style="color : red;">*</span></label>
            <input type="text" id="price" name="price" placeholder="Enter Price" class="form-control" required>
        </div>

 		<div class="form-group col-lg-2">
 			<label>Number Of Product <span style="color : red;">*</span></label>
 			<input type="text" id="no_of_product" name="no_of_product" placeholder="Enter No. Of Product" class="form-control" required>
 		</div>

              <div class="form-group col-lg-4 serial_no" id="serial_no">
              </div>
 	</div>
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

       $(document).ready(function(){
          $("#no_of_product").on("change",function(e){

               var app = $('#no_of_product').val();

               var html = '';
               for ( i = 0; i < app; i++)
               {
                    html += "<div><label>Serial No "+(i+1)+"<span style='color : red;''>*</span></label><input placeholder='Enter Serial Number' class='form-control'style='width:100%' type='text' name='serial_no[]' required></div>";
             }
             
             $('#serial_no').html(html);
      });
   });

 </script>