<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
            
        <a class="navbar-brand m-0" href="{{ route('profile') }}" target="_blank">
            <img src="{{ asset('img/Logo_PLN.png') }}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">Pusharlis P3K Management </span>
            
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'profile' ? 'active' : '' }}"
                    href="{{ route('profile') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>
            @if (Auth::check() && (Auth::user()->role === 'manager' || Auth::user()->role === 'supervisor'))
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}"
                        href="{{ route('home') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
            @endif
            {{-- <li class="nav-item mt-3 d-flex align-items-center">
                <div class="ps-4">
                    <i class="fab fa-laravel" style="color: #f4645f;"></i>
                </div>
                <h6 class="ms-2 text-uppercase text-xs font-weight-bolder opacity-6 mb-0">Pages</h6>
            </li> --}}
            
            @if (Auth::check() && Auth::user()->role === 'admin')
                <li class="nav-item">
                    <a class="nav-link {{ str_contains(request()->url(), 'view_user') == true ? 'active' : '' }}"
                        href="{{ route('view_user.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-bullet-list-67 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">User Management</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ route('inspeksi.show') == url()->current() ? 'active' : '' }}"
                        href="{{ route('inspeksi.show') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-archive text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Inpeksi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ route('kotak.index') == url()->current() ? 'active' : '' }}"
                        href="{{ route('kotak.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-archive text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">kotak P3K</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#portaldata" aria-controls="portaldata" role="button"
                        aria-expanded="false"
                        class="nav-link {{ str_contains(request()->url(), 'data_p3k') == true || str_contains(request()->url(), 'kotak_p3k') == true ? 'active' : '' }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-ruler-pencil text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Portal Data</span>
                    </a>
                    <div class="collapse   " id="portaldata">

                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link " href="{{ route('kotak_p3k.index') }}">
                                    <span class="sidenav-mini-icon"> L </span>
                                    <span class="sidenav-normal"> List Kotak P3K </span>
                                </a>
                                <a class="nav-link " href="{{ route('data_p3k.index') }}">
                                    <span class="sidenav-mini-icon"> L </span>
                                    <span class="sidenav-normal"> List Items </span>
                                </a>
                                <a class="nav-link " href="{{ route('lemari.index') }}">
                                    <span class="sidenav-mini-icon"> L </span>
                                    <span class="sidenav-normal"> Lemari </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="{{ route('history.index') }}">
                                    <span class="sidenav-mini-icon"> L </span>
                                    <span class="sidenav-normal"> History Pemakaian </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="{{ route('history.request') }}">
                                    <span class="sidenav-mini-icon"> L </span>
                                    <span class="sidenav-normal"> History Request </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif
            @if (Auth::check() && Auth::user()->role === 'teamP3K')
                <li class="nav-item">
                    <a class="nav-link {{ route('kotak.index') == url()->current() ? 'active' : '' }}"
                        href="{{ route('landing.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-archive text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Landing</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ route('kotak.index') == url()->current() ? 'active' : '' }}"
                        href="{{ route('kotak.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-archive text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">kotak P3K</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ route('inspeksi.show') == url()->current() ? 'active' : '' }}"
                        href="{{ route('inspeksi.show') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-archive text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Inpeksi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#form" aria-controls="dashboardsExamples" role="button"
                        aria-expanded="false"
                        class="nav-link {{ str_contains(request()->url(), 'input_P3K') == true || str_contains(request()->url(), 'history') == true || str_contains(request()->url(), 'request') == true || str_contains(request()->url(), 'request_P3K') == true ? 'active' : '' }}"
                        id="dropdownForms">

                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-ruler-pencil text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Forms</span>
                    </a>
                    <div class="collapse " id="form">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link " href="{{ route('input_P3K.index') }}">
                                    <span class="sidenav-mini-icon"> L </span>
                                    <span class="sidenav-normal"> Pengguanaan P3K </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="{{ route('request_P3K.index') }}">
                                    <span class="sidenav-mini-icon"> L </span>
                                    <span class="sidenav-normal"> Request P3K </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="{{ route('history.index') }}">
                                    <span class="sidenav-mini-icon"> L </span>
                                    <span class="sidenav-normal"> History Pemakaian </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="{{ route('history.request') }}">
                                    <span class="sidenav-mini-icon"> L </span>
                                    <span class="sidenav-normal"> History Request </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif
            {{-- <li class="nav-item">
                <a class="nav-link " href="{{ route('sign-in-static') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-copy-04 text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Sign In</span>
                </a>
            </li> --}}
            {{-- <li class="nav-item">
                <a class="nav-link " href="{{ route('sign-up-static') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-collection text-info text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Sign Up</span>
                </a>
            </li> --}}
        </ul>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Ambil elemen dropdown
            var dropdown = document.getElementById('form');

            // Ambil semua link submenu di dalam dropdown
            var submenuLinks = dropdown.querySelectorAll('.nav-link');

            // Tambahkan event listener untuk setiap link submenu
            submenuLinks.forEach(function(link) {
                link.addEventListener('click', function() {
                    // Buka dropdown jika ada submenu yang diklik
                    dropdown.classList.add('show');
                });
            });

            // Tutup dropdown jika link utama tidak aktif
            var dropdownToggle = document.getElementById('dropdownForms');
            dropdownToggle.addEventListener('click', function() {
                if (!dropdown.classList.contains('show')) {
                    dropdown.classList.remove('show');
                }
            });
        });
    </script>
</aside>
