@php
$menu = collect([
# --- menu 1 --- #
(object) [
'title' => 'Beranda',
'icon' => 'fas fa-fw fa-home',
'route' => 'dashboard',
'submenu' => null
],
# --- menu 1 --- #
# --- menu 1 --- #
(object) [
'title' => 'Laporan Harian',
'icon' => 'fas fa-fw fa-file-alt',
'route' => 'laporan_harian.index',
'submenu' => null
],
# --- menu 1 --- #
# --- menu 3 --- #
(object) [
'title' => 'Laporan Bulanan',
'icon' => 'fas fa-fw fa-print',
'route' => null,
'submenu' => [
## --- submenu 3.2 --- #
(object) [
'title' => 'Cetak',
'route' => null
],
## --- submenu 3.1 --- #
## --- submenu 3.2 --- #
(object) [
'title' => 'E-Samsat',
'route' => 'laporan_bulanan_esamsat.index'
],
## --- submenu 3.2 --- #
// ## --- submenu 3.2 --- #
// (object) [
// 'title' => 'SKPD',
// 'route' => 'dashboard'
// ],
// ## --- submenu 3.2 --- #
]
],
# --- menu 2 --- #
# --- menu 3 --- #
(object) [
'title' => 'Pengaturan',
'icon' => 'fas fa-fw fa-wrench',
'route' => null,
'submenu' => [
## --- submenu 3.2 --- #
(object) [
'title' => 'Aplikasi',
'route' => null
],
## --- submenu 3.1 --- #
## --- submenu 3.2 --- #
(object) [
'title' => 'Payment Point',
'route' => 'payment_point.index'
],
## --- submenu 3.2 --- #
## --- submenu 3.2 --- #
(object) [
'title' => 'Penandatangan',
'route' => 'penandatangan.index'
],
## --- submenu 3.2 --- #
## --- submenu 3.2 --- #
(object) [
'title' => 'Kota Penandatangan',
'route' => 'kota_penandatangan.index'
],
## --- submenu 3.2 --- #
## --- submenu 3.2 --- #
(object) [
'title' => 'User',
'route' => 'user.index'
],
## --- submenu 3.2 --- #
## --- submenu 3.2 --- #
(object) [
'title' => 'Klasifikasi',
'route' => null
],
## --- submenu 3.1 --- #
## --- submenu 3.2 --- #
(object) [
'title' => 'Jenis PKB',
'route' => 'jenis_pkb.index'
],
## --- submenu 3.2 --- #
## --- submenu 3.2 --- #
(object) [
'title' => 'Wilayah',
'route' => 'wilayah.index'
],
## --- submenu 3.2 --- #
## --- submenu 3.2 --- #
(object) [
'title' => 'Jenis Kasir',
'route' => 'kasir.index'
],
## --- submenu 3.2 --- #
## --- submenu 3.2 --- #
(object) [
'title' => 'Kasir Pembayaran',
'route' => 'kasir_pembayaran.index'
],
## --- submenu 3.2 --- #
]
],
# --- menu 2 --- #
]);
@endphp

<ul class="navbar-nav bg-primary sidebar sidebar-dark accordion" id="sidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center mb-3" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <img class="d-block" src={{ asset('assets/img/logo.png') }} height="64" />
        </div>
    </a>
    @foreach ($menu as $m)
    @if(!empty($m->submenu))
    <li
        class="nav-item @foreach($m->submenu as $xsm) @if(collect($xsm)->contains(Route::currentRouteName())) active @endif @endforeach">
        <a href="javascript:void(0)" class="nav-link collapsed" data-toggle="collapse"
            data-target="#{{ Str::slug($m->title) }}" aria-expanded="true" aria-controls="{{ Str::slug($m->title) }}">
            <i class="{{ $m->icon }}"></i>
            <span>{{ $m->title }}</span>
        </a>
        <div id="{{ Str::slug($m->title) }}"
            class="collapse @foreach($m->submenu as $xsm) @if(collect($xsm)->contains(Route::currentRouteName())) show @endif @endforeach"
            aria-labelledby="{{ Str::slug($m->title) }}" data-parent="#sidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @foreach ($m->submenu as $sm)
                @if(!empty($sm->route))
                <a class="collapse-item @if(Route::is($sm->route)) active @endif" href="{{ URL::route($sm->route) }}">{{
                    $sm->title }}</a>
                @else
                <h6 class="collapse-header mt-3">{{ $sm->title }}</h6>
                @endif
                @endforeach
            </div>
        </div>
    </li>
    @else
    <li class="nav-item @if(Route::is($m->route)) active @endif">
        <a class="nav-link" href="{{ URL::route($m->route) }}">
            <i class="{{ $m->icon }}"></i>
            <span>{{ $m->title }}</span>
        </a>
    </li>
    @endif
    @endforeach
</ul>