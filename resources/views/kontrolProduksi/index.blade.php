@extends('adminlte::page')

@section('title', 'Daftar Kontrol Produksi')


@section('content')
    <div class="container">
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
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-secondary">
                        <h3 class="me-5">Kontrol Stok</h3>
                        <a href="{{ route('kontrolProduksi.create') }}" class="btn btn-sm btn-primary mb-3">Tambah Kontrol Produksi</a>
                    </div>
                    <div class="card-body">
                        <table id="kontrolProduksiTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tanggal</th>
                                    <th>Produk</th>
                                    <th>Jumlah</th>
                                    <th>Keterangan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kontrolProduksi as $kontrol)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $kontrol->tanggal }}</td>
                                        <td>{{ $kontrol->produk }}</td>
                                        <td>{{ $kontrol->jumlah }}</td>
                                        <td>{{ $kontrol->keterangan }}</td>
                                        <td>
                                            <a href="{{ route('kontrolProduksi.edit', $kontrol->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('kontrolProduksi.destroy', $kontrol->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
@stop

@section('js')
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#kontrolProduksiTable').DataTable();
        });
    </script>
@stop
