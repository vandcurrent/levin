<?php
include "/assets/koneksi.php";

error_reporting(0);

session_start();
$user_check=$_SESSION['login_user'];
$ses_sql=mysql_query("SELECT * FROM pegawai WHERE username='$user_check'");
$pegawai = mysql_fetch_array($ses_sql);
$login_session = $pegawai['username'];
if ($pegawai['level'] == 01) {
  $bagian = 'Customer Service';
}else
if ($pegawai['level'] == 02) {
  $bagian = 'Gudang';
}else
if ($pegawai['level'] == 03) {
  $bagian = 'Keuangan';
}else
if ($pegawai['level'] == 04) {
  $bagian = 'Kasir';
}else
if ($pegawai['level'] == 05) {
  $bagian = 'Pemilik';
}
if(!isset($login_session)){
mysql_close($connection);
header('Location: ../index.php');
}
?>
