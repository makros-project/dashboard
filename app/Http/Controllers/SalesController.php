<?php

namespace App\Http\Controllers;

use App\Models\Sale;
// use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
        return view('sales.create');    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'no_inv' => 'required|string',
            'tgl_kirim_fix' => 'required|date',
            'batch' => 'required|integer',
            'produk' => 'required|string',
            'jumlah' => 'required|integer',
            'nilai_barang' => 'required|integer',
            'alamat' => 'required|string',
            'kurir' => 'required|string',
        ]);

        // Simpan data ke tabel sales
        Sale::create([
            'no_inv' => $request->no_inv,
            'tgl_kirim_fix' => $request->tgl_kirim_fix,
            'batch' => $request->batch,
            'produk' => $request->produk,
            'jumlah' => $request->jumlah,
            'nilai_barang' => $request->nilai_barang,
            'alamat' => $request->alamat,
            'kurir' => $request->kurir,
        ]);

        return redirect()->route('sales.create')->with('success', 'Penjualan berhasil disimpan.');
        }

        public function cekOngkir(Request $request)
        {
            // Pastikan alamat dan kurir disediakan
            $request->validate([
                'alamat' => 'required|string',
                'kurir' => 'required|string',
            ]);
    
            // Panggil API ongkir (sesuaikan dengan API yang Anda gunakan)
            // Contoh menggunakan Http client Laravel:
            $response = Http::post('https://api.ongkir.example.com/cek', [
                'alamat' => $request->alamat,
                'kurir' => $request->kurir,
            ]);
    
            if ($response->successful()) {
                $ongkir = $response->json()['ongkir'];  // sesuaikan dengan struktur API Anda
                return response()->json(['ongkir' => $ongkir]);
            }
    
            return response()->json(['error' => 'Gagal memeriksa ongkir'], 500);
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


    public function batalfix(Request $request, $no_inv)
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


    //       // Validasi input dari request
    //     $validatedData = $request->validate([
    //         'tgl_kirim_fix' => 'required|date',
    //         'batch' => 'required|integer',
    //     ]);
    
    //     // Cari Sale berdasarkan no_inv, bukan id
    //     $sale = Sale::where('no_inv', $no_inv)->firstOrFail();
    // dd($sale);
    //     // Update record dengan data yang sudah divalidasi
    //     $sale->update($validatedData);
    
    //         // Redirect dengan pesan sukses
    //         return redirect()->route('sales.update')->with('success', 'Transaksi berhasil dibatalkan.');
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
        $sales = Sale::where('batch', $request->batch)
        ->where('tgl_kirim_fix', $request->tgl_kirim_fix)
        ->get();
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


    public function exportSales(Request $request)
    {
        // Ambil data dari database
        $sales = Sale::where('batch', $request->batch)
        ->where('tgl_kirim_fix', $request->tgl_kirim_fix)
        ->where('kurir', 'like', '%' . $request->kurir . '%')
        ->get();

        // Buat spreadsheet baru
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Buat header kolom di Excel
        $sheet->setCellValue('A1', 'Nama_Pengirim');
        $sheet->setCellValue('B1', 'Alamat_Pengirim');
        $sheet->setCellValue('C1', 'Kota_pengirim');
        $sheet->setCellValue('D1', 'Kodepos_Pengirim');
        $sheet->setCellValue('E1', 'Telepon_Pengirim');
        $sheet->setCellValue('F1', 'Nama_Penerima');
        $sheet->setCellValue('G1', 'Alamat_Penerima');
        $sheet->setCellValue('H1', 'Kota_penerima');
        $sheet->setCellValue('I1', 'Kodepos_Penerima');
        $sheet->setCellValue('J1', 'Telepon_Penerima');
        $sheet->setCellValue('K1', 'Berat');
        $sheet->setCellValue('L1', 'Isi_Kiriman');
        $sheet->setCellValue('M1', 'Nilai_Barang');
        $sheet->setCellValue('N1', 'Status_COD');
        $sheet->setCellValue('O1', 'Nilai_COD');

        // Isi data dari database ke kolom Excel
        $row = 2; // mulai dari baris kedua (baris pertama untuk header)
        foreach ($sales as $sale) {
            $sheet->setCellValue('A' . $row, "CV CIWIDEY FOOD");
            $sheet->setCellValue('B' . $row, "Perumahan Puri Indah Ciwidey Blok Puri Ayu No 30");
            $sheet->setCellValue('C' . $row, "Bandung");
            $sheet->setCellValue('D' . $row, "40972");
            $sheet->setCellValue('E' . $row, "8112349006");
            $sheet->setCellValue('F' . $row, $sale->pelanggan);
            $sheet->setCellValue('G' . $row, $sale->alamat);
            $sheet->setCellValue('H' . $row, $sale->kota);
            $sheet->setCellValue('I' . $row, $sale->kode_pos);
            $sheet->setCellValue('J' . $row, $sale->no_hp);
            $sheet->setCellValue('K' . $row, $sale->berat);
            $sheet->setCellValue('L' . $row, $sale->produks);
            $sheet->setCellValue('M' . $row, $sale->nilai_barang);
            $sheet->setCellValue('N' . $row, explode(" ",$sale->pelanggan)[0]);
            if (explode(" ",$sale->pelanggan)[0] == "COD") {
            $sheet->setCellValue('O' . $row, $sale->nilai_barang);
            }else {
            $sheet->setCellValue('O' . $row, "NON-COD");
            }
            $row++;
        }

        // Siapkan file Excel untuk di-download
        $writer = new Xlsx($spreadsheet);
        $fileName = $request->kurir.'_'.$request->tgl_kirim_fix.'_Batch_'.$request->batch.'.xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($temp_file);

        // Return file sebagai download response
        return Response::download($temp_file, $fileName)->deleteFileAfterSend(true);
    }

    public function rekap()
    {
        // Rekap jumlah produk berdasarkan tgl_kirim_fix
        $produkPerTglKirim = Sale::where('produk', '!=', 'Ongkir')
            ->select('produk','batch','tgl_kirim_fix', DB::raw('SUM(jumlah) as total_produk'))
            ->groupBy('produk','batch','tgl_kirim_fix')
            ->orderBy('tgl_kirim_fix', 'desc')
            ->get();

        // Rekap jumlah produk berdasarkan 10 tanggal terakhir
        $last10Dates = Sale::where('produk', '!=', 'Ongkir')
            ->orderBy('tgl_kirim_fix', 'desc')
            ->take(10)
            ->get()
            ->groupBy('tgl_kirim_fix')
            ->map(function ($group) {
                return $group->sum('jumlah');
            });

        // Rekap jumlah no_inv berdasarkan kurir
        $rekapKurir = Sale::where('produk', '!=', 'Ongkir')
            ->select('kurir', DB::raw('COUNT(no_inv) as total_no_inv'))
            ->groupBy('kurir')
            ->get();

        return view('sales.rekap', [
            'produkPerTglKirim' => $produkPerTglKirim,
            'last10Dates' => $last10Dates,
            'rekapKurir' => $rekapKurir,
        ]);
    }


    public function berita(Request $request)
    {
        // Ambil data dari request
        $tgl_kirim_fix = $request->input('tgl_kirim_fix');
        $batch = $request->input('batch');

        // Query untuk mendapatkan data berdasarkan tgl_kirim_fix dan batch
            $sales = Sale::select('no_inv','pelanggan')
             ->where('tgl_kirim_fix', $tgl_kirim_fix)
             ->where('batch', $batch)
             ->where('produk', '!=', 'Ongkir')
             ->groupBy('no_inv','pelanggan')
             ->get();
             
             $sales2 = Sale::where('tgl_kirim_fix', $tgl_kirim_fix)
             ->where('batch', $batch)
             ->where('produk', '!=', 'Ongkir')
             ->get();
             
             $kurir = Sale::select('kurir')
                  ->where('tgl_kirim_fix', $tgl_kirim_fix)
                  ->where('batch', $batch)
                  ->where('produk', '!=', 'Ongkir')
                  ->groupBy('kurir')
                  ->get();
             
        return view('sales.berita', compact('kurir','sales','sales2', 'tgl_kirim_fix', 'batch'));
    }




     // Fungsi untuk menangani permintaan dari Select2
    public function getDestinationData(Request $request)
    {
        $search = $request->input('searchTerm');

        // Query data dari database sesuai dengan input search term
        $results = DB::table('tb_indonesia')
            ->where('Provinsi', 'like', "%{$search}%")
            ->orWhere('Kabupaten', 'like', "%{$search}%")
            ->orWhere('Kecamatan', 'like', "%{$search}%")
            ->orWhere('KodePos', 'like', "%{$search}%")
            ->limit(6)
            ->get();

        $data = [];
        foreach ($results as $result) {
            // Panggilan ke API eksternal untuk mendapatkan ongkir
            $get_kecamatan_id = Http::get("https://sandbox-api.ptncs.com/bot/getkecid/ciwideyfooddemo/demo", [
                'provinsi' => str_replace(" ", "%20", $result->Provinsi),
                'kabupaten' => str_replace(" ", "%20", $result->Kabupaten),
                'kecamatan' => str_replace(" ", "%20", $result->Kecamatan),
            ])->json();

            $get_ongkir = Http::get("https://sandbox-api.ptncs.com/bot/publishrate/ciwideyfooddemo/demo", [
                'origin' => 327322,
                'destination' => $get_kecamatan_id['data'][0]['KecID'],
                'weight' => 1
            ])->json();

            foreach ($get_ongkir['data'] as $ongkir) {
                $data[] = [
                    "id" => "{$result->Provinsi}--{$result->Kabupaten}--{$result->Kecamatan}--{$result->KodePos}--{$ongkir['ServiceCode']}--" . ($ongkir['TotalPrice']+1000) . "--{$ongkir['Etd']} Hari",
                    "text" => "{$result->Provinsi}, {$result->Kabupaten}, {$result->Kecamatan}, {$result->KodePos}, {$ongkir['ServiceCode']} TF = " . number_format($ongkir['TotalPrice']+1000) . " {$ongkir['Etd']} Hari"
                ];
            }
        }

        return response()->json($data);
    }
}
