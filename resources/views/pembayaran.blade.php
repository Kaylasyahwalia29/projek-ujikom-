@extends('layouts.front')

@section('content')
<form action="{{ route('checkout.proses') }}" method="POST">
    @csrf
    <div class="untree_co-section">
        <div class="container">
            <div class="row">
                <!-- Billing Details -->
                <div class="col-md-6 mb-5 mb-md-0">
                    <h2 class="h3 mb-3 text-black">Detail Pembayaran</h2>
                    <div class="p-3 p-lg-5 border bg-white">

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="alamat" class="text-black">Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alamat">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="id_method">Metode Pembayaran</label>
                                    <select name="id_method" id="id_method" class="form-control">
                                        @foreach ($methods as $method)
                                            <option value="{{ $method->id }}">{{ $method->name_method }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="c_order_notes" class="text-black">Catatan</label>
                            <textarea name="catatan" id="c_order_notes" cols="30" rows="5" class="form-control"
                                placeholder="Tulis pesan jika ada..."></textarea>
                        </div>


                    </div>
                </div>

                <!-- Order Summary -->
                <div class="col-md-6">
                    <h2 class="h3 mb-3 text-black">Pesanan Anda</h2>
                    <div class="p-3 p-lg-5 border bg-white">
                        <table class="table site-block-order-table mb-5">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $grandTotal = 0; @endphp
                                @foreach ($cartItems as $item)
                                    @php
                                        $total = $item->jumlah * $item->produk->harga_produk;
                                        $grandTotal += $total;
                                    @endphp
                                    <tr>
                                        <td>{{ $item->produk->name_produk }}</td>
                                        <td>{{ $item->jumlah }}</td>
                                        <td>Rp{{ number_format($item->produk->harga_produk, 0, ',', '.') }}</td>
                                        <td>Rp{{ number_format($total, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3"><strong>Total</strong></td>
                                    <td><strong>Rp{{ number_format($grandTotal, 0, ',', '.') }}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <button type="submit" class="btn btn-black btn-lg py-3 btn-block">Bayar Sekarang</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
