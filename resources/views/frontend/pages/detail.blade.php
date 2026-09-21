@extends('frontend.app')

@section('content')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">{{ $product->category->name ?? 'Uncategorized' }}</a></li>
                    <li class='active'>{{ $product->name }}</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->
    <div class="body-content outer-top-xs">
        <div class='container'>
            <div class='row single-product'>
                <div class='col-xs-12 col-sm-12 col-md-3 sidebar'>
                    <div class="sidebar-module-container">
                        <div class="home-banner outer-top-n outer-bottom-xs">
                            <img src="{{ asset('assets/images/banners/LHS-banner.jpg') }}" alt="Image">
                        </div>


                        <!-- ============================================== HOT DEALS ============================================== -->
                        <div class="sidebar-widget hot-deals outer-bottom-xs">
                            <h3 class="section-title">Hot deals</h3>
                            <div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-ss">
                                @foreach($hotDeals as $hotDeal)
                                <div class="item">
                                    <div class="products">
                                        <div class="hot-deal-wrapper">
                                            <div class="image">
                                                <a href="{{ route('product.detail', $hotDeal->slug) }}">
                                                    <img src="{{ asset($hotDeal->thumbnail) }}"
                                                        alt="{{ $hotDeal->name }}">
                                                    <img src="{{ asset($hotDeal->thumbnail) }}"
                                                        alt="{{ $hotDeal->name }}" class="hover-image">
                                                </a>
                                            </div>
                                            <div class="sale-offer-tag"><span>HOT<br>
                                                    deal</span></div>
                                            <div class="timing-wrapper">
                                                <div class="box-wrapper">
                                                    <div class="date box"> <span class="key">120</span> <span
                                                            class="value">DAYS</span> </div>
                                                </div>
                                                <div class="box-wrapper">
                                                    <div class="hour box"> <span class="key">20</span> <span
                                                            class="value">HRS</span> </div>
                                                </div>
                                                <div class="box-wrapper">
                                                    <div class="minutes box"> <span class="key">36</span> <span
                                                            class="value">MINS</span> </div>
                                                </div>
                                                <div class="box-wrapper">
                                                    <div class="seconds box"> <span class="key">60</span> <span
                                                            class="value">SEC</span> </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.hot-deal-wrapper -->

                                        <div class="product-info text-left m-t-20">
                                            <h3 class="name"><a href="{{ route('product.detail', $hotDeal->slug) }}">{{ $hotDeal->name }}</a></h3>
                                            <div class="rating rateit-small"></div>
                                            <div class="product-price"> 
                                                <span class="price"> ${{ number_format($hotDeal->price, 2) }} </span> 
                                                @if($hotDeal->discount_price)
                                                <span class="price-before-discount">${{ number_format($hotDeal->discount_price, 2) }}</span> 
                                                @endif
                                            </div>
                                            <!-- /.product-price -->

                                        </div>
                                        <!-- /.product-info -->

                                        <div class="cart clearfix animate-effect">
                                            <div class="action">
                                                <div class="add-cart-button btn-group">
                                                    <button class="btn btn-primary icon" data-toggle="dropdown"
                                                        type="button"> <i class="fa fa-shopping-cart"></i> </button>
                                                    <button class="btn btn-primary cart-btn" type="button">Add to
                                                        cart</button>
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

                        <!-- ============================================== NEWSLETTER ============================================== -->
                        <div class="sidebar-widget newsletter outer-bottom-small outer-top-vs">
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
                            </div><!-- /.sidebar-widget-body -->
                        </div><!-- /.sidebar-widget -->
                        <!-- ============================================== NEWSLETTER: END ============================================== -->

                        <!-- ============================================== Testimonials============================================== -->
                        <div class="sidebar-widget  outer-top-vs ">
                            <div id="advertisement" class="advertisement">
                                <div class="item">
                                    <div class="avatar"><img src="{{ asset('assets/images/testimonials/member1.png') }}"
                                            alt="Image"></div>
                                    <div class="testimonials"><em>"</em> Vtae sodales aliq uam morbi non sem lacus port
                                        mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
                                    <div class="clients_author">John Doe <span>Abc Company</span> </div>
                                    <!-- /.container-fluid -->
                                </div><!-- /.item -->

                                <div class="item">
                                    <div class="avatar"><img src="{{ asset('assets/images/testimonials/member3.png') }}"
                                            alt="Image"></div>
                                    <div class="testimonials"><em>"</em>Vtae sodales aliq uam morbi non sem lacus port
                                        mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
                                    <div class="clients_author">Stephen Doe <span>Xperia Designs</span> </div>
                                </div><!-- /.item -->

                                <div class="item">
                                    <div class="avatar"><img src="{{ asset('assets/images/testimonials/member2.png') }}"
                                            alt="Image"></div>
                                    <div class="testimonials"><em>"</em> Vtae sodales aliq uam morbi non sem lacus port
                                        mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
                                    <div class="clients_author">Saraha Smith <span>Datsun &amp; Co</span> </div>
                                    <!-- /.container-fluid -->
                                </div><!-- /.item -->

                            </div><!-- /.owl-carousel -->
                        </div>

                        <!-- ============================================== Testimonials: END ============================================== -->



                    </div>
                </div><!-- /.sidebar -->
                <div class='col-xs-12 col-sm-12 col-md-9 rht-col'>
                    <div class="detail-block">
                        <div class="row">

                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 gallery-holder">
                                <div class="product-item-holder size-big single-product-gallery small-gallery">

                                    <div id="owl-single-product">
                                        <div class="single-product-gallery-item" id="slide1">
                                            <a data-lightbox="image-1" data-title="Gallery"
                                                href="{{ asset($product->thumbnail) }}">
                                                <img class="img-responsive" alt=""
                                                    src="{{ asset('assets/images/blank.gif') }}"
                                                    data-echo="{{ asset($product->thumbnail) }}" />
                                            </a>
                                        </div><!-- /.single-product-gallery-item -->

        </div><!-- /.single-product-slider -->


        <div class="single-product-gallery-thumbs
                                                    gallery-thumbs">

                                                <div id="owl-single-product-thumbnails">
                                                    <div class="item">
                                                        <a class="horizontal-thumb active"
                                                            data-target="#owl-single-product" data-slide="1"
                                                            href="#slide1">
                                                            <img class="img-responsive" alt=""
                                                                src="{{ asset('assets/images/blank.gif') }}"
                                                                data-echo="{{ asset($product->thumbnail) }}" />
                                                        </a>
                                                    </div>
                                                </div><!-- /#owl-single-product-thumbnails -->



                                        </div><!-- /.gallery-thumbs -->

                                    </div><!-- /.single-product-gallery -->
                                </div><!-- /.gallery-holder -->
                                <div class='col-sm-12 col-md-8 col-lg-8 product-info-block'>
                                    <div class="product-info">
                                        <h1 class="name">{{ $product->name }}</h1>

                                        <div class="rating-reviews m-t-20">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="pull-left">
                                                        <div class="rating rateit-small"></div>
                                                    </div>
                                                    <div class="pull-left">
                                                        <div class="reviews">
                                                            <a href="#" class="lnk">(13 Reviews)</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- /.row -->
                                        </div><!-- /.rating-reviews -->

                                        <div class="stock-container info-container m-t-10">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="pull-left">
                                                        <div class="stock-box">
                                                            <span class="label">Availability :</span>
                                                        </div>
                                                    </div>
                                                    <div class="pull-left">
                                                        <div class="stock-box">
                                                            <span class="value">
                                                                @if($product->stock > 0)
                                                                    <span class="text-success">In Stock ({{ $product->stock }})</span>
                                                                @else
                                                                    <span class="text-danger">Out of Stock</span>
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- /.row -->
                                        </div><!-- /.stock-container -->

                                        <div class="description-container m-t-20">
                                            <p>{!! $product->description ?? 'No description available for this product.' !!}</p>
                                        </div><!-- /.description-container -->

                                        <div class="price-container info-container m-t-30">
                                            <div class="row">


                                                <div class="col-sm-6 col-xs-6">
                                                    <div class="price-box">
                                                        <span
                                                            class="price">${{ $product->discount_price ? number_format($product->discount_price, 2) : number_format($product->price, 2) }}</span>
                                                        @if ($product->discount_price)
                                                            <span
                                                                class="price-strike">${{ number_format($product->price, 2) }}</span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-sm-6 col-xs-6">
                                                    <div class="favorite-button m-t-5">
                                                        <a class="btn btn-primary" data-toggle="tooltip"
                                                            data-placement="right" title="Wishlist" href="{{ route('wishlist.add', $product->id) }}">
                                                            <i class="fa fa-heart"></i>
                                                        </a>
                                                        <a class="btn btn-primary" data-toggle="tooltip"
                                                            data-placement="right" title="Add to Compare" href="{{ route('compare.add', $product->id) }}">
                                                            <i class="fa fa-signal"></i>
                                                        </a>
                                                        <a class="btn btn-primary" data-toggle="tooltip"
                                                            data-placement="right" title="E-mail" href="#">
                                                            <i class="fa fa-envelope"></i>
                                                        </a>
                                                    </div>
                                                </div>

                                            </div><!-- /.row -->
                                        </div><!-- /.price-container -->

                                        <div class="quantity-container info-container">
                                            <div class="row">

                                                <div class="qty">
                                                    <span class="label">Qty :</span>
                                                </div>

                                                <div class="qty-count">
                                                    <div class="cart-quantity">
                                                        <div class="quant-input">
                                                            <div class="arrows">
                                                                <div class="arrow plus gradient"><span class="ir"><i
                                                                            class="icon fa fa-sort-asc"></i></span></div>
                                                                <div class="arrow minus gradient"><span class="ir"><i
                                                                            class="icon fa fa-sort-desc"></i></span></div>
                                                            </div>
                                                            <input type="text" value="1">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="add-btn">
                                                    @if($product->stock > 0)
                                                        <form action="{{ route('cart.add', $product->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            <button type="submit" class="btn btn-primary"><i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART</button>
                                                        </form>
                                                    @else
                                                        <button type="button" class="btn btn-danger disabled" disabled><i class="fa fa-ban inner-right-vs"></i> OUT OF STOCK</button>
                                                    @endif
                                                </div>


                                            </div><!-- /.row -->
                                        </div><!-- /.quantity-container -->






                                    </div><!-- /.product-info -->
                                </div><!-- /.col-sm-7 -->
                            </div><!-- /.row -->
                        </div>

                        <div class="product-tabs inner-bottom-xs">
                            <div class="row">
                                <div class="col-sm-12 col-md-3 col-lg-3">
                                    <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                                        <li class="active"><a data-toggle="tab" href="#description">DESCRIPTION</a></li>
                                        <li><a data-toggle="tab" href="#review">REVIEW</a></li>
                                        <li><a data-toggle="tab" href="#tags">TAGS</a></li>
                                    </ul><!-- /.nav-tabs #product-tabs -->
                                </div>
                                <div class="col-sm-12 col-md-9 col-lg-9">

                                    <div class="tab-content">

                                        <div id="description" class="tab-pane in active">
                                            <div class="product-tab">
                                                <p class="text">{!! $product->description ?? 'No description.' !!}</p>
                                            </div>
                                        </div><!-- /.tab-pane -->

                                        <div id="review" class="tab-pane">
                                            <div class="product-tab">

                                                <div class="product-reviews">
                                                    <h4 class="title">Customer Reviews</h4>

                                                    <div class="reviews">
                                                        <div class="review">
                                                            <div class="review-title"><span class="summary">We love this
                                                                    product</span><span class="date"><i
                                                                        class="fa fa-calendar"></i><span>1 days
                                                                        ago</span></span></div>
                                                            <div class="text">"Lorem ipsum dolor sit amet, consectetur
                                                                adipiscing elit.Aliquam suscipit."</div>
                                                        </div>

                                                    </div><!-- /.reviews -->
                                                </div><!-- /.product-reviews -->



                                                <div class="product-add-review">
                                                    <h4 class="title">Write your own review</h4>
                                                    <div class="review-table">
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="cell-label">&nbsp;</th>
                                                                        <th>1 star</th>
                                                                        <th>2 stars</th>
                                                                        <th>3 stars</th>
                                                                        <th>4 stars</th>
                                                                        <th>5 stars</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="cell-label">Quality</td>
                                                                        <td><input type="radio" name="quality"
                                                                                class="radio" value="1"></td>
                                                                        <td><input type="radio" name="quality"
                                                                                class="radio" value="2"></td>
                                                                        <td><input type="radio" name="quality"
                                                                                class="radio" value="3"></td>
                                                                        <td><input type="radio" name="quality"
                                                                                class="radio" value="4"></td>
                                                                        <td><input type="radio" name="quality"
                                                                                class="radio" value="5"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="cell-label">Price</td>
                                                                        <td><input type="radio" name="quality"
                                                                                class="radio" value="1"></td>
                                                                        <td><input type="radio" name="quality"
                                                                                class="radio" value="2"></td>
                                                                        <td><input type="radio" name="quality"
                                                                                class="radio" value="3"></td>
                                                                        <td><input type="radio" name="quality"
                                                                                class="radio" value="4"></td>
                                                                        <td><input type="radio" name="quality"
                                                                                class="radio" value="5"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="cell-label">Value</td>
                                                                        <td><input type="radio" name="quality"
                                                                                class="radio" value="1"></td>
                                                                        <td><input type="radio" name="quality"
                                                                                class="radio" value="2"></td>
                                                                        <td><input type="radio" name="quality"
                                                                                class="radio" value="3"></td>
                                                                        <td><input type="radio" name="quality"
                                                                                class="radio" value="4"></td>
                                                                        <td><input type="radio" name="quality"
                                                                                class="radio" value="5"></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table><!-- /.table .table-bordered -->
                                                        </div><!-- /.table-responsive -->
                                                    </div><!-- /.review-table -->

                                                    <div class="review-form">
                                                        <div class="form-container">
                                                            <form class="cnt-form">

                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="exampleInputName">Your Name <span
                                                                                    class="astk">*</span></label>
                                                                            <input type="text" class="form-control txt"
                                                                                id="exampleInputName" placeholder="">
                                                                        </div><!-- /.form-group -->
                                                                        <div class="form-group">
                                                                            <label for="exampleInputSummary">Summary <span
                                                                                    class="astk">*</span></label>
                                                                            <input type="text" class="form-control txt"
                                                                                id="exampleInputSummary" placeholder="">
                                                                        </div><!-- /.form-group -->
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="exampleInputReview">Review <span
                                                                                    class="astk">*</span></label>
                                                                            <textarea class="form-control txt txt-review" id="exampleInputReview" rows="4" placeholder=""></textarea>
                                                                        </div><!-- /.form-group -->
                                                                    </div>
                                                                </div><!-- /.row -->

                                                                <div class="action text-right">
                                                                    <button class="btn btn-primary btn-upper">SUBMIT
                                                                        REVIEW</button>
                                                                </div><!-- /.action -->

                                                            </form><!-- /.cnt-form -->
                                                        </div><!-- /.form-container -->
                                                    </div><!-- /.review-form -->

                                                </div><!-- /.product-add-review -->

                                            </div><!-- /.product-tab -->
                                        </div><!-- /.tab-pane -->

                                        <div id="tags" class="tab-pane">
                                            <div class="product-tag">

                                                <h4 class="title">Product Tags</h4>
                                                <form class="form-inline form-cnt">
                                                    <div class="form-container">

                                                        <div class="form-group">
                                                            <label for="exampleInputTag">Add Your Tags: </label>
                                                            <input type="email" id="exampleInputTag"
                                                                class="form-control txt">


                                                        </div>

                                                        <button class="btn btn-upper btn-primary" type="submit">ADD
                                                            TAGS</button>
                                                    </div><!-- /.form-container -->
                                                </form><!-- /.form-cnt -->

                                                <form class="form-inline form-cnt">
                                                    <div class="form-group">
                                                        <label>&nbsp;</label>
                                                        <span class="text col-md-offset-3">Use spaces to separate tags. Use
                                                            single quotes (') for phrases.</span>
                                                    </div>
                                                </form><!-- /.form-cnt -->

                                            </div><!-- /.product-tab -->
                                        </div><!-- /.tab-pane -->

                                    </div><!-- /.tab-content -->
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div><!-- /.product-tabs -->

                        <!-- ============================================== UPSELL PRODUCTS ============================================== -->
                        <section class="section featured-product">
                            <div class="row">
                                <div class="col-lg-3">
                                    <h3 class="section-title">Upsell Products</h3>
                                    <div class="ad-imgs">
                                        <img class="img-responsive"
                                            src="{{ asset('assets/images/banners/home-banner1.jpg') }}" alt="">
                                        <img class="img-responsive"
                                            src="{{ asset('assets/images/banners/home-banner2.jpg') }}" alt="">
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div
                                        class="owl-carousel homepage-owl-carousel upsell-product custom-carousel owl-theme outer-top-xs">

                                        <div class="item item-carousel">
                                            <div class="products">

                                                <div class="product">
                                                    <div class="product-image">
                                                        <div class="image">
                                                            <a href="detail.html"><img
                                                                    src="{{ asset('assets/images/products/p1.jpg') }}"
                                                                    alt=""></a>
                                                        </div><!-- /.image -->

                                                        <div class="tag sale"><span>sale</span></div>
                                                    </div><!-- /.product-image -->


                                                    <div class="product-info text-left">
                                                        <h3 class="name"><a href="detail.html">Floral Print Buttoned</a>
                                                        </h3>
                                                        <div class="rating rateit-small"></div>
                                                        <div class="description"></div>

                                                        <div class="product-price">
                                                            <span class="price">
                                                                $650.99 </span>
                                                            <span class="price-before-discount">$ 800</span>

                                                        </div><!-- /.product-price -->

                                                    </div><!-- /.product-info -->
                                                    <div class="cart clearfix animate-effect">
                                                        <div class="action">
                                                            <ul class="list-unstyled">
                                                                <li class="add-cart-button btn-group">
                                                                    <button class="btn btn-primary icon"
                                                                        data-toggle="dropdown" type="button">
                                                                        <i class="fa fa-shopping-cart"></i>
                                                                    </button>
                                                                    <button class="btn btn-primary cart-btn"
                                                                        type="button">Add to cart</button>

                                                                </li>

                                                                <li class="lnk wishlist">
                                                                    <a class="add-to-cart" href="detail.html"
                                                                        title="Wishlist">
                                                                        <i class="icon fa fa-heart"></i>
                                                                    </a>
                                                                </li>

                                                                <li class="lnk">
                                                                    <a class="add-to-cart" href="detail.html"
                                                                        title="Compare">
                                                                        <i class="fa fa-signal"></i>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div><!-- /.action -->
                                                    </div><!-- /.cart -->
                                                </div><!-- /.product -->

                                            </div><!-- /.products -->
                                        </div><!-- /.item -->

                                        <div class="item item-carousel">
                                            <div class="products">

                                                <div class="product">
                                                    <div class="product-image">
                                                        <div class="image">
                                                            <a href="detail.html"><img
                                                                    src="{{ asset('assets/images/products/p2.jpg') }}"
                                                                    alt=""></a>
                                                        </div><!-- /.image -->

                                                        <div class="tag sale"><span>sale</span></div>
                                                    </div><!-- /.product-image -->


                                                    <div class="product-info text-left">
                                                        <h3 class="name"><a href="detail.html">Floral Print Buttoned</a>
                                                        </h3>
                                                        <div class="rating rateit-small"></div>
                                                        <div class="description"></div>

                                                        <div class="product-price">
                                                            <span class="price">
                                                                $650.99 </span>
                                                            <span class="price-before-discount">$ 800</span>

                                                        </div><!-- /.product-price -->

                                                    </div><!-- /.product-info -->
                                                    <div class="cart clearfix animate-effect">
                                                        <div class="action">
                                                            <ul class="list-unstyled">
                                                                <li class="add-cart-button btn-group">
                                                                    <button class="btn btn-primary icon"
                                                                        data-toggle="dropdown" type="button">
                                                                        <i class="fa fa-shopping-cart"></i>
                                                                    </button>
                                                                    <button class="btn btn-primary cart-btn"
                                                                        type="button">Add to cart</button>

                                                                </li>

                                                                <li class="lnk wishlist">
                                                                    <a class="add-to-cart" href="detail.html"
                                                                        title="Wishlist">
                                                                        <i class="icon fa fa-heart"></i>
                                                                    </a>
                                                                </li>

                                                                <li class="lnk">
                                                                    <a class="add-to-cart" href="detail.html"
                                                                        title="Compare">
                                                                        <i class="fa fa-signal"></i>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div><!-- /.action -->
                                                    </div><!-- /.cart -->
                                                </div><!-- /.product -->

                                            </div><!-- /.products -->
                                        </div><!-- /.item -->

                                        <div class="item item-carousel">
                                            <div class="products">

                                                <div class="product">
                                                    <div class="product-image">
                                                        <div class="image">
                                                            <a href="detail.html"><img
                                                                    src="{{ asset('assets/images/products/p3.jpg') }}"
                                                                    alt=""></a>
                                                        </div><!-- /.image -->

                                                        <div class="tag hot"><span>hot</span></div>
                                                    </div><!-- /.product-image -->


                                                    <div class="product-info text-left">
                                                        <h3 class="name"><a href="detail.html">Floral Print Buttoned</a>
                                                        </h3>
                                                        <div class="rating rateit-small"></div>
                                                        <div class="description"></div>

                                                        <div class="product-price">
                                                            <span class="price">
                                                                $650.99 </span>
                                                            <span class="price-before-discount">$ 800</span>

                                                        </div><!-- /.product-price -->

                                                    </div><!-- /.product-info -->
                                                    <div class="cart clearfix animate-effect">
                                                        <div class="action">
                                                            <ul class="list-unstyled">
                                                                <li class="add-cart-button btn-group">
                                                                    <button class="btn btn-primary icon"
                                                                        data-toggle="dropdown" type="button">
                                                                        <i class="fa fa-shopping-cart"></i>
                                                                    </button>
                                                                    <button class="btn btn-primary cart-btn"
                                                                        type="button">Add to cart</button>

                                                                </li>

                                                                <li class="lnk wishlist">
                                                                    <a class="add-to-cart" href="detail.html"
                                                                        title="Wishlist">
                                                                        <i class="icon fa fa-heart"></i>
                                                                    </a>
                                                                </li>

                                                                <li class="lnk">
                                                                    <a class="add-to-cart" href="detail.html"
                                                                        title="Compare">
                                                                        <i class="fa fa-signal"></i>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div><!-- /.action -->
                                                    </div><!-- /.cart -->
                                                </div><!-- /.product -->

                                            </div><!-- /.products -->
                                        </div><!-- /.item -->

                                        <div class="item item-carousel">
                                            <div class="products">

                                                <div class="product">
                                                    <div class="product-image">
                                                        <div class="image">
                                                            <a href="detail.html"><img
                                                                    src="{{ asset('assets/images/products/p4.jpg') }}"
                                                                    alt=""></a>
                                                        </div><!-- /.image -->

                                                        <div class="tag new"><span>new</span></div>
                                                    </div><!-- /.product-image -->


                                                    <div class="product-info text-left">
                                                        <h3 class="name"><a href="detail.html">Floral Print Buttoned</a>
                                                        </h3>
                                                        <div class="rating rateit-small"></div>
                                                        <div class="description"></div>

                                                        <div class="product-price">
                                                            <span class="price">
                                                                $650.99 </span>
                                                            <span class="price-before-discount">$ 800</span>

                                                        </div><!-- /.product-price -->

                                                    </div><!-- /.product-info -->
                                                    <div class="cart clearfix animate-effect">
                                                        <div class="action">
                                                            <ul class="list-unstyled">
                                                                <li class="add-cart-button btn-group">
                                                                    <button class="btn btn-primary icon"
                                                                        data-toggle="dropdown" type="button">
                                                                        <i class="fa fa-shopping-cart"></i>
                                                                    </button>
                                                                    <button class="btn btn-primary cart-btn"
                                                                        type="button">Add to cart</button>

                                                                </li>

                                                                <li class="lnk wishlist">
                                                                    <a class="add-to-cart" href="detail.html"
                                                                        title="Wishlist">
                                                                        <i class="icon fa fa-heart"></i>
                                                                    </a>
                                                                </li>

                                                                <li class="lnk">
                                                                    <a class="add-to-cart" href="detail.html"
                                                                        title="Compare">
                                                                        <i class="fa fa-signal"></i>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div><!-- /.action -->
                                                    </div><!-- /.cart -->
                                                </div><!-- /.product -->

                                            </div><!-- /.products -->
                                        </div><!-- /.item -->

                                        <div class="item item-carousel">
                                            <div class="products">

                                                <div class="product">
                                                    <div class="product-image">
                                                        <div class="image">
                                                            <a href="detail.html"><img
                                                                    src="{{ asset('assets/images/blank.gif') }}"
                                                                    data-echo="{{ asset('assets/images/products/p5.jpg') }}"
                                                                    alt=""></a>
                                                        </div><!-- /.image -->

                                                        <div class="tag hot"><span>hot</span></div>
                                                    </div><!-- /.product-image -->


                                                    <div class="product-info text-left">
                                                        <h3 class="name"><a href="detail.html">Floral Print Buttoned</a>
                                                        </h3>
                                                        <div class="rating rateit-small"></div>
                                                        <div class="description"></div>

                                                        <div class="product-price">
                                                            <span class="price">
                                                                $650.99 </span>
                                                            <span class="price-before-discount">$ 800</span>

                                                        </div><!-- /.product-price -->

                                                    </div><!-- /.product-info -->
                                                    <div class="cart clearfix animate-effect">
                                                        <div class="action">
                                                            <ul class="list-unstyled">
                                                                <li class="add-cart-button btn-group">
                                                                    <button class="btn btn-primary icon"
                                                                        data-toggle="dropdown" type="button">
                                                                        <i class="fa fa-shopping-cart"></i>
                                                                    </button>
                                                                    <button class="btn btn-primary cart-btn"
                                                                        type="button">Add to cart</button>

                                                                </li>

                                                                <li class="lnk wishlist">
                                                                    <a class="add-to-cart" href="detail.html"
                                                                        title="Wishlist">
                                                                        <i class="icon fa fa-heart"></i>
                                                                    </a>
                                                                </li>

                                                                <li class="lnk">
                                                                    <a class="add-to-cart" href="detail.html"
                                                                        title="Compare">
                                                                        <i class="fa fa-signal"></i>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div><!-- /.action -->
                                                    </div><!-- /.cart -->
                                                </div><!-- /.product -->

                                            </div><!-- /.products -->
                                        </div><!-- /.item -->

                                        <div class="item item-carousel">
                                            <div class="products">

                                        @foreach($relatedProducts as $relatedProduct)
                                        <div class="item item-carousel">
                                            <div class="products">

                                                <div class="product">
                                                    <div class="product-image">
                                                        <div class="image">
                                                            <a href="{{ route('product.detail', $relatedProduct->slug) }}"><img
                                                                    src="{{ asset($relatedProduct->thumbnail) }}"
                                                                    alt="{{ $relatedProduct->name }}"></a>
                                                        </div><!-- /.image -->

                                                        @if($relatedProduct->is_featured)
                                                        <div class="tag hot"><span>hot</span></div>
                                                        @elseif($relatedProduct->discount_price)
                                                        <div class="tag sale"><span>sale</span></div>
                                                        @endif
                                                    </div><!-- /.product-image -->


                                                    <div class="product-info text-left">
                                                        <h3 class="name"><a href="{{ route('product.detail', $relatedProduct->slug) }}">{{ $relatedProduct->name }}</a>
                                                        </h3>
                                                        <div class="rating rateit-small"></div>
                                                        <div class="description"></div>

                                                        <div class="product-price">
                                                            <span class="price">
                                                                ${{ number_format($relatedProduct->price, 2) }} </span>
                                                            @if($relatedProduct->discount_price)
                                                            <span class="price-before-discount">${{ number_format($relatedProduct->discount_price, 2) }}</span>
                                                            @endif
                                                        </div><!-- /.product-price -->

                                                    </div><!-- /.product-info -->
                                                    <div class="cart clearfix animate-effect">
                                                        <div class="action">
                                                            <ul class="list-unstyled">
                                                                <li class="add-cart-button btn-group">
                                                                    <button class="btn btn-primary icon"
                                                                        data-toggle="dropdown" type="button">
                                                                        <i class="fa fa-shopping-cart"></i>
                                                                    </button>
                                                                    <button class="btn btn-primary cart-btn"
                                                                        type="button">Add to cart</button>

                                                                </li>

                                                                <li class="lnk wishlist">
                                                                    <a class="add-to-cart" href="#"
                                                                        title="Wishlist">
                                                                        <i class="icon fa fa-heart"></i>
                                                                    </a>
                                                                </li>

                                                                <li class="lnk">
                                                                    <a class="add-to-cart" href="#"
                                                                        title="Compare">
                                                                        <i class="fa fa-signal"></i>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div><!-- /.action -->
                                                    </div><!-- /.cart -->
                                                </div><!-- /.product -->

                                            </div><!-- /.products -->
                                        </div><!-- /.item -->
                                        @endforeach
                                    </div><!-- /.home-owl-carousel -->
                                </div>
                            </div>
                        </section><!-- /.section -->
                        <!-- ============================================== UPSELL PRODUCTS : END ============================================== -->

                    </div><!-- /.col -->
                    <div class="clearfix"></div>
                </div><!-- /.row -->
                <!-- ============================================== BRANDS CAROUSEL ============================================== -->
                <div id="brands-carousel" class="logo-slider">

                    <div class="logo-slider-inner">
                        <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
                            <div class="item m-t-15">
                                <a href="#" class="image">
                                    <img data-echo="{{ asset('assets/images/brands/brand1.png') }}"
                                        src="{{ asset('assets/images/blank.gif') }}" alt="">
                                </a>
                            </div><!--/.item-->

                            <div class="item m-t-10">
                                <a href="#" class="image">
                                    <img data-echo="{{ asset('assets/images/brands/brand2.png') }}"
                                        src="{{ asset('assets/images/blank.gif') }}" alt="">
                                </a>
                            </div><!--/.item-->

                            <div class="item">
                                <a href="#" class="image">
                                    <img data-echo="{{ asset('assets/images/brands/brand3.png') }}"
                                        src="{{ asset('assets/images/blank.gif') }}" alt="">
                                </a>
                            </div><!--/.item-->

                            <div class="item">
                                <a href="#" class="image">
                                    <img data-echo="{{ asset('assets/images/brands/brand4.png') }}"
                                        src="{{ asset('assets/images/blank.gif') }}" alt="">
                                </a>
                            </div><!--/.item-->

                            <div class="item">
                                <a href="#" class="image">
                                    <img data-echo="{{ asset('assets/images/brands/brand5.png') }}"
                                        src="{{ asset('assets/images/blank.gif') }}" alt="">
                                </a>
                            </div><!--/.item-->

                            <div class="item">
                                <a href="#" class="image">
                                    <img data-echo="{{ asset('assets/images/brands/brand6.png') }}"
                                        src="{{ asset('assets/images/blank.gif') }}" alt="">
                                </a>
                            </div><!--/.item-->

                            <div class="item">
                                <a href="#" class="image">
                                    <img data-echo="{{ asset('assets/images/brands/brand2.png') }}"
                                        src="{{ asset('assets/images/blank.gif') }}" alt="">
                                </a>
                            </div><!--/.item-->

                            <div class="item">
                                <a href="#" class="image">
                                    <img data-echo="{{ asset('assets/images/brands/brand4.png') }}"
                                        src="{{ asset('assets/images/blank.gif') }}" alt="">
                                </a>
                            </div><!--/.item-->

                            <div class="item">
                                <a href="#" class="image">
                                    <img data-echo="{{ asset('assets/images/brands/brand1.png') }}"
                                        src="{{ asset('assets/images/blank.gif') }}" alt="">
                                </a>
                            </div><!--/.item-->

                            <div class="item">
                                <a href="#" class="image">
                                    <img data-echo="{{ asset('assets/images/brands/brand5.png') }}"
                                        src="{{ asset('assets/images/blank.gif') }}" alt="">
                                </a>
                            </div><!--/.item-->
                        </div><!-- /.owl-carousel #logo-slider -->
                    </div><!-- /.logo-slider-inner -->

                </div><!-- /.logo-slider -->
                <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
            </div><!-- /.container -->
        </div><!-- /.body-content -->
    @endsection
