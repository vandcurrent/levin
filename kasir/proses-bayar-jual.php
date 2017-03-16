<?php
include "../sesi.php";
$jasa = $_POST['jasa'];
$bayar = $_POST['bayar'];
$total = $_POST['total'];
$tanggal = date('Y-m-d');
$sisa = $_POST['sisa'];

//nganjuk
if($bayar < $total) {
	$sql = mysql_query("SELECT bayar FROM penjualan WHERE no_nota = $jasa") or die (mysql_error());
	$row = mysql_fetch_row($sql);
	$bayarx = $row[0] + $bayar;
	$fsisa = $bayar - $sisa;
	// echo $row[0]."+";
	// echo $bayar."=";
	// echo $bayarx;

	mysql_query("UPDATE penjualan SET bayar=$bayarx WHERE no_nota = $jasa") or die(mysql_error());

	//TO JURNAL
	mysql_query("INSERT INTO jurnal VALUES ('','$tanggal', '100', 'dr', '$fsisa')") or die(mysql_error());//kas
  	mysql_query("INSERT INTO jurnal VALUES ('','$tanggal', '110', 'cr', '$fsisa')") or die(mysql_error());//piutang


?>
<script>
	alert("Uang Bayar Kurang Dari Total Yang Harus Di Lunasi, Maka Pembayaran Secara KASBON (DP)");
	window.location="belum-lunas-jual.php";
</script>
<?php
}
//LUNAS
elseif ($bayar >= $total){
  $qinsertpelunasan = "UPDATE nota SET tgl_lunas = '$tanggal' WHERE id_transaksi = $jasa";
  mysql_query($qinsertpelunasan) or die(mysql_error());
  $qinsertperbaikan = "UPDATE penjualan SET status = 'lunas', sisa = '0', tanggal_lunas='$tanggal' WHERE no_nota = $jasa";
  mysql_query($qinsertperbaikan) or die(mysql_error());

  //TO JURNAL
  mysql_query("INSERT INTO jurnal VALUES ('','$tanggal', '100', 'dr', '$bayar')") or die(mysql_error());//kas
  mysql_query("INSERT INTO jurnal VALUES ('','$tanggal', '110', 'cr', '$bayar')") or die(mysql_error());//piutang

?>
<script>
	var kembalian = <?=$bayar-$total?>;
	alert("Perbaikan Berhasil Dilunasi, Kembalian Pembayaran Pelanggan= Rp."+kembalian);
	window.location="lunas-jual.php";
</script>

<?php
}
?>
