<div class="main-sidebar sidebar-style-2">
<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
    <a href="#">Stisla</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
    <a href="#">St</a>
    </div>
    <ul class="sidebar-menu">
    <li class="menu-header">Dashboard</li>
    <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
    
    <li class="menu-header">Ecommerce</li>
    <li class="{{ Route::is('admin.categories.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.categories.index') }}"><i class="fas fa-tags"></i> <span>Categories</span></a></li>
    <li class="{{ Route::is('admin.products.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.products.index') }}"><i class="fas fa-box"></i> <span>Products</span></a></li>
    <li class="{{ Route::is('admin.inventory.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.inventory.index') }}"><i class="fas fa-boxes"></i> <span>Inventory</span></a></li>
    <li class="{{ Route::is('admin.orders.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.orders') }}"><i class="fas fa-shopping-cart"></i> <span>Orders</span></a></li>
    
    <li class="menu-header">CMS</li>
    <li class="{{ Route::is('admin.subscribers.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.subscribers.index') }}"><i class="fas fa-envelope"></i> <span>Subscribers</span></a></li>
    <li class="{{ Route::is('admin.sliders.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.sliders.index') }}"><i class="fas fa-images"></i> <span>Sliders</span></a></li>
    <li class="{{ Route::is('admin.settings.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.settings.index') }}"><i class="fas fa-cog"></i> <span>Settings</span></a></li>
    </ul>

    <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
    <a href="{{ route('home') }}" class="btn btn-primary btn-lg btn-block btn-icon-split" target="_blank">
        <i class="fas fa-rocket"></i> View Frontend
    </a>
    </div>        
</aside>
</div>
