@extends('frontend.app')

@section('content')
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="home.html">Home</a></li>
				<li class='active'>Login</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
	<div class="container">
		<div class="sign-in-page">
			<div class="row">
				<!-- Sign-in -->			
<div class="col-md-6 col-sm-6 sign-in">
	<h4 class="">Sign in</h4>
	<p class="">Hello, Welcome to your account.</p>
	<div class="social-sign-in outer-top-xs">
		<a href="#" class="facebook-sign-in"><i class="fa fa-facebook"></i> Sign In with Facebook</a>
		<a href="#" class="twitter-sign-in"><i class="fa fa-twitter"></i> Sign In with Twitter</a>
	</div>
	<form method="POST" action="{{ route('login') }}" class="register-form outer-top-xs">
		@csrf
		<div class="form-group">
		    <label class="info-title" for="email">Email Address <span>*</span></label>
		    <input type="email" name="email" class="form-control unicase-form-control text-input" id="email" required autofocus autocomplete="username">
		</div>
	  	<div class="form-group">
		    <label class="info-title" for="password">Password <span>*</span></label>
		    <input type="password" name="password" class="form-control unicase-form-control text-input" id="password" required autocomplete="current-password">
		</div>
		<div class="radio outer-xs">
		  	<label>
		    	<input type="radio" name="remember" id="remember_me">Remember me!
		  	</label>
		  	@if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="forgot-password pull-right">Forgot your Password?</a>
            @endif
		</div>
	  	<button type="submit" class="btn-upper btn btn-primary checkout-page-button">Login</button>
	</form>					
</div>
<!-- Sign-in -->

<!-- create a new account -->
<div class="col-md-6 col-sm-6 create-new-account">
	<h4 class="checkout-subtitle">Create a new account</h4>
	<p class="text title-tag-line">Create your new account.</p>
	<form method="POST" action="{{ route('register') }}" class="register-form outer-top-xs">
		@csrf
		<div class="form-group">
		    <label class="info-title" for="name">Name <span>*</span></label>
		    <input type="text" name="name" class="form-control unicase-form-control text-input" id="name" required autofocus autocomplete="name">
		</div>
		<div class="form-group">
	    	<label class="info-title" for="registerEmail">Email Address <span>*</span></label>
	    	<input type="email" name="email" class="form-control unicase-form-control text-input" id="registerEmail" required autocomplete="username">
	  	</div>
        <div class="form-group">
		    <label class="info-title" for="registerPassword">Password <span>*</span></label>
		    <input type="password" name="password" class="form-control unicase-form-control text-input" id="registerPassword" required autocomplete="new-password">
		</div>
         <div class="form-group">
		    <label class="info-title" for="password_confirmation">Confirm Password <span>*</span></label>
		    <input type="password" name="password_confirmation" class="form-control unicase-form-control text-input" id="password_confirmation" required autocomplete="new-password">
		</div>
	  	<button type="submit" class="btn-upper btn btn-primary checkout-page-button">Sign Up</button>
	</form>
	
	
</div>	
<!-- create a new account -->			</div><!-- /.row -->
		</div><!-- /.sigin-in-->
		<!-- ============================================== BRANDS CAROUSEL ============================================== -->
<div id="brands-carousel" class="logo-slider wow fadeInUp">

		<div class="logo-slider-inner">	
			<div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
				<div class="item m-t-15">
					<a href="#" class="image">
						<img data-echo=\"{{ asset('assets/images/brands/brand1.png') }}\" src=\"{{ asset('assets/images/blank.gif') }}\" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item m-t-10">
					<a href="#" class="image">
						<img data-echo=\"{{ asset('assets/images/brands/brand2.png') }}\" src=\"{{ asset('assets/images/blank.gif') }}\" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo=\"{{ asset('assets/images/brands/brand3.png') }}\" src=\"{{ asset('assets/images/blank.gif') }}\" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo=\"{{ asset('assets/images/brands/brand4.png') }}\" src=\"{{ asset('assets/images/blank.gif') }}\" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo=\"{{ asset('assets/images/brands/brand5.png') }}\" src=\"{{ asset('assets/images/blank.gif') }}\" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo=\"{{ asset('assets/images/brands/brand6.png') }}\" src=\"{{ asset('assets/images/blank.gif') }}\" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo=\"{{ asset('assets/images/brands/brand2.png') }}\" src=\"{{ asset('assets/images/blank.gif') }}\" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo=\"{{ asset('assets/images/brands/brand4.png') }}\" src=\"{{ asset('assets/images/blank.gif') }}\" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo=\"{{ asset('assets/images/brands/brand1.png') }}\" src=\"{{ asset('assets/images/blank.gif') }}\" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo=\"{{ asset('assets/images/brands/brand5.png') }}\" src=\"{{ asset('assets/images/blank.gif') }}\" alt="">
					</a>	
				</div><!--/.item-->
		    </div><!-- /.owl-carousel #logo-slider -->
		</div><!-- /.logo-slider-inner -->
	
</div><!-- /.logo-slider -->
<!-- ============================================== BRANDS CAROUSEL : END ============================================== -->	</div><!-- /.container -->
</div><!-- /.body-content -->

@endsection
