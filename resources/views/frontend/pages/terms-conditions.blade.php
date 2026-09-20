@extends('frontend.app')

@section('content')
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="#">Home</a></li>
				<li class='active'>Terms & Conditions</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
	<div class="container">
		<div class="terms-conditions-page">
			<div class="row">
				<div class="col-md-12 terms-conditions">
	<h2 class="heading-title">Terms and Conditions</h2>
	<div class="">
		@if($content)
			{!! $content !!}
		@else
			<p>Terms and Conditions will be updated soon.</p>
		@endif
	</div>
</div>			</div><!-- /.row -->
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
