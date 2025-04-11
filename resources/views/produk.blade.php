@extends('layouts.front')

@section('content')
<!-- Start Hero Section -->
<div class="hero" style="background-image: url('../images/produk/img_banner_pcp_sale.jpg'); background-size: cover; height: 60vh; background-position: center;">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>Shop</h1>
                </div>
            </div>
            <div class="col-lg-7">

            </div>
        </div>
    </div>
</div>
<!-- End Hero Section -->


<div class="untree_co-section product-section before-footer-section">
    <div class="container">
        <div class="row">
            @foreach($produk as $item)
            <div class="col-12 col-md-4 col-lg-3 mb-4">
                <div class="product-item">
                    <a href="{{url('produk', $item->id)}}" class="text-decoration-none">
                        <img src="{{ asset('images/produk/'.$item->image_produk) }}" class="img-fluid product-thumbnail"
                            style="max-height: 200px; object-fit: cover;" alt="{{ $item->name_produk }}">
                        <h3 class="product-title">{{ $item->name_produk }}</h3>
                        <p class="product-description">{{ $item->desc_produk }}</p>
                        <strong class="product-price">Rp {{ number_format($item->harga_produk, 0, ',', '.') }}</strong>
                        <br>
                        <a href="{{ url('keranjang') }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-plus-circle-fill mr-2"></i>Add to Cart
                        </a>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection