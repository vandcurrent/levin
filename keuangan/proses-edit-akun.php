<?php
include "../sesi.php";

$kode_akun=$_POST['kode_akun'];
$nama_akun=$_POST['nama_akun'];



$query = "UPDATE akun set nama_akun='$nama_akun' where kode_akun='$kode_akun'";
$eksekusi=mysql_query($query);

if($eksekusi) {
?>

<script>
	alert("Berhasil mengupdate data akun");
	window.location="data-akun.php";
</script>
<?php
}else{
?>
<script>
	alert("Gagal mengupdate data akun");
	window.location="ubah-akun.php";
</script>
<?php
}
?>
