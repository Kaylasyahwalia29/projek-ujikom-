@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Data Informasi
                    <a href="{{route('informasi.index')}}" class="btn btn-sm btn-primary"
                        style="float: right">Kembali</a>
                </div>
                <div class="card-body">
                    <form action="{{route('informasi.update', $informasi->id)}}" method="post"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="mb-2">
                            <label for="name_informasi">Judul Informasi</label>
                            <input type="text" class="form-control @error('name_informasi') is-invalid @enderror"
                                name="name_informasi" value="{{$informasi->name_informasi}}">
                            @error('name_informasi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="tgl_informasi">Tanggal Informasi</label>
                            <input type="date" class="form-control @error('tgl_informasi') is-invalid @enderror"
                                name="tgl_informasi" value="{{$informasi->tgl_informasi}}">
                            @error('tgl_informasi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="image_informasi">Images</label>
                            @if($informasi->image_informasi)
                            <p><img src="{{ asset('images/informasi/' .$informasi->image_informasi)}}"
                                    alt="image_informasi" width="100px" height="80">
                            </p>
                            @endif
                            <input type="file" name="image_informasi"
                                class="form-control @error('image_informasi') is-invalid @enderror">
                            @error('image_informasi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="desc_informasi">Deskripsi</label>
                            <textarea class="form-control @error('desc_informasi') is-invalid @enderror"
                                name="desc_informasi"></textarea>
                            @error('desc_informasi')
                            <span class="invalid-feedback" role="alert" value="{{$informasi->nim}}">
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