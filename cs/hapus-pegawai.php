<?php
include "../sesi.php";

$id_pegawai=$_GET["id_pegawai"];

$delete="delete from pegawai where id_pegawai='$id_pegawai'";
$eksekusi=mysql_query($delete);

if ($eksekusi) {
?>

<script>
	alert("Berhasil menghapus data pegawai");
	window.location="view_pegawai.php";
</script>
<?php
}else{
?>
<script>
	alert("Gagal menghapus data pegawai");
	window.location="view_pegawai.php";
</script>
<?php
}
?>
