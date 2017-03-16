<?php
include "../sesi.php";

$id_montir=$_GET["id_montir"];

$delete="delete from montir where id_montir='$id_montir'";
$eksekusi=mysql_query($delete);

if ($eksekusi) {
?>

<script>
	alert("Berhasil menghapus data montir");
	window.location="data-montir.php";
</script>
<?php
}else{
?>
<script>
	alert("Gagal menghapus data montir");
	window.location="data-montir.php";
</script>
<?php
}
?>
