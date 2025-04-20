<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar"
    style="border: 1px solid">

    @php
        $cartCount = \App\Models\Keranjang::where('user_id', session('loginId'))->count();
    @endphp


    <div class="container">
        <a class="navbar-brand" href="index.html">Beauty Shop<span>.</span></a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni"
            aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsFurni">
            <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">Home</a>
                </li>
                <li><a class="nav-link" href="{{ url('/produk') }}">Shop</a></li>
                <li><a class="nav-link" href="{{ url('/about') }}">About us</a></li>
                <li><a class="nav-link" href="{{ url('/contact') }}">Contact us</a></li>
                <li><a class="nav-link" href="{{ url('/pesanan-saya') }}">Pesanan Saya</a></li>
            </ul>

            <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                <li><button class="nav-link" href="{{ url('/') }}"><i class="bi bi-search"
                            style="font-size: 23px;"></i></button></li>
                <li>

                    <!-- Tambahkan ini di layout, misalnya di dalam navbar -->
                    <li class="nav-item">
                        <a href="/keranjang" class="nav-link position-relative">
                            <i class="fa fa-shopping-cart"></i>
                            @if(auth()->check())
                                <span id="cart-count"
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ session('cart_count', 0) }}
                                </span>
                            @endif
                        </a>
                    </li>
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('register') }}">Register</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile') }}">
                            @php
                                $foto = Auth::user()->foto ?? null;
                            @endphp

                            @if($foto)
                                <img src="{{ asset('images/profile/' . $foto) }}" alt="profile" width="32" height="32"
                                    class="rounded-circle me-2" style="object-fit: cover;">
                            @else
                                <i class="fas fa-user-circle me-2 fa-lg"></i>
                            @endif
                            <span>{{ Auth::user()->name }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="nav-link">Logout</button>
                        </form>
                    </li>
                @endguest



            </ul>
        </div>
    </div>

</nav>
