<?php
include "../sesi.php";

$jenis=$_GET['j'];
$nama=$_GET['k'];
$merk=$_GET['m'];

$rharga = mysql_fetch_array(mysql_query("SELECT harga FROM sparepart Where jenis_sparepart = '$jenis' and nama_sparepart = '$nama' and merk = '$merk'"));
$harga = $rharga['harga'];
echo $harga;
?>
