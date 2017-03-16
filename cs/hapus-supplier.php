<?php
include "../sesi.php";

$id_supplier=$_GET["id_supplier"];

$delete="delete from supplier where id_supplier='$id_supplier'";
$eksekusi=mysql_query($delete);

if ($eksekusi) {
?>

<script>
	alert("Berhasil menghapus data supplier");
	window.location="data-supplier.php";
</script>
<?php
}else{
?>
<script>
	alert("Gagal menghapus data supplier");
	window.location="data-supplier.php";
</script>
<?php
}
?>
