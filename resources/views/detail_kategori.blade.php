@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4">Produk dalam Kategori: <span class="text-primary">{{ $kategori->name_kategori }}</span></h2>

        @if ($produk->isEmpty())
            <p class="text-muted">Belum ada produk di kategori ini.</p>
        @else
            <div class="row">
                @foreach ($produk as $item)
                    <div class="col-md-3 mb-4">
                        <div class="card h-100 shadow-sm">
                            <img src="{{ asset('images/produk/' . $item->image) }}" class="card-img-top"
                                style="height: 200px; object-fit: cover;" alt="{{ $item->name_produk }}">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $item->name_produk }}</h5>
                                <p class="card-text text-danger mb-2">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                                <a href="{{ route('produk.show', $item->id) }}"
                                    class="btn btn-sm btn-outline-primary mt-auto">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
