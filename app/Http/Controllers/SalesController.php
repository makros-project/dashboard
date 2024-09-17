<?php

namespace App\Http\Controllers;

use App\Models\Sale;
// use Barryvdh\DomPDF\PDF;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
   
    $sales = Sale::distinct('no_inv')
    ->get();

    return view('sales.index', compact('sales'));
    }


   

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($no_inv)
    {
       // Mengambil sale berdasarkan no_inv
       $sale = Sale::where('no_inv', $no_inv)->firstOrFail();

       $detail = Sale::where('no_inv', $no_inv)->get();
       $total = Sale::where('no_inv', $no_inv)->where('produk', 'not like', '%Ongkir%')->sum('jumlah');
       $totals = Sale::where('no_inv', $no_inv)->where('produk', 'not like', '%Ongkir%')->sum('satuan');
        $grand = $total*$totals;
       // Mengembalikan view dengan data sale
       return view('sales.show', compact('sale','detail','total','grand'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $no_inv)
    {
        // Validasi input dari request
        $validatedData = $request->validate([
            'tgl_kirim_fix' => 'required|date',
            'batch' => 'required|integer',
        ]);
    
        // Cari Sale berdasarkan no_inv, bukan id
        $sale = Sale::where('no_inv', $no_inv)->firstOrFail();
    
        // Update record dengan data yang sudah divalidasi
        $sale->update($validatedData);
    
        // Redirect dengan pesan sukses
        return redirect()->route('sales.index')->with('success', 'Data berhasil diperbarui.');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function download(Request $request)
    {
   

        return view('download.index');
    }

    public function print(Request $request)
    {
        // Menampilkan form edit produk
        // $sales = Sale::findOrFail();
        $sales = Sale::where('batch', $request->batch)->where('tgl_kirim_fix', $request->tgl_kirim_fix)->get();
        $tgl = $request->tgl_kirim_fix;
        $batch = $request->batch;

        return view('sales.print', compact('sales','tgl','batch'));
    }


    public function printPDF(Request $request)
    {
        // Ambil semua data sales
        $sales = Sale::where('batch','=',$request->batch)->where('tgl_kirim_fix','=',$request->tgl_kirim_fix)->get();

        // Load view sales dan pass data ke view
        $pdf = PDF::loadView('sales.print', compact('sales'));

        // Return hasil sebagai file download atau bisa juga tampilkan di browser
        return $pdf->download('sales.pdf'); // Untuk download langsung
        // return $pdf->stream(); // Untuk menampilkan langsung di browser
        
    }
}
