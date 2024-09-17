<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data produk
        $produks = Produk::orderby('nama_barang', 'asc')
            ->where('nama_barang', '!=', 'Ongkir')
            ->get();
    
        // Membagikan data ke lebih dari satu view
        view()->share('produks', $produks);
    
        return view('produk.index'); // View pertama
        // Dan pada route lain, view 'dashboard' juga bisa diakses menggunakan data ini
    }

    public function home()
    {
        // Mengambil data yang disimpan di session flash
        $produks = Produk::orderby('nama_barang', 'asc')
        ->where('nama_barang', '!=', 'Ongkir')
        ->get();
        
        // Kirim ke view dashboard
        return view('home', compact('produks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Menampilkan form untuk membuat produk baru
        return view('produk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'kode' => 'required|unique:tb_barang|max:255',
            'tgl_terima' => 'required|date',
            'nama_barang' => 'required|max:255',
            'satuan' => 'required|max:50',
            'stok' => 'required|integer',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'harga_ecer' => 'required|numeric',
            'h_reseller' => 'required|numeric',
            'profit' => 'required|numeric',
            'berat' => 'required|numeric',
            'profit_reseller' => 'required|numeric',
            'profit_db' => 'required|numeric',
        ]);

        // Membuat produk baru
        Produk::create($validatedData);

        // Redirect ke halaman daftar produk dengan pesan sukses
        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Menampilkan detail produk
        $produk = Produk::findOrFail($id);
        return view('produk.show', compact('produk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Menampilkan form edit produk
        $produk = Produk::findOrFail($id);
        return view('produk.edit', compact('produk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'kode' => 'required|max:255',
            'tgl_terima' => 'required|date',
            'nama_barang' => 'required|max:255',
            'satuan' => 'required|max:50',
            'stok' => 'required|integer',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'harga_ecer' => 'required|numeric',
            'h_reseller' => 'required|numeric',
            'profit' => 'required|numeric',
            'berat' => 'required|numeric',
            'profit_reseller' => 'required|numeric',
            'profit_db' => 'required|numeric',
        ]);

        // Update produk yang sudah ada
        $produk = Produk::findOrFail($id);
        $produk->update($validatedData);

        // Redirect ke halaman daftar produk dengan pesan sukses
        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Menghapus produk
        $produk = Produk::findOrFail($id);
        $produk->delete();

        // Redirect ke halaman daftar produk dengan pesan sukses
        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus!');
    }
}
