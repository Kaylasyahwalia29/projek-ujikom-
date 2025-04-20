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
                                        $harga = $item->produk->harga_produk ?? 0;
                                        $total = $jumlah * $harga;
                                        $overallTotal += $total;
                                    @endphp
                                    <tr>
                                        <td class="product-thumbnail">
                                            @if ($item->produk && $item->produk->image_produk)
                                                <img src="{{ asset('images/produk/' . $item->produk->image_produk) }}"
                                                    class="img-fluid" style="height: 100px">
                                            @else
                                                <img src="{{ asset('front/images/produk/default.jpg') }}" class="img-fluid"
                                                    style="height: 100px">
                                            @endif
                                        </td>

                                        <td class="product-name">
                                            @if ($item->produk)
                                                <h2 class="h5 text-black">{{ $item->produk->name_produk }}</h2>
                                            @else
                                                <h2 class="h5 text-danger">Produk tidak ditemukan</h2>
                                            @endif
                                        </td>
                                        <td>{{ number_format($harga, 0, ',', '.') }}</td>
                                        <td>
                                            <div class="input-group quantity-container" style="max-width: 140px;">
                                                <button type="button" class="btn btn-outline-secondary qty-btn"
                                                    onclick="changeQty(this, -1, {{ $item->id }}, {{ $harga }})">−</button>
                                                <input type="number" class="form-control text-center quantity-amount"
                                                    value="{{ $jumlah }}" min="1"
                                                    oninput="updateTotal(this, {{ $harga }}, {{ $item->id }})">
                                                <button type="button" class="btn btn-outline-secondary qty-btn"
                                                    onclick="changeQty(this, 1, {{ $item->id }}, {{ $harga }})">+</button>
                                            </div>
                                        </td>

                                        <td class="total-harga">{{ number_format($total, 0, ',', '.') }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-danger"
                                                onclick="hapusProduk({{ $item->id }})">Hapus</button>
                                        </td>
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

@section('scripts-front')
    <script>
        function changeQty(button, change, itemId, price) {
            let input = button.parentElement.querySelector('.quantity-amount');
            let newQty = Math.max(1, parseInt(input.value) + change);
            input.value = newQty;

            updateTotal(input, price, itemId);
            updateQtyToServer(itemId, newQty);
        }

        function updateTotal(input, price, itemId) {
            let quantity = parseInt(input.value);
            let total = price * quantity;
            let totalHargaElement = input.closest('tr').querySelector('.total-harga');
            totalHargaElement.innerHTML = formatNumber(total);
            updateOverallTotal();
        }

        function updateQtyToServer(itemId, newQty) {
            fetch(`/keranjang/update-qty/${itemId}`, {
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        jumlah: newQty
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (!data.success) {
                        alert('Gagal update jumlah!');
                    }
                });
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


        function hapusProduk(id) {
            Swal.fire({
                title: 'Hapus Produk?',
                text: "Produk akan dihapus dari keranjang!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#aaa',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/keranjang-user/delete/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: 'Produk telah dihapus.',
                                    icon: 'success',
                                    timer: 1500,
                                    showConfirmButton: false
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire('Gagal', 'Tidak bisa menghapus produk.', 'error');
                            }
                        });
                }
            });
        }
    </script>
@endsection
