@extends('backend.layouts.app')
@section('title', 'Ecommerce Dashboard')
@section('page_header', 'Ecommerce Dashboard')

@push('css-libraries')
  <link rel="stylesheet" href="{{ asset('backend/assets/modules/jqvmap/dist/jqvmap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/modules/summernote/summernote-bs4.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css') }}">
@endpush

@section('content')
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-stats">
                  <div class="card-stats-title">Order Statistics (This Month)</div>
                  <div class="card-stats-items">
                    <div class="card-stats-item">
                      <div class="card-stats-item-count">{{ $pendingOrders }}</div>
                      <div class="card-stats-item-label">Pending</div>
                    </div>
                    <div class="card-stats-item">
                      <div class="card-stats-item-count">{{ $shippedOrders }}</div>
                      <div class="card-stats-item-label">Shipping</div>
                    </div>
                    <div class="card-stats-item">
                      <div class="card-stats-item-count">{{ $completedOrders }}</div>
                      <div class="card-stats-item-label">Completed</div>
                    </div>
                  </div>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-archive"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Orders</h4>
                  </div>
                  <div class="card-body">
                    {{ $totalOrdersCount }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-chart">
                  <!-- Small chart omitted for simplicity -->
                </div>
                <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Sales (This Month)</h4>
                  </div>
                  <div class="card-body">
                    ${{ number_format($totalSales, 2) }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-chart">
                  <!-- Small chart omitted for simplicity -->
                </div>
                <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-shopping-bag"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Products Out of Stock</h4>
                  </div>
                  <div class="card-body">
                    {{ $outOfStockProducts->count() }}
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-8">
              <div class="card">
                <div class="card-header">
                  <h4>Sales (Last 7 Days)</h4>
                </div>
                <div class="card-body">
                  <canvas id="myChart" height="158"></canvas>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="card gradient-bottom">
                <div class="card-header">
                  <h4>Top 5 Best Selling Products</h4>
                </div>
                <div class="card-body" id="top-5-scroll">
                  <ul class="list-unstyled list-unstyled-border">
                    @forelse($topProducts as $item)
                    <li class="media">
                      <img class="mr-3 rounded" width="55" src="{{ $item->product && $item->product->thumbnail ? asset($item->product->thumbnail) : asset('backend/assets/img/products/product-3-50.png') }}" alt="product">
                      <div class="media-body">
                        <div class="float-right"><div class="font-weight-600 text-muted text-small">{{ $item->total_sold }} Sold</div></div>
                        <div class="media-title">{{ $item->product ? $item->product->name : 'Unknown Product' }}</div>
                        <div class="mt-1">
                          <div class="budget-price">
                            <div class="budget-price-square bg-primary" data-width="64%"></div>
                            <div class="budget-price-label">${{ $item->product ? $item->product->price : '0.00' }}</div>
                          </div>
                        </div>
                      </div>
                    </li>
                    @empty
                    <li>No sales data available.</li>
                    @endforelse
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-8">
              <div class="card">
                <div class="card-header">
                  <h4>Recent Orders</h4>
                  <div class="card-header-action">
                    <a href="{{ route('admin.orders') }}" class="btn btn-danger">View All <i class="fas fa-chevron-right"></i></a>
                  </div>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive table-invoice">
                    <table class="table table-striped">
                      <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Action</th>
                      </tr>
                      @forelse($recentOrders as $order)
                      <tr>
                        <td><a href="{{ route('admin.orders.show', $order->id) }}">{{ $order->order_number }}</a></td>
                        <td class="font-weight-600">{{ $order->first_name }} {{ $order->last_name }}</td>
                        <td>
                            @if($order->order_status == 'pending')
                                <div class="badge badge-warning">Pending</div>
                            @elseif($order->order_status == 'delivered')
                                <div class="badge badge-success">Delivered</div>
                            @elseif($order->order_status == 'cancelled')
                                <div class="badge badge-danger">Cancelled</div>
                            @else
                                <div class="badge badge-primary">{{ ucfirst($order->order_status) }}</div>
                            @endif
                        </td>
                        <td>${{ number_format($order->total_amount, 2) }}</td>
                        <td>
                          <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-primary">Detail</a>
                        </td>
                      </tr>
                      @empty
                      <tr>
                          <td colspan="5" class="text-center">No recent orders found.</td>
                      </tr>
                      @endforelse
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card card-hero">
                <div class="card-header" style="background-image: none; background-color: #fc544b;">
                  <div class="card-icon">
                    <i class="fas fa-exclamation-triangle" style="color: rgba(255, 255, 255, 0.4);"></i>
                  </div>
                  <h4>{{ $outOfStockProducts->count() }}</h4>
                  <div class="card-description">Products Out of Stock</div>
                </div>
                <div class="card-body p-0">
                  <div class="tickets-list">
                    @forelse($outOfStockProducts as $product)
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="ticket-item">
                      <div class="ticket-title">
                        <h4>{{ $product->name }}</h4>
                      </div>
                      <div class="ticket-info">
                        <div>Category: {{ $product->category ? $product->category->name : 'N/A' }}</div>
                        <div class="bullet"></div>
                        <div class="text-danger">0 in stock</div>
                      </div>
                    </a>
                    @empty
                    <div class="p-4 text-center">
                        All products are currently well-stocked.
                    </div>
                    @endforelse
                    <a href="{{ route('admin.inventory.index') }}" class="ticket-item ticket-more">
                      View Inventory <i class="fas fa-chevron-right"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
@endsection

@push('js-libraries')
  <script src="{{ asset('backend/assets/modules/chart.min.js') }}"></script>
  <script src="{{ asset('backend/assets/modules/owlcarousel2/dist/owl.carousel.min.js') }}"></script>
@endpush

@push('page-scripts')
  <script>
    "use strict";

    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: {!! json_encode($chartLabels) !!},
        datasets: [{
          label: 'Sales',
          data: {!! json_encode($chartData) !!},
          borderWidth: 2,
          backgroundColor: 'rgba(63,82,227,.8)',
          borderColor: 'transparent',
          pointBorderWidth: 0,
          pointRadius: 3.5,
          pointBackgroundColor: 'transparent',
          pointHoverBackgroundColor: 'rgba(63,82,227,.8)',
        }]
      },
      options: {
        legend: {
          display: false
        },
        scales: {
          yAxes: [{
            gridLines: {
              drawBorder: false,
              color: '#f2f2f2',
            },
            ticks: {
              beginAtZero: true,
              callback: function(value, index, values) {
                return '$' + value;
              }
            }
          }],
          xAxes: [{
            gridLines: {
              display: false,
              tickMarkLength: 15,
            }
          }]
        },
      }
    });
  </script>
@endpush
