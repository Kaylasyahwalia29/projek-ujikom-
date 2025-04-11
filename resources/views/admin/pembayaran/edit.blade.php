@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Data Pembayaran
                    <a href="{{route('kategori.index')}}" class="btn btn-sm btn-primary"
                        style="float: right">Kembali</a>
                </div>
                <div class="card-body">
                    <form action="{{route('pembayaran.update', $pembayaran->id)}}" method="post"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="mb-2">
                            <label for="alamat_pembayaran">Alamat</label>
                            <input type="text" class="form-control @error('alamat_pembayaran') is-invalid @enderror"
                                name="jumlah_pembayaran" value="{{$pembayaran->alamat_pembayaran}}">
                            @error('alamat_pembayaran')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror   
                        </div>
                        <div class="mb-2">
                            <label for="jumlah_pembayaran">jumlah</label>
                            <input type="text" class="form-control @error('jumlah_pembayaran') is-invalid @enderror"
                                name="jumlah_pembayaran" value="{{$pembayaran->jumlah_pembayaran}}">
                            @error('jumlah_pembayaran')
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