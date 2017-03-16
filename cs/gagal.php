<?php
include "../sesi.php";
$jasa = $_GET['jasa'];
$tgl_selesai = date('Y-m-d');
$jam_selesai = date('H:i:s');

  $qupdategagal = "UPDATE perbaikan SET status = 'gagal',tgl_selesai = '$tgl_selesai',jam_selesai = '$jam_selesai' WHERE id_jasa = $jasa";
  $result=mysql_query($qupdategagal);


if($result) {
?>
<script>
	window.location="gagal-perbaikan.php";
</script>
<?php
}else{
?>
<script>
	window.location="sedang-perbaikan.php";
</script>

<?php
}
?>
