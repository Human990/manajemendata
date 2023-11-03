<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-file-invoice-dollar"></i>
        </div>
        <div class="sidebar-brand-text mx-3">E <sup>REKAP</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a href="{{ route('adminkota-dashboard') }}" class="nav-link">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    {{-- <div class="sidebar-heading">
        Data Master
    </div> --}}

    <!-- Nav Item - Pages Collapse Menu -->
    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Components</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <a class="collapse-item" href="buttons.html">Buttons</a>
                <a class="collapse-item" href="cards.html">Cards</a>
            </div>
        </div>
    </li> --}}

    <!-- Nav Item - Utilities Collapse Menu -->
    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Utilities</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                <a class="collapse-item" href="utilities-color.html">Colors</a>
                <a class="collapse-item" href="utilities-border.html">Borders</a>
                <a class="collapse-item" href="utilities-animation.html">Animations</a>
                <a class="collapse-item" href="utilities-other.html">Other</a>
            </div>
        </div>
    </li> --}}

    <!-- Heading -->
    <div class="sidebar-heading">
        Data Master
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Login Screens:</h6>
                <a class="collapse-item" href="login.html">Login</a>
                <a class="collapse-item" href="register.html">Register</a>
                <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item" href="404.html">404 Page</a>
                <a class="collapse-item" href="blank.html">Blank Page</a>
            </div>
        </div>
    </li> --}}

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a href="{{ route('adminkota-tahun') }}" class="nav-link">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Master Tahun</span>
        </a>
        <a href="{{ route('adminkota-rupiah') }}" class="nav-link">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Master Rupiah</span>
        </a>
        <a href="{{ route('adminkota-jabatanlama') }}" class="nav-link">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Master Jabatan Lama</span>
        </a>
        <a href="{{ route('adminkota-jabatanbaru') }}" class="nav-link">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Master Jabatan Baru</span>
        </a>
        <a href="#" class="nav-link">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Rincian Per OPD</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Laporan
    </div>

    <li class="nav-item">
        <a href="{{ route('adminkota-tpp-total') }}" class="nav-link">
            <i class="fas fa-fw fa-file-excel"></i>
            <span>Rekap Total All OPD</span>
        </a>
        <a href="#" class="nav-link">
            <i class="fas fa-fw fa-file-excel"></i>
            <span>Rekap Per Person Cetak</span>
        </a>
        <a href="#" class="nav-link">
            <i class="fas fa-fw fa-file-excel"></i>
            <span>Rekap Per Jenis Tunjangan</span>
        </a>
    </li>
    {{-- <a href="{{route('master-pegawai')}}" class="@yield('master-pegawai') nav-link">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Master Pegawai</span>
        </a>
        <a href="{{route('tpp-beban-kerja')}}" class="@yield('tpp-beban-kerja') nav-link">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>TPP Beban Kerja</span>
        </a> --}}
    {{-- <a href="{{ route('pegawai-bulanan') }}" class="@yield('pegawai-bulanan') nav-link">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Pegawai Bulanan All OPD</span>
        </a>
        <a href="{{ route('tpp-pegawai') }}" class="@yield('tpp-pegawai') nav-link">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Rekap Tpp Per OPD</span>
        </a>
        <a href="{{ route('tpp-total') }}" class="@yield('tpp-total') nav-link">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Rekap Tpp Total</span>
        </a>
        <a href="{{ route('tpp-kondisi2') }}" class="@yield('tpp-guru-rsud') nav-link">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Rekap Tpp Total ( Guru & RSUD terpisah )</span>
        </a>
        <a href="#" class="@yield('tpp-detail') nav-link">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Rekap Tpp Total Detail</span>
        </a> --}}


    <!-- Nav Item - Tables -->
    {{-- <li class="nav-item">
        <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span></a>
    </li> --}}

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->
    {{-- <div class="sidebar-card d-none d-lg-flex">
        <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
        <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
        <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
    </div> --}}

</ul>
