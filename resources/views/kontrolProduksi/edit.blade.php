@extends('adminlte::page')

@section('title', 'Edit Kontrol Produksi')

@section('content_header')
    <h1>Edit Kontrol Produksi</h1>
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
                    <div class="card-body">
                        <form action="{{ route('kontrolProduksi.update', $kontrolProduksi->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="form-group">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ $kontrolProduksi->tanggal }}">
                            </div>
                            
                            <div class="form-group">
                                <label for="produk">Produk</label>
                                <select name="produk" id="produk" class="form-control select2">
                                    @foreach($produk as $p)
                                        <option value="{{ $p->id }}" 
                                            {{ $kontrolProduksi->produk == $p->nama_barang ? 'selected' : '' }}>
                                            {{ $p->nama_barang }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="jenis">Jenis Transaksi</label>
                                <select name="jenis" id="jenis" class="form-control">
                                    <option value="Masuk" {{ $kontrolProduksi->jenis == 'Masuk' ? 'selected' : '' }}>Masuk</option>
                                    <option value="Keluar" {{ $kontrolProduksi->jenis == 'Keluar' ? 'selected' : '' }}>Keluar</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                <input type="number" name="jumlah" id="jumlah" class="form-control" value="{{ $kontrolProduksi->jumlah }}">
                            </div>
                            
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea name="keterangan" id="keterangan" class="form-control">{{ $kontrolProduksi->keterangan }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@stop
