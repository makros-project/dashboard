<?php
namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Indonesia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OngkirController extends Controller
{
    public function showForm()
    {
        $dest = Indonesia::all();
        return view('sales.create', compact('dest'));
    }
    
    public function store(Request $request)
    {
        // Validasi data yang masuk
        $validatedData = $request->validate([
        'no_inv' => 'required|integer',
        'tgl_kirim' => 'required|date',
        'tgl_kirim_fix' => 'required|date',
        'pelanggan' => 'required|max:255',
        // 'produk' => 'required|max:255',
        // 'status_bayar' => 'required|max:255',
        // 'jumlah' => 'required|integer',
        // 'j_harga' => 'required|max:255',
        // 'satuan' => 'required|max:255',
        // 'batch' => 'required|max:1',
        // 'estimasi' => 'required|max:10',
        // 'no_hp' => 'required|max:15',
        // 'alamat' => 'required|max:1000',
        // 'kabupaten' => 'required|max:255',
        // 'provinsi' => 'required|max:255',
        // 'kabid' => 'required|max:255',
        // 'kecid' => 'required|max:255',
        // 'kota' => 'required|max:255',
        // 'kecamatan' => 'required|max:255',
        // 'kode_pos' => 'required|max:255',
        // 'produks' => 'required|max:255',
        // 'berat' => 'required|integer',
        // 'nilai_barang' => 'required|integer',
        // 'pembayaran' => 'required|max:255',
        // 'jumlah_item' => 'required|integer',
        // 'kurir' => 'required|max:255',
        // 'steril' => 'required|max:255',
        // 'block' => 'required|max:255',
        // 'follow_up' => 'required|max:255',
        // 'keterangan' => 'required|max:255',
        // 'ongkir_real' => 'required|integer',
        // 'waktu' => 'required|date',
        // 'waktu_fix' => 'required|date',
        // 'profit' => 'required|integer'
        ]);

        $address = $request->tujuan;
        $provinsi = explode("--",$address)[0];
        $kabupaten = explode("--",$address)[1];
        $kecamatan = explode("--",$address)[2];
        $kode_pos = explode("--",$address)[3];
        $service = explode("--",$address)[4];
        $ongkir = explode("--",$address)[5];
        $etd = explode("--",$address)[6];
        $kabid = explode("--",$address)[7];
        $kecid = explode("--",$address)[8];

        Sale::create([
        'no_inv' => $request->no_inv ,
        'tgl_kirim' => $request->tgl_kirim ,
        'tgl_kirim_fix' => '0001-001-01' ,
        'pelanggan' => $request->pembeli ,
        // 'produk' => $request->produk ,
        // 'status_bayar' => $request->status_bayar ,
        // 'jumlah' => $request->jumlah ,
        // 'j_harga' => $request->j_harga ,
        // 'satuan' => $request->satuan ,
        // 'batch' => $request->batch ,
        // 'estimasi' => $request->estimasi ,
        // 'no_hp' => $request->no_hp ,
        // 'alamat' => $request->alamat ,
        // 'kabupaten' => $kabupaten ,
        // 'provinsi' => $provinsi ,
        // 'kabid' => $kabid ,
        // 'kecid' => $kecid ,
        // 'kota' => $kabupaten ,
        // 'kecamatan' => $kecamatan ,
        // 'kode_pos' => $kode_pos ,
        // 'produks' => $request->produks ,
        // 'berat' => $request->berat ,
        // 'nilai_barang' => $request->nilai_barang ,
        // 'pembayaran' => $request->pembayaran ,
        // 'jumlah_item' => $request->jumlah_item ,
        // 'kurir' => $request->kurir ,
        // 'steril' => $request->steril ,
        // 'block' => $request->block ,
        // 'follow_up' => $request->follow_up ,
        // 'keterangan' => $request->keterangan ,
        // 'ongkir_real' => $request->ongkir_real ,
        // 'waktu' => $request->waktu ,
        // 'waktu_fix' => $request->waktu_fix ,
        // 'profit' => $request->profit 
        ]);
        // Membuat produk baru
        Sale::create($validatedData);

        // Redirect ke halaman daftar produk dengan pesan sukses
        return redirect()->route('sale.create')->with('success', 'Transaksi berhasil ditambahkan!');
    }
}
