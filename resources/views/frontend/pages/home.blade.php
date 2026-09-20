@extends('frontend.app')

@section('content')
    <div class="body-content" id="top-banner-and-menu" style="padding-top: 20px;">
        <div class="container">
            <div class="row">
                <!-- ============================================== SIDEBAR ============================================== -->
                <div class="col-xs-12 col-sm-12 col-md-3 sidebar">

                    <!-- ================================== TOP NAVIGATION ================================== -->
                    <div class="side-menu animate-dropdown outer-bottom-xs">
                        <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>
                        <nav class="yamm megamenu-horizontal">
                            <ul class="nav">

                                @foreach ($homeCategories as $category)
                                    <li class="dropdown menu-item">
                                        <a href="{{ route('category') }}?category={{ $category->slug }}"
                                            class="dropdown-toggle" data-toggle="dropdown">
                                            <i class="icon fa fa-shopping-bag" aria-hidden="true"></i>
                                            {{ $category->name }}
                                        </a>

                                        @if ($category->children->count() > 0)
                                            <ul class="dropdown-menu mega-menu">
                                                <li class="yamm-content">
                                                    <div class="row">
                                                        @foreach ($category->children->chunk(4) as $chunk)
                                                            <div class="col-sm-12 col-md-3">
                                                                <ul class="links list-unstyled">
                                                                    @foreach ($chunk as $subCategory)
                                                                        <li><a
                                                                                href="{{ route('category') }}?category={{ $subCategory->slug }}">{{ $subCategory->name }}</a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </li>
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                                <!-- /.menu-item -->

                            </ul>
                            <!-- /.nav -->
                        </nav>
                        <!-- /.megamenu-horizontal -->
                    </div>
                    <!-- /.side-menu -->
                    <!-- ================================== TOP NAVIGATION : END ================================== -->

                                        <!-- ============================================== HOT DEALS ============================================== -->
                    <div class="sidebar-widget hot-deals outer-bottom-xs">
                        <h3 class="section-title">Hot deals</h3>
                        <div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-ss">
                            @foreach($hotDeals as $deal)
                            <div class="item">
                                <div class="products">
                                    <div class="hot-deal-wrapper">
                                        <div class="image">
                                            <a href="{{ route('product.detail', $deal->slug) }}">
                                                <img src="{{ asset($deal->thumbnail) }}" alt="{{ $deal->name }}">
                                                <img src="{{ asset($deal->thumbnail) }}" alt="{{ $deal->name }}" class="hover-image">
                                            </a>
                                        </div>
                                        <div class="sale-offer-tag"><span>HOT<br>deal</span></div>
                                        <div class="timing-wrapper">
                                            <div class="box-wrapper">
                                                <div class="date box"> <span class="key">120</span> <span class="value">DAYS</span> </div>
                                            </div>
                                            <div class="box-wrapper">
                                                <div class="hour box"> <span class="key">20</span> <span class="value">HRS</span> </div>
                                            </div>
                                            <div class="box-wrapper">
                                                <div class="minutes box"> <span class="key">36</span> <span class="value">MINS</span> </div>
                                            </div>
                                            <div class="box-wrapper">
                                                <div class="seconds box"> <span class="key">60</span> <span class="value">SEC</span> </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.hot-deal-wrapper -->

                                    <div class="product-info text-left m-t-20">
                                        <h3 class="name"><a href="{{ route('product.detail', $deal->slug) }}">{{ $deal->name }}</a></h3>
                                        <div class="rating rateit-small"></div>
                                        <div class="product-price"> 
                                            @if($deal->discount_price)
                                                <span class="price"> ${{ number_format($deal->discount_price, 2) }} </span> 
                                                <span class="price-before-discount">${{ number_format($deal->price, 2) }}</span> 
                                            @else
                                                <span class="price"> ${{ number_format($deal->price, 2) }} </span>
                                            @endif
                                        </div>
                                        <!-- /.product-price -->
                                    </div>
                                    <!-- /.product-info -->

                                    <div class="cart clearfix animate-effect">
                                        <div class="action">
                                            <div class="add-cart-button btn-group">
                                                <form action="{{ route('cart.add', $deal->id) }}" method="POST" class="d-inline" style="display: inline-block;">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $deal->id }}">
                                                    <input type="hidden" name="quantity" value="1">
                                                    <button class="btn btn-primary icon" type="submit"> <i class="fa fa-shopping-cart"></i> </button>
                                                    <button class="btn btn-primary cart-btn" type="submit">Add to cart</button>
                                                </form>
                                                <a href="{{ route('wishlist.add', $deal->id) }}" class="btn btn-primary icon" title="Wishlist" style="margin-left: 5px;">
                                                    <i class="fa fa-heart"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <!-- /.action -->
                                    </div>
                                    <!-- /.cart -->
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <!-- /.sidebar-widget -->
                    </div>
                    <!-- ============================================== HOT DEALS: END ============================================== -->

                                        <!-- ============================================== SPECIAL OFFER ============================================== -->
                    <div class="sidebar-widget outer-bottom-small wow fadeInUp">
                        <h3 class="section-title">Special Offer</h3>
                        <div class="sidebar-widget-body outer-top-xs">
                            <div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">
                                <div class="item">
                                    <div class="products special-product">
                                        @foreach($specialOffers->take(3) as $offer)
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image"> <a href="{{ route('product.detail', $offer->slug) }}"> <img src="{{ asset($offer->thumbnail) }}" alt="{{ $offer->name }}"> </a> </div>
                                                            <!-- /.image -->
                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="{{ route('product.detail', $offer->slug) }}">{{ $offer->name }}</a></h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="product-price"> 
                                                                @if($offer->discount_price)
                                                                    <span class="price"> ${{ number_format($offer->discount_price, 2) }} </span> 
                                                                    <span class="price-before-discount" style="font-size: 11px;">${{ number_format($offer->price, 2) }}</span> 
                                                                @else
                                                                    <span class="price"> ${{ number_format($offer->price, 2) }} </span>
                                                                @endif
                                                            </div>
                                                            <!-- /.product-price -->
                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @if($specialOffers->count() > 3)
                                <div class="item">
                                    <div class="products special-product">
                                        @foreach($specialOffers->skip(3)->take(3) as $offer)
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image"> <a href="{{ route('product.detail', $offer->slug) }}"> <img src="{{ asset($offer->thumbnail) }}" alt="{{ $offer->name }}"> </a> </div>
                                                            <!-- /.image -->
                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="{{ route('product.detail', $offer->slug) }}">{{ $offer->name }}</a></h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="product-price"> 
                                                                @if($offer->discount_price)
                                                                    <span class="price"> ${{ number_format($offer->discount_price, 2) }} </span> 
                                                                    <span class="price-before-discount" style="font-size: 11px;">${{ number_format($offer->price, 2) }}</span> 
                                                                @else
                                                                    <span class="price"> ${{ number_format($offer->price, 2) }} </span>
                                                                @endif
                                                            </div>
                                                            <!-- /.product-price -->
                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        <!-- /.sidebar-widget-body -->
                    </div>
                    <!-- /.sidebar-widget -->
                    <!-- ============================================== SPECIAL OFFER : END ============================================== -->
                    <!-- ============================================== PRODUCT TAGS ============================================== -->
                    <div class="sidebar-widget product-tag">
                        <h3 class="section-title">Product tags</h3>
                        <div class="sidebar-widget-body outer-top-xs">
                            <div class="tag-list"> <a class="item" title="Phone" href="category.html">Phone</a> <a
                                    class="item active" title="Vest" href="category.html">Vest</a> <a class="item"
                                    title="Smartphone" href="category.html">Smartphone</a> <a class="item"
                                    title="Furniture" href="category.html">Furniture</a> <a class="item"
                                    title="T-shirt" href="category.html">T-shirt</a> <a class="item"
                                    title="Sweatpants" href="category.html">Sweatpants</a> <a class="item"
                                    title="Sneaker" href="category.html">Sneaker</a> <a class="item" title="Planters"
                                    href="category.html">Planters</a> <a class="item" title="Rose"
                                    href="category.html">Rose</a> </div>
                            <!-- /.tag-list -->
                        </div>
                        <!-- /.sidebar-widget-body -->
                    </div>
                    <!-- /.sidebar-widget -->
                    <!-- ============================================== PRODUCT TAGS : END ============================================== -->
                    <!-- ============================================== SPECIAL DEALS ============================================== -->

                    <div class="sidebar-widget outer-bottom-small">
                        <h3 class="section-title">Special Deals</h3>
                        <div class="sidebar-widget-body outer-top-xs">
                            <div
                                class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">
                                <div class="item">
                                    <div class="products special-product">
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image"> <a href="#"> <img
                                                                        src="{{ asset('assets/images/products/p8.jpg') }}"
                                                                        alt=""> </a> </div>
                                                            <!-- /.image -->

                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="#">Floral Print Shirt</a>
                                                            </h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="product-price"> <span class="price"> $450.99
                                                                </span> </div>
                                                            <!-- /.product-price -->

                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->

                                        </div>
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image"> <a href="#"> <img
                                                                        src="{{ asset('assets/images/products/p5.jpg') }}"
                                                                        alt=""> </a> </div>
                                                            <!-- /.image -->

                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="#">Floral Print Shirt</a>
                                                            </h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="product-price"> <span class="price"> $450.99
                                                                </span> </div>
                                                            <!-- /.product-price -->

                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->

                                        </div>
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image"> <a href="#"> <img
                                                                        src="{{ asset('assets/images/products/p6.jpg') }}"
                                                                        alt="image"> </a> </div>
                                                            <!-- /.image -->

                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="#">Floral Print Shirt</a>
                                                            </h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="product-price"> <span class="price"> $450.99
                                                                </span> </div>
                                                            <!-- /.product-price -->

                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->

                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="products special-product">
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image"> <a href="#"> <img
                                                                        src="{{ asset('assets/images/products/p8.jpg') }}"
                                                                        alt=""> </a> </div>
                                                            <!-- /.image -->

                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="#">Floral Print Shirt</a>
                                                            </h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="product-price"> <span class="price"> $450.99
                                                                </span> </div>
                                                            <!-- /.product-price -->

                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->

                                        </div>
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image"> <a href="#"> <img
                                                                        src="{{ asset('assets/images/products/p7.jpg') }}"
                                                                        alt=""> </a> </div>
                                                            <!-- /.image -->

                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="#">Floral Print Shirt</a>
                                                            </h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="product-price"> <span class="price"> $450.99
                                                                </span> </div>
                                                            <!-- /.product-price -->

                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->

                                        </div>
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image"> <a href="#"> <img
                                                                        src="{{ asset('assets/images/products/p6.jpg') }}"
                                                                        alt=""> </a> </div>
                                                            <!-- /.image -->

                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="#">Floral Print Shirt</a>
                                                            </h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="product-price"> <span class="price"> $450.99
                                                                </span> </div>
                                                            <!-- /.product-price -->
                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->

                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="products special-product">
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image"> <a href="#"> <img
                                                                        src="{{ asset('assets/images/products/p5.jpg') }}"
                                                                        alt="images">
                                                                    <div class="zoom-overlay"></div>
                                                                </a> </div>
                                                            <!-- /.image -->

                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="#">Floral Print Shirt</a>
                                                            </h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="product-price"> <span class="price"> $450.99
                                                                </span> </div>
                                                            <!-- /.product-price -->

                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->

                                        </div>
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image"> <a href="#"> <img
                                                                        src="{{ asset('assets/images/products/p4.jpg') }}"
                                                                        alt="">
                                                                    <div class="zoom-overlay"></div>
                                                                </a> </div>
                                                            <!-- /.image -->

                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="#">Floral Print Shirt</a>
                                                            </h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="product-price"> <span class="price"> $450.99
                                                                </span> </div>
                                                            <!-- /.product-price -->

                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->

                                        </div>
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image"> <a href="#"> <img
                                                                        src="{{ asset('assets/images/products/p13.jpg') }}"
                                                                        alt="image"> </a> </div>
                                                            <!-- /.image -->

                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="#">Floral Print Shirt</a>
                                                            </h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="product-price"> <span class="price"> $450.99
                                                                </span> </div>
                                                            <!-- /.product-price -->

                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.sidebar-widget-body -->
                    </div>
                    <!-- /.sidebar-widget -->
                    <!-- ============================================== SPECIAL DEALS : END ============================================== -->
                    <!-- ============================================== NEWSLETTER ============================================== -->
                    <div class="sidebar-widget newsletter outer-bottom-small">
                        <h3 class="section-title">Newsletters</h3>
                        <div class="sidebar-widget-body outer-top-xs">
                            <p>Sign Up for Our Newsletter!</p>
                            <form action="{{ route('subscribe') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label class="sr-only" for="exampleInputEmail1">Email address</label>
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                        placeholder="Subscribe to our newsletter" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Subscribe</button>
                            </form>
                        </div>
                        <!-- /.sidebar-widget-body -->
                    </div>
                    <!-- /.sidebar-widget -->
                    <!-- ============================================== NEWSLETTER: END ============================================== -->

                    <!-- ============================================== Testimonials============================================== -->
                    <div class="sidebar-widget outer-top-vs ">
                        <div id="advertisement" class="advertisement">
                            <div class="item">
                                <div class="avatar"><img src="{{ asset('assets/images/testimonials/member1.png') }}"
                                        alt="Image"></div>
                                <div class="testimonials"><em>"</em> Vtae sodales aliq uam morbi non sem lacus port mollis.
                                    Nunc condime tum metus eud molest sed consectetuer. Sed quia non numquam eius modi
                                    tempora incidunt ut labore et dolore magnam aliquam quaerat.<em>"</em></div>
                                <div class="clients_author">John Doe <span>Abc Company</span> </div>
                                <!-- /.container-fluid -->
                            </div>
                            <!-- /.item -->

                            <div class="item">
                                <div class="avatar"><img src="{{ asset('assets/images/testimonials/member3.png') }}"
                                        alt="Image"></div>
                                <div class="testimonials"><em>"</em>Vtae sodales aliq uam morbi non sem lacus port mollis.
                                    Nunc condime tum metus eud molest sed consectetuer. Sed quia non numquam eius modi
                                    tempora incidunt ut labore et dolore magnam aliquam quaerat.<em>"</em></div>
                                <div class="clients_author">Stephen Doe <span>Xperia Designs</span> </div>
                            </div>
                            <!-- /.item -->

                            <div class="item">
                                <div class="avatar"><img src="{{ asset('assets/images/testimonials/member2.png') }}"
                                        alt="Image"></div>
                                <div class="testimonials"><em>"</em>Vtae sodales aliq uam morbi non sem lacus port mollis.
                                    Nunc condime tum metus eud molest sed consectetuer. Sed quia non numquam eius modi
                                    tempora incidunt ut labore et dolore magnam aliquam quaerat.<em>"</em></div>
                                <div class="clients_author">Saraha Smith <span>Datsun &amp; Co</span> </div>
                                <!-- /.container-fluid -->
                            </div>
                            <!-- /.item -->

                        </div>
                        <!-- /.owl-carousel -->
                    </div>

                    <!-- ============================================== Testimonials: END ============================================== -->


                </div>
                <!-- /.sidemenu-holder -->
                <!-- ============================================== SIDEBAR : END ============================================== -->

                <!-- ============================================== CONTENT ============================================== -->
                <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">
                    <!-- ========================================== SECTION – HERO ========================================= -->

                    <div id="hero" class="hero-slider-modern">
                        <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
                            <div class="item" style="background-image: url(assets/images/sliders/01.jpg);">
                                <div class="container-fluid">
                                    <div class="caption bg-color vertical-center text-left">
                                        <div class="slider-header fadeInDown-1">Top Brands</div>
                                        <div class="big-text fadeInDown-1"> New Collections </div>
                                        <div class="excerpt fadeInDown-2 hidden-xs"> <span>Lorem ipsum dolor sit amet,
                                                consectetur adipisicing elit.</span> </div>
                                        <div class="button-holder fadeInDown-3"> <a
                                                href="index6c11.html?page=single-product"
                                                class="btn-lg btn btn-uppercase btn-primary shop-now-button">Shop Now</a>
                                        </div>
                                    </div>
                                    <!-- /.caption -->
                                </div>
                                <!-- /.container-fluid -->
                            </div>
                            <!-- /.item -->

                            <div class="item" style="background-image: url(assets/images/sliders/02.jpg);">
                                <div class="container-fluid">
                                    <div class="caption bg-color vertical-center text-left">
                                        <div class="slider-header fadeInDown-1">Spring 2024</div>
                                        <div class="big-text fadeInDown-1"> Berry Plants Fashion </div>
                                        <div class="excerpt fadeInDown-2 hidden-xs"> <span>Nemo enim ipsam voluptatem quia
                                                voluptas sit aspernatur aut odit aut fugit</span> </div>
                                        <div class="button-holder fadeInDown-3"> <a
                                                href="index6c11.html?page=single-product"
                                                class="btn-lg btn btn-uppercase btn-primary shop-now-button">Shop Now</a>
                                        </div>
                                    </div>
                                    <!-- /.caption -->
                                </div>
                                <!-- /.container-fluid -->
                            </div>
                            <!-- /.item -->

                        </div>
                        <!-- /.owl-carousel -->
                    </div>

                    <!-- ========================================= SECTION – HERO : END ========================================= -->


                    <!-- ============================================== SCROLL TABS ============================================== -->
                    <div id="product-tabs-slider" class="scroll-tabs outer-top-vs">
                        <div class="more-info-tab clearfix ">
                            <h3 class="new-product-title pull-left">New Products</h3>
                            <ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">
                                <li class="active"><a data-transition-type="backSlide" href="#all" data-toggle="tab">All</a></li>
                                @foreach($homeCategories as $category)
                                    <li><a data-transition-type="backSlide" href="#category-{{ $category->id }}" data-toggle="tab">{{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                            <!-- /.nav-tabs -->
                        </div>
                        <div class="tab-content outer-top-xs">
                            <div class="tab-pane in active" id="all">
                                <div class="product-slider">
                                    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme">
                                        @foreach($newProducts as $product)
                                            @include('frontend.partials._product_card', ['product' => $product])
                                        @endforeach
                                    </div>
                                    <!-- /.home-owl-carousel -->
                                </div>
                                <!-- /.product-slider -->
                            </div>
                            <!-- /.tab-pane -->

                            @foreach($homeCategories->take(3) as $category)
                                <div class="tab-pane" id="category-{{ $category->id }}">
                                    <div class="product-slider">
                                        <div class="owl-carousel home-owl-carousel custom-carousel owl-theme">
                                            @php
                                                // Get products for this category and its children
                                                $catIds = $category->children->pluck('id')->push($category->id);
                                                $catProducts = $products->whereIn('category_id', $catIds);
                                            @endphp
                                            @foreach($catProducts as $product)
                                                @include('frontend.partials._product_card', ['product' => $product])
                                            @endforeach
                                        </div>
                                        <!-- /.home-owl-carousel -->
                                    </div>
                                    <!-- /.product-slider -->
                                </div>
                                <!-- /.tab-pane -->
                            @endforeach
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- ============================================== SCROLL TABS : END ============================================== -->
                    <!-- ============================================== WIDE PRODUCTS ============================================== -->
                    <div class="wide-banners outer-bottom-xs">
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <div class="wide-banner cnt-strip">
                                    <div class="image"> <img class="img-responsive"
                                            src="{{ asset('assets/images/banners/home-banner1.jpg') }}" alt="">
                                    </div>
                                </div>
                                <!-- /.wide-banner -->
                            </div>

                            <div class="col-md-4 col-sm-4">
                                <div class="wide-banner cnt-strip">
                                    <div class="image"> <img class="img-responsive"
                                            src="{{ asset('assets/images/banners/home-banner3.jpg') }}" alt="">
                                    </div>
                                </div>
                                <!-- /.wide-banner -->
                            </div>

                            <!-- /.col -->
                            <div class="col-md-4 col-sm-4">
                                <div class="wide-banner cnt-strip">
                                    <div class="image"> <img class="img-responsive"
                                            src="{{ asset('assets/images/banners/home-banner2.jpg') }}" alt="">
                                    </div>
                                </div>
                                <!-- /.wide-banner -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.wide-banners -->

                    <!-- ============================================== WIDE PRODUCTS : END ============================================== -->
                    <!-- ============================================== FEATURED PRODUCTS ============================================== -->
                    <section class="section featured-product">
                        <div class="row">
                            <div class="col-lg-3">
                                <h3 class="section-title">Featured Products</h3>
                                <ul class="sub-cat">
                                    <li><a href="#">Plants</a></li>
                                    <li><a href="#">Air Condition</a></li>
                                </ul>
                            </div>
                            <div class="col-lg-9">
                                <div class="owl-carousel homepage-owl-carousel custom-carousel owl-theme outer-top-xs">
                                    @foreach($featuredProducts as $product)
                                    <div class="item item-carousel">
                                        <div class="products">
                                            <div class="product">
                                                <div class="product-image">
                                                    <div class="image">
                                                        <a href="{{ route('product.detail', $product->slug) }}">
                                                            <img src="{{ asset($product->thumbnail) }}" alt="{{ $product->name }}">
                                                            <img src="{{ asset($product->thumbnail) }}" alt="{{ $product->name }}" class="hover-image">
                                                        </a>
                                                    </div>
                                                    <!-- /.image -->
                                                    @if($product->is_hot_deal)
                                                        <div class="tag hot"><span>hot</span></div>
                                                    @elseif($product->is_special_offer)
                                                        <div class="tag sale"><span>sale</span></div>
                                                    @else
                                                        <div class="tag new"><span>new</span></div>
                                                    @endif
                                                </div>
                                                <!-- /.product-image -->

                                                <div class="product-info text-left">
                                                    <h3 class="name"><a href="{{ route('product.detail', $product->slug) }}">{{ $product->name }}</a></h3>
                                                    <div class="rating rateit-small"></div>
                                                    <div class="description"></div>
                                                    <div class="product-price"> 
                                                        @if($product->discount_price)
                                                            <span class="price"> ${{ number_format($product->discount_price, 2) }} </span>
                                                            <span class="price-before-discount">${{ number_format($product->price, 2) }}</span>
                                                        @else
                                                            <span class="price"> ${{ number_format($product->price, 2) }} </span>
                                                        @endif
                                                    </div>
                                                    <!-- /.product-price -->
                                                </div>
                                                <!-- /.product-info -->
                                                <div class="cart clearfix animate-effect">
                                                    <div class="action">
                                                        <ul class="list-unstyled">
                                                            <li class="add-cart-button btn-group">
                                                                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-inline">
                                                                    @csrf
                                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                                    <input type="hidden" name="quantity" value="1">
                                                                    <button class="btn btn-primary icon" type="submit"> <i class="fa fa-shopping-cart"></i> </button>
                                                                    <button class="btn btn-primary cart-btn" type="submit">Add to cart</button>
                                                                </form>
                                                            </li>
                                                            <li class="lnk wishlist"> 
                                                                <a class="add-to-cart" href="{{ route('wishlist.add', $product->id) }}" title="Wishlist"> 
                                                                    <i class="icon fa fa-heart"></i> 
                                                                </a> 
                                                            </li>
                                                            <li class="lnk"> 
                                                                <a class="add-to-cart" href="#" title="Compare"> 
                                                                    <i class="fa fa-signal" aria-hidden="true"></i>
                                                                </a> 
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <!-- /.action -->
                                                </div>
                                                <!-- /.cart -->
                                            </div>
                                            <!-- /.product -->
                                        </div>
                                        <!-- /.products -->
                                    </div>
                                    <!-- /.item -->
                                    @endforeach
                                </div>
                                <!-- /.owl-carousel -->
                            </div>
                        </div>
                    </section>
                    <!-- /.section -->
                    <!-- ============================================== FEATURED PRODUCTS : END ============================================== -->
                    <!-- ============================================== WIDE PRODUCTS ============================================== -->
                    <div class="wide-banners outer-bottom-xs">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="wide-banner1 cnt-strip">
                                    <div class="image"> <img class="img-responsive"
                                            src="{{ asset('assets/images/banners/home-banner.jpg') }}" alt="">
                                    </div>
                                    <div class="strip strip-text">
                                        <div class="strip-inner">
                                            <h2 class="text-right">Amazing Ficus<br>
                                                <span class="shopping-needs">Get 40% off on selected items</span>
                                            </h2>
                                        </div>
                                    </div>
                                    <div class="new-label">
                                        <div class="text">NEW</div>
                                    </div>
                                    <!-- /.new-label -->
                                </div>
                                <!-- /.wide-banner -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-4">
                                <div class="wide-banner cnt-strip">
                                    <div class="image"> <img class="img-responsive"
                                            src="{{ asset('assets/images/banners/home-banner4.jpg') }}" alt="">
                                    </div>


                                    <!-- /.new-label -->
                                </div>
                                <!-- /.wide-banner -->
                            </div>

                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.wide-banners -->
                    <!-- ============================================== WIDE PRODUCTS : END ============================================== -->



                    <!-- /.sidebar-widget -->
                    <!-- ============================================== BEST SELLER : END ============================================== -->

                    <!-- ============================================== BLOG SLIDER ============================================== -->
                    <section class="section latest-blog outer-bottom-vs">
                        <h3 class="section-title">Latest form Blog</h3>
                        <div class="blog-slider-container outer-top-xs">
                            <div class="owl-carousel blog-slider custom-carousel">
                                <div class="item">
                                    <div class="blog-post">
                                        <div class="blog-post-image">
                                            <div class="image"> <a href="blog.html"><img
                                                        src="{{ asset('assets/images/blog-post/blog_big_01.jpg') }}"
                                                        alt=""></a> </div>
                                        </div>
                                        <!-- /.blog-post-image -->

                                        <div class="blog-post-info text-left">
                                            <h3 class="name"><a href="#">Voluptatem accusantium doloremque
                                                    laudantium</a></h3>
                                            <span class="info">By Jone Doe &nbsp;|&nbsp; 21 March 2016 </span>
                                            <p class="text">Sed quia non numquam eius modi tempora incidunt ut labore et
                                                dolore magnam aliquam quaerat voluptatem.</p>
                                        </div>
                                        <!-- /.blog-post-info -->

                                    </div>
                                    <!-- /.blog-post -->
                                </div>
                                <!-- /.item -->

                                <div class="item">
                                    <div class="blog-post">
                                        <div class="blog-post-image">
                                            <div class="image"> <a href="blog.html"><img
                                                        src="{{ asset('assets/images/blog-post/blog_big_02.jpg') }}"
                                                        alt=""></a> </div>
                                        </div>
                                        <!-- /.blog-post-image -->

                                        <div class="blog-post-info text-left">
                                            <h3 class="name"><a href="#">Dolorem eum fugiat quo voluptas nulla
                                                    pariatur</a></h3>
                                            <span class="info">By Saraha Smith &nbsp;|&nbsp; 21 March 2016 </span>
                                            <p class="text">Sed quia non numquam eius modi tempora incidunt ut labore et
                                                dolore magnam aliquam quaerat voluptatem.</p>
                                        </div>
                                        <!-- /.blog-post-info -->

                                    </div>
                                    <!-- /.blog-post -->
                                </div>
                                <!-- /.item -->

                                <!-- /.item -->

                                <div class="item">
                                    <div class="blog-post">
                                        <div class="blog-post-image">
                                            <div class="image"> <a href="blog.html"><img
                                                        src="{{ asset('assets/images/blog-post/blog_big_03.jpg') }}"
                                                        alt=""></a> </div>
                                        </div>
                                        <!-- /.blog-post-image -->

                                        <div class="blog-post-info text-left">
                                            <h3 class="name"><a href="#">Dolorem eum fugiat quo voluptas nulla
                                                    pariatur</a></h3>
                                            <span class="info">By Saraha Smith &nbsp;|&nbsp; 21 March 2016 </span>
                                            <p class="text">Sed ut perspiciatis unde omnis iste natus error sit
                                                voluptatem accusantium</p>
                                        </div>
                                        <!-- /.blog-post-info -->

                                    </div>
                                    <!-- /.blog-post -->
                                </div>
                                <!-- /.item -->

                                <div class="item">
                                    <div class="blog-post">
                                        <div class="blog-post-image">
                                            <div class="image"> <a href="blog.html"><img
                                                        src="{{ asset('assets/images/blog-post/blog_big_01.jpg') }}"
                                                        alt=""></a> </div>
                                        </div>
                                        <!-- /.blog-post-image -->

                                        <div class="blog-post-info text-left">
                                            <h3 class="name"><a href="#">Dolorem eum fugiat quo voluptas nulla
                                                    pariatur</a></h3>
                                            <span class="info">By Saraha Smith &nbsp;|&nbsp; 21 March 2016 </span>
                                            <p class="text">Sed ut perspiciatis unde omnis iste natus error sit
                                                voluptatem accusantium</p>
                                        </div>
                                        <!-- /.blog-post-info -->

                                    </div>
                                    <!-- /.blog-post -->
                                </div>
                                <!-- /.item -->

                                <div class="item">
                                    <div class="blog-post">
                                        <div class="blog-post-image">
                                            <div class="image"> <a href="blog.html"><img
                                                        src="{{ asset('assets/images/blog-post/blog_big_02.jpg') }}"
                                                        alt=""></a> </div>
                                        </div>
                                        <!-- /.blog-post-image -->

                                        <div class="blog-post-info text-left">
                                            <h3 class="name"><a href="#">Dolorem eum fugiat quo voluptas nulla
                                                    pariatur</a></h3>
                                            <span class="info">By Saraha Smith &nbsp;|&nbsp; 21 March 2016 </span>
                                            <p class="text">Sed ut perspiciatis unde omnis iste natus error sit
                                                voluptatem accusantium</p>
                                        </div>
                                        <!-- /.blog-post-info -->

                                    </div>
                                    <!-- /.blog-post -->
                                </div>
                                <!-- /.item -->

                            </div>
                            <!-- /.owl-carousel -->
                        </div>
                        <!-- /.blog-slider-container -->
                    </section>
                    <!-- /.section -->
                    <!-- ============================================== BLOG SLIDER : END ============================================== -->

                    <!-- ============================================== FEATURED PRODUCTS ============================================== -->
                    <section class="section featured-product">
                        <div class="row">
                            <div class="col-lg-3">
                                <h3 class="section-title">Featured Products</h3>
                                <ul class="sub-cat">
                                    <li><a href="#">Plants</a></li>
                                    <li><a href="#">Air Condition</a></li>
                                </ul>
                            </div>
                            <div class="col-lg-9">
                                <div class="owl-carousel homepage-owl-carousel custom-carousel owl-theme outer-top-xs">
                                    @foreach($featuredProducts as $product)
                                    <div class="item item-carousel">
                                        <div class="products">
                                            <div class="product">
                                                <div class="product-image">
                                                    <div class="image">
                                                        <a href="{{ route('product.detail', $product->slug) }}">
                                                            <img src="{{ asset($product->thumbnail) }}" alt="{{ $product->name }}">
                                                            <img src="{{ asset($product->thumbnail) }}" alt="{{ $product->name }}" class="hover-image">
                                                        </a>
                                                    </div>
                                                    <!-- /.image -->
                                                    @if($product->is_hot_deal)
                                                        <div class="tag hot"><span>hot</span></div>
                                                    @elseif($product->is_special_offer)
                                                        <div class="tag sale"><span>sale</span></div>
                                                    @else
                                                        <div class="tag new"><span>new</span></div>
                                                    @endif
                                                </div>
                                                <!-- /.product-image -->

                                                <div class="product-info text-left">
                                                    <h3 class="name"><a href="{{ route('product.detail', $product->slug) }}">{{ $product->name }}</a></h3>
                                                    <div class="rating rateit-small"></div>
                                                    <div class="description"></div>
                                                    <div class="product-price"> 
                                                        @if($product->discount_price)
                                                            <span class="price"> ${{ number_format($product->discount_price, 2) }} </span>
                                                            <span class="price-before-discount">${{ number_format($product->price, 2) }}</span>
                                                        @else
                                                            <span class="price"> ${{ number_format($product->price, 2) }} </span>
                                                        @endif
                                                    </div>
                                                    <!-- /.product-price -->
                                                </div>
                                                <!-- /.product-info -->
                                                <div class="cart clearfix animate-effect">
                                                    <div class="action">
                                                        <ul class="list-unstyled">
                                                            <li class="add-cart-button btn-group">
                                                                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-inline">
                                                                    @csrf
                                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                                    <input type="hidden" name="quantity" value="1">
                                                                    <button class="btn btn-primary icon" type="submit"> <i class="fa fa-shopping-cart"></i> </button>
                                                                    <button class="btn btn-primary cart-btn" type="submit">Add to cart</button>
                                                                </form>
                                                            </li>
                                                            <li class="lnk wishlist"> 
                                                                <a class="add-to-cart" href="{{ route('wishlist.add', $product->id) }}" title="Wishlist"> 
                                                                    <i class="icon fa fa-heart"></i> 
                                                                </a> 
                                                            </li>
                                                            <li class="lnk"> 
                                                                <a class="add-to-cart" href="#" title="Compare"> 
                                                                    <i class="fa fa-signal" aria-hidden="true"></i>
                                                                </a> 
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <!-- /.action -->
                                                </div>
                                                <!-- /.cart -->
                                            </div>
                                            <!-- /.product -->
                                        </div>
                                        <!-- /.products -->
                                    </div>
                                    <!-- /.item -->
                                    @endforeach
                                </div>
                                <!-- /.owl-carousel -->
                            </div>
                        </div>
                    </section>
                    <!-- /.section -->
                    <!-- ============================================== FEATURED PRODUCTS : END ============================================== -->

                </div>
                <!-- /.homebanner-holder -->
                <!-- ============================================== CONTENT : END ============================================== -->
            </div>
            <!-- /.row -->
            <!-- ============================================== BRANDS CAROUSEL ============================================== -->
            <div id="brands-carousel" class="logo-slider">
                <div class="logo-slider-inner">
                    <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
                        <div class="item m-t-15"> <a href="#" class="image"> <img
                                    data-echo="{{ asset('assets/images/brands/brand1.png') }}"
                                    src="{{ asset('assets/images/blank.gif') }}" alt=""> </a> </div>
                        <!--/.item-->

                        <div class="item m-t-10"> <a href="#" class="image"> <img
                                    data-echo="{{ asset('assets/images/brands/brand2.png') }}"
                                    src="{{ asset('assets/images/blank.gif') }}" alt=""> </a> </div>
                        <!--/.item-->

                        <div class="item"> <a href="#" class="image"> <img
                                    data-echo="{{ asset('assets/images/brands/brand3.png') }}"
                                    src="{{ asset('assets/images/blank.gif') }}" alt=""> </a> </div>
                        <!--/.item-->

                        <div class="item"> <a href="#" class="image"> <img
                                    data-echo="{{ asset('assets/images/brands/brand4.png') }}"
                                    src="{{ asset('assets/images/blank.gif') }}" alt=""> </a> </div>
                        <!--/.item-->

                        <div class="item"> <a href="#" class="image"> <img
                                    data-echo="{{ asset('assets/images/brands/brand5.png') }}"
                                    src="{{ asset('assets/images/blank.gif') }}" alt=""> </a> </div>
                        <!--/.item-->

                        <div class="item"> <a href="#" class="image"> <img
                                    data-echo="{{ asset('assets/images/brands/brand6.png') }}"
                                    src="{{ asset('assets/images/blank.gif') }}" alt=""> </a> </div>
                        <!--/.item-->

                        <div class="item"> <a href="#" class="image"> <img
                                    data-echo="{{ asset('assets/images/brands/brand2.png') }}"
                                    src="{{ asset('assets/images/blank.gif') }}" alt=""> </a> </div>
                        <!--/.item-->

                        <div class="item"> <a href="#" class="image"> <img
                                    data-echo="{{ asset('assets/images/brands/brand4.png') }}"
                                    src="{{ asset('assets/images/blank.gif') }}" alt=""> </a> </div>
                        <!--/.item-->

                        <div class="item"> <a href="#" class="image"> <img
                                    data-echo="{{ asset('assets/images/brands/brand1.png') }}"
                                    src="{{ asset('assets/images/blank.gif') }}" alt=""> </a> </div>
                        <!--/.item-->

                        <div class="item"> <a href="#" class="image"> <img
                                    data-echo="{{ asset('assets/images/brands/brand5.png') }}"
                                    src="{{ asset('assets/images/blank.gif') }}" alt=""> </a> </div>
                        <!--/.item-->
                    </div>
                    <!-- /.owl-carousel #logo-slider -->
                </div>
                <!-- /.logo-slider-inner -->

            </div>
            <!-- /.logo-slider -->
            <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /#top-banner-and-menu -->

    <!-- ============================================== INFO BOXES ============================================== -->
    <div class="row our-features-box">
        <div class="container">
            <ul>
                <li>
                    <div class="feature-box">
                        <div class="icon-truck"></div>
                        <div class="content-blocks">We ship worldwide</div>
                    </div>
                </li>
                <li>
                    <div class="feature-box">
                        <div class="icon-support"></div>
                        <div class="content-blocks">call
                            +1 800 789 0000</div>
                    </div>
                </li>
                <li>
                    <div class="feature-box">
                        <div class="icon-money"></div>
                        <div class="content-blocks">Money Back Guarantee</div>
                    </div>
                </li>
                <li>
                    <div class="feature-box">
                        <div class="icon-return"></div>
                        <div class="content">30 days return</div>
                    </div>
                </li>

            </ul>
        </div>
    </div>
    <!-- /.info-boxes -->
    <!-- ============================================== INFO BOXES : END ============================================== -->
@endsection
