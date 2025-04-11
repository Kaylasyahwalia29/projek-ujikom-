@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Tambah Transaksi
                    <a href="{{ route('transaksi.index') }}" class="btn btn-sm btn-primary float-end">Kembali</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('transaksi.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="id_pengguna" class="form-label">Nama Pengguna</label>
                            <select name="id_pengguna" class="form-select @error('id_pengguna') is-invalid @enderror" required>
                                <option value="">-- Pilih Pengguna --</option>
                                @foreach($penggunas as $pengguna)
                                    <option value="{{ $pengguna->id_pengguna }}" {{ old('id_pengguna') == $pengguna->id_pengguna ? 'selected' : '' }}>
                                        {{ $pengguna->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_pengguna')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="id_barang" class="form-label">Nama Barang</label>
                            <select name="id_barang" class="form-select @error('id_barang') is-invalid @enderror" required>
                                <option value="">-- Pilih Barang --</option>
                                @foreach($barangs as $barang)
                                    <option value="{{ $barang->id_barang }}" {{ old('id_barang') == $barang->id_barang ? 'selected' : '' }}>
                                        {{ $barang->nama_barang }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_barang')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="total" class="form-label">Total</label>
                            <input type="number" name="total" class="form-control @error('total') is-invalid @enderror" value="{{ old('total') }}" required>
                            @error('total')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Uncomment kalau kamu punya field tanggal_transaksi --}}
                        
                        <div class="mb-3">
                            <label for="tanggal_transaksi" class="form-label">Tanggal Transaksi</label>
                            <input type="datetime-local" name="tanggal_transaksi" class="form-control @error('tanggal_transaksi') is-invalid @enderror" value="{{ old('tanggal_transaksi') }}">
                            @error('tanggal_transaksi')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                       

                        <div class="mb-3">
                            <button type="submit" class="btn btn-success">Simpan</button>
                            <button type="reset" class="btn btn-warning">Reset</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
