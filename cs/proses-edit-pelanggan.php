<?php
include "../sesi.php";
?>

<?php

$id=$_POST['id'];
$nama=$_POST['nama'];
$alamat=$_POST['alamat'];
$telpon=$_POST['telpon_'];
$email=$_POST['email'];
// echo $id;

$query = "UPDATE pelanggan set nama_pelanggan='$nama', alamat_pelanggan='$alamat', telpon_pelanggan='$telpon', email_pelanggan = '$email' where id_pelanggan='$id'";
$eksekusi=mysql_query($query) or die(mysql_error());

if($eksekusi) {
?>

<script>
	alert("Berhasil mengupdate data pelanggan");
	window.location="data-pelanggan.php";
</script>
<?php
}else{
?>
<script>
	alert("Gagal mengupdate data pegawai");
	window.location="ubah-pelanggan.php";
</script>
<?php
}
?>
