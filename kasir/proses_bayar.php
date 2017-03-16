<?php
include "../sesi.php";
$jasa = $_POST['jasa'];
$bayar = $_POST['bayar'];
$total = $_POST['total'];
$tanggal = date('Y-m-d');
$tipe = $_POST['tipe'];
$row = $_POST['row'];
$atotal = $_POST['atotal'];
$jenis = $_POST['jenis'];
$merk = $_POST['merk'];
$ppn = $_POST['ppn'];
$dp = $_POST['dp'];
$nama = $_POST['keterangan'];
$q = $_POST['q'];
$harga = $_POST['harga'];
$sisa = $_POST['sisa'];
$fsisa = $sisa - $bayar;
 
// NGANJUK
if($bayar < $total) {
	$sql = mysql_query("SELECT dp FROM perbaikan WHERE id_jasa = $jasa") or die (mysql_error());
	$row1 = mysql_fetch_row($sql);
	$bayarx = $row1[0] + $bayar;
	mysql_query("UPDATE perbaikan SET dp=$bayarx WHERE id_jasa = $jasa") or die(mysql_error());

	for($i = 0; $i < $row; $i++)
	  {
	  	//echo $nama[$i];
	  	//echo $tipe[$i];
	  	$setok = mysql_query("SELECT stok FROM sparepart WHERE jenis_sparepart = '$jenis[$i]' AND nama_sparepart = '$nama[$i]' AND merk='$merk[$i]'") or die(mysql_error());
		$stok = mysql_fetch_array($setok);
		$tstok = $stok[0] - $q[$i];
		mysql_query("UPDATE sparepart SET stok = '$tstok' WHERE jenis_sparepart = '$jenis[$i]' AND nama_sparepart = '$nama[$i]' AND merk='$merk[$i]'") or die(mysql_error());

	  	$s = mysql_query("SELECT MIN(id_sparepart) FROM sparepart WHERE merk='$merk[$i]' AND jenis_sparepart='$jenis[$i]'") or die(mysql_error());
	    $id_sparepart= mysql_fetch_array($s);

		$h = mysql_query("SELECT MAX(id_sparepart), hpp FROM hpp WHERE id_sparepart='$id_sparepart[0]'") or die(mysql_error());
	    $hpp = mysql_fetch_assoc($h);
	    $nhpp = $hpp['hpp'];
// echo dp;
	    if ($dp == 0){
		  	if($tipe[$i] == "penjualan")
		  	{
		  		mysql_query("INSERT INTO stok VALUES ('','$id_sparepart[0]', '$tanggal', '', '$q[$i]', '$harga[$i]', '$atotal[$i]', '$q[$i]', '$harga[$i]', '$atotal[$i]', '$tipe[$i]')") or die(mysql_error());

				mysql_query("INSERT INTO jurnal VALUES ('','$tanggal', '400', 'cr', '$atotal[$i]')") or die(mysql_error());//penjualan
				mysql_query("INSERT INTO jurnal VALUES ('','$tanggal', '120', 'cr', '$nhpp')") or die(mysql_error());//persediaan
				mysql_query("INSERT INTO jurnal VALUES ('','$tanggal', '500', 'dr', '$nhpp')") or die(mysql_error());//hpp
				// echo "dp 0";
		  	}
		  	elseif ($tipe[$i] == "pendapatan") {
		  		mysql_query("INSERT INTO jurnal VALUES ('','$tanggal', '410', 'cr', '$atotal[$i]')") or die(mysql_error());//pendapatan jasa
		  	}
	  	}
	  }
	  if (dp == 0)
	  {
	  	mysql_query("INSERT INTO jurnal VALUES ('','$tanggal', '250', 'cr', '$ppn')") or die(mysql_error());//ppn	  	
	  }
	  	//$piutang = $total - $bayar;
		mysql_query("INSERT INTO jurnal VALUES ('','$tanggal', '100', 'dr', '$bayar')") or die(mysql_error());//kas
		mysql_query("INSERT INTO jurnal VALUES ('','$tanggal', '110', 'dr', '$fsisa')") or die(mysql_error());//piutang dagang
?>
<script>
	alert("Uang Bayar Kurang Dari Total Yang Harus Di Lunasi, Maka Pembayaran Secara KASBON (DP)");
	window.location="belum-lunas.php";
</script>
<?php
}
//KES
elseif ($bayar >= $total && $dp == 0){

	$qinsertpelunasan = "UPDATE nota SET tgl_lunas = '$tanggal' WHERE id_transaksi = $jasa";
	mysql_query($qinsertpelunasan) or die(mysql_error());
	$qinsertperbaikan = "UPDATE perbaikan SET pembayaran = 'lunas', dp = '0' WHERE id_jasa = $jasa";
	mysql_query($qinsertperbaikan);
	//echo $row;
	for($i = 0; $i < $row; $i++)
	{
		$setok = mysql_query("SELECT stok FROM sparepart WHERE jenis_sparepart = '$jenis[$i]' AND nama_sparepart = '$nama[$i]' AND merk='$merk[$i]'") or die(mysql_error());
		$stok = mysql_fetch_array($setok);
		// echo $q[$i];
		$tstok = $stok[0] - $q[$i];
		mysql_query("UPDATE sparepart SET stok = '$tstok' WHERE jenis_sparepart = '$jenis[$i]' AND nama_sparepart = '$nama[$i]' AND merk='$merk[$i]'") or die(mysql_error());

		//echo " #".$i;
		$s = mysql_query("SELECT MIN(id_sparepart) FROM sparepart WHERE merk='$merk[$i]' AND jenis_sparepart='$jenis[$i]'") or die(mysql_error());
		$id_sparepart= mysql_fetch_array($s);

		$h = mysql_query("SELECT MAX(id_sparepart), hpp FROM hpp WHERE id_sparepart='$id_sparepart[0]'") or die(mysql_error());
		$hpp = mysql_fetch_assoc($h);
		$nhpp = $hpp['hpp'];
		// echo $jenis[0];

		if($tipe[$i] == "penjualan")
		{

		mysql_query("INSERT INTO stok VALUES ('','$id_sparepart[0]', '$tanggal', '', '$q[$i]', '$harga[$i]', '$atotal[$i]', '$q[$i]', '$harga[$i]', '$atotal[$i]', '$tipe[$i]')") or die(mysql_error());

		mysql_query("INSERT INTO jurnal VALUES ('','$tanggal', '400', 'cr', '$atotal[$i]')") or die(mysql_error());//penjualan
		mysql_query("INSERT INTO jurnal VALUES ('','$tanggal', '120', 'cr', '$nhpp')") or die(mysql_error());//persediaan
		mysql_query("INSERT INTO jurnal VALUES ('','$tanggal', '500', 'dr', '$nhpp')") or die(mysql_error());//hpp
		}
		elseif ($tipe[$i] == "pendapatan") {
			mysql_query("INSERT INTO jurnal VALUES ('','$tanggal', '410', 'cr', '$atotal[$i]')") or die(mysql_error());//pendapatan jasa
		}
	}
	mysql_query("INSERT INTO jurnal VALUES ('','$tanggal', '100', 'dr', '$bayar')") or die(mysql_error());//kas
	mysql_query("INSERT INTO jurnal VALUES ('','$tanggal', '250', 'cr', '$ppn')") or die(mysql_error());//ppn
?>
<script>
	var kembalian = <?=$bayar-$total?>;
	alert("Perbaikan Berhasil Dilunasi, Kembalian Pembayaran Pelanggan= Rp."+kembalian);
	window.location="lunas.php";
</script>
<?php
}
//LUNAS ABIS NGANJUK
elseif ($bayar >= $total && $dp != 0){

	$qinsertpelunasan = "UPDATE nota SET tgl_lunas = '$tanggal' WHERE id_transaksi = $jasa";
	mysql_query($qinsertpelunasan) or die(mysql_error());
	$qinsertperbaikan = "UPDATE perbaikan SET pembayaran = 'lunas', dp = '0' WHERE id_jasa = $jasa";
	mysql_query($qinsertperbaikan);
	//echo $row;

	mysql_query("INSERT INTO jurnal VALUES ('','$tanggal', '100', 'dr', '$bayar')") or die(mysql_error());//kas
	mysql_query("INSERT INTO jurnal VALUES ('','$tanggal', '110', 'cr', '$bayar')") or die(mysql_error());//piutang
?>
<script>
	var kembalian = <?=$bayar-$total?>;
	alert("Perbaikan Berhasil Dilunasi, Kembalian Pembayaran Pelanggan= Rp."+kembalian);
	window.location="lunas.php";
</script>
<?php
}
?>