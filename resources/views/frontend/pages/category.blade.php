@extends('frontend.app')

@section('content')
<div class="breadcrumb">
  <div class="container">
    <div class="breadcrumb-inner">
      <ul class="list-inline list-unstyled">
        <li><a href="#">Home</a></li>
        <li class='active'>Cacti</li>
      </ul>
    </div>
    <!-- /.breadcrumb-inner --> 
  </div>
  <!-- /.container --> 
</div>
<!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
  <div class='container'>
    <div class='row'>
      <div class='col-xs-12 col-sm-12 col-md-3 sidebar'> 
        <!-- ================================== TOP NAVIGATION ================================== -->
        <div class="side-menu animate-dropdown outer-bottom-xs">
          <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>
          <nav class="yamm megamenu-horizontal">
            <ul class="nav">
              @foreach($parentCategories as $pCat)
              <li class="dropdown menu-item"> 
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon fa fa-envira" aria-hidden="true"></i>{{ $pCat->name }}</a>
                @if($pCat->children->count() > 0)
                <ul class="dropdown-menu mega-menu">
                  <li class="yamm-content">
                    <div class="row">
                      @foreach($pCat->children->chunk(5) as $chunk)
                      <div class="col-sm-12 col-md-3">
                        <ul class="links list-unstyled">
                          @foreach($chunk as $child)
                          <li><a href="{{ route('category', array_merge(request()->query(), ['category' => $child->id])) }}">{{ $child->name }}</a></li>
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
            </ul>
          </nav>
          <!-- /.megamenu-horizontal --> 
        </div>
        <!-- /.side-menu --> 
        <!-- ================================== TOP NAVIGATION : END ================================== -->
        <div class="sidebar-module-container">
          <div class="sidebar-filter"> 
            <form action="{{ route('category') }}" method="GET" id="filter-form">
            <!-- ============================================== SIDEBAR CATEGORY ============================================== -->
            <div class="sidebar-widget">
              <h3 class="section-title">Shop by</h3>
              <div class="widget-header">
                <h4 class="widget-title">Category</h4>
              </div>
              <div class="sidebar-widget-body">
                <div class="accordion">
                  @foreach($parentCategories as $index => $pCat)
                  <div class="accordion-group">
                    <div class="accordion-heading"> 
                        <a href="#collapse{{ $index }}" data-toggle="collapse" class="accordion-toggle collapsed"> 
                            {{ $pCat->name }} 
                        </a> 
                    </div>
                    <div class="accordion-body collapse {{ request('category') == $pCat->id ? 'in' : '' }}" id="collapse{{ $index }}" style="height: 0px;">
                      <div class="accordion-inner">
                        <ul>
                          @foreach($pCat->children as $child)
                          <li>
                            <div style="display:flex; justify-content:space-between; align-items:center;">
                              <a href="{{ route('category', array_merge(request()->query(), ['category' => $child->id])) }}" class="{{ request('category') == $child->id ? 'text-primary font-weight-bold' : '' }}">{{ $child->name }}</a>
                              @if(request('category') == $child->id)
                                <a href="{{ route('category', Arr::except(request()->query(), ['category'])) }}" class="text-danger" title="Clear category filter"><i class="fa fa-times"></i></a>
                              @endif
                            </div>
                          </li>
                          @endforeach
                        </ul>
                      </div>
                    </div>
                  </div>
                  @endforeach
                </div>
              </div>
            </div>
            <!-- ============================================== SIDEBAR CATEGORY : END ============================================== --> 
            
            <!-- ============================================== PRICE SILDER============================================== -->
            <div class="sidebar-widget">
              <div class="widget-header">
                <h4 class="widget-title">Price Slider</h4>
              </div>
              <div class="sidebar-widget-body m-t-10">
                <div class="price-box"> <span class="price-slider-min">${{ request('min_price', 0) }}.00</span> <span class="price-slider-max">${{ $maxPrice }}.00</span> </div>
                <div class="price-slider-inner">
                  <input type="text" class="price-slider" value="" data-slider-min="0" data-slider-max="{{ $maxPrice }}" data-slider-step="1" data-slider-value="[{{ request('min_price', 0) }},{{ request('max_price', $maxPrice) }}]">
                  <input type="hidden" name="min_price" id="min_price" value="{{ request('min_price', 0) }}">
                  <input type="hidden" name="max_price" id="max_price" value="{{ request('max_price', $maxPrice) }}">
                  
                  @if(request('category'))
                      <input type="hidden" name="category" value="{{ request('category') }}">
                  @endif
                  @if(request('tag'))
                      <input type="hidden" name="tag" value="{{ request('tag') }}">
                  @endif
                </div>
                <button type="submit" class="lnk btn btn-primary mt-3" style="margin-top:15px;">Filter</button>
              </div>
            </div>
            <!-- ============================================== PRICE SILDER : END ============================================== --> 
            <!-- ============================================== PRODUCT TAGS ============================================== -->
            <div class="sidebar-widget product-tag wow fadeInUp">
              <h3 class="section-title">Product tags</h3>
              <div class="sidebar-widget-body outer-top-xs">
                <div class="tag-list">
                    @forelse($productTags as $tag)
                        <a class="item {{ request('tag') == $tag ? 'active' : '' }}" title="{{ $tag }}" 
                           href="{{ route('category', array_merge(request()->query(), ['tag' => $tag])) }}">{{ $tag }}</a>
                    @empty
                        <span class="text-muted">No tags found</span>
                    @endforelse
                </div>
              </div>
            </div>
            <!-- ============================================== PRODUCT TAGS : END ============================================== -->
            </form>
          <!-- /.Testimonials -->
            <div class="sidebar-widget  outer-top-vs ">
              <div id="advertisement" class="advertisement">
                <div class="item">
                  <div class="avatar"><img src=\"{{ asset('assets/images/testimonials/member1.png') }}\" alt="Image"></div>
                  <div class="testimonials"><em>"</em> Vtae sodales aliq uam morbi non sem lacus port mollis. Nunc condime tum metus eud molest sed consectetuer. Sed quia non numquam eius modi tempora incidunt ut labore et dolore.<em>"</em></div>
                  <div class="clients_author">John Doe <span>Abc Company</span> </div>
                  <!-- /.container-fluid --> 
                </div>
                <!-- /.item -->
                
                <div class="item">
                  <div class="avatar"><img src=\"{{ asset('assets/images/testimonials/member3.png') }}\" alt="Image"></div>
                  <div class="testimonials"><em>"</em>Vtae sodales aliq uam morbi non sem lacus port mollis. Nunc condime tum metus eud molest sed consectetuer. Sed quia non numquam eius modi tempora incidunt ut labore et dolore.<em>"</em></div>
                  <div class="clients_author">Stephen Doe <span>Xperia Designs</span> </div>
                </div>
                <!-- /.item -->
                
                <div class="item">
                  <div class="avatar"><img src=\"{{ asset('assets/images/testimonials/member2.png') }}\" alt="Image"></div>
                  <div class="testimonials"><em>"</em> Vtae sodales aliq uam morbi non sem lacus port mollis. Nunc condime tum metus eud molest sed consectetuer. Sed quia non numquam eius modi tempora incidunt ut labore et dolore.<em>"</em></div>
                  <div class="clients_author">Saraha Smith <span>Datsun &amp; Co</span> </div>
                  <!-- /.container-fluid --> 
                </div>
                <!-- /.item --> 
                
              </div>
              <!-- /.owl-carousel --> 
            </div>
            
            <!-- ============================================== Testimonials: END ============================================== -->
            
             <!-- ============================================== NEWSLETTER ============================================== -->
        <div class="sidebar-widget newsletter outer-bottom-small  outer-top-vs">
          <h3 class="section-title">Newsletters</h3>
          <div class="sidebar-widget-body outer-top-xs">
            <p>Sign Up for Our Newsletter!</p>
            <form action="{{ route('subscribe') }}" method="POST">
                @csrf
              <div class="form-group">
                <label class="sr-only" for="exampleInputEmail1">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Subscribe to our newsletter" required>
              </div>
              <button type="submit" class="btn btn-primary">Subscribe</button>
            </form>
          </div>
          <!-- /.sidebar-widget-body --> 
        </div>
        <!-- /.sidebar-widget --> 
        <!-- ============================================== NEWSLETTER: END ============================================== --> 
            
           
          </div>
          <!-- /.sidebar-filter --> 
        </div>
        <!-- /.sidebar-module-container --> 
      </div>
      <!-- /.sidebar -->
      <div class="col-xs-12 col-sm-12 col-md-9 rht-col"> 
        <!-- ========================================== SECTION – HERO ========================================= -->
        
        {{-- <div id="category" class="category-carousel hidden-xs">
          <div class="item">
            <div class="image"> <img src="{{ asset('assets/images/banners/cat-banner-1.jpg') }}" alt="" class="img-responsive"> </div>
            <div class="container-fluid">
              <div class="caption vertical-top text-left">
                <div class="big-text"> Big Sale </div>
                <div class="excerpt hidden-sm hidden-md"> Save up to 49% off </div>
                <div class="excerpt-normal hidden-sm hidden-md"> Lorem ipsum dolor sit amet, consectetur adipiscing elit </div>
                <div class="buy-btn"><a href="#" class="lnk btn btn-primary">Show Now</a></div>
              </div>
              <!-- /.caption --> 
            </div>
            <!-- /.container-fluid --> 
          </div>
        </div> --}}
        
     
        <div class="clearfix filters-container m-t-10">
          <div class="row">
            <div class="col col-sm-6 col-md-3 col-lg-3 col-xs-6">
              <div class="filter-tabs">
                <ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
                  <li class="active"> <a data-toggle="tab" href="#grid-container"><i class="icon fa fa-th-large"></i>Grid</a> </li>
                  <li><a data-toggle="tab" href="#list-container"><i class="icon fa fa-bars"></i>List</a></li>
                </ul>
              </div>
              <!-- /.filter-tabs --> 
            </div>
            <!-- /.col -->
            <div class="col col-sm-12 col-md-5 col-lg-5 hidden-sm">
              <div class="col col-sm-6 col-md-6 no-padding">
                <div class="lbl-cnt"> <span class="lbl">Sort by</span>
                  <div class="fld inline">
                    <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                      <button data-toggle="dropdown" type="button" class="btn dropdown-toggle"> Position <span class="caret"></span> </button>
                      <ul role="menu" class="dropdown-menu">
                        <li role="presentation"><a href="#">position</a></li>
                        <li role="presentation"><a href="#">Price:Lowest first</a></li>
                        <li role="presentation"><a href="#">Price:HIghest first</a></li>
                        <li role="presentation"><a href="#">Product Name:A to Z</a></li>
                      </ul>
                    </div>
                  </div>
                  <!-- /.fld --> 
                </div>
                <!-- /.lbl-cnt --> 
              </div>
              <!-- /.col -->
              <div class="col col-sm-6 col-md-6 no-padding hidden-sm hidden-md">
                <div class="lbl-cnt"> <span class="lbl">Show</span>
                  <div class="fld inline">
                    <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                      <button data-toggle="dropdown" type="button" class="btn dropdown-toggle"> 1 <span class="caret"></span> </button>
                      <ul role="menu" class="dropdown-menu">
                        <li role="presentation"><a href="#">1</a></li>
                        <li role="presentation"><a href="#">2</a></li>
                        <li role="presentation"><a href="#">3</a></li>
                        <li role="presentation"><a href="#">4</a></li>
                        <li role="presentation"><a href="#">5</a></li>
                        <li role="presentation"><a href="#">6</a></li>
                        <li role="presentation"><a href="#">7</a></li>
                        <li role="presentation"><a href="#">8</a></li>
                        <li role="presentation"><a href="#">9</a></li>
                        <li role="presentation"><a href="#">10</a></li>
                      </ul>
                    </div>
                  </div>
                  <!-- /.fld --> 
                </div>
                <!-- /.lbl-cnt --> 
              </div>
              <!-- /.col --> 
            </div>
            <!-- /.col -->
            <div class="col col-sm-6 col-md-4 col-xs-6 col-lg-4 text-right">
              <div class="pagination-container">
                {{ $products->appends(request()->query())->links('pagination::bootstrap-4') }}
              </div>
              <!-- /.pagination-container --> </div>
            <!-- /.col --> 
          </div>
          <!-- /.row --> 
        </div>
        <div class="search-result-container ">
          <div id="myTabContent" class="tab-content category-list">
            <div class="tab-pane active " id="grid-container">
              <div class="category-product">
                <div class="row">
                  @forelse($products as $product)
                  <div class="col-sm-6 col-md-4 col-lg-3">
                      @include('frontend.partials._product_card', ['product' => $product])
                  </div>
                  @empty
                  <div class="col-sm-12 text-center" style="padding: 50px 0;">
                      <h4>No products found matching your criteria.</h4>
                  </div>
                  @endforelse
                </div>
              </div>
            </div>
            <!-- /.tab-pane -->
            
            <div class="tab-pane "  id="list-container">
              <div class="category-product">
                <div class="category-product-inner">
                  <div class="products">
                    @forelse($products as $product)
                    <div class="product-list product">
                      <div class="row product-list-row">
                        <div class="col col-sm-3 col-lg-3">
                          <div class="product-image">
                            <div class="image"> <a href="{{ route('product.detail', $product->slug) }}"><img src="{{ asset($product->thumbnail) }}" alt="{{ $product->name }}"></a> </div>
                          </div>
                        </div>
                        <div class="col col-sm-9 col-lg-9">
                          <div class="product-info">
                            <h3 class="name"><a href="{{ route('product.detail', $product->slug) }}">{{ $product->name }}</a></h3>
                            <div class="rating rateit-small"></div>
                            <div class="product-price"> 
                                @if($product->discount_price)
                                    <span class="price"> ${{ $product->discount_price }} </span>
                                    <span class="price-before-discount">$ {{ $product->price }}</span>
                                @else
                                    <span class="price"> ${{ $product->price }} </span>
                                @endif
                            </div>
                            <div class="description m-t-10">{{ Str::limit(strip_tags($product->description), 150) }}</div>
                            <div class="cart clearfix animate-effect">
                              <div class="action">
                                <ul class="list-unstyled">
                                  <li class="add-cart-button btn-group">
                                    @if($product->stock > 0)
                                        <form action="{{ route('cart.add', $product->id) }}" method="POST" style="display: inline-block; margin: 0;">
                                            @csrf
                                            <button class="btn btn-primary icon" type="submit"> 
                                                <i class="fa fa-shopping-cart"></i> 
                                            </button>
                                            <button class="btn btn-primary cart-btn" type="submit">Add to cart</button>
                                        </form>
                                    @else
                                        <button class="btn btn-danger icon disabled" type="button" disabled> 
                                            <i class="fa fa-ban"></i> 
                                        </button>
                                        <button class="btn btn-danger cart-btn disabled" type="button" disabled>Stock Out</button>
                                    @endif
                                  </li>
                                  <li class="lnk wishlist"> 
                                      <a class="add-to-cart" href="{{ route('wishlist.add', $product->id) }}" title="Wishlist"> 
                                          <i class="icon fa fa-heart"></i> 
                                      </a> 
                                  </li>
                                  <li class="lnk"> 
                                      <a data-toggle="tooltip" class="add-to-cart" href="{{ route('compare.add', $product->id) }}" title="Compare"> 
                                          <i class="fa fa-signal" aria-hidden="true"></i>
                                      </a> 
                                  </li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      @if($product->stock <= 0)
                          <div class="tag out-of-stock" style="background: #dc3545; color: #fff; padding: 5px 10px; position: absolute; top: 10px; left: 20px; font-size: 11px; text-transform: uppercase; font-weight: 700; border-radius: 3px;"><span>stock out</span></div>
                      @elseif($product->is_featured)
                          <div class="tag hot"><span>hot</span></div>
                      @else
                          <div class="tag new"><span>new</span></div>
                      @endif
                    </div>
                    @empty
                    <div class="text-center" style="padding: 50px 0;">
                        <h4>No products found matching your criteria.</h4>
                    </div>
                    @endforelse
                  </div>
                </div>
              </div>
            </div>
            <!-- /.tab-pane #list-container --> 
          </div>
          <!-- /.tab-content -->
          <div class="clearfix filters-container bottom-row">
            <div class="text-right">
              <div class="pagination-container">
                {{ $products->appends(request()->query())->links('pagination::bootstrap-4') }}
              </div>
              <!-- /.pagination-container --> </div>
            <!-- /.text-right --> 
            
          </div>
          <!-- /.filters-container --> 
          
        </div>
        <!-- /.search-result-container --> 
        
      </div>
      <!-- /.col --> 
    </div>
    <!-- /.row --> 
    <!-- ============================================== BRANDS CAROUSEL ============================================== -->
    <div id="brands-carousel" class="logo-slider">
      <div class="logo-slider-inner">
        <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
          <div class="item m-t-15"> <a href="#" class="image"> <img data-echo=\"{{ asset('assets/images/brands/brand1.png') }}\" src=\"{{ asset('assets/images/blank.gif') }}\" alt=""> </a> </div>
          <!--/.item-->
          
          <div class="item m-t-10"> <a href="#" class="image"> <img data-echo=\"{{ asset('assets/images/brands/brand2.png') }}\" src=\"{{ asset('assets/images/blank.gif') }}\" alt=""> </a> </div>
          <!--/.item-->
          
          <div class="item"> <a href="#" class="image"> <img data-echo=\"{{ asset('assets/images/brands/brand3.png') }}\" src=\"{{ asset('assets/images/blank.gif') }}\" alt=""> </a> </div>
          <!--/.item-->
          
          <div class="item"> <a href="#" class="image"> <img data-echo=\"{{ asset('assets/images/brands/brand4.png') }}\" src=\"{{ asset('assets/images/blank.gif') }}\" alt=""> </a> </div>
          <!--/.item-->
          
          <div class="item"> <a href="#" class="image"> <img data-echo=\"{{ asset('assets/images/brands/brand5.png') }}\" src=\"{{ asset('assets/images/blank.gif') }}\" alt=""> </a> </div>
          <!--/.item-->
          
          <div class="item"> <a href="#" class="image"> <img data-echo=\"{{ asset('assets/images/brands/brand6.png') }}\" src=\"{{ asset('assets/images/blank.gif') }}\" alt=""> </a> </div>
          <!--/.item-->
          
          <div class="item"> <a href="#" class="image"> <img data-echo=\"{{ asset('assets/images/brands/brand2.png') }}\" src=\"{{ asset('assets/images/blank.gif') }}\" alt=""> </a> </div>
          <!--/.item-->
          
          <div class="item"> <a href="#" class="image"> <img data-echo=\"{{ asset('assets/images/brands/brand4.png') }}\" src=\"{{ asset('assets/images/blank.gif') }}\" alt=""> </a> </div>
          <!--/.item-->
          
          <div class="item"> <a href="#" class="image"> <img data-echo=\"{{ asset('assets/images/brands/brand1.png') }}\" src=\"{{ asset('assets/images/blank.gif') }}\" alt=""> </a> </div>
          <!--/.item-->
          
          <div class="item"> <a href="#" class="image"> <img data-echo=\"{{ asset('assets/images/brands/brand5.png') }}\" src=\"{{ asset('assets/images/blank.gif') }}\" alt=""> </a> </div>
          <!--/.item--> 
        </div>
        <!-- /.owl-carousel #logo-slider --> 
      </div>
      <!-- /.logo-slider-inner --> 
      
    </div>
    <!-- /.logo-slider --> 
    <!-- ============================================== BRANDS CAROUSEL : END ============================================== --> </div>
  <!-- /.container --> 
  
</div>
<!-- /.body-content --> 

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    if ($('.price-slider').length > 0) {
        $('.price-slider').on('slide', function(slideEvt) {
            $('#min_price').val(slideEvt.value[0]);
            $('#max_price').val(slideEvt.value[1]);
        });
    }
});
</script>
@endpush
