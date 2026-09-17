<!-- JavaScripts placed at the end of the document so the pages load faster --> 
<script src="{{ asset('assets/js/jquery-1.11.1.min.js') }}"></script> 
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script> 
<script src="{{ asset('assets/js/bootstrap-hover-dropdown.min.js') }}"></script> 
<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script> 
<script src="{{ asset('assets/js/echo.min.js') }}"></script> 
<script src="{{ asset('assets/js/jquery.easing-1.3.min.js') }}"></script> 
<script src="{{ asset('assets/js/bootstrap-slider.min.js') }}"></script> 
<script src="{{ asset('assets/js/jquery.rateit.min.js') }}"></script> 
<script src="{{ asset('assets/js/lightbox.min.js') }}"></script> 
<script src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script> 
<script src="{{ asset('assets/js/wow.min.js') }}"></script> 
<script src="{{ asset('assets/js/scripts.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
  toastr.options = {
    "closeButton": true,
    "progressBar": true
  }
  @if(Session::has('success'))
  toastr.success("{{ session('success') }}");
  @endif
  @if(Session::has('error'))
  toastr.error("{{ session('error') }}");
  @endif
  @if(Session::has('info'))
  toastr.info("{{ session('info') }}");
  @endif
  @if(Session::has('warning'))
  toastr.warning("{{ session('warning') }}");
  @endif
  @if ($errors->any())
    @foreach ($errors->all() as $error)
      toastr.error("{{ $error }}");
    @endforeach
  @endif
</script>
