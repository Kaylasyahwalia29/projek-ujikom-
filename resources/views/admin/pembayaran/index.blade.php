@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
@endsection

@section('content')
<h4 class="py-3 mb-4"><span style="color: white">Tables </span> pembayaran</h4>
<div class="card">
    <div class="card-header">
        <div class="float-start">
            <h5> pembayaran </h5>
        </div>
        <div class="float-end">
            <a href="{{route('pembayaran.create')}}" class="btn btn-sm btn-primary">
                Add
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive text-nowrap">
            <table class="table" id="example">
                <thead>
                    <td>No</td>
                    <td>Alamat</td>
                    <td>Method</td>
                    <td>Action</td>
                </thead>
                @php $no = 1; @endphp
                <tbody>
                    @foreach ($pembayaran as $item)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$item->alamat}}</td>
                        <td>{{$item->method->name_method}}</td>
                        {{-- <td>{{$item->harga}}</td>
                        <td>{{$item->stok}}</td> --}}
                        <td>
                            <form action="{{route('pembayaran.destroy', $item->id)}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <a href="{{route('pembayaran.edit', $item->id)}}" class="btn btn-sm btn-success">Edit
                                </a>
                                <a href="{{route('pembayaran.show', $item->id)}}" class="btn btn-sm btn-warning">Show
                                </a>
                                <a href="{{ route('pembayaran.destroy', $item->id) }}" class="btn btn-sm btn btn-danger"
                                    data-confirm-delete="true">Delete</a>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
