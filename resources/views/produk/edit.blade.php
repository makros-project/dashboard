
@extends('adminlte::page')

@section('title', 'Edit Produk')

{{-- @section('content_header')
    <h1>Edit Produk</h1>
@stop --}}

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Edit Produk</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('produk.update', $produk->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="kode">Kode Produk</label>
                        <input type="text" class="form-control" id="kode" name="kode" value="{{ $produk->kode }}" required>
                    </div>

                    <div class="form-group">
                        <label for="tgl_terima">Tanggal Terima</label>
                        <input type="date" class="form-control" id="tgl_terima" name="tgl_terima" value="{{ $produk->tgl_terima }}" required>
                    </div>

                    <div class="form-group">
                        <label for="nama_barang">Nama Barang</label>
                        <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="{{ $produk->nama_barang }}" required>
                    </div>

                    <div class="form-group">
                        <label for="satuan">Satuan</label>
                        <input type="text" class="form-control" id="satuan" name="satuan" value="{{ $produk->satuan }}" required>
                    </div>

                    <div class="form-group">
                        <label for="stok">Stok</label>
                        <input type="number" class="form-control" id="stok" name="stok" value="{{ $produk->stok }}" required>
                    </div>

                    <div class="form-group">
                        <label for="harga_beli">Harga Beli</label>
                        <input type="number" class="form-control" id="harga_beli" name="harga_beli" value="{{ $produk->harga_beli }}" required>
                    </div>

                    <div class="form-group">
                        <label for="harga_jual">Harga Jual</label>
                        <input type="number" class="form-control" id="harga_jual" name="harga_jual" value="{{ $produk->harga_jual }}" required>
                    </div>

                    <div class="form-group">
                        <label for="harga_ecer">Harga Ecer</label>
                        <input type="number" class="form-control" id="harga_ecer" name="harga_ecer" value="{{ $produk->harga_ecer }}" required>
                    </div>

                    <div class="form-group">
                        <label for="h_reseller">Harga Reseller</label>
                        <input type="number" class="form-control" id="h_reseller" name="h_reseller" value="{{ $produk->h_reseller }}" required>
                    </div>

                    <div class="form-group">
                        <label for="profit">Profit</label>
                        <input type="number" class="form-control" id="profit" name="profit" value="{{ $produk->profit }}" required>
                    </div>

                    <div class="form-group">
                        <label for="berat">Berat</label>
                        <input type="number" class="form-control" id="berat" name="berat" value="{{ $produk->berat }}" required>
                    </div>

                    <div class="form-group">
                        <label for="profit_reseller">Profit Reseller</label>
                        <input type="number" class="form-control" id="profit_reseller" name="profit_reseller" value="{{ $produk->profit_reseller }}" required>
                    </div>

                    <div class="form-group">
                        <label for="profit_db">Profit DB</label>
                        <input type="number" class="form-control" id="profit_db" name="profit_db" value="{{ $produk->profit_db }}" required>
                    </div>

                    <button type="submit" class="btn btn-success">Update</button>
                </form>
            </div>
        </div>
    </div>
@stop
