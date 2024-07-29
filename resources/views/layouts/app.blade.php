<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{ config('app.name') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])

        {{-- datatable --}}
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">

        <script src="https://kit.fontawesome.com/a584191b57.js" crossorigin="anonymous"></script>
    </head>

    <body>
        <div class="sidebar sidebar-dark sidebar-fixed border-end" id="sidebar">
            <div class="sidebar-header border-bottom">
                <div class="sidebar-brand">
                    <svg class="sidebar-brand-full" width="88" height="32" alt="CoreUI Logo">
                        <use xlink:href="/assets/brand/coreui.svg#full"></use>
                    </svg>
                    <svg class="sidebar-brand-narrow" width="32" height="32" alt="CoreUI Logo">
                        <use xlink:href="/assets/brand/coreui.svg#signet"></use>
                    </svg>
                </div>
                <button class="btn-close d-lg-none" type="button" data-coreui-dismiss="offcanvas"
                    data-coreui-theme="dark" aria-label="Close"
                    onclick="coreui.Sidebar.getInstance(document.querySelector(&quot;#sidebar&quot;)).toggle()"></button>
            </div>
            <ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
                <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">
                        <div class="nav-icon">
                            <i class="cil-speedometer icon icon-lg"></i>
                        </div> Dashboard
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('payments.list-siswa') }}">
                        <div class="nav-icon">
                            <i class="cil-money icon icon-lg"></i>
                        </div> Pembayaran
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('jadwal.pertemuan') }}">
                        <div class="nav-icon">
                            <i class="fa fa-calendar icon icon-lg"></i>
                        </div> Jadwal Pertemuan
                    </a></li>

                <li class="nav-divider"></li>
                <li class="nav-title">Master Data</li>
                <li class="nav-item"><a class="nav-link" href="{{ route('siswa.index') }}">
                        <div class="nav-icon">
                            <i class="fa fa-child"></i>
                        </div> Siswa
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('alumni.index') }}">
                        <div class="nav-icon">
                            <i class="fa fa-user-graduate"></i>
                        </div> Alumni
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}">
                        <div class="nav-icon">
                            <i class="cil-people"></i>
                        </div> Users
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('program.index') }}">
                        <div class="nav-icon">
                            <i class="cil-book"></i>
                        </div> Program
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('jadwal-ajar.index') }}">
                        <div class="nav-icon">
                            <i class="cil-calendar"></i>
                        </div> Jadwal Ajar
                    </a></li>

                <li class="nav-divider"></li>
                <li class="nav-title">Sistem</li>
                <li class="nav-item"><a class="nav-link" href="{{ route('cabang.index') }}">
                        <div class="nav-icon">
                            <i class="fa-regular fa-building"></i>
                        </div> Cabang
                    </a></li>

                <li class="nav-divider"></li>
                <li class="nav-title">Laporan</li>
                <li class="nav-item"><a class="nav-link" href="{{ route('reports.payments.create') }}">
                        <div class="nav-icon">
                            <i class="fas fa-receipt"></i>
                        </div> Pembayaran
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('reports.presensi.create') }}">
                        <div class="nav-icon">
                            <i class="fas fa-receipt"></i>
                        </div> Presensi
                    </a></li>
            </ul>
            <div class="sidebar-footer border-top d-none d-md-flex">
                <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
            </div>
        </div>

        <div class="wrapper d-flex flex-column min-vh-100">
            <header class="header header-sticky mb-4 p-0">
                <div class="container-fluid border-bottom px-4">
                    <button class="header-toggler" type="button"
                        onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()"
                        style="margin-inline-start: -14px;">
                        <div class="icon icon-lg">
                            <i class="cil-menu"></i>
                        </div>
                    </button>
                    <ul class="header-nav ms-auto">
                        <li class="nav-item py-1">
                            <div class="vr h-100 text-body mx-2 text-opacity-75"></div>
                        </li>
                        <li class="nav-item dropdown">
                            <button class="btn btn-link nav-link d-flex align-items-center px-2 py-2" type="button"
                                aria-expanded="false" data-coreui-toggle="dropdown">
                                <div class="icon icon-lg theme-icon-active">
                                    <i class="cil-contrast"></i>
                                </div>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" style="--cui-dropdown-min-width: 8rem;">
                                <li>
                                    <button class="dropdown-item d-flex align-items-center" type="button"
                                        data-coreui-theme-value="light">
                                        <div class="icon me-3">
                                            <i class="cil-sun">
                                            </i>
                                        </div>Light
                                    </button>
                                </li>
                                <li>
                                    <button class="dropdown-item d-flex align-items-center" type="button"
                                        data-coreui-theme-value="dark">
                                        <div class="icon me-3">
                                            <i class="cil-moon">
                                            </i>
                                        </div>Dark
                                    </button>
                                </li>
                                <li>
                                    <button class="dropdown-item d-flex align-items-center active" type="button"
                                        data-coreui-theme-value="auto">
                                        <div class="icon me-3">
                                            <i class="cil-contrast">
                                            </i>
                                        </div>Auto
                                    </button>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item py-1">
                            <div class="vr h-100 text-body mx-2 text-opacity-75"></div>
                        </li>
                        <li class="nav-item dropdown"><a class="nav-link py-0 pe-0" data-coreui-toggle="dropdown"
                                href="#" aria-haspopup="true" aria-expanded="false">
                                <div class="avatar avatar-md"><img class="avatar-img" src="/assets/img/avatars/8.jpg"
                                        alt="user@email.com"></div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end pt-0">
                                <div
                                    class="dropdown-header bg-body-tertiary text-body-secondary fw-semibold rounded-top mb-2">
                                    <div class="fw-semibold">Account</div>
                                </div>
                                {{-- <a class="dropdown-item" href="#">
                                    <div class="icon me-2">
                                        <i class="cil-user"></i>
                                    </div> Profile
                                </a>
                                <div class="dropdown-divider"></div> --}}
                                <a class="dropdown-item" href="#" data-coreui-toggle="modal"
                                    data-coreui-target="#logoutModal">
                                    <div class="icon me-2">
                                        <i class="cil-account-logout">
                                        </i>
                                    </div> Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="container-fluid px-4">
                    <nav aria-label="breadcrumb">
                        @yield('breadcrumb')
                    </nav>
                </div>
            </header>
            <div class="body flex-grow-1">
                <div class="container-lg px-4 pb-5">
                    @yield('content')
                </div>
            </div>
            <footer class="footer px-4">
                <div><a href="https://coreui.io">CoreUI </a><a
                        href="https://coreui.io/product/free-bootstrap-admin-template/">Bootstrap Admin Template</a>
                    &copy; 2024 creativeLabs.</div>
                <div class="ms-auto">Powered by&nbsp;<a href="https://coreui.io/docs/">CoreUI UI Components</a></div>
            </footer>
        </div>

        <!-- Logout Modal -->
        <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="logoutModalLabel">Logout</h5>
                        <button type="button" class="btn-close" data-coreui-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin keluar?
                    </div>
                    <form class="modal-footer" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Logout</button>
                    </form>
                </div>
            </div>
        </div>

        <script>
            const header = document.querySelector('header.header');

            document.addEventListener('scroll', () => {
                if (header) {
                    header.classList.toggle('shadow-sm', document.documentElement.scrollTop > 0);
                }
            });
        </script>

        <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"
            integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
        <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>

        @yield('script')
    </body>

</html>
