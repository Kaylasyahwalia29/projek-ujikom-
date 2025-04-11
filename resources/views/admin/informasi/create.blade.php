@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Data Informasi
                    <a href="{{ route('informasi.index') }}" class="btn btn-sm btn-primary"
                        style="float: right">Kembali</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('informasi.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-2">
                            <label for="name_informasi">Juduk Informasi</label>
                            <input type="text" placeholder="Judul Informasi"
                                class="form-control @error('name_informasi') is-invalid @enderror"
                                name="name_informasi">
                            @error('name_informasi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="tgl_informasi">Tanggal</label>
                            <input type="date" placeholder="Tanggal"
                                class="form-control @error('tgl_informasi') is-invalid @enderror" name="tgl_informasi">
                            @error('tgl_informasi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="image_informasi">Images</label>
                            <input type="file" name="image_informasi" class="form-control @error('image_informasi') is-invalid @enderror">
                            @error('image_informasi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="desc_informasi">Deskripsi</label>
                            <textarea class="form-control @error('desc_informasi') is-invalid @enderror" name="desc_informasi"></textarea>
                            @error('desc_informasi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-2">
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