<?php
include "../sesi.php";

$ket=$_GET['a'];
$jenis=$_GET['j'];
$nama=$_GET['k'];
$merk=$_GET['m'];

// echo $jenis ."+". $nama ."+". $merk;
if($ket == "a"){
	$h = mysql_query("SELECT hpp FROM hpp WHERE id_sparepart='$jenis' AND nama_sparepart = '$nama' AND merk = '$merk' AND id_hpp = (SELECT MAX(id_hpp) FROM hpp WHERE id_sparepart='$jenis' AND nama_sparepart = '$nama' AND merk = '$merk')");
    $rharga = mysql_fetch_array($h);
    $harga = $rharga['hpp'];
    echo $harga;
}
else if ($ket == "b"){
	$rharga = mysql_fetch_array(mysql_query("SELECT stok FROM sparepart Where jenis_sparepart = '$jenis' and nama_sparepart = '$nama' and merk = '$merk'"));
	$harga = $rharga['stok'];
	echo $harga;
}
elseif ($ket == "c"){
	$rharga = mysql_fetch_array(mysql_query("SELECT tahun FROM sparepart Where jenis_sparepart = '$jenis' and nama_sparepart = '$nama' and merk = '$merk'"));
	$harga = $rharga['tahun'];
	echo $harga;
}
?>
