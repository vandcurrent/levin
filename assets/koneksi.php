<?php

 //koneksi ke DB MySQL
 date_default_timezone_set("Asia/Jakarta");
 $host = "localhost"; $user = "root"; $password = null;

 $conn= mysql_connect($host,$user,$password);
 if($conn) {
	$mydb=mysql_select_db('cv_levin',$conn);
	//echo "koneksi berhasil";
 }else{
	//echo "error koneksi";
 }

?>
