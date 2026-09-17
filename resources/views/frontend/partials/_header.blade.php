<!-- ============================================== HEADER ============================================== -->

<!-- MOBILE ONLY: Announcement Bar -->
<div class="mobile-announcement mobile-only">
  🌿 Free Delivery on orders above $99 | Use code: <strong>TREE15</strong> for 15% off
</div>

<!-- MOBILE ONLY: Slim Header (hamburger + logo + cart) -->
<div class="mobile-header mobile-only">
  <button class="mobile-nav-toggle" id="mobileDrawerToggle" type="button">
    <i class="fa fa-bars"></i>
  </button>
  <a href="{{ route('home') }}" class="mobile-logo">
    <img src="{{ asset('assets/images/logo.png') }}" alt="TreeWorld">
  </a>
  <a href="{{ route('shopping-cart') }}" class="mobile-cart-icon">
    <i class="fa fa-shopping-bag"></i>
    <span class="mobile-cart-count">2</span>
  </a>
</div>

<!-- MOBILE ONLY: Search Bar -->
<div class="mobile-search-bar mobile-only">
  <form>
    <i class="fa fa-search mobile-search-icon"></i>
    <input type="text" placeholder="I'm searching for..." class="mobile-search-input">
  </form>
</div>

<!-- MOBILE ONLY: Dark Overlay for Drawer -->
<div class="drawer-overlay mobile-only" id="drawerOverlay"></div>

<!-- MOBILE ONLY: Drawer Close Button (injected into sidebar via JS) -->
<div class="drawer-close-btn mobile-only" id="drawerCloseBtn" style="display:none;">
  <span class="drawer-title">☰ Browse Categories</span>
  <button id="mobileDrawerClose"><i class="fa fa-times"></i></button>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var toggle   = document.getElementById('mobileDrawerToggle');
    var overlay  = document.getElementById('drawerOverlay');
    var closeBtn = document.getElementById('mobileDrawerClose');
    var closeBtnDiv = document.getElementById('drawerCloseBtn');
    var sidebar  = document.querySelector('.sidebar');

    if (window.innerWidth <= 767 && sidebar) {
      // Inject close button into top of sidebar
      sidebar.insertBefore(closeBtnDiv, sidebar.firstChild);
      closeBtnDiv.style.display = 'flex';

      function openDrawer() {
        sidebar.classList.add('drawer-open');
        overlay.classList.add('active');
        document.body.style.overflow = 'hidden';
      }
      function closeDrawer() {
        sidebar.classList.remove('drawer-open');
        overlay.classList.remove('active');
        document.body.style.overflow = '';
      }

      if (toggle)   toggle.addEventListener('click', openDrawer);
      if (overlay)  overlay.addEventListener('click', closeDrawer);
      if (closeBtn) closeBtn.addEventListener('click', closeDrawer);
    }
  });
</script>

<!-- MOBILE ONLY: Fixed Bottom Navigation -->
<div class="mobile-bottom-nav mobile-only">
  <a href="{{ route('home') }}" class="mobile-bottom-nav-item">
    <i class="fa fa-th-large"></i>
    <span>SHOP</span>
  </a>
  @guest
    <a href="{{ route('login') }}" class="mobile-bottom-nav-item">
      <div class="mobile-bottom-nav-item-content">
        <i class="icon fa fa-user"></i>
        <span>Account</span>
      </div>
    </a>
  @else
    <a href="{{ route('dashboard') }}" class="mobile-bottom-nav-item">
      <div class="mobile-bottom-nav-item-content">
        <i class="icon fa fa-user"></i>
        <span>Account</span>
      </div>
    </a>
  @endguest
  <a href="{{ route('shopping-cart') }}" class="mobile-bottom-nav-item mobile-bottom-nav-center">
    <i class="fa fa-shopping-bag"></i>
    <span class="mobile-cart-badge">2</span>
  </a>
  <a href="{{ route('my-wishlist') }}" class="mobile-bottom-nav-item">
    <i class="fa fa-heart"></i>
    <span>WISHLIST</span>
  </a>
  <a href="{{ route('category') }}" class="mobile-bottom-nav-item">
    <i class="fa fa-percent"></i>
    <span>OFFERS</span>
  </a>
