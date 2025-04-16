@extends('layouts.front')

@section('content')

 
    <!-- Start Hero Section -->
    <div class="hero" style="background-image: url('../images/produk/bg3.jpg'); background-size: cover; height: 60vh; background-position: center;">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>About</h1>
                        <p class="mb-4">Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam
                            vulputate velit imperdiet dolor tempor tristique.</p>
                        {{-- <p><a href="" class="btn btn-secondary me-2">Shop Now</a></p> --}}
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="hero-img-wrap text-lg-end">
                        <img src="{{ asset('front/assets/images/bg1.png') }}"
                            style="max-height: 500px; margin-left: 170px; margin-top: -150px" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->
    
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
    
@endsection