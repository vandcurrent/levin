<?php
include "../sesi.php";

$id_supplier=$_POST["id_supplier"];
$nama_supplier=$_POST["nama_supplier"];
$alamat_supplier=$_POST["alamat_supplier"];
$telpon_supplier=$_POST["telpon_supplier"];
$email_supplier=$_POST["email_supplier"];


//3.insert SQL Data
$sqlinsert = "INSERT INTO supplier(id_supplier, nama_supplier, alamat_supplier, telpon_supplier, email_supplier)
	VALUES ('$id_supplier','$nama_supplier','$alamat_supplier','$telpon_supplier','$email_supplier')";
$result = mysql_query($sqlinsert);

if($result){
header("location:data-supplier.php");
?>
<?php
}else{
header("location:tambah-supplier.php");
}
?>
