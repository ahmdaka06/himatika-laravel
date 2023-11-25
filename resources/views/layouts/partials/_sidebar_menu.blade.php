<ul class="menu-inner py-1 d-none-print">
    <!-- Dashboards -->
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Menu Utama</span></li>
    <li class="menu-item {{ request()->is('/*') ? 'active' : '' }}">
        <a href="{{ url('/') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Basic">Halaman Utama</div>
        </a>
    </li>

    <li class="menu-header small text-uppercase"><span class="menu-header-text">Seminar</span></li>
    <li class="menu-item {{ request()->is('seminar/register') ? 'active' : '' }}">
        <a href="{{ url('/seminar/register') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-credit-card-alt"></i>
            <div data-i18n="Basic">Pendaftaran Seminar</div>
        </a>
        <a href="{{ url('/seminar/invoice') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-search"></i>
            <div data-i18n="Basic">Cari Faktur</div>
        </a>
    </li>
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
