@include('layouts.header')

@include('layouts.sidebar')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	@yield('content')
</div>
@include('layouts.footer')