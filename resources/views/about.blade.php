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
    
    <!-- Start Why Choose Us Section -->
    <div class="why-choose-section">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-6">
                    <h2 class="section-title">Why Choose Us</h2>
                    <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit
                        imperdiet dolor tempor tristique.</p>
    
                    <div class="row my-5">
                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <i class="bi bi-truck" style="font-size: 40px;"></i>
                                </div>
                                <h3>Fast &amp; Free Shipping</h3>
                                <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam
                                    vulputate.</p>
                            </div>
                        </div>
    
                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <i class="bi bi-bag" style="font-size: 35px;"></i>
                                </div>
                                <h3>Easy to Shop</h3>
                                <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam
                                    vulputate.</p>
                            </div>
                        </div>
    
                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <i class="bi bi-life-preserver" style="font-size: 35px"></i>
                                </div>
                                <h3>24/7 Support</h3>
                                <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam
                                    vulputate.</p>
                            </div>
                        </div>
    
                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <i class="bi bi-arrow-return-left" style="font-size: 35px"></i>
                                </div>
                                <h3>Hassle Free Returns</h3>
                                <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam
                                    vulputate.</p>
                            </div>
                        </div>
    
                    </div>
                </div>
    
                <div class="col-lg-5">
                    <div class="img-wrap">
                        <img src="{{ asset('front/assets/images/petshop2.jpg') }}" alt="Image" class="img-fluid"
                            style="width: 100%; max-width: none; height: 500px;"">
                    </div>
                </div>
    
            </div>
        </div>
    </div>
    <!-- End Why Choose Us Section -->
    
@endsection