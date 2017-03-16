<?php
include "../sesi.php";

$id_montir=$_POST['id_montir'];
$nama_montir=$_POST['nama_montir'];
$alamat_montir=$_POST['alamat_montir'];
$telpon_montir=$_POST['telpon_montir'];
$banyak_mobil=$_POST['banyak_mobil'];



$query = "UPDATE montir set nama_montir='$nama_montir', alamat_montir='$alamat_montir', telpon_montir='$telpon_montir', banyak_mobil='$banyak_mobil' where id_montir='$id_montir'";
$eksekusi=mysql_query($query);

if($eksekusi) {
?>

<script>
	alert("Berhasil mengupdate data montir");
	window.location="data-montir.php";
</script>
<?php
}else{
?>
<script>
	alert("Gagal mengupdate data montir");
	window.location="ubah-montir.php";
</script>
<?php
}
?>
