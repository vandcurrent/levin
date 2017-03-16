<?php
	mysql_connect("localhost","root","");
	mysql_select_db("cv_levin");
	switch ($_GET['action']) {
		case 'jenis':
			echo"<option>Pilih Sparepart</option>";
			$cari = mysql_query("select nama_sparepart from sparepart where jenis_sparepart='$_GET[jenis]' group by nama_sparepart");
			while ($hcari = mysql_fetch_assoc($cari)) {
				echo"
					<option value='$hcari[nama_sparepart]'>$hcari[nama_sparepart]</option>
				";
			}		
			break;
		
		case 'keterangan':
			echo"<option>Pilih Merk</option>";
			$cari = mysql_query("select * from sparepart where nama_sparepart='$_GET[keterangan]'");
			while ($hcari = mysql_fetch_assoc($cari)) {
				echo"
					<option value='$hcari[merk]'>$hcari[merk]</option>
				";
			}
			break;

		case 'merk':
			$cari = mysql_query("select harga from sparepart where merk='$_GET[merk]' and nama_sparepart='$_GET[keterangan]'");
			$hasil= mysql_fetch_assoc($cari);
			echo"$hasil[harga]";
			break;

		default:
			# code...
			break;
	}
	
?>