<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar"
    style="border: 1px solid">

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
                <li><a class="nav-link" href="{{ url('blog') }}">Blog</a></li>
                <li><a class="nav-link" href="{{ url('/contact') }}">Contact us</a></li>
            </ul>

            <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                <li><button class="nav-link" href="{{ url('/') }}"><i class="bi bi-search"
                            style="font-size: 23px;"></i></button></li>
                <li>

                <li><a class="nav-link" href="{{ url('/keranjang') }}"><i class="bi bi-cart"
                            style="font-size: 23px;"></i></a></li>
                <li>

                {{-- <li class="dropdown"><button class="dropdown-toggle" id="dropdownMenuButton"> </button></li> --}}
                    @guest


                    

                    <li>
                    <a class="nav-link" href="{{url('login')}}">Login</a>
                </li>
                <li>
                    <a class="nav-link" href="{{url('register')}}">Register</a>
                </li>

                @else
                    <a class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @endguest
                </li>
            </ul>
        </div>
    </div>

</nav>
