<?php
	mysql_connect("localhost","root","");
	mysql_select_db("cv_levin");

	 switch ($_GET['action']) {
	 	case 'jenis':
	 	echo "<option value=''>Pilih Nama Sparepart</option>";
	 	$a = mysql_query("select * from det_sparepart where id_sparepart='$_GET[merk]'");
				while($b = mysql_fetch_assoc($a)){
					echo"
						<option value='".$b[nama_sparepart]."'>".$b[nama_sparepart]."</option>
					";
					$harga["id_sparepart"] = $b['id_sparepart'];
				}
	 		break;

	 	case 'harga':
	 		$a = mysql_query("select * from sparepart where id_sparepart='$_GET[merk]'");
	 		while ($b = mysql_fetch_assoc($a)) {
	 			$harga["id_sparepart"] = $b['id_sparepart'];	
	 		}
	 		
			//$harga["harga"] = $b[0];
	 		echo json_encode($harga);
	 		break;
	 	
	 	default:
	 		# code...
	 		break;
	 }
?>