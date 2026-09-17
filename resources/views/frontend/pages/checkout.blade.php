@extends('frontend.app')

@section('content')
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="#">Home</a></li>
				<li class='active'>Checkout</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
	<div class="container">
		<div class="checkout-box ">
			<form action="{{ route('checkout.store') }}" method="POST">
				@csrf
				<div class="row">
					<div class="col-xs-12 col-sm-8 col-md-8 rht-col">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="unicase-checkout-title">Billing & Shipping Information</h4>
							</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-md-6 form-group">
										<label>First Name <span>*</span></label>
										<input type="text" name="first_name" class="form-control" value="{{ Auth::check() ? explode(' ', Auth::user()->name)[0] : old('first_name') }}" required>
									</div>
									<div class="col-md-6 form-group">
										<label>Last Name <span>*</span></label>
										<input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" required>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 form-group">
										<label>Email Address <span>*</span></label>
										<input type="email" name="email" class="form-control" value="{{ Auth::check() ? Auth::user()->email : old('email') }}" required>
									</div>
									<div class="col-md-6 form-group">
										<label>Phone Number <span>*</span></label>
										<input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
									</div>
								</div>
								<div class="form-group">
									<label>Address <span>*</span></label>
									<textarea name="address" class="form-control" rows="3" required>{{ old('address') }}</textarea>
								</div>
								<div class="row">
									<div class="col-md-6 form-group">
										<label>Town / City <span>*</span></label>
										<input type="text" name="city" class="form-control" value="{{ old('city') }}" required>
									</div>
									<div class="col-md-6 form-group">
										<label>Postcode / ZIP <span>*</span></label>
										<input type="text" name="zip_code" class="form-control" value="{{ old('zip_code') }}" required>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-4">
						<!-- checkout-progress-sidebar -->
						<div class="checkout-progress-sidebar ">
							<div class="panel-group">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="unicase-checkout-title">Your Order</h4>
									</div>
									<div class="panel-body">
										<ul class="nav nav-checkout-progress list-unstyled">
											@if(isset($cart) && count($cart) > 0)
												@foreach($cart as $item)
												<li style="border-bottom: 1px solid #eee; padding-bottom: 10px; margin-bottom: 10px;">
													<strong>{{ $item['name'] }}</strong> x {{ $item['quantity'] }}
													<span class="pull-right">${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
												</li>
												@endforeach
											@endif
											<li style="margin-top: 20px; font-size: 18px; font-weight: bold; color: #158cba;">
												Order Total:
												<span class="pull-right">${{ isset($total) ? number_format($total, 2) : '0.00' }}</span>
											</li>
										</ul>
										<hr>
										<div class="form-group">
											<div class="radio">
												<label>
													<input type="radio" name="payment_method" value="cod" checked>
													Cash on Delivery
												</label>
											</div>
											<p class="text-muted" style="font-size: 12px; margin-left: 20px;">Pay with cash upon delivery.</p>
										</div>
										<button type="submit" class="btn btn-primary btn-block" style="margin-top: 20px;">PLACE ORDER</button>
									</div>
								</div>
							</div>
						</div> 
						<!-- checkout-progress-sidebar -->
					</div>
				</div><!-- /.row -->
			</form>
		</div><!-- /.checkout-box -->
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
