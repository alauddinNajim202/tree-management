@extends('frontend.app')

@section('content')
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="{{ route('home') }}">Home</a></li>
				<li><a href="{{ route('track-orders') }}">Track your orders</a></li>
				<li class='active'>Result</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
	<div class="container">
		<div class="track-order-page">
			<div class="row">
				<div class="col-md-12">
					<h2 class="heading-title">Order #ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</h2>
				</div>
            </div>
            <div class="row mt-4" style="margin-top: 30px;">
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">Order Status</div>
                        <div class="panel-body">
                            <h3 style="color: 
                                {{ $order->order_status == 'pending' ? '#f0ad4e' : 
                                ($order->order_status == 'processing' ? '#5bc0de' : 
                                ($order->order_status == 'shipped' ? '#0275d8' : 
                                ($order->order_status == 'delivered' ? '#5cb85c' : '#d9534f'))) }}; text-transform: uppercase; margin-bottom: 20px;">
                                Current Status: {{ $order->order_status }}
                            </h3>
                            
                            <h4>Items Ordered:</h4>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->items as $item)
                                        <tr>
                                            <td>{{ $item->product_name }}</td>
                                            <td>${{ number_format($item->price, 2) }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>${{ number_format($item->total, 2) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" class="text-right">Grand Total:</th>
                                            <th>${{ number_format($order->total_amount, 2) }}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">Order Information</div>
                        <div class="panel-body">
                            <p><strong>Date:</strong> {{ $order->created_at->format('d M Y, h:i A') }}</p>
                            <p><strong>Name:</strong> {{ $order->first_name }} {{ $order->last_name }}</p>
                            <p><strong>Email:</strong> {{ $order->email }}</p>
                            <p><strong>Phone:</strong> {{ $order->phone }}</p>
                            <hr>
                            <p><strong>Shipping Address:</strong><br>
                                {{ $order->address }}<br>
                                {{ $order->city }} - {{ $order->zip_code }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
		</div>
    </div>
</div>
@endsection
