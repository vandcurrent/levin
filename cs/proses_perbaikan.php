<?php
include "../sesi.php";

$nama_montir="'".$_POST['montir']."'";
$sqlselect="SELECT id_montir FROM montir WHERE nama_montir LIKE $nama_montir";
$hasil=mysql_fetch_array(mysql_query($sqlselect));
$id_montir = $hasil['id_montir'];
$tanggal = date("Y-m-d", strtotime($_POST['tanggal']));
$no_polisi = $_POST['no_polisi'];
$kerusakan = $_POST['kerusakan'];
$status = $_POST['status'];
$no_polisi = $_POST['no_polisi'];

if (isset($_POST['sparepart'])) {
  $sparepart = $_POST['sparepart'];
  $id_sp = $_POST['id_sparepart'];
  $jenis_sp = $_POST['jenis'];
  $nama_sp = $_POST['nama_sparepart'];
  $merk_sp = $_POST['merk'];
  $stok_sp = $_POST['stok'];
  $harga_sp = $_POST['harga'];
  $banyak_sp = $_POST['banyaknya'];
  $jumlah_sp = $_POST['jumlah'];

  $id_supplier = "'".$id_sp."'";
  $ambilstok=mysql_fetch_array(mysql_query("SELECT stok FROM sparepart WHERE id_sparepart LIKE $id_supplier"));
  $saldo = $ambilstok['stok']-$banyak_sp;

	$ambilidstok = mysql_fetch_array(mysql_query("SELECT * FROM stok"));
	$id_stok=$ambilidstok['id_stok']+1;

  mysql_query("INSERT INTO stok VALUES ('$id_stok','$id_sp','$tanggal','','0','$banyak_sp','$saldo')");

  mysql_query("UPDATE sparepart SET stok = '$saldo' WHERE id_sparepart = $id_supplier") or die(mysql_error());
}else {
  $sparepart = 'tidak';
  $id_stok = 0;
}

$sqlinsert = "INSERT INTO perbaikan VALUES ('','$tanggal','$no_polisi','$id_montir','$kerusakan','$status','$sparepart','$id_stok')";
$result = mysql_query($sqlinsert);

if($result) {
?>
<script>
  alert("Berhasil mengupdate data perbaikan");
	window.location="belum-perbaikan.php";
</script>
<?php
}else{
?>
<script>
  alert("Gagal mengupdate data");
	window.location="tambah-kendaraan.php";
</script>

<?php
}
?>

?>