</div>

<header class="header-style-1"> 
  
  <!-- ============================================== TOP MENU ============================================== -->
  <div class="top-bar animate-dropdown">
    <div class="container">
      <div class="header-top-inner">
        <div class="cnt-account">
          <ul class="list-unstyled">
            @auth
              <li class="myaccount"><a href="{{ route('dashboard') }}"><span>My Account</span></a></li>
            @endauth
            <li class="wishlist"><a href="{{ route('my-wishlist') }}"><span>Wishlist</span></a></li>
            <li class="header_cart hidden-xs"><a href="{{ route('shopping-cart') }}"><span>My Cart</span></a></li>
            <li class="check"><a href="{{ route('checkout') }}"><span>Checkout</span></a></li>
            @guest
              <li class="login"><a href="{{ route('login') }}"><span>Login / Register</span></a></li>
            @else
              <li class="login">
                <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display: none;">
                    @csrf
                </form>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <span>Logout</span>
                </a>
              </li>
            @endguest
          </ul>
        </div>
        <!-- /.cnt-account -->
        
        <div class="cnt-block">
          <ul class="list-unstyled list-inline">
            <li class="dropdown dropdown-small"> <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="value">USD </span><b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">USD</a></li>
                <li><a href="#">INR</a></li>
                <li><a href="#">GBP</a></li>
              </ul>
            </li>
            <li class="dropdown dropdown-small lang"> <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="value">English </span><b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">English</a></li>
                <li><a href="#">French</a></li>
                <li><a href="#">German</a></li>
              </ul>
            </li>
          </ul>
          <!-- /.list-unstyled --> 
        </div>
        <!-- /.cnt-cart -->
        <div class="clearfix"></div>
      </div>
      <!-- /.header-top-inner --> 
    </div>
    <!-- /.container --> 
  </div>
  <!-- /.header-top --> 
  <!-- ============================================== TOP MENU : END ============================================== -->
  <div class="main-header">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-3 logo-holder"> 
          <!-- ============================================================= LOGO ============================================================= -->
          <div class="logo"> <a href="{{ route('home') }}"> <img src="{{ asset('assets/images/logo.png') }}" alt="logo"> </a> </div>
          <!-- /.logo --> 
          <!-- ============================================================= LOGO : END ============================================================= --> </div>
        <!-- /.logo-holder -->
        
        <div class="col-lg-7 col-md-6 col-sm-8 col-xs-12 top-search-holder"> 
          <!-- /.contact-row --> 
          <!-- ============================================================= SEARCH AREA ============================================================= -->
          <div class="search-area">
            <form>
              <div class="control-group">
                <ul class="categories-filter animate-dropdown">
                  <li class="dropdown"> <a class="dropdown-toggle"  data-toggle="dropdown" href="{{ route('category') }}">Categories <b class="caret"></b></a>
                    <ul class="dropdown-menu" role="menu" >
                      <li class="menu-header">All Categories</li>
                      @if(isset($headerCategories) && $headerCategories->count() > 0)
                        @foreach($headerCategories as $cat)
                          <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('category') }}?category={{ $cat->slug }}">- {{ $cat->name }}</a></li>
                        @endforeach
                      @else
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">- No Categories Found</a></li>
                      @endif
                    </ul>
                  </li>
                </ul>
                <input class="search-field" placeholder="Search here..." />
                <a class="search-button" href="#" ></a> </div>
            </form>
          </div>
          <!-- /.search-area --> 
          <!-- ============================================================= SEARCH AREA : END ============================================================= --> </div>
        <!-- /.top-search-holder -->
        
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 animate-dropdown top-cart-row"> 
          <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->
          
          <div class="dropdown dropdown-cart"> <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
            <div class="items-cart-inner">
              <div class="basket">
              <div class="basket-item-count"><span class="count">2</span></div>
              <div class="total-price-basket"> <span class="lbl">Shopping Cart</span> <span class="value">$4580</span> </div>
              </div>
            </div>
            </a>
            <ul class="dropdown-menu">
              <li>
                <div class="cart-item product-summary">
                  <div class="row">
                    <div class="col-xs-4">
                      <div class="image"> <a href="{{ route('product.detail', 1) }}"><img src="{{ asset('assets/images/products/p4.jpg') }}" alt=""></a> </div>
                    </div>
                    <div class="col-xs-7">
                      <h3 class="name"><a href="{{ route('product.detail', 1) }}">Simple Product</a></h3>
                      <div class="price">$600.00</div>
                    </div>
                    <div class="col-xs-1 action"> <a href="#"><i class="fa fa-trash"></i></a> </div>
                  </div>
                </div>
                <!-- /.cart-item -->
                <div class="clearfix"></div>
                <hr>
                <div class="clearfix cart-total">
                  <div class="pull-right"> <span class="text">Sub Total :</span><span class='price'>$600.00</span> </div>
                  <div class="clearfix"></div>
                  <a href="{{ route('checkout') }}" class="btn btn-upper btn-primary btn-block m-t-20">Checkout</a> </div>
                <!-- /.cart-total--> 
                
              </li>
            </ul>
            <!-- /.dropdown-menu--> 
          </div>
          <!-- /.dropdown-cart --> 
          
          <!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= --> </div>
        <!-- /.top-cart-row --> 
      </div>
      <!-- /.row --> 
      
    </div>
    <!-- /.container --> 
    
  </div>
  <!-- /.main-header --> 
  
  <!-- ============================================== NAVBAR ============================================== -->
  <div class="header-nav animate-dropdown">
    <div class="container">
      <div class="yamm navbar navbar-default" role="navigation">
        <div class="navbar-header">
       <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> 
       <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        </div>
        <div class="nav-bg-class">
          <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
            <div class="nav-outer">
              <ul class="nav navbar-nav">
                <li class="active dropdown"> <a href="{{ route('home') }}">Home</a> </li>
                <li class="dropdown yamm mega-menu"> <a href="{{ route('home') }}" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">Fruit Trees</a>
                  <ul class="dropdown-menu container">
                    <li>
                      <div class="yamm-content ">
                        <div class="row">
                          <div class="col-xs-12 col-sm-6 col-md-2 col-menu">
                            <h2 class="title">Citrus Trees</h2>
                            <ul class="links">
                              <li><a href="#">Palms</a></li>
                              <li><a href="#">Outdoor Plants </a></li>
                              <li><a href="#">Bonsai</a></li>
                              <li><a href="#">Ficus</a></li>
                              <li><a href="#">Bamboo</a></li>
                              <li><a href="#">Dracaena</a></li>
                              <li><a href="#">Shrubs</a></li>
                            </ul>
                          </div>
                          <!-- /.col -->
                          
                          <div class="col-xs-12 col-sm-6 col-md-2 col-menu">
                            <h2 class="title">Berry Plants</h2>
                            <ul class="links">
                              <li><a href="#">Cacti</a></li>
                              <li><a href="#">Climbers</a></li>
                              <li><a href="#">Water Plants </a></li>
                              <li><a href="#">Herbs</a></li>
                              <li><a href="#">Moss</a></li>
                              <li><a href="#">Outdoor Plants</a></li>
                              <li><a href="#">Evergreens</a></li>
                            </ul>
                          </div>
                          <!-- /.col -->
                          
                          <div class="col-xs-12 col-sm-6 col-md-2 col-menu">
                            <h2 class="title">Tropical Trees</h2>
                            <ul class="links">
                              <li><a href="#">Pots</a></li>
                              <li><a href="#">Soil</a></li>
                              <li><a href="#">Shrubs</a></li>
                              <li><a href="#">Outdoor Plants</a></li>
                              <li><a href="#">Compost</a></li>
                              <li><a href="#">Watering Cans</a></li>
                              <li><a href="#">Pruners</a></li>
                            </ul>
                          </div>
                          <!-- /.col -->
                          
                          <div class="col-xs-12 col-sm-6 col-md-2 col-menu">
                            <h2 class="title">Nut Trees</h2>
                            <ul class="links">
                              <li><a href="#">Shears </a></li>
                              <li><a href="#">Ferns</a></li>
                              <li><a href="#">Palms</a></li>
                              <li><a href="#">Climbers</a></li>
                              <li><a href="#">Spades</a></li>
                              <li><a href="#">Rakes</a></li>
                              <li><a href="#">Swim Wear</a></li>
                            </ul>
                          </div>
                          <!-- /.col -->
                          
                          <div class="col-xs-12 col-sm-6 col-md-4 col-menu banner-image"> <img class="img-responsive" src="{{ asset('assets/images/banners/top-menu-banner.jpg') }}" alt=""> </div>
                          <!-- /.yamm-content --> 
                        </div>
                      </div>
                    </li>
                  </ul>
                </li>
                <li class="dropdown mega-menu"> 
                <a href="{{ route('category') }}"  data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">Indoor Plants <span class="menu-label hot-menu hidden-xs">hot</span> </a>
                  <ul class="dropdown-menu container">
                    <li>
                      <div class="yamm-content">
                        <div class="row">
                          <div class="col-xs-12 col-sm-12 col-md-2 col-menu">
                            <h2 class="title">Air Purifying</h2>
                            <ul class="links">
                              <li><a href="#">Trowels</a></li>
                              <li><a href="#">Sprayers</a></li>
                              <li><a href="#">Neem Oil</a></li>
                              <li><a href="#">Fungicide</a></li>
                              <li><a href="#">Insecticide</a></li>
                              <li><a href="#">Rooting Hormone</a></li>
                              <li><a href="#">Plant Food</a></li>
                              <li><a href="#">Mulch</a></li>
                              <li><a href="#">Pebbles</a></li>
                              <li><a href="#">Trellis</a></li>
                            </ul>
                          </div>
                          <!-- /.col -->
                          
                          <div class="col-xs-12 col-sm-12 col-md-2 col-menu">
                            <h2 class="title">Low Light</h2>
                            <ul class="links">
                              <li><a href="#">Stakes</a></li>
                              <li><a href="#">Ties</a></li>
                              <li><a href="#">PC Trowels Store</a></li>
                              <li><a href="#">Grow Lights</a></li>
                              <li><a href="#">Heat Mats</a></li>
                              <li><a href="#">Thermometers</a></li>
                              <li><a href="#">Memory (RAM)</a></li>
                              <li><a href="#">pH Testers</a></li>
                              <li><a href="#">Seed Trays</a></li>
                              <li><a href="#">Peat Pellets</a></li>
                            </ul>
                          </div>
                          <!-- /.col -->
                          
                          <div class="col-xs-12 col-sm-12 col-md-2 col-menu">
                            <h2 class="title">Pet Friendly</h2>
                            <ul class="links">
                              <li><a href="#">Coir</a></li>
                              <li><a href="#">Perlite</a></li>
                              <li><a href="#">Vermiculite</a></li>
                              <li><a href="#">Sand</a></li>
                              <li><a href="#">Loam</a></li>
                              <li><a href="#">Film Pet Friendly</a></li>
                              <li><a href="#">Silt</a></li>
                              <li><a href="#">Chalk</a></li>
                              <li><a href="#">Peat</a></li>
                              <li><a href="#">Gravel</a></li>
                            </ul>
                          </div>
                          <!-- /.col -->
                          <div class="col-xs-12 col-sm-12 col-md-2 col-menu">
                            <h2 class="title">Succulents</h2>
                            <ul class="links">
                              <li><a href="#">Neem Oil</a></li>
                              <li><a href="#">Orchid Mix</a></li>
                              <li><a href="#">Insecticide</a></li>
                              <li><a href="#">Cactus Mix</a></li>
                              <li><a href="#">Bonsai Mix</a></li>
                              <li><a href="#">Plant Food</a></li>
                              <li><a href="#">Potting Soil</a></li>
                              <li><a href="#">Coir</a></li>
                              <li><a href="#">Peat Pellets</a></li>
                              <li><a href="#">Topsoil</a></li>
                            </ul>
                          </div>
                          <div class="col-xs-12 col-sm-12 col-md-4 col-menu custom-banner"> <a href="#"><img alt="" src="{{ asset('assets/images/banners/top-menu-banner1.jpg') }}"></a> </div>
                        </div>
                        <!-- /.row --> 
                      </div>
                      <!-- /.yamm-content --> </li>
                  </ul>
                </li>
                <li class="dropdown hidden-sm"> <a href="{{ route('category') }}">Fertilizers <span class="menu-label new-menu hidden-xs">new</span> </a> </li>
                <li class="dropdown hidden-sm"> <a href="{{ route('category') }}">Seeds</a> </li>
                <li class="dropdown"> <a href="{{ route('contact') }}">Gardening Tools</a> </li>
                <li class="dropdown"> <a href="{{ route('contact') }}">Outdoor Plants</a> </li>
                <li class="dropdown"> <a href="{{ route('contact') }}">Pots & Planters</a> </li>
                <li class="dropdown"> <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">Pages</a>
                  <ul class="dropdown-menu pages">
                    <li>
                      <div class="yamm-content">
                        <div class="row">
                          <div class="col-xs-12 col-menu">
                            <ul class="links">
                              <li><a href="{{ route('home') }}">Home</a></li>
                              <li><a href="{{ route('category') }}">Category</a></li>
                              <li><a href="{{ route('product.detail', 1) }}">Detail</a></li>
                              <li><a href="{{ route('shopping-cart') }}">Shopping Cart Summary</a></li>
                              <li><a href="{{ route('checkout') }}">Checkout</a></li>
                              <li><a href="{{ route('blog') }}">Blog</a></li>
                              <li><a href="{{ route('blog-details') }}">Blog Detail</a></li>
                              <li><a href="{{ route('contact') }}">Contact</a></li>
                              @guest
                              <li><a href="{{ route('login') }}">Login / Register</a></li>
                              @else
                              <li><a href="{{ route('dashboard') }}">My Account</a></li>
                              @endguest                              <li><a href="{{ route('my-wishlist') }}">Wishlist</a></li>
                              <li><a href="{{ route('terms-conditions') }}">Terms and Condition</a></li>
                              <li><a href="{{ route('track-orders') }}">Track Orders</a></li>
                              <li><a href="{{ route('product-comparison') }}">Product-Comparison</a></li>
                              <li><a href="{{ route('faq') }}">FAQ</a></li>
                              <li><a href="{{ route('404') }}">404</a></li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </li>
                  </ul>
                </li>
                <li class="dropdown  navbar-right special-menu"> <a href="#">Get 30% off on selected items</a> </li>
              </ul>
              <!-- /.navbar-nav -->
              <div class="clearfix"></div>
            </div>
            <!-- /.nav-outer --> 
          </div>
          <!-- /.navbar-collapse --> 
          
        </div>
        <!-- /.nav-bg-class --> 
      </div>
      <!-- /.navbar-default --> 
    </div>
    <!-- /.container-class --> 
    
  </div>
  <!-- /.header-nav --> 
  <!-- ============================================== NAVBAR : END ============================================== --> 
  
</header>

<!-- ============================================== HEADER : END ============================================== -->
