@extends('frontend.app')

@section('content')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class='active'>My Account</li>
            </ul>
        </div>
    </div>
</div>

<div class="body-content outer-top-xs" id="top-banner-and-menu">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-3 sidebar">
                <div class="side-menu animate-dropdown outer-bottom-xs">
                    <div class="head" style="background-color: #27ae60; color: #fff; padding: 12px 18px; font-weight: 600;"><i class="icon fa fa-user fa-fw"></i> My Account</div>
                    <nav class="yamm megamenu-horizontal">
                        <ul class="nav">
                            <li style="border-bottom: 1px solid #f1f5f9;"><a href="{{ route('dashboard') }}" style="padding: 12px 18px; display: block; color: #555;"><i class="icon fa fa-dashboard fa-fw"></i> Dashboard</a></li>
                            <li style="border-bottom: 1px solid #f1f5f9;"><a href="{{ route('my-wishlist') }}" style="padding: 12px 18px; display: block; color: #555;"><i class="icon fa fa-heart fa-fw"></i> Wishlist</a></li>
                            <li style="border-bottom: 1px solid #f1f5f9;"><a href="{{ route('track-orders') }}" style="padding: 12px 18px; display: block; color: #555;"><i class="icon fa fa-truck fa-fw"></i> Track Orders</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" id="sidebar-logout-form" style="display: none;">
                                    @csrf
                                </form>
                                <a href="#" onclick="event.preventDefault(); document.getElementById('sidebar-logout-form').submit();" style="padding: 12px 18px; display: block; color: #555;">
                                    <i class="icon fa fa-sign-out fa-fw"></i> Logout
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-9">
                <div class="sign-in-page" style="margin-bottom: 30px; padding: 25px; background: #fff; border: 1px solid #eaeaea; border-radius: 5px;">
                    <h4 style="margin-top: 0; color: #1e293b;">Welcome, {{ Auth::user()->name }}!</h4>
                    <p style="color: #64748b; margin-bottom: 20px;">From your account dashboard you can view your recent orders, manage your shipping and billing addresses, and edit your password and account details.</p>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div style="background: #f8fafc; border: 1px solid #e2e8f0; padding: 20px; border-radius: 5px; text-align: center; margin-bottom: 15px;">
                                <i class="fa fa-shopping-bag" style="font-size: 30px; color: #27ae60; margin-bottom: 10px;"></i>
                                <h5>Orders</h5>
                                <a href="{{ route('track-orders') }}" class="btn btn-primary btn-sm" style="margin-top: 10px;">View Orders</a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div style="background: #f8fafc; border: 1px solid #e2e8f0; padding: 20px; border-radius: 5px; text-align: center; margin-bottom: 15px;">
                                <i class="fa fa-heart" style="font-size: 30px; color: #27ae60; margin-bottom: 10px;"></i>
                                <h5>Wishlist</h5>
                                <a href="{{ route('my-wishlist') }}" class="btn btn-primary btn-sm" style="margin-top: 10px;">View Wishlist</a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div style="background: #f8fafc; border: 1px solid #e2e8f0; padding: 20px; border-radius: 5px; text-align: center; margin-bottom: 15px;">
                                <i class="fa fa-user" style="font-size: 30px; color: #27ae60; margin-bottom: 10px;"></i>
                                <h5>Profile</h5>
                                <a href="#" class="btn btn-primary btn-sm" style="margin-top: 10px;">Edit Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
