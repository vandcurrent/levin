<?php
include "../sesi.php";

$tanggal=$_POST['tanggal'];
$akun_cr=$_POST['akun_cr'];
$akun_dr=$_POST['akun_dr'];
//$ket=$_POST['keterangan'];
$biaya=$_POST['biaya'];

$result = mysql_query("INSERT INTO jurnal values (
	'',
	'$tanggal',
	'$akun_cr',
	'cr',
	'$biaya'
)");
$result2 = mysql_query("INSERT INTO jurnal values (
	'',
	'$tanggal',
	'$akun_dr',
	'dr',
	'$biaya'
)");

if($result && $result2) {
?>
<script>
	alert("Berhasil menyimpan data operasional");
	window.location="jurnal.php";
</script>
<?php
}else{
?>
<script>
	alert("Gagal menyimpan data");
	window.location="jurnal-umum.php";
</script>
<?php
}
?>
?>
