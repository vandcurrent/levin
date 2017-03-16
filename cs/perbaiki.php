<?php
include "../sesi.php";
$montir = $_POST['montir'];
$jasa = $_POST['jasa'];
$tanggal = date('Y-m-d');
  mysql_query("INSERT INTO nota VALUES ('','perbaikan','$jasa','$tanggal','')");
  $qinsertpelunasan = "UPDATE perbaikan SET id_montir = '$montir', status = 'sedang' WHERE id_jasa = '$jasa'";
  $result=mysql_query($qinsertpelunasan);

// echo $qinsertpelunasan;
if($result) {
?>
<script>
  alert("Berhasil menyimpan data perbaikan");
	window.location="sedang-perbaikan.php";
</script>
<?php
}else{
?>
<script>
  alert("Galat menyimpan data");
	window.location="belum-perbaikan.php";
</script>

<?php
}
?>
