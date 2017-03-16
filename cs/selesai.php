<?php
include "../sesi.php";
$jasa = $_GET['jasa'];
$montir = $_GET['montir'];
$tgl_selesai = date('Y-m-d');
$jam_selesai = date('H:i:s');

$rmontir = mysql_fetch_array(mysql_query("SELECT banyak_mobil from montir where id_montir = $montir"));
$bperbaikan = $rmontir['banyak_mobil']+1;
mysql_query("UPDATE montir SET banyak_mobil = $bperbaikan where id_montir = $montir");
$qinsertpelunasan = "UPDATE perbaikan SET status = 'sudah',tgl_selesai = '$tgl_selesai',jam_selesai = '$jam_selesai' WHERE id_jasa = $jasa";
$result=mysql_query($qinsertpelunasan);


if($result) {
?>
<script>
	window.location="sudah-perbaikan.php";
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
