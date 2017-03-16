<?php
include "../sesi.php";
$tipe=$_POST['tipe_pelanggan'];

$nama_pelanggan=$_POST['nama_pelanggan'];
$alamat_pelanggan=$_POST['alamat_pelanggan'];
$telpon_pelanggan=$_POST['telpon_pelanggan'];
$email_pelanggan=$_POST['email_pelanggan'];

$no_polisi=$_POST['no_polisi'];
$no_mesin=$_POST['no_mesin'];
$no_rangka=$_POST['no_rangka'];
$nama_kendaraan=$_POST['nama_kendaraan'];
$tipe_kendaraan=$_POST['tipe_kendaraan'];
$transmisi=$_POST['transmisi'];
$tahun=$_POST['tahun'];
$warna=$_POST['warna'];
$KM=$_POST['KM'];

$tgl_masuk=date('Y-m-d');
$jam_masuk=date('H:i:s');

if ($tipe == 'baru') {
	$id_pelanggan=intval(substr($_POST['id_pelanggan'],7));
	mysql_query("INSERT INTO pelanggan values (
		'$id_pelanggan',
		'$nama_pelanggan',
		'$alamat_pelanggan',
		'$telpon_pelanggan',
		'$email_pelanggan'
		)");
}else {
	$id_pelanggan=$_POST['id_pelanggan'];
}
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

//3.insert SQL Data
mysql_query("INSERT INTO kendaraan_pelanggan values (
	'$no_polisi',
	'$no_mesin',
	'$no_rangka',
	'$nama_kendaraan',
	'$tipe_kendaraan',
	'$transmisi',
	'$tahun',
	'$warna',
	'$KM',
	'$id_pelanggan'
	)");

mysql_query("INSERT INTO perbaikan values (
	'',
	'$tgl_masuk',
	'$jam_masuk',
	'$no_polisi',
	'',
	'belum',
	'tidak',
	'0',
	'',
	'',
	'belum',
	'0'
)");

$ridjasa = mysql_fetch_array(mysql_query("SELECT id_jasa FROM perbaikan ORDER BY id_jasa DESC"));
$id_jasa = $ridjasa['id_jasa'];
$qnota = "INSERT INTO nota values (
	'',
	'perbaikan',
	'$id_jasa',
	'$tgl_masuk',
	''
	)";
$result = mysql_query($qnota);

if($result) {
echo "<script> alert('Berhasil menyimpan data pelanggan dan kendaraan yang rusak'); window.location='belum-perbaikan.php'; </script>";
//echo "gagal";
}else{
echo "<script> alert('Gagal menyimpan data'); window.location='tambah-kendaraan.php';</script>";
	// echo $result;
	// echo "<br/>";
	// echo $qnota;
}
?>
