@extends('adminlte::page')

@section('title', 'Rekap')



@section('content')

<body>

<div class="container card mt-2">
   

    <!-- Rekap Produk berdasarkan Tanggal Kirim -->
    <h2 class="">Rekap Produk harian</h2>
    <table class="table table-sm table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Tgl Packing</th>
                <th>Batch</th>
                <th>Produk</th>
                <th>Total Produk</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produkPerTglKirim as $rekap)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $rekap->tgl_kirim_fix }}</td>
                    <td>{{ $rekap->batch }}</td>
                    <td>{{ $rekap->produk }}</td>
                    <td>{{ $rekap->total_produk }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Rekap Produk Berdasarkan 10 Tanggal Terakhir -->
    <h2 class="mt-4">Rekap Produk 10 Tanggal Terakhir</h2>
    <table class="table table-sm table-bordered table-striped">
        <thead>
            <tr>
                <th>Tanggal Kirim</th>
                <th>Total Produk</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($last10Dates as $tgl => $total)
                <tr>
                    <td>{{ $tgl }}</td>
                    <td>{{ $total }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Rekap Jumlah No Invoice Berdasarkan Kurir -->
    <h2 class="mt-4">Rekap Produk perKurir</h2>
    <table class="table table-sm table-bordered table-striped">
        <thead>
            <tr>
                <th>Kurir</th>
                <th>Total No Invoice</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rekapKurir as $rekap)
                <tr>
                    <td>{{ $rekap->kurir }}</td>
                    <td>{{ $rekap->total_no_inv }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop