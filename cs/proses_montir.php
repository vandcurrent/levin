<?php
include "../sesi.php";

?>

<?php
$id_montir=intval(substr($_POST['id_montir'],4,11));
$nama_montir=$_POST["nama_montir"];
$alamat_montir=$_POST["alamat_montir"];
$telpon_montir=$_POST["telpon_montir"];
//$banyak_mobil=$_POST["banyak_mobil"];


//3.insert SQL Data
$sqlinsert = "INSERT INTO montir(id_montir, nama_montir, alamat_montir, telpon_montir, banyak_mobil)
	VALUES ('','$nama_montir','$alamat_montir','$telpon_montir','')";
$result = mysql_query($sqlinsert) or die(mysql_error());

if($result){
header("location:data-montir.php");

?>
<?php
}else{
header("location:tambah-montir.php");
}

?>
