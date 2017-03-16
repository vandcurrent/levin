<?php
include "/assets/koneksi.php";
session_start();
$error='Silahkan Masukan Identitas';
if (isset($_POST['submit'])) {
if (empty($_POST['username']) || empty($_POST['password'])) {
$error = "Username / Password Kosong";
}
else
{
$username=$_POST['username'];
$password=$_POST['password'];
$username = stripslashes($username);
$password = stripslashes($password);
$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);
$query = mysql_query("SELECT * FROM pegawai WHERE username='$username' AND password='$password'");
$user = mysql_fetch_array($query);
$rows = mysql_num_rows($query);
if ($rows == 1) {
$_SESSION['login_user']=$username;
$_SESSION['pass']=$password;
  if ($user['level'] == 01 ) {
    header("location: ./cs/beranda.php");
  }else
  if ($user['level'] == 02 ) {
    header("location: ./gudang/beranda.php");
  }else
  if ($user['level'] == 03 ) {
    header("location: ./keuangan/beranda.php");
  }else
  if ($user['level'] == 04 ) {
    header("location: ./kasir/beranda.php");
  }
  else
  if ($user['level'] == 05 ) {
    header("location: ./pemilik/beranda.php");
  }
}else {
$error = "Username / Password tidak valid";
}
}
mysql_close($conn);
}
?>
