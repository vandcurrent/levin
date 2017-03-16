<?php
	mysql_connect("localhost","root","");
	mysql_select_db("cv_levin");

	$sql = "SELECT * FROM stok WHERE nama_sparepart='$_GET[id_sparepart]'";
	mysql_query($sql);
	while ($baris = mysql_fetch_assoc($sql)) {
		echo $baris[jenis];
		echo $baris[tipe];
		echo "<tr><td>$baris['id_sparepart']</td></tr>";
	}
?>
