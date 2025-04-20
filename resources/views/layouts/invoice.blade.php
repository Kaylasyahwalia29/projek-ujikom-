@extends('layouts.front')

@section('content')
<div class="untree_co-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="h3 mb-3 text-black">Invoice #{{ $transaksi->id }}</h2>
                <p class="mb-4">Terima kasih telah melakukan transaksi dengan kami. Berikut adalah detail pesanan Anda:</p>

                <div class="p-3 p-lg-5 border bg-white">
                    <!-- Detail Pembeli -->
                    <h4 class="text-black">Detail Pembeli</h4>
                    <p><strong>Nama Pengguna:</strong> {{ $transaksi->nama_pengguna }}</p>
                    <p><strong>Alamat Pengiriman:</strong> {{ $transaksi->pembayaran->alamat }}</p>
                    <p><strong>Catatan:</strong> {{ $transaksi->pembayaran->catatan ?? '-' }}</p>

                    <!-- Rincian Produk -->
                    <h4 class="text-black mt-4">Rincian Produk</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Jumlah</th>
                                <th>Harga Satuan</th>
                                <th>Total Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaksi->detailTransaksi as $detail)
                                <tr>
                                    <td>{{ $detail->produk->name_produk }}</td>
                                    <td>{{ $detail->jumlah }}</td>
                                    <td>Rp{{ number_format($detail->produk->harga_produk, 0, ',', '.') }}</td>
                                    <td>Rp{{ number_format($detail->jumlah * $detail->produk->harga_produk, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Total Pembayaran -->
                    <div class="text-right">
                        <h4 class="text-black">Total Pembayaran</h4>
                        <p><strong>Total Harga:</strong> Rp{{ number_format($transaksi->total_harga, 0, ',', '.') }}</p>
                    </div>

                    <!-- Informasi Pembayaran -->
                    <div class="mt-4">
                        <h4 class="text-black">Metode Pembayaran</h4>
                        <p><strong>Metode Pembayaran:</strong> {{ $transaksi->pembayaran->method->name_method }}</p>
                    </div>

                    <!-- Tanggal Transaksi -->
                    <div class="mt-4">
                        <p><strong>Tanggal Transaksi:</strong> {{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d-M-Y') }}</p>

                    </div>

                    <!-- Pesan Konfirmasi -->
                    <div class="mt-4">
                        <p class="text-success">Pembayaran berhasil! Terima kasih telah berbelanja dengan kami.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
