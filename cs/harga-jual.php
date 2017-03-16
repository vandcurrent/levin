<?php
include "../sesi.php";

$jenis=$_GET['j'];
$nama=$_GET['k'];
$merk=$_GET['m'];

$rharga = mysql_fetch_array(mysql_query("SELECT harga, stok, tahun FROM sparepart Where jenis_sparepart = '$jenis' and nama_sparepart = '$nama' and merk = '$merk'"));
$harga['a'] = $rharga['harga'];
$harga['b'] = $rharga['stok'];
$harga['c'] = $rharga['tahun'];
echo json_encode($harga);
?>
