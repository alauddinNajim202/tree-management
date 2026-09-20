<?php

$filePath = 'resources/views/frontend/pages/home.blade.php';
$content = file_get_contents($filePath);

// 1. Hot Deals
$hotDealsDynamic = <<<'EOD'
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
EOD;

$pattern = '/<!-- ============================================== HOT DEALS ============================================== -->.*?<!-- ============================================== HOT DEALS: END ============================================== -->/s';
$content = preg_replace($pattern, $hotDealsDynamic, $content);

// 2. Special Offer
$specialOfferDynamic = <<<'EOD'
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
EOD;

$pattern = '/<!-- ============================================== SPECIAL OFFER ============================================== -->.*?<!-- ============================================== SPECIAL OFFER : END ============================================== -->/s';
$content = preg_replace($pattern, $specialOfferDynamic, $content);

// 3. Featured Products
$featuredProductsDynamic = <<<'EOD'
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
EOD;

$pattern = '/<!-- ============================================== FEATURED PRODUCTS ============================================== -->.*?<!-- ============================================== FEATURED PRODUCTS : END ============================================== -->/s';
$content = preg_replace($pattern, $featuredProductsDynamic, $content);

file_put_contents($filePath, $content);
echo "done\n";
