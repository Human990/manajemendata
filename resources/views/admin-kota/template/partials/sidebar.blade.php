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
    <div class="sidebar-heading">
        Data Master
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Data Master</span>
        </a>
        <div id="collapsePages" class="collapse 
            {{ Request::is('*master-tahun*') ? 'show' : '' }}
            {{ Request::is('*master-opd*') ? 'show' : '' }}
            {{ Request::is('*master-indeks*') ? 'show' : '' }}
            {{ Request::is('*master-jabatan*') ? 'show' : '' }}
            {{ Request::is('*master-rupiah*') ? 'show' : '' }}
            {{-- {{ Request::is('*master-jabatanlama*') ? 'show' : '' }}
            {{ Request::is('*master-jabatanbaru*') ? 'show' : '' }} --}}
            {{ Request::is('*data-pegawai*') ? 'show' : '' }}
            " aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <div class="collapse-divider"></div>
                <a href="{{ route('adminkota-tahun') }}" class="collapse-item {{ Request::is('*master-tahun*') ? 'active' : '' }}">
                    <span>Master Tahun</span>
                </a>
                <a href="{{ route('adminkota-opd') }}" class="collapse-item {{ Request::is('*master-opd*') ? 'active' : '' }}">
                    <span>Master OPD</span>
                </a>
                <a href="{{ route('adminkota-indeks') }}" class="collapse-item {{ Request::is('*master-indeks*') ? 'active' : '' }}">
                    <span>Master Indeks</span>
                </a>
                <a href="{{ route('adminkota-jabatan') }}" class="collapse-item {{ Request::is('*master-jabatan*') ? 'active' : '' }}">
                    <span>Master Jabatan</span>
                </a>
                <a href="{{ route('adminkota-rupiah') }}" class="collapse-item {{ Request::is('*master-rupiah*') ? 'active' : '' }}">
                    <span>Master Rupiah</span>
                </a>
                {{-- <a href="{{ route('adminkota-jabatanlama') }}" class="collapse-item {{ Request::is('*master-jabatanlama*') ? 'active' : '' }}">
                    <span>Master Jabatan Lama</span>
                </a>
                <a href="{{ route('adminkota-jabatanbaru') }}" class="collapse-item {{ Request::is('*master-jabatanbaru*') ? 'active' : '' }}">
                    <span>Master Jabatan Baru</span>
                </a> --}}
                <a href="{{ route('adminkota-pegawai')}}" class="collapse-item {{ Request::is('*data-pegawai*') ? 'active' : '' }}">
                    <span>Data Pegawai</span>
                </a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Laporan
    </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-file-excel"></i>
            <span>Laporan</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a href="{{ route('adminkota-tpp-total') }}" class="collapse-item">
                    <span>Rekap TPP All OPD</span>
                </a>
                <a href="{{ route('adminkota-tpp-pegawai')}}" class="collapse-item">
                    <span>Rekap TPP Per Person</span>
                </a>
                {{-- <a href="#" class="collapse-item">
                    <span>Rekap Per Jenis Tunjangan</span>
                </a> --}}
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
