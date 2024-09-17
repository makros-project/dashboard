@extends('adminlte::page')

@section('title', 'Tambah Kontrol Produksi')

@section('content_header')
    <h1>Tambah Kontrol Produksi</h1>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Kontrol Produksi</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('kontrolProduksi.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ old('tanggal', date('Y-m-d')) }}">
                            </div>
                            <div class="form-group">
                                <label for="produk">Produk</label>
                                <select name="produk" id="produk" class="form-control select2">
                                    <option value="">Pilih Produk</option>
                                    @foreach($produk as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_barang }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                <input type="number" name="jumlah" id="jumlah" class="form-control" value="{{ old('jumlah') }}">
                            </div>
                            <div class="form-group">
                                <label for="jenis">jenis</label>
                                <select name="jenis" id="jenis" class="form-control">
                                    <option value="">Pilih jenis</option>
                                    <option value="Masuk">Masuk</option>
                                    <option value="Keluar">Keluar</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea name="keterangan" class="form-control" id="" cols="30" rows="3"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: 'Pilih Produk',
                allowClear: true
            });
        });
    </script>
@stop
