@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
@endsection

@section('content')
<h4 class="py-3 mb-4"><span style="color: white">Tables </span> produk</h4>
<div class="card">
    <div class="card-header">
        <div class="float-start">
            <h5> produk </h5>
        </div>
        <div class="float-end">
            <a href="{{ route('produk.create') }}" class="btn btn-sm btn-primary">
                Add
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive text-nowrap">
            <table class="table" id="example">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Name Produk</td>
                        <td>Kategori Produk</td>
                        <td>Harga</td>
                        <td>Stok</td>
                        <td>Image</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach ($produk as $item)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $item->name_produk }}</td>
                        <td>{{ $item->kategori->name_kategori }}</td>
                        <td>Rp {{ number_format($item->harga_produk, 0, ',', '.') }}</td>
                        <td>{{ $item->stok_produk }}</td>
                        <td><img src="{{ asset('images/produk/'.$item->image_produk) }}" alt="Product Image"
                                style="width: 50px; height: 50px;"></td>
                        <td>
                            <form action="{{ route('produk.destroy', $item->id) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <a href="{{ route('produk.edit', $item->id) }}" class="btn btn-sm btn-success">Edit</a>
                                <a href="{{route('produk.show', $item->id)}}" class="btn btn-sm btn-warning">Show</a>
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
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