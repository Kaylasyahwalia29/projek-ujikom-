@extends('layouts.front')

@section('content')
<div class="untree_co-section">
<div class="container">
    <h2>Pesanan Saya</h2>

    @if($transaksis->isEmpty())
        <p>Belum ada pesanan.</p>
    @else
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Total Harga</th>
                <th>Tanggal</th>
                <th>Metode Pembayaran</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksis as $transaksi)
            <tr>
                <td>{{ $transaksi->nama_produk }}</td>
                <td>Rp{{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                <td>{{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d-m-Y') }}</td>
                <td>{{ $transaksi->pembayaran->method->name_method ?? '-' }}</td>
                <td>{{ $transaksi->status ?? '-' }}</td>
                <td>
                    <a href="{{ route('invoice.show', $transaksi->id) }}" class="btn btn-sm btn-primary">Lihat</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
</div>
@endsection
