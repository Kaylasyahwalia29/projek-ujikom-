@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
@endsection

@section('content')
    <h4 class="py-3 mb-4"><span style="color: white">Tables </span> Transaksi</h4>
    <div class="card">
        <div class="card-header">
            <div class="float-start">
                <h5>Transaksi</h5>
            </div>
            <div class="float-end">
                <a href="{{ route('transaksi.create') }}" class="btn btn-sm btn-primary">
                    Add
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table" id="example">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pengguna</th>
                            <th>Nama Produk</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                            <th>Tanggal Transaksi</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach ($transaksis as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->nama_pengguna }}</td>
                            <td>{{ $item->nama_produk }}</td>
                            <td>{{ $item->jumlah_produk }}</td>
                            <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y H:i') }}</td>
                            <td>
                                <form action="{{ route('transaksi.ubahStatus', $item->id) }}" method="POST">
                                    @csrf
                                    <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                        @foreach(['Belum Bayar', 'Dikemas', 'Dikirim', 'Selesai', 'Pengembalian', 'Dibatalkan'] as $status)
                                            <option value="{{ $status }}" {{ $item->status == $status ? 'selected' : '' }}>
                                                {{ $status }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('transaksi.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('transaksi.edit', $item->id) }}" class="btn btn-sm btn-success">Edit</a>
                                    <a href="{{ route('transaksi.show', $item->id) }}" class="btn btn-sm btn-warning">Show</a>
                                    <button type="submit" class="btn btn-sm btn-danger" data-confirm-delete="true">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

            </div>
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
