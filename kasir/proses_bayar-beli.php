<?php
include "../sesi.php";
$jasa = $_POST['jasa'];
$bayar = $_POST['bayar'];
$total = $_POST['total'];
$tanggal = date('Y-m-d');
//$dp = $_POST['dp'];

if($bayar < $total) {
	$sql = mysql_query("SELECT dp FROM pembelian WHERE no_nota = $jasa") or die (mysql_error());
	$row = mysql_fetch_row($sql);
	$bayarx = $row[0] + $bayar;
	mysql_query("UPDATE pembelian SET dp=$bayarx WHERE no_nota = $jasa") or die(mysql_error());


	//TO JURNAL
	mysql_query("INSERT INTO jurnal VALUES ('', '$tanggal', '100', 'cr', $bayar)"); //kas
	mysql_query("INSERT INTO jurnal VALUES ('', '$tanggal', '200', 'dr', $bayar)"); //hutang
?>
<script>
	alert("Uang Bayar Kurang Dari Total Yang Harus Di Lunasi, Maka Pembayaran Secara KASBON (DP)");
	window.location="belum-lunas.php";
</script>
<?php
}
//utang bayar lunas
else
if ($bayar >= $total){
  $qinsertpelunasan = "UPDATE nota SET tgl_lunas = $tanggal WHERE id_transaksi = $jasa";
  mysql_query($qinsertpelunasan) or die(mysql_error());
  $qinsertperbaikan = "UPDATE pembelian SET status = 'lunas', dp = '0', sisa = '0', tanggal_lunas = $tanggal WHERE no_nota = $jasa";
  mysql_query($qinsertperbaikan) or die(mysql_error());

  //TO JURNAL
	mysql_query("INSERT INTO jurnal VALUES ('', '$tanggal', '100', 'cr', $bayar)"); //kas
	mysql_query("INSERT INTO jurnal VALUES ('', '$tanggal', '200', 'dr', $bayar)"); //hutang
  
?>
<script>
	var kembalian = <?=$bayar-$total?>;
	alert("Perbaikan Berhasil Dilunasi, Kembalian Pembayaran Pelanggan= Rp."+kembalian);
	window.location="lunas-beli.php";
</script>

<?php
}
?>
