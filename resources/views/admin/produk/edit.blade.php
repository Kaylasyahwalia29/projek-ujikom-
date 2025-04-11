@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Data produk
                    <a href="{{ route('produk.index') }}" class="btn btn-sm btn-primary"
                        style="float: right">Kembali</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('produk.update', $produk->id)}}" method="post" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <label for="name_produk" class="form-label">Name Produk</label>
                            <input type="text" name="name_produk" placeholder="Judul produk"
                                class="form-control @error('name_produk') is-invalid @enderror"
                                value="{{ $produk->name_produk }}">
                            @error('name_produk')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="id_kategori" class="form-label">Kategori Produk</label>
                            <select name="id_kategori" class="form-control @error('id_kategori') is-invalid @enderror">
                                <option value="" disabled selected>Pilih Kategori</option>
                                @foreach ($kategori as $data)
                                <option value="{{ $data->id }}" {{ $produk->id_kategori == $data->id ? 'selected' : ''
                                    }}>{{ $data->name_kategori }}</option>
                                @endforeach
                            </select> 
                            @error('id_kategori')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="harga_produk" class="form-label">Harga Produk</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="text" name="harga_produk" placeholder="0"
                                    class="form-control @error('harga_produk') is-invalid @enderror"
                                    value="{{ number_format($produk->harga_produk, 0, ',', '.') }}">
                            </div>
                            @error('harga_produk')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="stok_produk" class="form-label">Stok Produk</label>
                            <input type="number" name="stok_produk" placeholder="Stok_produk"
                                class="form-control @error('stok_produk') is-invalid @enderror"
                                value="{{ $produk->stok_produk }}">
                            @error('stok_produk')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="image_produk" class="form-label">Images</label>
                            @if($produk->image_produk)
                            <p><img src="{{ asset('images/produk/' .$produk->image_produk)}}" alt="image_produk"
                                    width="100px" height="80"></p>
                            @endif
                            <input type="file" name="image_produk"
                                class="form-control @error('image_produk') is-invalid @enderror">
                            @error('image_produk')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="desc_produk" class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('desc_produk') is-invalid @enderror"
                                name="desc_produk"></textarea>
                            @error('desc_produk')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-sm btn-success" type="submit">Simpan</button>
                            <button class="btn btn-sm btn-warning" type="reset">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection