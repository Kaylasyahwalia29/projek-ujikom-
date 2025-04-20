<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="https://demos.creative-tim.com/argon-dashboard/pages/dashboard.html" target="_blank">
            <img src="{{asset('../images/produk/logo.png')}}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold"></span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <ul class="navbar-nav">
        <!-- Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="{{url('admin/dashboard')}}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Dashboard</span>
            </a>
        </li>

        <!-- Tables Informasi -->
        <li class="nav-item">
            <a class="nav-link" href="{{url('admin/informasi')}}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-single-copy-04 text-warning text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Tables Informasi</span>
            </a>
        </li>

        <!-- Tables Kategori -->
        <li class="nav-item">
            <a class="nav-link" href="{{url('admin/kategori')}}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-app text-info text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Tables Kategori</span>
            </a>
        </li>

        <!-- Tables Produk -->
        <li class="nav-item">
            <a class="nav-link" href="{{url('admin/produk')}}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-bullet-list-67 text-danger text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Tables Produk</span>
            </a>
        </li>

        <!-- Tables Method -->
        <li class="nav-item">
            <a class="nav-link" href="{{url('admin/method')}}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-settings text-danger text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Tables Method</span>
            </a>
        </li>

        <!-- Tables Pembayaran -->
        <li class="nav-item">
            <a class="nav-link" href="{{url('admin/pembayaran')}}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Tables Pembayaran</span>
            </a>
        </li>

        <!-- Tables Keranjang -->


        <!-- Tables Transaksi -->
        <li class="nav-item">
            <a class="nav-link" href="{{url('admin/transaksi')}}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-credit-card text-warning text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Tables Transaksi</span>
            </a>
        </li>

        <!-- Tables User -->
        <li class="nav-item">
            <a class="nav-link" href="{{url('admin/user')}}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-circle-08 text-primary text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Tables User</span>
            </a>
        </li>
    </ul>
</aside>
