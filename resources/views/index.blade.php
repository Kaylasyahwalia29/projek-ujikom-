@extends('layouts.front')

@section('content')
    <!-- Start Hero Section -->
    <div class="hero"
        style="background-image: url('../images/produk/bg1.jpg'); background-size: cover; height: 100vh; background-position: center;">
        <div class="container-fluid mt-5">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <p class="mb-4"></p>
                        {{-- <p><a href="{{url('produk')}}" class="btn btn-secondary me-2">Shop Now</a></p> --}}
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="hero-img-wrap text-lg-end">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <!-- Start kategori Product  -->
    <!-- Start kategori Product  -->
    <div class="product-section py-5" style="background-color: #f8f9fa;">
        <div class="container">
            <div class="row align-items-start mb-5">

                <!-- Produk Grid Dalam Kotak -->
                <div class="col-lg-12">
                    <p class="mb-4"></p><!-- Ubah dari col-lg-9 menjadi col-lg-12 -->
                    <div class="card shadow-sm border-0 p-4" style="border-radius: 15px;">
                        <div class="row">

                            
                            @foreach ($produk as $item)
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                                    <!-- Ubah col-lg-4 menjadi col-lg-3 untuk menampilkan lebih banyak produk dalam satu baris -->
                                    <div class="card h-100 shadow-sm border-0 product-card text-center">
                                        <a href="{{ url('produk', $item->id) }}">
                                            <img src="{{ asset('images/produk/' . $item->image_produk) }}"
                                                class="card-img-top"
                                                style="height: 230px; object-fit: cover; border-radius: 10px;"
                                                alt="{{ $item->name_produk }}">
                                        </a>
                                        <div class="card-body">
                                            <h5 class="card-title mb-1 fw-semibold">
                                                {{ $item->name_produk }}
                                            </h5>
                                            <div class="text-success fw-bold mb-2">
                                                Rp {{ number_format($item->harga_produk, 0, ',', '.') }}
                                            </div>

                                            <!-- Rating -->
                                            <div class="mb-2">
                                                @php
                                                    $rating = $item->rating ?? 0;
                                                    $fullStars = floor($rating);
                                                    $halfStar = $rating - $fullStars >= 0.5;
                                                    $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                                                @endphp

                                                @for ($i = 0; $i < $fullStars; $i++)
                                                    <i class="fa fa-star text-warning"></i>
                                                @endfor
                                                @if ($halfStar)
                                                    <i class="fa fa-star-half-o text-warning"></i>
                                                @endif
                                                @for ($i = 0; $i < $emptyStars; $i++)
                                                    <i class="fa fa-star-o text-warning"></i>
                                                @endfor
                                            </div>
                                        </div>
                                        <!-- Tombol Lihat Selengkapnya -->
                                        <a href="{{ url('produk', $item->id) }}"
                                            class="btn btn-sm btn-primary mt-1">
                                            Lihat Selengkapnya
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- End Product Section -->

    <!-- Start Why Choose Us Section -->
    <style>
        .why-choose-section {
            background-color: #f8f9fa;
            padding: 80px 0;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .feature {
            margin-bottom: 30px;
            text-align: left;
            transition: transform 0.3s ease;
        }

        .feature:hover {
            transform: translateY(-5px);
        }

        .feature .icon {
            color: #27ae60;
            margin-bottom: 15px;
        }

        .feature h3 {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .feature p {
            font-size: 0.95rem;
            color: #555;
        }

        .img-wrap img {
            border-radius: 12px;
            object-fit: cover;
            width: 100%;
            height: 100%;
        }

        @media (max-width: 768px) {
            .why-choose-section {
                text-align: center;
            }

            .feature {
                text-align: center;
            }

            .img-wrap {
                margin-top: 40px;
            }
        }
    </style>

    <div class="why-choose-section">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-6">
                    <h2 class="section-title">Why Choose Us</h2>
                    <p class="mb-5">Kami memberikan layanan terbaik dan pengalaman belanja yang menyenangkan untuk
                        pelanggan kami.</p>

                    <div class="row">
                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <i class="bi bi-truck" style="font-size: 40px;"></i>
                                </div>
                                <h3>Fast & Free Shipping</h3>
                                <p>Pengiriman cepat dan gratis ke seluruh Indonesia.</p>
                            </div>
                        </div>
                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <i class="bi bi-bag" style="font-size: 40px;"></i>
                                </div>
                                <h3>Easy to Shop</h3>
                                <p>Proses belanja yang mudah dan ramah pengguna.</p>
                            </div>
                        </div>
                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <i class="bi bi-life-preserver" style="font-size: 40px;"></i>
                                </div>
                                <h3>24/7 Support</h3>
                                <p>Dukungan pelanggan yang siap membantu kapan saja.</p>
                            </div>
                        </div>
                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <i class="bi bi-arrow-return-left" style="font-size: 40px;"></i>
                                </div>
                                <h3>Hassle-Free Returns</h3>
                                <p>Pengembalian produk yang mudah dan tanpa ribet.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="img-wrap">
                        <img src="{{ asset('images/produk/img_inspiring_com.jpg') }}" alt="Image" class="img-fluid"
                            style="height: 500px;">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- End Why Choose Us Section -->

    <!-- Start Blog Section -->
    <div class=" blog-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-6">
                    <h2 class="section-title">Recent Blog</h2>
                </div>
            </div>

            <div class="row">
                @foreach ($informasi as $item)
                    <div class="col-12 col-sm-6 col-md-4 mb-4 mb-md-0">
                        <div class="post-entry">
                            <a href="#" class="post-thumbnail"><img
                                    src="{{ asset('images/informasi/' . $item->image_informasi) }}" alt="Image"
                                    class="img-fluid" style="height: 300px; width: 350px;"></a>
                            <div class="post-content-entry">
                                <h4 style="color: black"><b>{{ $item->name_informasi }}</b></h4>
                                <h6>{{ $item->desc_informasi }}</h6>
                                <div class="meta">
                                    <span>by <a href="#">Admin</a></span> <span>on <a
                                            href="#">{{ $item->tgl_informasi }}</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- End Blog Section -->
@endsection
