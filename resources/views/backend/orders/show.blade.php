@extends('backend.layouts.app')

@section('title', 'Order Details')
@section('page_header', 'Order Details')

@section('breadcrumb')
  <div class="section-header-breadcrumb">
    <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
    <div class="breadcrumb-item"><a href="{{ route('admin.orders') }}">Orders</a></div>
    <div class="breadcrumb-item active">Details</div>
  </div>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Items from Order #{{ $order->id }}</h4>

                <div class="table-responsive">
                    <table class="table table-bordered table-centered mb-0 text-dark">
                        <thead class="table-light">
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
                            <tr>
                                <td colspan="3" class="text-end fw-bold">Grand Total:</td>
                                <td class="fw-bold">${{ number_format($order->total_amount, 2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Order Status</h4>
                <form action="{{ route('admin.orders.status', $order->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <select name="order_status" class="form-select">
                            <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $order->order_status == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="shipped" {{ $order->order_status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                            <option value="delivered" {{ $order->order_status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="cancelled" {{ $order->order_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Update Status</button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Billing & Shipping Info</h4>
                <ul class="list-unstyled mb-0 text-dark">
                    <li>
                        <p class="mb-2"><span class="fw-bold me-2">Name:</span> {{ $order->first_name }} {{ $order->last_name }}</p>
                        <p class="mb-2"><span class="fw-bold me-2">Email:</span> {{ $order->email }}</p>
                        <p class="mb-2"><span class="fw-bold me-2">Phone:</span> {{ $order->phone }}</p>
                        <p class="mb-2"><span class="fw-bold me-2">Address:</span> {{ $order->address }}</p>
                        <p class="mb-2"><span class="fw-bold me-2">City:</span> {{ $order->city }}</p>
                        <p class="mb-0"><span class="fw-bold me-2">ZIP Code:</span> {{ $order->zip_code }}</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
