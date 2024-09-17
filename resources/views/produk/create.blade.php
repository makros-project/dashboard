@extends('adminlte::page')

@section('title', 'Tambah Produk')

@section('content_header')
    <h1>Tambah Produk</h1>
@stop

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Tambah Produk</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('produk.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="kode">Kode Produk</label>
                        <input type="text" class="form-control" id="kode" name="kode" required>
                    </div>

                    <div class="form-group">
                        <label for="tgl_terima">Tanggal Terima</label>
                        <input type="date" class="form-control" id="tgl_terima" name="tgl_terima" required>
                    </div>

                    <div class="form-group">
                        <label for="nama_barang">Nama Barang</label>
                        <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
                    </div>

                    <div class="form-group">
                        <label for="satuan">Satuan</label>
                        <input type="text" class="form-control" id="satuan" name="satuan" required>
                    </div>

                    <div class="form-group">
                        <label for="stok">Stok</label>
                        <input type="number" class="form-control" id="stok" name="stok" required>
                    </div>

                    <div class="form-group">
                        <label for="harga_beli">Harga Beli</label>
                        <input type="number" class="form-control" id="harga_beli" name="harga_beli" required>
                    </div>

                    <div class="form-group">
                        <label for="harga_jual">Harga Jual</label>
                        <input type="number" class="form-control" id="harga_jual" name="harga_jual" required>
                    </div>

                    <div class="form-group">
                        <label for="harga_ecer">Harga Ecer</label>
                        <input type="number" class="form-control" id="harga_ecer" name="harga_ecer" required>
                    </div>

                    <div class="form-group">
                        <label for="h_reseller">Harga Reseller</label>
                        <input type="number" class="form-control" id="h_reseller" name="h_reseller" required>
                    </div>

                    <div class="form-group">
                        <label for="profit">Profit</label>
                        <input type="number" class="form-control" id="profit" name="profit" required>
                    </div>

                    <div class="form-group">
                        <label for="berat">Berat</label>
                        <input type="number" class="form-control" id="berat" name="berat" required>
                    </div>

                    <div class="form-group">
                        <label for="profit_reseller">Profit Reseller</label>
                        <input type="number" class="form-control" id="profit_reseller" name="profit_reseller" required>
                    </div>

                    <div class="form-group">
                        <label for="profit_db">Profit DB</label>
                        <input type="number" class="form-control" id="profit_db" name="profit_db" required>
                    </div>

                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- Add your custom styles here --}}
@stop

@section('js')
    <script> console.log('Tambah Produk page loaded'); </script>
@stop
