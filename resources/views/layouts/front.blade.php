<!DOCTYPE html>
<html lang="en">

<head>
<!-- Meta -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<meta name="keywords" content="MediaCenter, Template, eCommerce">
<meta name="robots" content="all">
<title>TreeWorld - Premium Tree Shop</title>

<!-- Bootstrap Core CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

<!-- Customizable CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/blue.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/owl.transitions.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/animate.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/rateit.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap-select.min.css') }}">

<!-- Icons/Glyphs -->
<link rel="stylesheet" href="{{ asset('assets/css/font-awesome.css') }}">

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Barlow:200,300,300i,400,400i,500,500i,600,700,800" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
</head>
<body class="cnt-home">

@include('partials.header')

@yield('content')

@include('partials.footer')

<!-- For demo purposes – can be removed on production --> 

<!-- For demo purposes – can be removed on production : End --> 

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
</body>

</html>