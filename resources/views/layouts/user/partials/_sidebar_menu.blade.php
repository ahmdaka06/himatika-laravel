<ul class="menu-inner py-1 d-none-print">
    @auth
    <!-- Dashboards -->
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Menu Utama</span></li>
    <li class="menu-item {{ request()->is('dashboard') ? 'active' : '' }}">
        <a href="{{ route('user.dashboard.index') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Basic">Dashboard</div>
        </a>
    </li>
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Peserta</span></li>
    <li class="menu-item {{ request()->is('dashboard/participants') || request()->is('dashboard/participants/*') ? 'active' : '' }}">
        <a href="{{ route('user.participant.index') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-user"></i>
            <div data-i18n="Basic">Peserta</div>
        </a>
    </li>
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Berita</span></li>
    <li class="menu-item {{ request()->is('dashboard/news') || request()->is('dashboard/news/*') ? 'active' : '' }}">
        <a href="{{ route('user.news.index') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-user"></i>
            <div data-i18n="Basic">Berita</div>
        </a>
    </li>
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Pengaturan Website</span></li>
    <li class="menu-item {{ request()->is('dashboard/website-config') || request()->is('dashboard/website-config/*') ? 'active' : '' }}">
        <a href="{{ route('user.website-config.indexGET') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-user"></i>
            <div data-i18n="Basic">Pengaturan Website</div>
        </a>
    </li>
    @endauth
    <!-- Layouts -->
    {{-- <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-layout"></i>
            <div data-i18n="Layouts">Layouts</div>
        </a>

        <ul class="menu-sub">
            <li class="menu-item">
                <a href="layouts-without-menu.html" class="menu-link">
                    <div data-i18n="Without menu">Without menu</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="layouts-without-navbar.html" class="menu-link">
                    <div data-i18n="Without navbar">Without navbar</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="layouts-container.html" class="menu-link">
                    <div data-i18n="Container">Container</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="layouts-fluid.html" class="menu-link">
                    <div data-i18n="Fluid">Fluid</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="layouts-blank.html" class="menu-link">
                    <div data-i18n="Blank">Blank</div>
                </a>
            </li>
        </ul>
    </li> --}}


</ul>
