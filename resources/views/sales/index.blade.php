@extends('adminlte::page')

@section('title', 'Data Penjualan')

@section('content_header')
    <h1>Data Penjualan</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <table id="salesTable" class="table table-sm table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Data Transaksi</th>
                        <th>Waktu Invoice</th>
                        <th>Tanggal Packing</th>
                        {{-- <th>Aksi</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sales as $sale)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td >
                                <div class="rounded  input-group">
                                    <a class="text-dark btn-sm text-start"  href="{{ route('sales.show',$sale->no_inv) }}" role="button">
                                        {{ $sale->pelanggan }} <br>Invoice : {{ $sale->no_inv }}<br>
                                        ({{ $sale->alamat }})<br>{{ $sale->produks }}
                                    </a>
                                </div>
                                
                            </td>
                            <td>{{ $sale->tgl_kirim }}</td>
                            <td>{{ $sale->tgl_kirim_fix }}
                                <p>Batch {{ $sale->batch }}</p>
                            </td>
                          
                    @endforeach
                        </tr>

                       
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
@stop

@section('js')
    <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#salesTable').DataTable();
        });
    </script>
@stop
