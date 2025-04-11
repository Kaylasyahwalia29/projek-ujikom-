@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Transaksi
                    <a href="{{ route('transaksi.index') }}" class="btn btn-sm btn-primary float-end">Kembali</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="id_pengguna" class="form-label">Nama Pengguna</label>
                            <select name="id_pengguna" id="id_pengguna" class="form-select" required>
                                @foreach ($penggunas as $pengguna)
                                    <option value="{{ $pengguna->id_pengguna }}" {{ $transaksi->id_pengguna == $pengguna->id_pengguna ? 'selected' : '' }}>
                                        {{ $pengguna->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="id_barang" class="form-label">Nama Barang</label>
                            <select name="id_barang" id="id_barang" class="form-select" required>
                                @foreach ($barangs as $barang)
                                    <option value="{{ $barang->id_barang }}" {{ $transaksi->id_barang == $barang->id_barang ? 'selected' : '' }}>
                                        {{ $barang->nama_barang }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="total" class="form-label">Total</label>
                            <input type="number" name="total" id="total" class="form-control @error('total') is-invalid @enderror"
                                value="{{ old('total', $transaksi->total) }}" required>
                            @error('total')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        {{-- Uncomment jika kamu pakai tanggal_transaksi di DB --}}
                        {{-- 
                        <div class="mb-3">
                            <label for="tanggal_transaksi" class="form-label">Tanggal Transaksi</label>
                            <input type="datetime-local" name="tanggal_transaksi" id="tanggal_transaksi" class="form-control"
                                value="{{ old('tanggal_transaksi', \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('Y-m-d\TH:i')) }}">
                        </div>
                        --}}

                        <div class="mb-3">
                            <button class="btn btn-success" type="submit">Simpan</button>
                            <button class="btn btn-warning" type="reset">Reset</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
