@extends('adminlte::page')

@section('title', 'Berita')



@section('content')
<body>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Berita Acara Penjualan</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
    
    <div class="container mt-5">
        <div class="text-center">
            <h4>Berita Acara Penjualan Batch {{ $batch }}</h4>
            <p>Tanggal {{ $tgl_kirim_fix }}</p>
        </div>
        <!-- Form untuk input tgl_kirim_fix dan batch -->
        <form method="GET" action="{{ route('sales.berita') }}" class="mb-4 d-print-none">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="tgl_kirim_fix" class="form-label">Tanggal Kirim</label>
                    <input type="date" id="tgl_kirim_fix" name="tgl_kirim_fix" class="form-control" value="{{ $tgl_kirim_fix }}">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="batch" class="form-label">Batch</label>
                    <select id="batch" name="batch" class="form-select">
                        <option value="">-- Pilih Batch --</option>
                        @for ($i = 1; $i <= 4; $i++)
                            <option value="{{ $i }}" {{ $batch == $i ? 'selected' : '' }}>Batch {{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-2 mb-3">
                    <button type="submit" class="btn btn-primary mt-4">Tampilkan</button>
                </div>
            </div>
        </form>
    
        <!-- Tabel Berita Acara Penjualan -->
        @if($sales->isNotEmpty())
            <h2 class="mb-3">Data Penjualan</h2>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr class="bg-secondary">
                        <th>No</th>
                        <th style="width: 50%">Invoice</th>
                        <th>Tagihan</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalProduks = $sales->groupBy('produks')->mapWithKeys(function ($group, $key) {
                            return [$key => $group->sum('jumlah')];
                        });
                        $grand = 0;
                    @endphp
                    
                    @foreach ($sales as $index => $sale)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><b>{{ $sale->pelanggan }}</b>   <br> Produk :
                                @php
                                $prod = $sales2->where('no_inv',$sale->no_inv);
                                $total = 0;
                                @endphp
                               @foreach ($prod as $item)
                                   {{ $item->produk }}({{ $item->jumlah }} x {{ $item->satuan }})
                                @php
                                $total += $item->jumlah*$item->satuan;
                                @endphp
                               @endforeach
                            </td>
                            <td>{{ number_format($total, 2) }}</td>
                            <td>{{ $sale->keterangan }}</td>
                        </tr>
                        <?php $grand += $total ?>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" class="text-center"><strong>Total</strong></td>
                        <td colspan="2" >
                            {{ number_format($grand,2) }}
                        </td>
                        
                    </tr>
                </tfoot>
            </table>


            <h3>Jumlah Paket</h3>
            <table class="table table-bordered table-striped">
                <thead>
                    <th>#</th>
                    <th>Kurir</th>
                    <th>Jumlah Paket</th>
                </thead>
                <tbody>
                    @foreach ($kurir as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                {{ $item->kurir }}
                            </td>
                            <td>
                                {{ $sales->count() }}
                            </td>
                        </tr> 
                    @endforeach
                   
                </tbody>
            </table>
        @else
            <p class="text-muted">Tidak ada data untuk tanggal dan batch yang dipilih.</p>
        @endif
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
    


@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop