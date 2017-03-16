<?php
	mysql_connect("localhost","root","");
	mysql_select_db("cv_levin");
	switch ($_GET['action']) {
		case 'autofield':
			$a = mysql_query("select * from sparepart where merk='$_GET[merk]' and nama_sparepart='$_GET[ket]'");
			$b = mysql_fetch_assoc($a);

			$field["tipe"] = $b['tahun'];
			$field["stok"] = $b['stok'];
			echo json_encode($field);	
			break;

		default:
			# code...
			break;
	}
	
?>