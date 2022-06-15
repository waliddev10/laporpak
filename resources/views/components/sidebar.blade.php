<div class="sidebar-wrapper">
    <div>
        <div class="logo-wrapper"><a>
                <img class="for-light" src="{{ asset('assets/images/logo/logo.png') }}" alt="" height="50"><img
                    class="for-dark" src="{{ asset('assets/images/logo/logo_dark.png') }}" alt="" height="50"></a>
            <div class="back-btn"><i class="fa fa-angle-left"></i></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid">
                </i></div>
        </div>
        <div class="logo-icon-wrapper"><a href="index.html"><img src="{{ asset('assets/images/logo/logo-icon.png') }}"
                    alt="" height="36"></a></div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn"><a href="index.html"><img height="36"
                                src="{{ asset('assets/images/logo/logo-icon.png') }}" alt=""></a>
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                aria-hidden="true"></i></div>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>General</h6>
                        </div>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav active" href="{{ route('dashboard') }}">
                            <i data-feather="clock"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="file-manager.html">
                            <i data-feather="calendar"></i>
                            <span>Kalender Penugasan</span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="file-manager.html">
                            <i data-feather="folder"></i>
                            <span>Arsip Penugasan</span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="file-manager.html">
                            <i data-feather="file-text"></i>
                            <span>Riwayat Penugasan</span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="file-manager.html">
                            <i data-feather="phone"></i>
                            <span>Kontak Pegawai</span>
                        </a>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Admin</h6>
                        </div>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title" href="#">
                            <i data-feather="database"></i>
                            <span>Data Master</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{ route('dashboard') }}">Daftar Bidang</a></li>
                            <li><a href="{{ route('dashboard') }}">Daftar SKPD</a></li>
                            <li><a href="{{ route('dashboard') }}">Daftar Tanggal Libur</a></li>
                            <li><a href="{{ route('dashboard') }}">Jabatan Pegawai</a></li>
                            <li><a href="{{ route('dashboard') }}">Pangkat Pegawai</a></li>
                            <li><a href="{{ route('dashboard') }}">Jenis Penugasan</a></li>
                            <li><a href="{{ route('dashboard') }}">Kategori Penugasan</a></li>
                            <li><a href="{{ route('dashboard') }}">Jabatan dalam Tim</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="{{ route('user.index') }}">
                            <i data-feather="users"></i>
                            <span>Data User</span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="file-manager.html">
                            <i data-feather="info"></i>
                            <span>Info Aplikasi</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>
