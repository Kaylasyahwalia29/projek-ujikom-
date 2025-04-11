@extends('layouts.front')

@section('content')
    <div class="untree_co-section before-footer-section">
        <div class="container">
            <div class="row mb-5">
                <form class="col-md-12" method="post">
                    <div class="site-blocks-table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">Gambar</th>
                                    <th class="product-name">Produk</th>
                                    <th class="product-price">Harga</th>
                                    <th class="product-quantity">Jumlah</th>
                                    <th class="product-total">Total Harga</th>
                                    {{-- <th class="product-remove">Hapus</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $overallTotal = 0; // Inisialisasi total keseluruhan
                                @endphp
                                @foreach ($keranjang as $item)
                                
                                    <tr>
                                        <td class="product-thumbnail">
                                            <img src="{{ asset('front/images/produk/')}} .$item->produk->image_produk)}}" alt="Image"
                                            class="img-fluid" style="height: 100px">
                                        </td>
                                        <td class="product-name">
                                            <h2 class="h5 text-black">{{ $item->name_produk }}</h2>
                                        </td>
                                        <td>{{ number_format($item->harga_produk, 3 , 0, ',') }}</td>
                                        <td>
                                            <div class="input-group mb-3 d-flex align-items-center quantity-container"
                                                style="max-width: 120px;">
                                                <input type="number" class="form-control text-center quantity-amount"
                                                    value="{{ isset($quantity) ? $quantity : 1 }}" placeholder=""
                                                    aria-label="Example text with button addon"
                                                    aria-describedby="button-addon1"
                                                    onchange="updateTotal(this, {{ $item->harga_produk }})">
                                            </div>
                                        </td>

                                        <td class="total-harga">
                                            {{ number_format($item->totalHarga ?? 0, 4, '.', ',') }}
                                        </td>
                                        {{-- <td>
                                            <a href="" class="btn btn-black btn-sm">X</a>
                                        </td> --}}

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="row mb-5">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <button class="btn btn-black btn-sm btn-block"
                                onclick="window.location='{{ url('/produk') }}'">Tambahkan Produk</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 pl-5">
                    <div class="row justify-content-end">
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-12 text-right border-bottom mb-5">
                                    <h3 class="text-black h4 text-uppercase">Total Keranjang</h3>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <span class="text-black">Subtotal</span>
                                </div>
                                <div class="col-md-6 text-right">
                                    <strong class="text-black"
                                        id="cart-subtotal">{{ number_format($overallTotal, 2, 0, ',') }}</strong>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-6">
                                    <span class="text-black">Total</span>
                                </div>
                                <div class="col-md-6 text-right">
                                    <strong class="text-black"
                                        id="cart-total">{{ number_format($overallTotal, 2, 0, ',') }}</strong>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-black btn-block" style="font-size: 14px;"
                                        onclick="window.location='{{ url('/pembayaran') }}'">Lanjutkan ke
                                        Pembayaran</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    // Fungsi untuk memperbarui total harga produk ketika jumlah diubah
    function updateTotal(element, price) {
        var quantity = element.value;
        var total = price * quantity;
        var totalHargaElement = element.closest('tr').querySelector('.total-harga');
        totalHargaElement.innerHTML = formatNumber(total);
        updateOverallTotal();
    }

    // Fungsi untuk memperbarui total keseluruhan ketika harga produk berubah
    function updateOverallTotal() {
        var overallTotal = 0;
        document.querySelectorAll('.total-harga').forEach(function(element) {
            overallTotal += parseFloat(element.innerHTML.replace(/,/g, ''));
        });
        document.getElementById('cart-subtotal').innerHTML = formatNumber(overallTotal);
        document.getElementById('cart-total').innerHTML = formatNumber(overallTotal);
    }

    // Fungsi untuk memformat angka agar memiliki dua tempat desimal dan pemisah ribuan
    function formatNumber(number) {
        return number.toLocaleString('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    }
</script>
