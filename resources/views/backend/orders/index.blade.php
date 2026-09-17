@extends('backend.layouts.app')

@section('title', 'Manage Orders')
@section('page_header', 'Manage Orders')

@section('breadcrumb')
  <div class="section-header-breadcrumb">
    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
    <div class="breadcrumb-item">Orders</div>
  </div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <div class="table-responsive">
                    <table class="table table-centered table-nowrap mb-0 text-dark">
                        <thead class="table-light">
                            <tr>
                                <th>Order ID</th>
                                <th>Customer Name</th>
                                <th>Email</th>
                                <th>Date</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                            <tr>
                                <td><a href="{{ route('admin.orders.show', $order->id) }}" class="text-body fw-bold">ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</a></td>
                                <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                                <td>{{ $order->email }}</td>
                                <td>{{ $order->created_at->format('d M Y, h:i A') }}</td>
                                <td>${{ number_format($order->total_amount, 2) }}</td>
                                <td>
                                    @if($order->order_status == 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif($order->order_status == 'processing')
                                        <span class="badge bg-info">Processing</span>
                                    @elseif($order->order_status == 'shipped')
                                        <span class="badge bg-primary">Shipped</span>
                                    @elseif($order->order_status == 'delivered')
                                        <span class="badge bg-success">Delivered</span>
                                    @else
                                        <span class="badge bg-danger">Cancelled</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-primary">
                                        <i class="mdi mdi-eye"></i> View
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">No orders found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {{ $orders->links('pagination::bootstrap-4') }}
                </div>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col -->
</div>
@endsection
