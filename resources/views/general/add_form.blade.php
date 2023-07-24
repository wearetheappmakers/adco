@extends('main')
@section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
  <br>
  <div class="kt-portlet">
    <div class="kt-portlet__head">
      <div class="kt-portlet__head-label">
        <h3 class="kt-portlet__head-title">
          {{ $title }}
        </h3>
      </div>
    </div>
    <form class="kt-form" class="addform" id="addform">
      @csrf
      <?php
      $index = route($resourcePath.'.index');
      $store = route($resourcePath.'.store');
      ?>
      @include($resourcePath.'.create')
    </form>
    <div class="kt-portlet__foot">
      <div class="kt-form__actions">
        <center>
          <button type="submit" class="btn btn-success submit" id="submit" style="background-color: black;">Submit</button>
          <a href="{{ $index }}"><button type="button" class="btn btn-outline-secondary">Cancel</button></a>
        </center>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">

  $(document).ready(function(){
    $("#submit").on("click",function(e){
      e.preventDefault();
      @if($resourcePath === "task")
      for ( instance in CKEDITOR.instances ) {
        CKEDITOR.instances.description.updateElement();

              }
            
      @endif
      if($("#addform").valid()){
        $.ajax({
          type:"POST",
          url:"{{ $store }}",
          data: new FormData($('#addform')[0]),
          processData: false,
          contentType:false,

        success: function(data){
          if(data.status==='success'){
            toastr["success"]("{{$module}} Added Successfully.", "Success");
            window.location="{{ $index }}";
          }else if(data.status==='error'){
            toastr["error"]("{{$module}} Unsuccessfull", "Error");
            location.reload();
          }else if(data.status==='duplicate_serial'){
            toastr["error"]("Duplicate Serial Number", "Error");
            // location.reload();
          }
          else if(data.status==='duplicate_hsn'){
            toastr["error"]("Duplicate Hsn code", "Error");
            // location.reload();
          }
          else if(data.status==='duplicate'){
            toastr["error"]("Duplicate Email", "Error");
            // location.reload();
          }
          else if (data.status === 'limit_exceed') {
            toastr["warning"]("Your leave limit has been exceed!", "Warning");
          }
        }
      });
      }else{
        e.preventDefault();
      }
    });
  });
</script>
@endpush