<?php
include "../sesi.php";
?>

<?php

$id_pegawai=$_POST['id_pegawai'];
$nama_pegawai=$_POST['nama_pegawai'];
$alamat_pegawai=$_POST['alamat_pegawai'];
$telpon_pegawai=$_POST['telpon_pegawai'];


$query = "UPDATE pegawai set nama_pegawai='$nama_pegawai', alamat_pegawai='$alamat_pegawai', telpon_pegawai='$telpon_pegawai' where id_pegawai='$id_pegawai'";
$eksekusi=mysql_query($query) or die(mysql_error());

if($eksekusi) {
?>

<script>
	alert("Berhasil mengupdate data pegawai");
	window.location="data-pegawai.php";
</script>
<?php
}else{
?>
<script>
	alert("Gagal mengupdate data pegawai");
	window.location="ubah-pegawai.php";
</script>
<?php
}
?>
