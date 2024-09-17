@extends('adminlte::page')

@section('title', 'Data Penjualan')

@section('content_header')
    <h1>Detail Penjualan</h1>
@stop

@section('content')
<div class="col-md-8">
    <div class="card">
        <div class="card-header bg-secondary">
             {{ $sale->pelanggan }} (Invoice : {{ $sale->no_inv }})
        </div>
        <div class="card-body">
            Time : {{ $sale->created_at }} <br>
            Waktu dipacking : {{ $sale->waktu_fix }} <br>

           Kontak : {{ $sale->no_hp }} <br>
           Alamat : {{ $sale->alamat }} <br>
           Estimasi : {{ $sale->estimasi }} Hari<br>
           Berat : {{ $sale->berat }} gram<br>
           <hr>
           Produk :
            <ol>
                @php
                $tot = 0;
                @endphp
                @foreach ($detail as $item)
                   <li>{{ $item->produk }} ({{ number_format($item->satuan) }} x {{ $item->jumlah }}) = {{ number_format($item->jumlah*$item->satuan) }}</li>
                   @php
                    $tot += $item->satuan*$item->jumlah;
                    @endphp
                @endforeach

                </ol>
                <hr>
                Catatan : {{ $sale->keterangan }} <br>
                Total Invoice : Rp. {{ number_format($tot) }}
        </div>
        <div class="row">
            <div class="col-md-6">
         
        <form action="{{ route('sales.update',$sale->no_inv) }}" method="post" class="my-2 mx-2">
            @csrf
            @method('put')
            <div class="input-group">
                <a href="{{ route('sales.index') }}" class="btn btn-sm btn-danger">Back</a>
                <input type="text" hidden name="no_inv"  value="{{ $sale->no_inv }}">
                <input type="date" value="{{ date('Y-m-d') }}" name="tgl_kirim_fix" class="form-control">
                <select name="batch" id="" class="form-control">
                    <option value="1">Batch 1</option>
                    <option value="2">Batch 2</option>
                    <option value="3">Batch 3</option>
                    <option value="4">Batch 4</option>
                </select>
                <button type="submit" class="btn btn-primary">Fix Kirim</button>
            </div>
        </form>
               
    </div>
</div>
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
