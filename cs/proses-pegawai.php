<?php
include "../sesi.php";

$id_pegawai=$_POST['id_pegawai'];
$nama_pegawai=$_POST['nama_pegawai'];
$alamat_pegawai=$_POST['alamat_pegawai'];
$telpon_pegawai=$_POST['telpon_pegawai'];
$username=$_POST['username'];
$password=$_POST['password'];
$level=$_POST['level'];
$status=$_POST['status'];

$result = mysql_query("INSERT INTO pegawai values (
	'$id_pegawai',
	'$nama_pegawai',
	'$alamat_pegawai',
	'$telpon_pegawai',
	'$username',
	'$password',
	'$level',
	'$status'
)");

if($result) {
?>
<script>
	alert("Berhasil menyimpan data pegawai baru");
	window.location="data-pegawai.php";
</script>
<?php
}else{
?>
<script>
	alert("Gagal menyimpan data");
	window.location="tambah-pegawai.php";
</script>
<?php
}
?>
?>
