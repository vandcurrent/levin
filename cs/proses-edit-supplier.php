<?php
include "../sesi.php";

$id_supplier=$_POST['id_supplier'];
$nama_supplier=$_POST['nama_supplier'];
$alamat_supplier=$_POST['alamat_supplier'];
$telpon_supplier=$_POST['telpon_supplier'];
$email_supplier=$_POST['email_supplier'];



$query = "UPDATE supplier set nama_supplier='$nama_supplier', alamat_supplier='$alamat_supplier', telpon_supplier='$telpon_supplier', email_supplier='$email_supplier' where id_supplier='$id_supplier'";
$eksekusi=mysql_query($query);

if($eksekusi) {
?>

<script>
	alert("Berhasil mengupdate data supplier");
	window.location="data-supplier.php";
</script>
<?php
}else{
?>
<script>
	alert("Gagal mengupdate data supplier");
	window.location="uabah-supplier.php";
</script>
<?php
}
?>
