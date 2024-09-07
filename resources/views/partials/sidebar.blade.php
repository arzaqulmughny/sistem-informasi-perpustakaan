@php
    $menu = App\Helpers\Menu::MENU;
@endphp

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center my-2" href="/">
        <div class="sidebar-brand-icon" style="width: 40px; overflow: hidden; height: 40px; min-width: 40px;">
            <img style="width: 100%; height: 100%; object-fit: contain; object-position: center;"
                src="" alt="">
        </div>
        <div class="sidebar-brand-text mx-3" style="text-align: start;">{{ env('APP_NAME') ?? '' }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    @foreach ($menu as $menuItem)
        @if ($menuItem['type'] === 'group')
            <div class="sidebar-heading">
                {{ $menuItem['label'] }}
            </div>

            @foreach ($menuItem['links'] as $menuItemChild)
                @if ($menuItemChild['type'] === 'single')
                    <li class="nav-item {{ Request::is(ltrim($menuItemChild['link'], '/')) ? 'active': '' }}" href="{{ $menuItemChild['link'] }}">
                        <a class="nav-link" href="{{ $menuItemChild['link'] }}">
                            {!! $menuItemChild['icon'] !!}
                            <span>{{ $menuItemChild['label'] }}</span></a>
                    </li>
                @endif
            @endforeach
        @elseif($menuItem['type'] === 'single')
            <li class="nav-item {{ Request::is(ltrim($menuItem['link'])) ? 'active': '' }}">
                <a class="nav-link" href="{{ $menuItem['link'] }}">
                    {!! $menuItem['icon'] !!}
                    <span>{{ $menuItem['label'] }}</span></a>
            </li>
        @endif
    @endforeach
    {{-- <!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="index.html">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li> --}}

    <!-- Divider -->
    {{-- <hr class="sidebar-divider"> --}}

    <!-- Heading -->
    {{-- <div class="sidebar-heading">
    Menu
</div> --}}

    <!-- Nav Item - Pages Collapse Menu -->
    {{-- <li class="nav-item">
    <a class="nav-link" href="charts.html">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Single</span></a>
</li> --}}

    {{-- <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Multi Level</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Components:</h6>
            <a class="collapse-item" href="buttons.html">Halaman</a>
        </div>
    </div>
</li> --}}

    <!-- Divider -->
    {{-- <hr class="sidebar-divider d-none d-md-block"> --}}

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline mt-5">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
