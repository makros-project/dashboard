
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
    </style>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
<div class="card text-center bg-secondary text-light">
<h3>Daftar Resi </h3>
<p>Tanggal : {{ $tgl }} Batch : {{ $batch }}</p>
</div>

<table class="table table-sm table-bordered mt-3">
    <thead>
        <tr>
            <th>#</th>
            <th>Invoice Number</th>
            <th>Total</th>
            <th>Batch</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($sales as $sale)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $sale->no_inv }}</td>
                <td>{{ $sale->total }}</td>
                <td>{{ $sale->batch }}</td>
                <td>{{ $sale->tgl_kirim_fix }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
