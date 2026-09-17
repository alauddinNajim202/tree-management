@extends('frontend.app')

@section('content')
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="#">Home</a></li>
				<li class='active'>Shopping Cart</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content outer-top-xs">
	<div class="container">
		<div class="row ">
			<div class="shopping-cart">
				<div class="shopping-cart-table ">
	<div class="table-responsive">
		<table class="table">
			<thead>
				<tr>
					<th class="cart-romove item">Remove</th>
					<th class="cart-description item">Image</th>
					<th class="cart-product-name item">Product Name</th>
					<th class="cart-edit item">Edit</th>
					<th class="cart-qty item">Quantity</th>
					<th class="cart-sub-total item">Subtotal</th>
					<th class="cart-total last-item">Grandtotal</th>
				</tr>
			</thead><!-- /thead -->
			
			<tbody>
				@if(isset($cart) && count($cart) > 0)
					@foreach($cart as $id => $item)
					{{-- @dd($item) --}}
					<tr>
						<td class="romove-item"><a href="{{ route('cart.remove', $id) }}" title="cancel" class="icon"><i class="fa fa-trash-o"></i></a></td>
						<td class="cart-image">
							<a class="entry-thumbnail" href="{{ route('product.detail', $item['slug']) }}">
							    <img src="{{ asset(($item['image'])) }}" alt="">
							</a>
						</td>
						<td class="cart-product-name-info">
							<h4 class='cart-product-description'><a href="{{ route('product.detail', $item['slug']) }}">{{ $item['name'] }}</a></h4>
							<div class="cart-product-info">
								<span class="product-color">Price:<span>${{ number_format($item['price'], 2) }}</span></span>
							</div>
						</td>
						<td class="cart-product-edit"></td>
						<td class="cart-product-quantity">
							<form action="{{ route('cart.update') }}" method="POST" class="form-inline">
								@csrf
								<input type="hidden" name="id" value="{{ $id }}">
								<div class="cart-quantity">
									<div class="quant-input">
						                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" style="width: 70px; padding: 5px;">
					              	</div>
					            </div>
								<button type="submit" class="btn btn-primary btn-sm" style="margin-top: 5px;"><i class="fa fa-refresh"></i></button>
							</form>
			            </td>
						<td class="cart-product-sub-total"><span class="cart-sub-total-price">${{ number_format($item['price'] * $item['quantity'], 2) }}</span></td>
						<td class="cart-product-grand-total"><span class="cart-grand-total-price">${{ number_format($item['price'] * $item['quantity'], 2) }}</span></td>
					</tr>
					@endforeach
				@else
					<tr>
						<td colspan="7" class="text-center" style="padding: 30px;">
							<h4>Your shopping cart is empty!</h4>
						</td>
					</tr>
				@endif
			</tbody><!-- /tbody -->
            
            <tfoot>
				<tr>
					<td colspan="7">
						<div class="shopping-cart-btn">
							<span class="">
								<a href="#" class="btn btn-upper btn-primary outer-left-xs">Continue Shopping</a>
								<a href="#" class="btn btn-upper btn-primary pull-right outer-right-xs">Update shopping cart</a>
							</span>
						</div><!-- /.shopping-cart-btn -->
					</td>
				</tr>
			</tfoot>
		</table><!-- /table -->
	</div>
</div><!-- /.shopping-cart-table -->				<div class="col-md-4 col-sm-12 estimate-ship-tax">
	<table class="table">
		<thead>
			<tr>
				<th>
					<span class="estimate-title">Estimate shipping and tax</span>
					<p>Enter your destination to get shipping and tax.</p>
				</th>
			</tr>
		</thead><!-- /thead -->
		<tbody>
				<tr>
					<td>
						<div class="form-group">
							<label class="info-title control-label">Country <span>*</span></label>
							<select class="form-control unicase-form-control selectpicker">
								<option>--Select options--</option>
								<option>India</option>
								<option>SriLanka</option>
								<option>united kingdom</option>
								<option>saudi arabia</option>
								<option>united arab emirates</option>
							</select>
						</div>
						<div class="form-group">
							<label class="info-title control-label">State/Province <span>*</span></label>
							<select class="form-control unicase-form-control selectpicker">
								<option>--Select options--</option>
								<option>TamilNadu</option>
								<option>Kerala</option>
								<option>Andhra Pradesh</option>
								<option>Karnataka</option>
								<option>Madhya Pradesh</option>
							</select>
						</div>
						<div class="form-group">
							<label class="info-title control-label">Zip/Postal Code</label>
							<input type="text" class="form-control unicase-form-control text-input" placeholder="">
						</div>
						<div class="pull-right">
							<button type="submit" class="btn-upper btn btn-primary">GET A QOUTE</button>
						</div>
					</td>
				</tr>
		</tbody>
	</table>
</div><!-- /.estimate-ship-tax -->

<div class="col-md-4 col-sm-12 estimate-ship-tax">
	<table class="table">
		<thead>
			<tr>
				<th>
					<span class="estimate-title">Discount Code</span>
					<p>Enter your coupon code if you have one..</p>
				</th>
			</tr>
		</thead>
		<tbody>
				<tr>
					<td>
						<div class="form-group">
							<input type="text" class="form-control unicase-form-control text-input" placeholder="You Coupon..">
						</div>
						<div class="clearfix pull-right">
							<button type="submit" class="btn-upper btn btn-primary">APPLY COUPON</button>
						</div>
					</td>
				</tr>
		</tbody><!-- /tbody -->
	</table><!-- /table -->
</div><!-- /.estimate-ship-tax -->

<div class="col-md-4 col-sm-12 cart-shopping-total">
	<table class="table">
		<thead>
			<tr>
				<th>
					<div class="cart-sub-total">
						Subtotal<span class="inner-left-md">${{ isset($total) ? number_format($total, 2) : '0.00' }}</span>
					</div>
					<div class="cart-grand-total">
						Grand Total<span class="inner-left-md">${{ isset($total) ? number_format($total, 2) : '0.00' }}</span>
					</div>
				</th>
			</tr>
		</thead><!-- /thead -->
		<tbody>
				<tr>
					<td>
						<div class="cart-checkout-btn pull-right">
							<a href="{{ route('checkout') }}" class="btn btn-primary checkout-btn">PROCEED TO CHECKOUT</a>
						</div>
					</td>
				</tr>
		</tbody><!-- /tbody -->
	</table><!-- /table -->
</div><!-- /.cart-shopping-total -->			</div><!-- /.shopping-cart -->
		</div> <!-- /.row -->
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
