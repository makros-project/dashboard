<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice CF</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    
    <!-- jQuery and Select2 JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>
<body>
 <div class="text-center">
            <h3 class=" ">Invoice Ciwidey Food</h3>
            <textarea class=" bg-secondary form-control text-center text-white" name="" id="tempat" cols="30" rows="7"></textarea>

        </div> 
    <div class="container ">

                
        <form method="post" action="{{ route('sales.store') }}">
            @csrf
            <div class="form-group">
                <label for="destinationSelect">Tujuan :</label>
                <select name="tujuan" id="destinationSelect" class="form-control js-data-example-ajax">
                    <option value="" selected disabled>Pilih Kecamatan / Kota Tujuan</option>
                </select>
            </div>

            <div class="input-group">
                <select class="bg-light" name="jen" id="">
                    <option value="COD ">COD</option>
                    <option value="TF ">TF</option>
                    <option value="">Lainnya</option>
                </select>
                <input type="text" name="pembeli" id="paste-pembeli" required placeholder="Nama"
                    value="" class="form-control text-center">
                <button class="btn btn-sm border" id="pastepembeli">Paste</button>
            </div>

            <div class="input-group">
                <input type="text" name="kurir" id="kur" required placeholder="kurir" value=""
                    class="form-control text-center">
                <input type="text" name="no_hp" required placeholder="No Hp" value=""
                    class="form-control text-center">
                    
                    <input type="text" hidden>

                <button class="btn btn-sm border" id="pasteno_hp" onclick="pasteno_hp()">Paste</button>
            </div>



            <div class="input-group">
                <input type="text" name="alamat" multiple required placeholder="Alamat" value=""class="form-control text-center">
                <button class="btn btn-sm border" id="pastealamat">Paste</button>
            </div>

            <div class="input-group input-group-sm mb-1">
                <select name="jenis" id="j_pembeli" class="form-control text-center" required>
                    <!-- <option value="" selected disabled>Pilih Jenis</option> -->
                    <option value="ecer">Ecer</option>
                    <option value="reseller">Reseller</option>
                    <option value="distributor">Distributor</option>
                </select>
                <input type="date" name="tgl_kirim" required placeholder="tgl_kirim"
                    class="form-control text-center" value="<?= date('Y-m-d'); ?>">
                <input type="numbers" name="estimasi" id="estimasi" value="" required
                    placeholder="Estimasi Hari" class="form-control text-center">

            </div>
            <div class="input-group">
            <input type="text" name="keterangan" id="keterangan" value="" 
                    placeholder="Keterangan" class="form-control text-center">
            </div>

            <div class="input-group  mb-1">
                <a href="https://ciwideyfood.com/app/penjualan/data_penjualan.php"
                    class="btn  btn-primary form-control">Invoice</a>
                <input type="submit" name="upload"  value="Upload" class="btn btn-success form-control ">
            </div>
        
            <textarea class="form-control mt-3" name="pesanan" id="list_produk" cols="100%" rows="10"><?php
                include 'invoice/koneksi.php';
                $no = 1;
                $sqlproduk = $koneksi->query("select * from tb_barang where nama_barang not like 'z%' order by nama_barang asc");

                while ($dataproduk = $sqlproduk->fetch_assoc()) {
                    echo "#" . $no ."(".$dataproduk['stok'] .")". "#" . $dataproduk['nama_barang'] . "#0" . "\n";
                    $no++;
                } ?>
        </textarea>

        <?php 
         $sales = $koneksi->query("select * from sales order by no_inv desc limit 1");
         $invo = $sales->fetch_assoc()
        ?>
        <input type="text" name="no_inv" hidden value="<?= $invo['no_inv']+1 ?>">
        </form>

     
    </div>
  

<script>
    $(document).ready(function() {
        // Inisialisasi Select2 untuk kota asal
        $('#originSelect').select2();

        // Inisialisasi Select2 untuk kota tujuan
        $('#destinationSelect').select2(
            {
            allowHtml : true,
            ajax : {
            url: "invoice/select-search.php", 
            method: "post",
            dataType: "json",
            data: function(params)
            {
                return {
                    searchTerm: params.term
                };
            },
            processResults: function(response){
                return {
                results: response
                };
            }  
        }
        }
        );
    });
</script>

<script>
                



                const pasteButton1 = document.querySelector("button[id='pastepembeli']");

pasteButton1.addEventListener('click', async () => {
    try {
        // Mengambil teks dari clipboard
        const text = await navigator.clipboard.readText();

        // Menambahkan teks ke input field
        const pembeliInput = document.querySelector("input[name='pembeli']");
        pembeliInput.value += text;

        // Memberikan umpan balik di console
        console.log('Text pasted successfully:', text);
    } catch (error) {
        // Menangani error dan memberikan umpan balik jika terjadi masalah
        console.error('Failed to read clipboard contents: ', error);
        alert('Failed to paste text. Please allow clipboard access in your browser.');
    }
});

  // Tombol untuk paste nomor HP
const pasteButton2 = document.querySelector("button[id='pasteno_hp']");

pasteButton2.addEventListener('click', async () => {
    try {
        // Mengambil teks dari clipboard
        const text = await navigator.clipboard.readText();
        
        // Menambahkan teks ke input field no_hp
        document.querySelector("input[name='no_hp']").value += text;
        
        console.log('Text for phone number pasted successfully.');
    } catch (error) {
        // Memberikan umpan balik jika gagal
        console.log('Failed to read clipboard contents for phone number.', error);
        alert('Failed to paste text for phone number. Please check clipboard permissions.');
    }
});

// Tombol untuk paste alamat
const pasteButton3 = document.querySelector("button[id='pastealamat']");

pasteButton3.addEventListener('click', async () => {
    try {
        // Mengambil teks dari clipboard
        const text = await navigator.clipboard.readText();
        
        // Menambahkan teks ke input field alamat
        document.querySelector("input[name='alamat']").value += text;
        
        console.log('Text for address pasted successfully.');
    } catch (error) {
        // Memberikan umpan balik jika gagal
        console.log('Failed to read clipboard contents for address.', error);
        alert('Failed to paste text for address. Please check clipboard permissions.');
    }
});

    </script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
