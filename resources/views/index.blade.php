@extends('layouts.front')

@section('content')


<!-- Start Hero Section -->
<div class="hero" style="background-image: url('../images/produk/bg1.jpg'); background-size: cover; height: 100vh; background-position: center;">
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
<div class="product-section">
    <div class="container">
        <div class="row">

            <!-- Start Column 1 -->
            <div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
                <h2 class="mb-4 section-title" style="font-size: 45px">product category</h2>
                <p class="mb-4">Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam
                    vulputate velit imperdiet dolor tempor tristique. </p>
            </div>
            <!-- End Column 1 -->

            <!-- Start Column 2 -->
            @foreach($kategori as $item)
            <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                <div class="text-center">
                    <a href="{{url('kategori', $item->id)}}">
                        <img src="{{asset('images/kategori/'.$item->image_kategori)}}"
                            style="height: 250px; width: 200px; border-radius: 20px;"
                            class="img-fluid product-thumbnail" alt="Nordic Chair">
                    </a>
                    <div class="pt-3">
                        <h3 class="product-title"><a href="cart.html"
                                style="text-decoration: none; color: inherit;">{{$item->name_kategori}}</a></h3>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- End Column 2 -->
        </div>
    </div>
</div>
<!-- End Product Section -->

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
                    <img src="{{ asset('images/produk/img_inspiring_com.jpg') }}" alt="Image" class="img-fluid"
                        style="width: 106%; max-width: none; height: 500px;">
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
                            @foreach($informasi as $item)
                            <div class="col-12 col-sm-6 col-md-4 mb-4 mb-md-0">
                                <div class="post-entry">
                                    <a href="#" class="post-thumbnail"><img
                                            src="{{asset('images/informasi/'.$item->image_informasi)}}" alt="Image"
                                            class="img-fluid" style="height: 300px; width: 350px;"></a>
                                    <div class="post-content-entry">
                                        <h4 style="color: black"><b>{{$item->name_informasi}}</b></h4>
                                        <h6>{{$item->desc_informasi}}</h6>
                                        <div class="meta">
                                            <span>by <a href="#">Admin</a></span> <span>on <a href="#">{{$item->tgl_informasi}}</a></span>
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