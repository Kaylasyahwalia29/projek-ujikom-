@extends('layouts.front')

@section('content')
    <div class="untree_co-section before-footer-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-12">
                    <div class="site-blocks-table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">Gambar</th>
                                    <th class="product-name">Produk</th>
                                    <th class="product-price">Harga</th>
                                    <th class="product-quantity">Jumlah</th>
                                    <th class="product-total">Total Harga</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @php $overallTotal = 0; @endphp
                                @foreach ($keranjang as $item)
                                    @php
                                        $jumlah = $item->jumlah ?? 1;
                                        $harga = $item->produk->harga ?? 0;
                                        $total = $jumlah * $harga;
                                        $overallTotal += $total;
                                    @endphp
                                    <tr>
                                        {{-- <img src="{{ asset('front/images/produk/' . ($item->produk->image_produk ?? 'default.jpg')) }}"
                                            class="img-fluid" style="height: 100px">
                                        <h2 class="h5 text-black">{{ $item->produk->nama ?? 'Produk tidak ditemukan' }}</h2> --}}
                                        @if ($item->produk)
                                            <td class="product-name">
                                                <h2 class="h5 text-black">{{ $item->produk->name_produk }}</h2>
                                            </td>
                                        @else
                                            <td class="product-name">
                                                <h2 class="h5 text-danger">Produk tidak ditemukan</h2>
                                            </td>
                                        @endif
                                        <td>{{ number_format($harga, 0, ',', '.') }}</td>
                                        <td>
                                            <div class="input-group mb-3 d-flex align-items-center quantity-container"
                                                style="max-width: 120px;">
                                                <input type="number" class="form-control text-center quantity-amount"
                                                    value="{{ $jumlah }}" min="1"
                                                    onchange="updateTotal(this, {{ $harga }})">
                                            </div>
                                        </td>
                                        <td class="total-harga">{{ number_format($total, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Total --}}
            <div class="row">
                <div class="col-md-6">
                    <button class="btn btn-black btn-sm btn-block"
                        onclick="window.location='{{ url('/produk') }}'">Tambahkan Produk</button>
                </div>

                <div class="col-md-6 pl-5">
                    <div class="row justify-content-end">
                        <div class="col-md-7">
                            <div class="border-bottom mb-5">
                                <h3 class="text-black h4 text-uppercase text-right">Total Keranjang</h3>
                            </div>
                            <div class="mb-3 d-flex justify-content-between">
                                <span class="text-black">Subtotal</span>
                                <strong class="text-black"
                                    id="cart-subtotal">{{ number_format($overallTotal, 0, ',', '.') }}</strong>
                            </div>
                            <div class="mb-5 d-flex justify-content-between">
                                <span class="text-black">Total</span>
                                <strong class="text-black"
                                    id="cart-total">{{ number_format($overallTotal, 0, ',', '.') }}</strong>
                            </div>
                            <div>
                                <button class="btn btn-black btn-block"
                                    onclick="window.location='{{ url('/pembayaran') }}'">Lanjutkan ke Pembayaran</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function updateTotal(element, price) {
            let quantity = parseInt(element.value);
            let total = price * quantity;
            let totalHargaElement = element.closest('tr').querySelector('.total-harga');
            totalHargaElement.innerHTML = formatNumber(total);
            updateOverallTotal();
        }

        function updateOverallTotal() {
            let overallTotal = 0;
            document.querySelectorAll('.total-harga').forEach(function(el) {
                let number = parseInt(el.innerHTML.replace(/\./g, ''));
                overallTotal += number;
            });

            document.getElementById('cart-subtotal').innerHTML = formatNumber(overallTotal);
            document.getElementById('cart-total').innerHTML = formatNumber(overallTotal);
        }

        function formatNumber(number) {
            return number.toLocaleString('id-ID');
        }
    </script>
@endsection
