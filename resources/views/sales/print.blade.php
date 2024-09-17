<!DOCTYPE html>
<html>
<head>
    <title>Sales PDF</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        /* Tambahkan CSS berikut untuk mencegah pemisahan baris */
        tbody, tr, td {
            page-break-inside: avoid;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    {{-- <div class="card text-center bg-secondary text-light">
        <h3>Daftar Resi </h3>
        <p>Tanggal : {{ $tgl }} Batch : {{ $batch }}</p>
    </div> --}}

    <table class="table table-sm table-bordered mt-3">
        @foreach ($sales as $sale)
            <tbody>
                <tr>
                    <td>
                        <div class="h5 text-center">
                            Batch : {{ $batch }} No : {{ $loop->iteration }}
                            @if (substr($sale->pelanggan,0,2) == "TF")
                                -> Transfer
                            @else
                                -> COD Barang + Ongkir
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-2 text-center">
                                <img src="{{url('/img/logo.jpg')}}" width="70px" alt="Image"/>
                            </div>
                            <div class="col-10">
                                <p>Pengirim : CV Ciwidey Food <br> Perum Puri Indah Ciwidey Blok Puri Ayu No. 30 Desa Pasirjambu kec Pasirjambu Kab. Bandung 085159759006</p>
                            </div>
                        </div>
                        <b>
                        <div class="row ms-2">
                            {{-- <div class="col-8"> --}}
                                Penerima : {{ $sale->pelanggan }} Kontak : 0{{ $sale->no_hp }} <br>
                                Alamat : {{ $sale->alamat }} <br>
                                </b>
                                <div class="fs-4 bg-warning text-center">{{ $sale->keterangan }}</div>
                            {{-- </div> --}}
                            {{-- <div class="col-4 text-center">
                                <div class="card">
                                    <h2>{{ $sale->kurir }}</h2>
                                </div>
                            </div> --}}
                        </div>
                    </td>
                    <td>
                        <p>Inv : {{ $sale->no_inv }}  <br>
                        Tgl : {{ $sale->tgl_kirim_fix }} <br>
                        Berat : {{ $sale->berat }} g<br>
                       
                        Produk : 
                        {{ str_replace("Ongkir,","",$sale->produks) }}
                        </p>
                        <div 
                        @if (substr($sale->kurir,0,3)=='NCS')
                            style="background-color : purple" class="text-center text-light" 
                        @elseif(substr($sale->kurir,0,3)=='POS')
                        style="background-color : orange" class="text-center"
                        @endif
                        >
                        <h2>{{ $sale->kurir }}</h2>
                    </div>
                    </td>
                </tr>
                <tr class="text-center " ><th colspan="2"><h6>“Paket ini hadir dengan penuh cinta. Terima kasih atas dukunganmu. Kami nantikan pesanan berikutnya!”</h6></th></tr>
            </tbody>
        @endforeach
    </table>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
