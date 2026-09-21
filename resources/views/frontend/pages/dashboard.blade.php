@extends('frontend.app')

@section('content')
<!-- MODERN PAGE HEADER -->
<div class="modern-page-header">
    <div class="container">
        <h1 class="page-title">My Account</h1>
        <ul class="breadcrumb">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li class="active">My Account</li>
        </ul>
    </div>
</div>

<div class="body-content modern-dashboard-wrapper">
    <div class="container">
        <div class="row">
            <!-- SIDEBAR -->
            <div class="col-xs-12 col-sm-12 col-md-3">
                <div class="modern-sidebar">
                    <div class="sidebar-header">
                        <div class="user-avatar">
                            <i class="fa fa-user-circle"></i>
                        </div>
                        <h4 class="user-name">{{ Auth::user()->name }}</h4>
                    </div>
                    <ul class="sidebar-nav">
                        <li>
                            <a href="{{ route('dashboard') }}" class="active">
                                <i class="fa fa-th-large"></i> Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('my-wishlist') }}">
                                <i class="fa fa-heart"></i> Wishlist
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('track-orders') }}">
                                <i class="fa fa-truck"></i> Track Orders
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('compare.index') }}">
                                <i class="fa fa-signal"></i> Compare
                            </a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" id="sidebar-logout-form" style="display: none;">
                                @csrf
                            </form>
                            <a href="#" onclick="event.preventDefault(); document.getElementById('sidebar-logout-form').submit();" class="logout-btn">
                                <i class="fa fa-sign-out"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- MAIN CONTENT -->
            <div class="col-xs-12 col-sm-12 col-md-9">
                <div class="modern-dashboard-content">
                    
                    <div class="dashboard-welcome">
                        <h2>Welcome back, <span>{{ Auth::user()->name }}</span>!</h2>
                        <p>From your account dashboard you can view your recent orders, manage your shipping and billing addresses, and edit your password and account details.</p>
                    </div>

                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            <div class="dashboard-stat-card">
                                <div class="stat-icon">
                                    <i class="fa fa-shopping-bag"></i>
                                </div>
                                <div class="stat-info">
                                    <h3>Orders</h3>
                                    <p>Check your order status</p>
                                    <a href="{{ route('track-orders') }}" class="btn btn-primary btn-sm">View Orders</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4 col-sm-6">
                            <div class="dashboard-stat-card">
                                <div class="stat-icon wishlist">
                                    <i class="fa fa-heart"></i>
                                </div>
                                <div class="stat-info">
                                    <h3>Wishlist</h3>
                                    <p>Your saved items</p>
                                    <a href="{{ route('my-wishlist') }}" class="btn btn-primary btn-sm">View Wishlist</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6">
                            <div class="dashboard-stat-card">
                                <div class="stat-icon profile">
                                    <i class="fa fa-user"></i>
                                </div>
                                <div class="stat-info">
                                    <h3>Profile</h3>
                                    <p>Manage account details</p>
                                    <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-sm">Edit Profile</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6" style="margin-top: 15px;">
                            <div class="dashboard-stat-card">
                                <div class="stat-icon" style="background-color: #f39c12;">
                                    <i class="fa fa-signal"></i>
                                </div>
                                <div class="stat-info">
                                    <h3>Compare</h3>
                                    <p>Compare products</p>
                                    <a href="{{ route('compare.index') }}" class="btn btn-primary btn-sm">Compare</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
