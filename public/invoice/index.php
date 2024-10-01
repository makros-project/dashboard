
<?php
include 'koneksi.php';

$sqlinvoice = $koneksi->query("select * from sales order by id desc");
// $re_pembeli1 = explode("-",$_GET['pembeli']);
// $re_pembeli = $re_pembeli1[0];
// $re_no_hp = $_GET['no_hp'];
// $re_alamat = $_GET['alamat'];
// $re_estimasi = $_GET['estimasi'];
// $re_produk = $_GET['produk'];
// $re_kurir = $re_pembeli1[1];

?>
<!doctype html> 
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoice Klip</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

        
    <!-- Include CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

<!-- Include JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


<script>
    $(document).ready(function() {
        // Inisialisasi Select2 untuk kota asal
        $('#originSelect').select2();

        // Inisialisasi Select2 untuk kota tujuan
        $('#destinationSelect').select2(
            {
            allowHtml : true,
            ajax : {
            url: "select-search.php", 
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
</head>

<body>
    
    <div class="container mt-2 sticky-top">
        
        <div class="row text-center">
            <h1 class=" ">Invoice Ciwidey Food</h1>
            <textarea class="fixed-top opacity-50 card mb-1 text-center" name="" id="tempat" cols="30" rows="7"
                style="background-color: black;color:#fff;">
              
            </textarea>

        </div>
        <div class=" bg-light" style="padding-bottom: 50px;">
            <form action="" method="post" style="padding-top: 125px;" class="" id="form1">


  <div class="text-center">         

  <!-- <a href="https://ciwideyfood.com/barokah/penjualan/ongkir/cek.php" class="btn btn-sm btn-primary">Cek Ongkir</a> -->


</div>    


            <select  name="tujuan" id="destinationSelect" class="js-example-basic-single text-center form-control" >
                <option value="" selected disabled>Pilih Kecamatan / Kota Tujuan</option>
            </select>


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
                <a href="ongkir/cek.php" class="btn btn-sm btn-info">Cek</a>
                </div>

                <div class="input-group  mb-1">
                    <a href="https://ciwideyfood.com/barokah/penjualan/data_penjualan.php"
                        class="btn  btn-primary form-control">Invoice</a>
                    <input type="submit" name="cek" value="Cek" class="btn btn-warning form-control ">
                    <input type="submit" name="upload"  value="Upload" class="btn btn-success form-control ">
                </div>

                <textarea class="form-control mt-3" name="pesanan" id="list_produk" cols="100%" rows="23"><?php
                
                $no = 1;
                $sqlproduk = $koneksi->query("select * from tb_barang  order by nama_barang asc");

                while ($dataproduk = $sqlproduk->fetch_assoc()) {
                    echo "#" . $no ."(".$dataproduk['stok'] .")". "#" . $dataproduk['nama_barang'] . "#0" . "\n";
                    $no++;
                } ?>
        </textarea>

       

                        </div>
                    </div>
                </div>
              
            </form>
        </div>
        <?php

$date = pow(date('H'),3);
$date1 = date('d')*3;

?>
<div class="opacity-25" style="font-size:12px;">
<?php
echo $date+$date1;
?>
</div>
    </div>
    <?php
    if (isset($_POST['submit'])) {
        $pembeli = str_replace("'", " ", htmlspecialchars($_POST['jen'] . $_POST['pembeli'] . " - " . $_POST['kurir']));
        $no_hp = htmlspecialchars(preg_replace('/[^0-9]/', '', ltrim($_POST['no_hp'], '0')));
        $alamat = str_replace("'", " ", htmlspecialchars(trim(preg_replace('/\s\s+/', ' ', $_POST['alamat']))));


        $jenis = $_POST['jenis'];
        $tgl_kirim = $_POST['tgl_kirim'];
        $estimasi = $_POST['estimasi'];
        

        $pesanan = $_POST['pesanan'];

        $array = explode("#", $pesanan);

        $jumlaharray = count(explode("#", $pesanan));
        for ($x = 2; $x <= $jumlaharray; $x += 3) {

            if (explode("#", $pesanan)[$x + 1] != 0) {
                $prod = explode("#", $pesanan)[$x];

                echo explode("#", $pesanan)[$x];
                echo " = ";
                echo explode("#", $pesanan)[$x + 1];
                echo "<br>";
            }
        }
    }
    ?>


    <?php
    if (isset($_POST['upload'])) {
        $tgl_kirim = $_POST['tgl_kirim'];
        $estimasi = $_POST['estimasi'];
        $keterangan = $_POST['keterangan'];

        $tujuan = $_POST['tujuan'];
        if(!empty($_POST['tujuan'])){
            echo $tujuan;
        }
        $kota = explode("--",$tujuan)[1];
      
        
        $Provinsi = explode("--",$_POST['tujuan'])[0];
        $Kabupaten = explode("--",$_POST['tujuan'])[1];
        $Kecamatan = explode("--",$_POST['tujuan'])[2];
        $KodePos = explode("--",$_POST['tujuan'])[3];
        $service = explode("--",$_POST['tujuan'])[4];
        $ongkir = explode("--",$_POST['tujuan'])[5];
        $etd = explode("--",$_POST['tujuan'])[6];
        $KabID = explode("--",$_POST['tujuan'])[7];
        $KecID = explode("--",$_POST['tujuan'])[8];



        $datainvoice = $sqlinvoice->fetch_assoc();
        $akhirinvoice = mysqli_num_rows($sqlinvoice) + 1;
        $no_inv = $akhirinvoice . $datainvoice['id'];
        

        $pembeli = str_replace("'", " ", htmlspecialchars($_POST['jen'] . $_POST['pembeli'] . " - " . $_POST['kurir']));
        $no_hp = htmlspecialchars(preg_replace('/[^0-9]/', '', str_replace('+62', '', ltrim($_POST['no_hp'], '0'))));
        $alamat = str_replace("'", " ", htmlspecialchars($_POST['alamat']));
        $jenis = $_POST['jenis'];

        $pesanan = $_POST['pesanan'];

        $array = explode("#", $pesanan);

        $jumlaharray = count(explode("#", $pesanan));

        $data_produk = [];
        $array_berat = [];
        $array_total = [];
        $array_jumlah = [];

        if($_POST['jen']=="COD"){
        $pembayaran = $_POST['jen'];}
        else {
            $pembayaran = "NON COD";
        }
        $kurir = $_POST['kurir'];


        for ($x = 2; $x <= $jumlaharray; $x += 3) {
            if (explode("#", $pesanan)[$x + 1] != 0) {
                $produk = explode("#", $pesanan)[$x];
                $jumlah = explode("#", $pesanan)[$x + 1];

                array_push($data_produk,$produk);
                array_push($array_jumlah,$jumlah);

           
                

                if ($jenis == "ecer") {
                    $sqlsatuan = $koneksi->query("select * from tb_barang where nama_barang='$produk' ");
                    $datasatuan = $sqlsatuan->fetch_assoc();
                    $satuan = $datasatuan['harga_ecer'];
                    $hpp = $datasatuan['harga_beli'];

                    $untung = ($datasatuan['harga_ecer']-$datasatuan['harga_beli']);

                    $berat = $datasatuan['berat'];
                    array_push($array_berat,$berat);
                    array_push($array_total,$satuan*$jumlah);

                                  

                    $sql12 = $koneksi->query("
            insert into sales (
                no_inv,
                tgl_kirim,
                pelanggan,
                produk,
                status_bayar,
                jumlah,
                j_harga,
                satuan,
                packing,
                akun,
                request_packing,
                estimasi,
                no_hp,
                alamat,
                keterangan,
                kabupaten,
                kota,
                kecamatan,
                kode_pos,
                pembayaran,
                kurir,
                kabid,
                kecid,
                ongkir_real,
                provinsi,
                profit

                )values(
                '$no_inv',
                '$tgl_kirim',
                upper('$pembeli'),
                '$produk',
                'LUNAS',
                '$jumlah',
                '$jenis',
                '$satuan',
                '123',
                '123',
                'N',
                '$estimasi',
                '$no_hp',
                '$alamat',
                '$keterangan',
                '$Kabupaten',
                '$kota',
                '$Kecamatan',
                '$KodePos',
                '$pembayaran',
                '$kurir',
                '$KabID',
                '$KecID',
                '$ongkir',
                '$Provinsi',
                '$untung'
                    
                    )");

        

                } elseif ($jenis == "reseller") {
                    $sqlsatuan = $koneksi->query("select * from tb_barang where nama_barang='$produk' ");
                    $datasatuan = $sqlsatuan->fetch_assoc();
                    $satuan = $datasatuan['h_reseller'];
                    $hpp = $datasatuan['harga_beli'];

                    $untung = ($datasatuan['h_reseller']-$datasatuan['harga_beli']);

                    
                    $berat = $datasatuan['berat'];
                    array_push($array_berat,$berat);
                    array_push($array_total,$satuan*$jumlah);

   
                    $sql12 = $koneksi->query("
                insert into sales (
                    no_inv,
                    tgl_kirim,
                    pelanggan,
                    produk,
                    status_bayar,
                    jumlah,
                    j_harga,
                    satuan,
                    packing,
                    akun,
                    request_packing,
                    estimasi,
                    no_hp,
                    alamat,
                    keterangan,
                    kabupaten,
                    kota,
                    kecamatan,
                    kode_pos,
                        pembayaran,
                        kurir,
                kabid,
                kecid,
                ongkir_real,
                provinsi,
                profit
                        

                    )values(
                    '$no_inv',
                    '$tgl_kirim',
                    upper('$pembeli'),
                    '$produk',
                    'LUNAS',
                    '$jumlah',
                    '$jenis',
                    '$satuan',
                    '123',
                    '123',
                    'N',
                    '$estimasi',
                    '$no_hp',
                    '$alamat',
                    '$keterangan',
                '$Kabupaten',
                '$kota',
                '$Kecamatan',
                '$KodePos',
                '$pembayaran',
                '$kurir',
                '$KabID',
                '$KecID',
                '$ongkir',
                '$Provinsi',
                '$untung'


                        
                        )");

                  

                } else {
                    $sqlsatuan = $koneksi->query("select * from tb_barang where nama_barang='$produk' ");
                    $datasatuan = $sqlsatuan->fetch_assoc();
                    $satuan = $datasatuan['harga_jual'];
                    $hpp = $datasatuan['harga_beli'];

                    $untung = ($datasatuan['harga_jual']-$datasatuan['harga_beli']);


                    $berat = $datasatuan['berat'];
                    array_push($array_berat,$berat);
                    array_push($array_total,$satuan*$jumlah);

     
                    $sql12 = $koneksi->query("
                    insert into sales (
                        no_inv,
                        tgl_kirim,
                        pelanggan,
                        produk,
                        status_bayar,
                        jumlah,
                        j_harga,
                        satuan,
                        packing,
                        akun,
                        request_packing,
                        estimasi,
                        no_hp,
                        alamat,
                        keterangan,
                        kabupaten,
                        kota,
                        kecamatan,
                        kode_pos,
                        pembayaran,
                        kurir,
                        kabid,
                        kecid,
                        ongkir_real,
                        provinsi,
                        profit

                        )values(
                        '$no_inv',
                        '$tgl_kirim',
                        upper('$pembeli'),
                        '$produk',
                        'LUNAS',
                        '$jumlah',
                        '$jenis',
                        '$satuan',
                        '123',
                        '123',
                        'N',
                        '$estimasi',
                        '$no_hp',
                        '$alamat',
                        '$keterangan',
                '$Kabupaten',
                '$kota',
                '$Kecamatan',
                '$KodePos',
                '$pembayaran',
                '$kurir',
                '$KabID',
                '$KecID',
                '$ongkir',
                '$Provinsi',
                                '$untung'

                            
                            )");

                   

                }
                echo explode("#", $pesanan)[$x];
                echo " = ";
                echo explode("#", $pesanan)[$x + 1];
                echo "<br>";
            } ?>
    <script>
    // alert("Data berhasil diupload!");
    window.location.href = "https://ciwideyfood.com/barokah/penjualan/data_penjualan.php?alert=<?= $pembeli.'%20Berhasil%20Diupload!'; ?>";
    </script>
    <?php
        $hasil_berat = array_sum($array_berat);
        $hasil_total = array_sum($array_total);
        $hasil_jumlah = array_sum($array_jumlah);

       $hasil_produks = implode(",",$data_produk);
        $sql_produks = $koneksi->query("
        update sales set
            produks = '$hasil_produks',
            nilai_barang = '$hasil_total',
            berat = '$hasil_berat',
            jumlah_item = '$hasil_jumlah'
        where no_inv ='$no_inv'
        ");
        }
   
    }
    ?>

    <!-- for($x=2;$x<=$jumlah;$x+=3){
        
        if(explode("#",$pesanan)[$x+1] != 0){
            echo explode("#",$pesanan)[$x];
            echo " = ";
            echo explode("#",$pesanan)[$x+1];
            echo "<br>";
        }
     } -->



    </div>

    <!-- CEK HARGA -->
    <?php
    if (isset($_POST['cek'])) {
        $tgl_kirim = $_POST['tgl_kirim'];
        $estimasi = $_POST['estimasi'];
        $datainvoice = $sqlinvoice->fetch_assoc();
        $akhirinvoice = mysqli_num_rows($sqlinvoice) + 1;
        $no_inv = $akhirinvoice . $datainvoice['id'];

        $pembeli = str_replace("'", " ", htmlspecialchars($_POST['jen'] . $_POST['pembeli'] . " - " . $_POST['kurir']));
        $no_hp = htmlspecialchars(preg_replace('/[^0-9]/', '', str_replace('+62', '', ltrim($_POST['no_hp'], '0'))));
        $alamat = str_replace("'", " ", htmlspecialchars($_POST['alamat']));
        $jenis = htmlspecialchars($_POST['jenis']);

        $pesanan = $_POST['pesanan'];

        $array = explode("#", $pesanan);

        $jumlaharray = count(explode("#", $pesanan));

        $cekharga = [];
        $cektotal = [];


        $cekjumlah = [];
        $ceksatuan = [];

        for ($x = 2; $x <= $jumlaharray; $x += 3) {
            if (explode("#", $pesanan)[$x + 1] != 0) {
                $produk = explode("#", $pesanan)[$x];
                $jumlah = explode("#", $pesanan)[($x + 1)];


                if ($jenis == "ecer") {
                    $sqlsatuan = $koneksi->query("select * from tb_barang where nama_barang='$produk'");
                    $datasatuan = $sqlsatuan->fetch_assoc();
                    $satuan = $datasatuan['harga_ecer'];

                    array_push($cekharga, $produk);
                    array_push($ceksatuan, $satuan);
                    array_push($cekjumlah, ($jumlah * $satuan) / $satuan);
                    array_push($cektotal, $satuan * $jumlah);
                } elseif ($jenis == "reseller") {
                    $sqlsatuan = $koneksi->query("select * from tb_barang where nama_barang='$produk'");
                    $datasatuan = $sqlsatuan->fetch_assoc();
                    $satuan = $datasatuan['h_reseller'];

                    array_push($cekharga, $produk);
                    array_push($ceksatuan, $satuan);
                    array_push($cekjumlah, ($jumlah * $satuan) / $satuan);
                    array_push($cektotal, $satuan * $jumlah);
                } else {
                    $sqlsatuan = $koneksi->query("select * from tb_barang where nama_barang='$produk'");
                    $datasatuan = $sqlsatuan->fetch_assoc();
                    $satuan = $datasatuan['harga_jual'];

                    array_push($cekharga, $produk);
                    array_push($ceksatuan, $satuan);
                    array_push($cekjumlah, ($jumlah * $satuan) / $satuan);
                    array_push($cektotal, $satuan * $jumlah);


                    echo explode("#", $pesanan)[$x];
                    echo " = ";
                    echo explode("#", $pesanan)[$x + 1];
                    echo "<br>";
                }
            }
        }
        $arrlength = count($cekharga);
        $total = array_sum($cektotal);
    ?>
    <script>
    window.location =
        "https://wa.me/62<?= $no_hp ?>?text=Cek%20Harga%20<?= $jenis ?>%20untuk%20<?= $no_hp ?>%0A%0A<?php for ($y = 0; $y < $arrlength; $y++) {
         echo ($y + 1) . '. ' . ' ' . $cekharga[$y] . ' ' . number_format($ceksatuan[$y]) . ' x ' . $cekjumlah[$y] . ' = ' . number_format($cekjumlah[$y] * $ceksatuan[$y]) . '%0a';
        } ?><?= '%0a*Total%20=%20Rp.' . number_format($total) . '*' ?>"
    </script>
    <?php
    }
    ?>
    <!-- CEK HARGA -->



    <script>
               

                const cek = document.querySelector("button[id='cek']");
                cek.addEventListener('click', async () => {
                    try {
                        const text1 = await navigator.clipboard.readText()
                        document.querySelector("input[name='pembeli']").value += text1;
                        document.querySelector("input[name='no_hp']").value += text1;
                        document.querySelector("input[name='alamat']").value += "tes";
                        document.querySelector("input[name='estimasi']").value += "tes";
                        document.querySelector("input[name='kurir']").value += "tes";
                        var field = document.createElement('input');
                        field.setAttribute('type', 'text');
                        document.body.appendChild(field);
                        
                        setTimeout(function() {
                            field.focus();
                            setTimeout(function() {
                                field.setAttribute('style', 'display:none;');
                            }, 50);
                        }, 50);

                    } catch (error) {
                        console.log('Failed to read clipboard');
                    }
                });






                const idbutton1 = document.querySelector("button[id='idbutton']");
                idbutton1.addEventListener('click', async () => {
                    try {
                        const text = 'ID'
                        document.querySelector("input[id='kur']").value = text;
                        
                    } catch (error) {
                        console.log('Failed to read clipboard');
                    }
                });

                const idbutton2 = document.querySelector("button[id='paxelbutton']");
                idbutton2.addEventListener('click', async () => {
                    try {
                        const text = 'POS'
                        document.querySelector("input[id='kur']").value = text;
                       
                    } catch (error) {
                        console.log('Failed to read clipboard');
                    }
                });

                const idbutton3 = document.querySelector("button[id='lionbutton']");
                idbutton3.addEventListener('click', async () => {
                    try {
                        const text = 'LION'
                        document.querySelector("input[id='kur']").value = text;
                        
                    } catch (error) {
                        console.log('Failed to read clipboard');
                    }
                });



                const pasteButton1 = document.querySelector("button[id='pastepembeli']");

                pasteButton1.addEventListener('click', async () => {
                    try {
                        const text = await navigator.clipboard.readText()
                        document.querySelector("input[name='pembeli']").value += text;
                        
                        console.log('Text pasted.');
                    } catch (error) {
                    }
                });

                const pasteButton2 = document.querySelector("button[id='pasteno_hp']");

                pasteButton2.addEventListener('click', async () => {
                    try {
                        const text = await navigator.clipboard.readText()
                        document.querySelector("input[name='no_hp']").value += text;
                        
                        console.log('Text pasted.');
                    } catch (error) {
                    }
                });

                const pasteButton3 = document.querySelector("button[id='pastealamat']");

                pasteButton3.addEventListener('click', async () => {
                    try {
                        const text = await navigator.clipboard.readText()
                        document.querySelector("input[name='alamat']").value += text;
                       
                        console.log('Text pasted.');
                    } catch (error) {
                        console.log('Failed to read clipboard');
                    }
                });
                </script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>

