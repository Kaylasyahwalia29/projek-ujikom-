    @extends('layouts.front')

    @section('content')
        <style>
            .contain {
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 50px 15px;
                background-color: #f9f9f9;
                min-height: 90vh;
            }

            .card-product {
                display: flex;
                flex-direction: column;
                background: #fff;
                border-radius: 16px;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
                max-width: 900px;
                width: 100%;
                overflow: hidden;
            }

            @media(min-width: 768px) {
                .card-product {
                    flex-direction: row;
                }
            }

            .product-image {
                flex: 1;
                background-color: #f2f2f2;
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 20px;
            }

            .product-image img {
                max-width: 100%;
                max-height: 350px;
                border-radius: 12px;
                object-fit: contain;
            }

            .product-details {
                flex: 1;
                padding: 30px;
            }

            .product-details h1 {
                font-size: 2rem;
                font-weight: 700;
                margin-bottom: 10px;
            }

            .product-details .price {
                font-size: 1.5rem;
                color: #27ae60;
                font-weight: 600;
                margin-bottom: 10px;
            }

            .product-details .kategori {
                font-size: 1rem;
                color: #888;
                margin-bottom: 20px;
            }

            .product-details {
                padding: 30px;
                font-family: 'Segoe UI', sans-serif;
            }

            .add-to-cart {
                display: inline-block;
                background: #27ae60;
                color: white;
                padding: 12px 30px;
                font-size: 1rem;
                border-radius: 8px;
                font-weight: bold;
                text-decoration: none;
                border: none;
                cursor: pointer;
                transition: 0.3s;
            }

            .add-to-cart:hover {
                background: #219653;
            }


            .description {
                font-size: 1rem;
                color: #555;
                margin-bottom: 20px;
            }

            .quantity-wrapper {
                display: flex;
                align-items: center;
                margin-bottom: 20px;
            }

            .qty-btn {
                background: transparent;
                border: 1px solid #ccc;
                color: #333;
                padding: 6px 12px;
                font-size: 1.2rem;
                cursor: pointer;
                border-radius: 6px;
            }

            .qty-btn:hover {
                background-color: #eee;
            }

            .qty-input {
                width: 60px;
                text-align: center;
                border: 1px solid #ccc;
                border-radius: 6px;
                margin: 0 10px;
                padding: 6px;
            }
        </style>
        <div class="contain">
            <div class="card-product">
                <div class="product-image">
                    <img src="{{ asset('images/produk/' . $produk->image_produk) }}" alt="{{ $produk->name_produk }}">
                </div>
                <div class="product-details">
                    <h1 class="product-title">{{ $produk->name_produk }}</h1>
                    <div class="price">Rp {{ number_format($produk->harga_produk, 0, ',', '.') }}</div>
                    <div class="kategori">{{ $produk->kategori->name_kategori }}</div>
                    <p class="description">{{ $produk->desc_produk }}</p>

                    {{-- <form action="{{ route('keranjang', $produk->id) }}" method="POST"> --}}

                    {{-- <div class="quantity-wrapper">
                        <button type="button" class="qty-btn" onclick="changeQty(-1)">−</button>
                        <input type="number" name="jumlah" id="qtyInput" value="1" min="1" class="qty-input">
                        <button type="button" class="qty-btn" onclick="changeQty(1)">+</button>
                    </div> --}}
                    <form id="addToCartForm" method="POST">
                        @csrf
                        <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                        <input type="hidden" name="total" id="totalInput" value="{{ $produk->harga_produk }}">

                        <div class="quantity-wrapper d-flex align-items-center">
                            <button type="button" class="qty-btn btn btn-outline-secondary me-2"
                                onclick="changeQty(-1)">−</button>
                            <input type="number" name="jumlah" id="qtyInput" value="1" min="1"
                                class="qty-input form-control text-center" style="width: 60px;">
                            <button type="button" class="qty-btn btn btn-outline-secondary ms-2"
                                onclick="changeQty(1)">+</button>
                        </div>
                        @if (Auth::check())
                            <button type="submit" class="btn btn-primary mt-3">Keranjang</button>
                        @else
                            <button type="button" class="btn btn-primary mt-3"
                                onclick="redirectToLogin()">Keranjang</button>
                        @endif


                    </form>




                </div>
            </div>
        </div>
    @endsection
    @section('scripts-front')
        <script>
            function redirectToLogin() {
                Swal.fire({
                    icon: 'info',
                    title: 'Login Diperlukan',
                    text: 'Silakan login terlebih dahulu untuk menambahkan ke keranjang.',
                    showCancelButton: true,
                    confirmButtonText: 'Login Sekarang',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('login') }}";
                    }
                });
            }

            function changeQty(amount) {
                const qtyInput = $('#qtyInput');
                let current = parseInt(qtyInput.val()) || 1;
                let newValue = current + amount;

                if (newValue < 1) newValue = 1;
                qtyInput.val(newValue);

                const price = {{ $produk->harga_produk ?? 0 }};
                $('#totalInput').val(newValue * price);
            }

            $(document).ready(function() {
                $('#addToCartForm').on('submit', function(e) {
                    e.preventDefault();

                    let form = $(this);
                    let formData = form.serialize();

                    $.ajax({
                        url: "{{ route('keranjang.add') }}",
                        type: "POST",
                        data: formData,
                        success: function(data) {
                            if (data.success) {
                                $('#cart-count').text(data.cart_count);
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Sukses!',
                                    text: 'Berhasil ditambahkan ke keranjang.',
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                            } else {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Gagal',
                                    text: data.message || 'Gagal menambahkan ke keranjang.',
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops!',
                                text: 'Terjadi kesalahan saat menambahkan ke keranjang.',
                            });
                        }
                    });
                });
            });
        </script>
    @endsection
