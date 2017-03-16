<?php
include "../sesi.php";

$id = $_GET['id'];
$tanggal = date('Y-m-d');
$result = mysql_query("UPDATE nota SET tgl_lunas = '$tanggal' where id_nota = $id");

if($result) {
?>
<script>
	alert("Berhasil membayar nota pembelian Sparepart");
	window.location="lunas.php";
</script>
<?php
}else{
?>
<script>
	alert("Gagal menyimpan data");
	window.location="belum-lunas.php";
</script>
<?php
}
?>
