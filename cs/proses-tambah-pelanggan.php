<?php
include "../sesi.php";

$nama=$_POST['nama'];
$alamat=$_POST['alamat'];
$telpon=$_POST['telpon'];
$email=$_POST['email'];

$result = mysql_query("INSERT INTO pelanggan values (
	'',
	'$nama',
	'$alamat',
	'$telpon',
	'$email'
)") or die(mysql_error());

if($result) {
?>
<script>
	alert("Berhasil menyimpan data pelanggan baru");
	window.location="data-pelanggan.php";
</script>
<?php
}else{
?>
<script>
	alert("Gagal menyimpan data");
	window.location="tambah-pelanggan.php";
</script>
<?php
}
?>
?>
