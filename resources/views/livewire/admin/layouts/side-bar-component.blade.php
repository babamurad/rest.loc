<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="/" target="_blank">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="/" target="_blank">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>

            <li class="{{ request()->is('admin/dashboard') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.dashboard') }}" wire:navigate><i class="fas fa-fire"></i>General Dashboard</a>
            </li>
            <li class="menu-header">Starter</li>
            <li  class="{{ request()->is('admin/slider') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.slider') }}" wire:navigate><i class="fas fa-images"></i> <span>Slider</span></a>
            </li>
            <li  class="{{ request()->is('admin/why-choose-us') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.why-choose-us') }}" wire:navigate><i class="fas fa-clipboard-check"></i> <span>Why choose us</span></a>
            </li>

             <li class="dropdown">
                 <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Manage Restaurant</span></a>
                 <ul class="dropdown-menu">
                     <li><a class="nav-link" href="{{ route('admin.category.index') }}">Product Categories</a></li>
                     <li><a class="nav-link" href="{{ route('admin.product.index') }}">Products</a></li>
                     <li><a class="nav-link" href="layout-top-navigation.html">Top Navigation</a></li>
                 </ul>
             </li>

            {{-- <li class="dropdown">
                 <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Layout</span></a>
                 <ul class="dropdown-menu">
                     <li><a class="nav-link" href="layout-default.html">Default Layout</a></li>
                     <li><a class="nav-link" href="layout-transparent.html">Transparent Sidebar</a></li>
                     <li><a class="nav-link" href="layout-top-navigation.html">Top Navigation</a></li>
                 </ul>
             </li>
             --}}

        </ul>

    </aside>
</div>
