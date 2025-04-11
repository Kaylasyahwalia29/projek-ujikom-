@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Data Kategori
                    <a href="{{route('kategori.index')}}" class="btn btn-sm btn-primary"
                        style="float: right">Kembali</a>
                </div>
                <div class="card-body">
                    <form action="{{route('kategori.update', $kategori->id)}}" method="post"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="mb-2">
                            <label for="name_kategori">Name Kategori</label>
                            <input type="text" class="form-control @error('name_kategori') is-invalid @enderror"
                                name="name_kategori" value="{{$kategori->name_kategori}}">
                            @error('name_kategori')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="image_kategori">Images</label>
                            @if($kategori->image_kategori)
                            <p><img src="{{ asset('images/kategori/' .$kategori->image_kategori)}}"
                                    alt="image_kategori" width="100px">
                            </p>
                            @endif
                            <input type="file" name="image_kategori"
                                class="form-control @error('image_kategori') is-invalid @enderror">
                            @error('image_kategori')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <button class="btn btn-sm btn-success" type="submit">
                                Simpan
                            </button>
                            <button class="btn btn-sm btn-warning" type="reset">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection