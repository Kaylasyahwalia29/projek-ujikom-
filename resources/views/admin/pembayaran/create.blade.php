@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
@endsection

@section('content')
    {{-- <h4 class="py-3 mb-4"><span style="color: white"></span> Tabel Pembayaran</h4> --}}

    <div class="card">
        <div class="card-header">
            <div class="card-header">
                Data Pembayaran
                <a href="{{ route('pembayaran.index') }}" class="btn btn-sm btn-primary float-end">Kembali</a>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('pembayaran.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                        placeholder="Masukkan nama">
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                        placeholder="Masukkan alamat">
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="tanggal_bayar" class="form-label">Tanggal Bayar</label>
                    <input type="date" name="tanggal_bayar"
                        class="form-control @error('tanggal_bayar') is-invalid @enderror">
                    @error('tanggal_bayar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="jumlah_bayar" class="form-label">Jumlah Bayar</label>
                    <input type="number" name="jumlah_bayar"
                        class="form-control @error('jumlah_bayar') is-invalid @enderror"
                        placeholder="Masukkan jumlah bayar">
                    @error('jumlah_bayar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="id_method" class="form-label">Metode Pembayaran</label>
                    <select name="id_method" class="form-select @error('id_method') is-invalid @enderror">
                        <option value="" selected disabled>Pilih metode pembayaran</option>
                        @foreach ($method as $data)
                            <option value="{{ $data->id }}">{{ $data->name_method }}</option>
                        @endforeach
                    </select>
                    @error('id_method')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                            <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                            <button type="reset" class="btn btn-sm btn-warning">Reset</button>
                        </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
    <script>
        new DataTable('#example');
    </script>
@endpush
