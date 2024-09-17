@extends('adminlte::page')

@section('title', 'Rekap')



@section('content')

<body>

<div class="container mt-5">
    <h1>Rekap Sales</h1>

    <!-- Rekap Produk berdasarkan Tanggal Kirim -->
    <h2 class="mt-4">Jumlah Produk Berdasarkan Tanggal Kirim</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tanggal Kirim</th>
                <th>Total Produk</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produkPerTglKirim as $rekap)
                <tr>
                    <td>{{ $rekap->tgl_kirim_fix }}</td>
                    <td>{{ $rekap->total_produk }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Rekap Produk Berdasarkan 10 Tanggal Terakhir -->
    <h2 class="mt-4">Jumlah Produk Berdasarkan 10 Tanggal Terakhir</h2>
    <table class="table table-bordered">
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
    <h2 class="mt-4">Jumlah No Invoice Berdasarkan Kurir</h2>
    <table class="table table-bordered">
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