@extends('layouts.front')

@section('content')
<style>
    .contain {
        font-family: Arial, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        background-color: #f5f5f5;
        font-size: 1.2em;
        padding: 50px 20px;
        /* Adjusted padding */
    }

    .containe {
        display: flex;
        background-color: white;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        max-width: 1000px;
        overflow: hidden;
        margin: auto;
        /* Center horizontally */
    }

    .image {
        flex: 1;
        background-size: contain;
        /* Changed to contain */
        background-position: center center;
        /* Centered horizontally and vertically */
        height: 500px;
    }

    .details {
        flex: 1;
        padding: 30px;
    }

    .details h1 {
        font-size: 2em;
        margin: 0 0 10px;
    }

    .details .price {
        font-size: 1.5em;
        color: #27ae60;
        margin: 0 0 20px;
    }

    .details p {
        font-size: 1.2em;
        color: #555;
        margin: 0 0 20px;
        /* Adjusted margin */
    }

    .details .add-to-cart {
        display: inline-block;
        padding: 15px 30px;
        background-color: #27ae60;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        font-size: 1.5em;
        font-weight: bold;
        transition: background-color 0.3s ease;
        /* Added transition */
    }

    .details .add-to-cart:hover {
        background-color: #219653;
        /* Darker shade on hover */
    }
</style>

<div class="contain">
    <div class="container">
        <img src="{{ asset('images/produk/'.$produk->image_produk) }}" class="image" alt="Product Image" style="max-height: 300px; max-widht: 100px;">
        <div class="details">
            <h1>{{ $produk->name_produk }}</h1>
            <div class="price">Rp {{ number_format($produk->harga_produk, 0, ',', '.') }}</div>
            <p>{{ $produk->desc_produk }}</p>
            <a href="{{url('keranjang')}}" class="add-to-cart">Add to Cart</a>
        </div>
    </div>
</div>
@endsection