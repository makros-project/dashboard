<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Models\KontrolProduksi;

class KontrolProduksiController extends Controller
{
    // Display a listing of the production control records
    public function index()
    {
        $kontrolProduksi = KontrolProduksi::orderBy('id', 'desc')->paginate(500);
        return view('kontrolProduksi.index', compact('kontrolProduksi'));
    }

    // Show the form for creating a new production control record
    public function create()
    {
        // Ambil produk yang tidak berawalan dengan 'z-'
        $produk = Produk::orderby('nama_barang')
        ->where('nama_barang','not like',' O%')
        ->where('nama_barang','not like','disk%')
        ->get();
        return view('kontrolProduksi.create', compact('produk'));
    }

    // Store a newly created production control record in storage
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'produk' => 'required|exists:tb_barang,id', // Validasi bahwa produk harus ada di tabel produk
            'jumlah' => 'required|integer',
            'keterangan' => 'nullable|string',
            'jenis' => 'required|in:Masuk,Keluar', // Validasi bahwa jenis harus "Masuk" atau "Keluar"
        ]);
    
        // Gabungkan 'jenis' dan 'keterangan_tambahan' menjadi satu string
        $keterangan = $request->jenis . ' -> ' . $request->keterangan;
    
        // Temukan produk berdasarkan ID
        $produk = Produk::findOrFail($request->produk);
    
        // Simpan data kontrol produksi dengan nama produk
        KontrolProduksi::create([
            'tanggal' => $request->tanggal,
            'produk' => $produk->nama_barang,
            'jumlah' => $request->jumlah,
            'keterangan' => $keterangan,
        ]);
    
        // Update stok produk
        if ($request->jenis == 'Keluar') {
            // Kurangi stok jika jenis adalah 'Keluar'
            $produk->stok = $produk->stok - $request->jumlah;
        } else {
            // Tambahkan stok jika jenis adalah 'Masuk'
            $produk->stok = $produk->stok + $request->jumlah;
        }
    
        // Simpan perubahan stok
        $produk->save();
    
        return redirect()->route('kontrolProduksi.index')
                         ->with('success', 'Data berhasil ditambahkan dan stok diperbarui.');
    }
    
    

    // Show the form for editing the specified production control record
    public function edit(KontrolProduksi $kontrolProduksi)
    {
        // Ambil semua produk yang tidak berawalan dengan 'z-'
        $produk = Produk::where('nama_barang', 'not like', 'z-%')->get();
        
        return view('kontrolProduksi.edit', compact('kontrolProduksi', 'produk'));
    }
    
    public function update(Request $request, KontrolProduksi $kontrolProduksi)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'produk' => 'required|exists:tb_barang,id', // Validasi produk harus ada di tabel
            'jumlah' => 'required|integer',
            'keterangan' => 'nullable|string',
            'jenis' => 'required|in:Masuk,Keluar', // Validasi jenis harus "Masuk" atau "Keluar"
        ]);
    
        // Ambil produk lama berdasarkan nama barang yang sudah ada di record sebelumnya
        $produkLama = Produk::where('nama_barang', $kontrolProduksi->produk)->first();
    
        // Kembalikan stok lama ke nilai sebelum update
        if ($kontrolProduksi->jenis == 'Keluar') {
            $produkLama->stok += $kontrolProduksi->jumlah; // Tambahkan kembali stok yang keluar
        } else {
            $produkLama->stok -= $kontrolProduksi->jumlah; // Kurangi stok yang sudah ditambah
        }
        $produkLama->save();
    
        // Ambil produk baru berdasarkan id produk dari request
        $produkBaru = Produk::findOrFail($request->produk);
    
        // Setelah stok lama dikembalikan, proses stok produk baru berdasarkan update
        if ($request->jenis == 'Keluar') {
            $produkBaru->stok -= $request->jumlah; // Kurangi stok jika produk keluar
        } else {
            $produkBaru->stok += $request->jumlah; // Tambah stok jika produk masuk
        }
        $produkBaru->save();
    
        // Gabungkan 'jenis' dan 'keterangan'
        $keterangan = $request->jenis . ' -> ' . $request->keterangan;
    
        // Update data kontrol produksi
        $kontrolProduksi->update([
            'tanggal' => $request->tanggal,
            'produk' => $produkBaru->nama_barang, // Gunakan nama produk dari produk baru
            'jumlah' => $request->jumlah,
            'keterangan' => $keterangan,
            'jenis' => $request->jenis, // Tambahkan jenis agar tetap konsisten
        ]);
    
        return redirect()->route('kontrolProduksi.index')
                         ->with('success', 'Data berhasil diupdate dan stok diperbarui.');
    }
    
    
    public function destroy(KontrolProduksi $kontrolProduksi)
    {
        // Ambil produk terkait
        $produk = Produk::where('nama_barang', $kontrolProduksi->produk)->firstOrFail();
    
        // Kembalikan stok sebelum menghapus data kontrol produksi
        if ($kontrolProduksi->jenis == 'Keluar') {
            // Jika jenis 'Keluar', tambahkan kembali jumlah ke stok
            $produk->stok += $kontrolProduksi->jumlah;
        } else {
            // Jika jenis 'Masuk', kurangi stok
            $produk->stok -= $kontrolProduksi->jumlah;
        }
        $produk->save();
    
        // Hapus data kontrol produksi
        $kontrolProduksi->delete();
    
        return redirect()->route('kontrolProduksi.index')
                         ->with('success', 'Data berhasil dihapus dan stok diperbarui.');
    }
    
}
