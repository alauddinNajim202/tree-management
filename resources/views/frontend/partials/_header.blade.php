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
    <img src="{{ asset($settings['site_logo'] ?? 'assets/images/logo.png') }}" alt="{{ $settings['site_name'] ?? 'TreeWorld' }}">
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

<header class="modern-header hidden-xs hidden-sm">
  <div class="container">
    <div class="modern-header-inner">
      <!-- LOGO -->
      <div class="modern-logo">
        <a href="{{ route('home') }}">
          <img src="{{ asset($settings['site_logo'] ?? 'assets/images/logo.png') }}" alt="{{ $settings['site_name'] ?? 'TreeWorld' }}">
        </a>
      </div>

      <!-- NAVIGATION -->
      <nav class="modern-nav">
        <ul class="modern-nav-list">
          <li><a href="{{ route('home') }}" class="active">Home</a></li>
          <li class="has-dropdown">
            <a href="{{ route('category') }}">Shop <i class="fa fa-angle-down"></i></a>
            <ul class="modern-dropdown">
              @if(isset($headerCategories) && $headerCategories->count() > 0)
                @foreach($headerCategories as $cat)
                  <li><a href="{{ route('category') }}?category={{ $cat->slug }}">{{ $cat->name }}</a></li>
                @endforeach
              @else
                <li><a href="#">No Categories</a></li>
              @endif
            </ul>
          </li>
          <li><a href="{{ route('category') }}">Indoor Plants</a></li>
          <li><a href="{{ route('contact') }}">Contact</a></li>
        </ul>
      </nav>

      <!-- ICONS -->
      <div class="modern-icons">
        <!-- Search Icon -->
        <a href="#" class="modern-icon-link" id="modernSearchTrigger">
          <i class="fa fa-search"></i>
        </a>
        
        <!-- Wishlist Icon -->
        <a href="{{ route('my-wishlist') }}" class="modern-icon-link">
          <i class="fa fa-heart-o"></i>
        </a>

        <!-- Account Icon -->
        <div class="modern-icon-dropdown-wrapper">
          <a href="{{ route('dashboard') }}" class="modern-icon-link">
            <i class="fa fa-user"></i>
          </a>
          <ul class="modern-dropdown icon-dropdown">
            @auth
              <li><a href="{{ route('dashboard') }}">My Account</a></li>
              <li><a href="{{ route('track-orders') }}">Track Orders</a></li>
              <li>
                <form method="POST" action="{{ route('logout') }}" style="display: none;" id="logout-form-desktop">
                  @csrf
                </form>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-desktop').submit();">Logout</a>
              </li>
            @endauth
            @guest
              <li><a href="{{ route('login') }}">Login</a></li>
              <li><a href="{{ route('register') }}">Register</a></li>
            @endguest
          </ul>
        </div>

        <!-- Cart Icon -->
        @php
            $cart = session()->get('cart', []);
            $cartTotal = 0;
            $cartCount = count($cart);
            foreach($cart as $item) {
                $cartTotal += $item['price'] * $item['quantity'];
            }
        @endphp
        <div class="modern-icon-dropdown-wrapper">
          <a href="{{ route('shopping-cart') }}" class="modern-icon-link">
            <i class="fa fa-shopping-bag"></i>
            <span class="modern-cart-badge">{{ $cartCount }}</span>
          </a>
          
          <!-- Mini Cart Dropdown -->
          <div class="modern-minicart">
            @if($cartCount > 0)
              <ul class="minicart-list">
                @foreach($cart as $id => $item)
                <li>
                  <div class="minicart-item">
                    <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}">
                    <div class="minicart-info">
                      <a href="{{ route('product.detail', $item['slug']) }}" class="name">{{ $item['name'] }}</a>
                      <span class="price">${{ number_format($item['price'], 2) }} x {{ $item['quantity'] }}</span>
                    </div>
                    <a href="{{ route('cart.remove', $id) }}" class="remove"><i class="fa fa-trash"></i></a>
                  </div>
                </li>
                @endforeach
              </ul>
              <div class="minicart-footer">
                <div class="subtotal">
                  <span>Subtotal:</span>
                  <strong>${{ number_format($cartTotal, 2) }}</strong>
                </div>
                <div class="actions">
                  <a href="{{ route('shopping-cart') }}" class="btn btn-primary btn-block">View Cart</a>
                  <a href="{{ route('checkout') }}" class="btn btn-outline btn-block">Checkout</a>
                </div>
              </div>
            @else
              <div class="minicart-empty">
                Your cart is empty!
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</header>

<!-- Modern Search Overlay (Hidden by default) -->
<div class="modern-search-overlay" id="modernSearchOverlay">
  <div class="search-close" id="modernSearchClose"><i class="fa fa-times"></i></div>
  <div class="search-container">
    <form>
      <input type="text" placeholder="Search for products, categories..." autofocus>
      <button type="submit"><i class="fa fa-search"></i></button>
    </form>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const trigger = document.getElementById('modernSearchTrigger');
  const overlay = document.getElementById('modernSearchOverlay');
  const close = document.getElementById('modernSearchClose');

  if(trigger && overlay && close) {
    trigger.addEventListener('click', function(e) {
      e.preventDefault();
      overlay.classList.add('active');
    });
    close.addEventListener('click', function() {
      overlay.classList.remove('active');
    });
  }
});
</script>

<!-- ============================================== HEADER : END ============================================== -->
