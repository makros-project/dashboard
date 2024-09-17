@extends('adminlte::page')

@section('title', 'Produk')

@section('content_header')
    {{-- <h1>Daftar Produk</h1> --}}
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                  @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                <div class="card">
                  

                    <div class="card-header">
                        <h3 class="me-5 fw-bold">Daftar Produk</h3>
                        <a href="{{ route('produk.create') }}" class="btn btn-sm btn-primary mb-3">Tambah Produk</a>
                    </div>
                    <div class="card-body">
                        <table id="produkTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Barang</th>
                                    <th>Stok</th>
                                    <th>Harga Beli</th>
                                    <th>Harga Jual</th>
                                    <th>Harga Ecer</th>
                                    <th>Harga Reseller</th>
                                    <th>Profit</th>
                                    <th>Berat</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produks as $produk)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $produk->nama_barang }}</td>
                                        <td>{{ $produk->stok }}</td>
                                        <td>{{ $produk->harga_beli }}</td>
                                        <td>{{ $produk->harga_jual }}</td>
                                        <td>{{ $produk->harga_ecer }}</td>
                                        <td>{{ $produk->h_reseller }}</td>
                                        <td>{{ $produk->profit }}</td>
                                        <td>{{ $produk->berat }}</td>
                                        <td>
                                            <a href="{{ route('produk.edit', $produk->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                            
                                            <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Delete</button>
                                            </form>
                                        </td>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
    <script>
        $(document).ready(function () {
            $('#produkTable').DataTable({
                // Add your DataTables configuration here
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });
    </script>
@stop

