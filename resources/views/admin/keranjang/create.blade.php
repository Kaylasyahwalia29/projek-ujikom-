@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Data Keranjang
                    <a href="{{ route('keranjang.index') }}" class="btn btn-sm btn-primary float-end">Kembali</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('keranjang.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Nama Produk -->
                        <div class="mb-3">
                            <label for="id_produk" class="form-label">Nama Produk</label>
                            <select name="id_produk" class="form-control @error('id_produk') is-invalid @enderror">
                                <option value="" disabled selected>Pilih Produk</option>
                                @foreach ($produk as $data)
                                    <option value="{{ $data->id }}">{{ $data->name_produk }}</option>
                                @endforeach
                            </select>
                            @error('id_produk')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror 
                        </div>

                        <!-- Jumlah -->
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah</label>
                            <input type="number" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror" placeholder="Masukkan jumlah" min="1">
                            @error('jumlah')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Total -->
                         <div class="mb-3">
                            <label for="total" class="form-label">Total</label>
                            <div class="input-group">
                                {{-- <span class="input-group-text">Rp</span> --}}
                                <input type="number" placeholder="0"
                                    class="form-control @error('total') is-invalid @enderror"
                                    name="total" value="">
                            </div>
                            @error('total')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <!-- Gambar -->
                        <div class="mb-3">
                            <label for="image" class="form-label">Gambar Produk</label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="mb-3">
                            <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                            <button type="reset" class="btn btn-sm btn-warning">Reset</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
