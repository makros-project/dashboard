@extends('adminlte::page')

@section('title', 'Download')

@section('content_header')
    <h1>Download Page</h1>
@stop

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header bg-secondary">
                Download Resi
            </div>
            <div class="card-body">
                <form action="{{ route('sales.print') }}">
                    @csrf
                    <div class="input-group" class="form-control">
                        <input type="date" name="tgl_kirim_fix" value="{{ date('Y-m-d') }}" id="" class="form-control">
                        <select name="batch" id="" class="form-control">
                            <option value="1">Batch 1</option>
                            <option value="2">Batch 2</option>
                            <option value="3">Batch 3</option>
                            <option value="4">Batch 4</option>
                        </select>
                        <input type="submit" value="Download Resi" class="btn-primary">
                </div>
                </form>
            </div>
        </div>
        <div class="card mt-2">
            <div class="card-header bg-secondary">
                Download Resi
            </div>
            <div class="card-body">
                <form action="{{ route('sales.print') }}">
                    @csrf
                    <div class="input-group" class="form-control">
                        <input type="date" name="tgl_kirim_fix" value="{{ date('Y-m-d') }}" id="" class="form-control">
                        <select name="batch" id="" class="form-control">
                            <option value="1">Batch 1</option>
                            <option value="2">Batch 2</option>
                            <option value="3">Batch 3</option>
                            <option value="4">Batch 4</option>
                        </select>
                        <input type="submit" value="Download Resi" class="btn-primary">
                </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop