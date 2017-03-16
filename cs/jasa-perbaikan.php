<?php
include "../sesi.php";
$jasa = $_GET['jasa'];

foreach ($_POST as $k => $v){
  if ($k=='id_data') {
    $id_data=$v;
  }elseif ($k=='keterangan') {
    $keterangan= $v;
  }elseif ($k=='jenis') {
    $jenis=$v;
  }elseif($k=='merk'){
    $merk=$v;
  }elseif ($k=='q') {
    $q = $v;
  }elseif($k=='harga'){
    $harga=$v;
  }elseif($k=='jumlah'){
	  $jumlah=$v;
  }elseif ($k=='tipe') {
    $tipe=$v;
  }
}
$subtotal = $_POST['subtotal'];
$ppn = $_POST['ppn'];
$total = $_POST['total'];
$nonot = $_POST['id_nota'];

if (count($id_data) <= count($keterangan)) {
  $ranger = count($keterangan)-1;
}else {
  $ranger = count($id_data)-1;
}


for ($x = 0; $x <= $ranger; $x++) {
  if ($id_data[$x]!=null) {
    if (!$keterangan[$x]){
      mysql_query("DELETE FROM data_nota WHERE id_data = $id_data[$x]") or die(mysql_error());
      // echo "$x - Delete<br>";
    }else{
      mysql_query("UPDATE data_nota SET nama_barang = '$keterangan[$x]', jenis = '$jenis[$x]', merk = '$merk[$x]',  harga = '$harga[$x]', kwantitas = '$q[$x]', total = '$jumlah[$x]', tipe = '$tipe[$x]' WHERE id_data = $id_data[$x]") or die(mysql_error());

      // echo "$x - Update<br>";
    }
  }else {
    mysql_query("INSERT INTO data_nota VALUES ('','$nonot','$keterangan[$x]','$jenis[$x]','$merk[$x]','$harga[$x]','$q[$x]','$jumlah[$x]','$tipe[$x]')") or die(mysql_error());
    // echo "$x - Insert<br>";
  }

  //TO JURNAL
  
}

$rsparepart = mysql_fetch_array(mysql_query("SELECT IF( EXISTS(SELECT * FROM data_nota WHERE jenis!='jasa' AND id_nota = $nonot), 1, 0) as sparepart"));
$sparepart = $rsparepart['sparepart'];

if ($sparepart == 1){
  mysql_query("UPDATE perbaikan SET sparepart = 'ganti' WHERE id_jasa = '$jasa'");
}else {
  mysql_query("UPDATE perbaikan SET sparepart = 'tidak' WHERE id_jasa = '$jasa'");
}

header('location:sedang-perbaikan.php');

?>
