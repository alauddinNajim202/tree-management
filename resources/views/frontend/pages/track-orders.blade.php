@extends('frontend.app')

@section('content')
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="home.html">Home</a></li>
				<li class='active'>Track your orders</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
	<div class="container">
		<div class="track-order-page">
			<div class="row">
				<div class="col-md-{{ Auth::check() ? '5' : '12' }}">
					<h2 class="heading-title">Track your Order</h2>
					<span class="title-tag inner-top-ss">Please enter your Order ID in the box below and press Enter. This was given to you on your receipt and in the confirmation email you should have received. </span>
					
					@if(session('error'))
						<div class="alert alert-danger outer-top-xs">{{ session('error') }}</div>
					@endif

					<form class="register-form outer-top-xs" role="form" action="{{ route('track-orders.post') }}" method="POST">
						@csrf
						<div class="form-group">
							<label class="info-title" for="exampleOrderId1">Order ID</label>
							<input type="text" name="order_id" class="form-control unicase-form-control text-input" id="exampleOrderId1" placeholder="e.g. ORD-00001" required>
						</div>
						<div class="form-group">
							<label class="info-title" for="exampleBillingEmail1">Billing Email</label>
							<input type="email" name="email" class="form-control unicase-form-control text-input" id="exampleBillingEmail1" required>
						</div>
						<button type="submit" class="btn-upper btn btn-primary checkout-page-button">Track</button>
					</form>	
				</div>
				
				@if(Auth::check())
				<div class="col-md-7">
					<h2 class="heading-title">My Recent Orders</h2>
					<div class="table-responsive outer-top-xs">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Order ID</th>
									<th>Date</th>
									<th>Total</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@forelse($myOrders as $order)
								<tr>
									<td>ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</td>
									<td>{{ $order->created_at->format('d M Y') }}</td>
									<td>${{ number_format($order->total_amount, 2) }}</td>
									<td>
										<span class="badge" style="background-color: 
											{{ $order->order_status == 'pending' ? '#f0ad4e' : 
											($order->order_status == 'processing' ? '#5bc0de' : 
											($order->order_status == 'shipped' ? '#0275d8' : 
											($order->order_status == 'delivered' ? '#5cb85c' : '#d9534f'))) }}">
											{{ ucfirst($order->order_status) }}
										</span>
									</td>
									<td>
										<form action="{{ route('track-orders.post') }}" method="POST">
											@csrf
											<input type="hidden" name="order_id" value="{{ $order->id }}">
											<input type="hidden" name="email" value="{{ $order->email }}">
											<button type="submit" class="btn btn-sm btn-info" style="color:white; padding: 2px 10px;">Track</button>
										</form>
									</td>
								</tr>
								@empty
								<tr>
									<td colspan="5" class="text-center">You haven't placed any orders yet.</td>
								</tr>
								@endforelse
							</tbody>
						</table>
					</div>
				</div>
				@endif
			</div><!-- /.row -->
		</div><!-- /.track-order-page-->
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
