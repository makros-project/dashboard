@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')

@stop

@section('content')
        <div class="row mt-2">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header bg-success">
                        Data Produk
                    </div>
                    <div class="card-body">
                    <ol>
                        @foreach ($produks as $key ) 
                            <li>{{ $key->nama_barang }} : {{ $key->stok }}</li>
                        @endforeach
                    </ol>
                    </div>
                </div>
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
   
@stop

