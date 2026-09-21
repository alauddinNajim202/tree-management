@extends('frontend.app')

@section('content')
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="home.html">Home</a></li>
				<li class='active'>Compare</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content outer-top-xs">
	<div class="container">
    <div class="product-comparison">
		<div>
			<h1 class="page-title text-center heading-title">Product Comparison</h1>
			<div class="table-responsive">
				<table class="table compare-table inner-top-vs">
					@if($compareProducts->count() > 0)
						<tr>
							<th>Products</th>
							@foreach($compareProducts as $product)
							<td>
								<div class="product">
									<div class="product-image">
										<div class="image">
											<a href="{{ route('product.detail', $product->slug) }}">
												<img alt="{{ $product->name }}" src="{{ asset($product->thumbnail) }}">
											</a>
										</div>
										<div class="product-info text-left">
											<h3 class="name"><a href="{{ route('product.detail', $product->slug) }}">{{ $product->name }}</a></h3>
											<div class="action mt-2">
												<form action="{{ route('cart.add', $product->id) }}" method="POST">
													@csrf
													<input type="hidden" name="quantity" value="1">
													<button type="submit" class="lnk btn btn-primary" style="margin-top: 10px;">Add To Cart</button>
												</form>
											</div>
										</div>
									</div>
								</div>
							</td>
							@endforeach
						</tr>

						<tr>
							<th>Price</th>
							@foreach($compareProducts as $product)
							<td>
								<div class="product-price">
									@if($product->discount_price)
										<span class="price"> ${{ number_format($product->discount_price, 2) }} </span>
										<span class="price-before-discount">${{ number_format($product->price, 2) }}</span>
									@else
										<span class="price"> ${{ number_format($product->price, 2) }} </span>
									@endif
								</div>
							</td>
							@endforeach
						</tr>

						<tr>
							<th>Description</th>
							@foreach($compareProducts as $product)
							<td><p class="text">{!! Str::limit(strip_tags($product->description), 150) !!}</p></td>
							@endforeach
						</tr>

						<tr>
							<th>Availability</th>
							@foreach($compareProducts as $product)
							<td>
								@if($product->quantity > 0)
									<p class="in-stock" style="color: #4CAF50;">In Stock</p>
								@else
									<p class="out-of-stock" style="color: red;">Out of Stock</p>
								@endif
							</td>
							@endforeach
						</tr>

						<tr>
							<th>Remove</th>
							@foreach($compareProducts as $product)
							<td class='text-center'>
								<a href="{{ route('compare.remove', $product->id) }}" class="remove-icon"><i class="fa fa-times"></i></a>
							</td>
							@endforeach
						</tr>
					@else
						<tr>
							<td class="text-center" style="padding: 40px;">
								<h4>Your compare list is empty.</h4>
								<a href="{{ route('category') }}" class="btn btn-primary" style="margin-top: 20px;">Continue Shopping</a>
							</td>
						</tr>
					@endif
				</table>
			</div>
            </div>
		</div>
	</div>
</div>

@endsection
