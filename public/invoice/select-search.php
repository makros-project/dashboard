
<?php 
include('koneksi.php');

if(!isset($_POST['searchTerm'])) {
    $select_query="select * from tb_indonesia where Kecamatan = 'Gambir'  limit 1 "; 
    $select_result=mysqli_query($koneksi, $select_query); }

// $select_query="SELECT * FROM user"; $select_result=mysqli_query($koneksi, $select_query); }
else
{ $search=$_POST['searchTerm'];
    $select_query="select * from tb_indonesia where
    Provinsi like '%".$search."%' 
    or Kabupaten like '%".$search."%' 
    or Kecamatan like '%".$search."%' 
    or KodePos like '%".$search."%' 

    limit 2";
    $select_result=mysqli_query($koneksi, $select_query);





// $data = http_request("https://sandbox-api.ptncs.com/bot/publishrate/ciwideyfooddemo/demo?origin=320438&destination='$desti'&weight=1
// ");
// $data = json_decode($data, TRUE); 

}
$data=array();

function http_request($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

while($select_data=mysqli_fetch_array($select_result)) {




    $get_kecamatan_id = http_request("https://sandbox-api.ptncs.com/bot/getkecid/ciwideyfooddemo/demo?provinsi=".str_replace(" ","%20",$select_data['Provinsi'])."&kabupaten=".str_replace(" ","%20",$select_data['Kabupaten'])."&kecamatan=".str_replace(" ","%20",$select_data['Kecamatan']));

    $get_kecamatan_id = json_decode($get_kecamatan_id, TRUE);

    $get_ongkir = http_request("https://sandbox-api.ptncs.com/bot/publishrate/ciwideyfooddemo/demo?origin=327322&destination=".$get_kecamatan_id['data'][0]['KecID']."&weight=1");
    $get_ongkir = json_decode($get_ongkir, TRUE);
foreach($get_ongkir['data'] as $get_ongkir){

$data[]=array(
"id"=>$select_data['Provinsi']."--".$select_data['Kabupaten']."--".$select_data['Kecamatan']."--".$select_data['KodePos']."--". $get_ongkir['ServiceCode']."--".($get_ongkir['TotalPrice']+1000)."--".$get_ongkir['Etd']." Hari"."--".substr($select_data['KecID'], 0, 4)."--".$select_data['KecID'],


"text"=>$select_data['Provinsi'].", ".$select_data['Kabupaten'].", ".$select_data['Kecamatan'].", ".$select_data['KodePos'].", ".$get_ongkir['ServiceCode']." TF = ".number_format($get_ongkir['TotalPrice']+1000)." ".$get_ongkir['Etd']." Hari"
);
}

// array_push($data,array("id"=>"--"."--"."--"."--". "--"."--"." "."--"."--"
// , "text"=>"Data Api.."));
}
echo json_encode($data);
?>

