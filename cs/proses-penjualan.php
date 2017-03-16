<?php
include "../sesi.php";

  $tanggal = date("Y-m-d", strtotime($_POST['tanggal']));
  $jenis_sp = $_POST['jenissp'];
  //$id_sp = $_POST['id_sparepart'];
  $nama_sp = $_POST['keterangan'];
  $merk_sp = $_POST['merk'];
  $tahun_sp = $_POST['tipe'];
  $stok_sp = $_POST['stok'];
  $harga_sp = $_POST['harga'];
  $banyak_sp = $_POST['qty'];
  $jumlah_sp = $_POST['jumlah'];
  $ppn= $_POST['ppn'];
  $total = $_POST['total'];
  $bayar = $_POST['bayar'];
  $subtotal = $_POST['subtotal'];
  $sisa=$_POST['sisa'];
  $row = $_POST['row'];
  $row = $row - 4;
  $pelanggan = $_POST['pelanggan'];
  //echo $row;
  $result = false;
  //$sisastok = $stok_sp - $banyak_sp;

$idt = mysql_query("SELECT MAX(id_transaksi) +1 FROM nota") or die (mysql_error());
$idtrans = mysql_fetch_array($idt);

$ainota = mysql_fetch_array(mysql_query("SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'cv_levin' AND TABLE_NAME = 'nota'")) or die(mysql_error());

if($banyak_sp <= 0)
{
  ?>
  <script>
  alert("Tidak ada barang yang dibeli. <br> Transaksi GAGAL");
  window.location="penjualan.php";
</script>
  <?php
}
else if($bayar < $total)
{
  for($i = 0; $i < $row; $i++){
    $s = mysql_query("SELECT id_sparepart FROM sparepart WHERE jenis_sparepart='$jenis_sp[$i]'") or die(mysql_error());
    $id_sparepart= mysql_fetch_array($s);
    //echo $id_sparepart[0];
    //TO STOK
    mysql_query("INSERT INTO stok VALUES ( NULL, '$id_sparepart[0]', '$tanggal','$jenis_sp[$i]' , '$banyak_sp[$i]', '$harga_sp[$i]', '$jumlah_sp[$i]', '$banyak_sp[$i]', '$harga_sp[$i]', '$jumlah_sp[$i]', 'penjualan')") or die(mysql_error());

    //TO SPAREPART
    $sisastok = $stok_sp[$i] - $banyak_sp[$i];
    // echo $id_sparepart[0]." idsp+ ";
    // echo $sisastok." sisa+ ";
    // echo $nama_sp[$i]." stok+ ";
    //echo $jenis_sp[$i]." merk +";

    mysql_query("UPDATE sparepart SET stok = '$sisastok' WHERE jenis_sparepart = '$jenis_sp[$i]' AND nama_sparepart= '$nama_sp[$i]'") or die(mysql_error());

    //TO PENJUALAN

    mysql_query("INSERT INTO penjualan VALUES ('','$tanggal','$jenis_sp[$i]','$id_sparepart[0]','$nama_sp[$i]','$merk_sp[$i]','$tahun_sp[$i]','$sisastok','$harga_sp[$i]','$banyak_sp[$i]','$ppn','$bayar','$sisa', 'belum', $pelanggan, $ainota[0],'')") or die(mysql_error());

//     //TO JURNAL
    $h = mysql_query("SELECT hpp FROM hpp WHERE id_sparepart='$jenis_sp[$i]' AND nama_sparepart = '$nama_sp[$i]' AND merk = '$merk_sp[$i]' AND id_hpp = (SELECT MAX(id_hpp) FROM hpp WHERE id_sparepart='$jenis_sp[$i]')");
    $hpp = mysql_fetch_assoc($h);
    $nhpp = $hpp['hpp'];
    echo $nhpp;
    mysql_query("INSERT INTO jurnal VALUES('', '$tanggal', '100', 'dr', '$total')") or die(mysql_error());//kas
    mysql_query("INSERT INTO jurnal VALUES('', '$tanggal', '500', 'dr', '$nhpp')") or die(mysql_error());//hpp
    mysql_query("INSERT INTO jurnal VALUES('', '$tanggal', '110', 'dr', '$sisa')") or die(mysql_error());//piutang dagang
    mysql_query("INSERT INTO jurnal VALUES('', '$tanggal', '120', 'cr', '$nhpp')") or die(mysql_error());//persediaan
    mysql_query("INSERT INTO jurnal VALUES('', '$tanggal', '400', 'cr', '$subtotal')") or die(mysql_error());//penjualan
    mysql_query("INSERT INTO jurnal VALUES('', '$tanggal', '250', 'cr', '$ppn')") or die(mysql_error());//ppn


    // echo $total."+";
    // echo $nhpp."+";
    // echo $subtotal."+";
    // echo $ppn."+";

    //TO NOTA
    //$ainota = mysql_fetch_array(mysql_query("SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'cv_levin' AND TABLE_NAME = 'nota'"));

    mysql_query("INSERT INTO nota VALUES ('', 'penjualan', '$idtrans[0]', '$tanggal', '')") or die (mysql_error());
    mysql_query("INSERT INTO data_nota VALUES ('', '$ainota[0]', '$nama_sp[$i]', '$jenis_sp[$i]', '$merk_sp[$i]', '$harga_sp[$i]', '$banyak_sp[$i]','$jumlah_sp[$i]', 'penjualan')") or die (mysql_error());

    $result = true;
  }//end
}
else
{
for($i = 0; $i < $row; $i++){
//echo $row;
    $s = mysql_query("SELECT id_sparepart FROM sparepart WHERE jenis_sparepart='$jenis_sp[$i]'") or die(mysql_error());
    $id_sparepart= mysql_fetch_array($s);

    //echo $jenis_sp[$i];
    //echo $id_sparepart[0];
    //TO STOK
    mysql_query("INSERT INTO stok VALUES ( NULL, '$id_sparepart[id_sparepart]', '$tanggal','$jenis_sp[$i]' , '$banyak_sp[$i]', '$harga_sp[$i]', '$jumlah_sp[$i]', '$banyak_sp[$i]', '$harga_sp[$i]', '$jumlah_sp[$i]', 'penjualan')") or die(mysql_error());

    //TO SPAREPART
    $sisastok = $stok_sp[$i] - $banyak_sp[$i];
// echo "#". $stok_sp[$i]."-";
// echo $banyak_sp[$i]."*";
    // echo $sisastok;
    mysql_query("UPDATE sparepart SET stok = '$sisastok' WHERE jenis_sparepart = '$jenis_sp[$i]' AND nama_sparepart= '$nama_sp[$i]'") or die(mysql_error());

    //TO PENJUALAN
    //$ainota = mysql_fetch_array(mysql_query("SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'cv_levin' AND TABLE_NAME = 'nota'")) or die(mysql_error());

    mysql_query("INSERT INTO penjualan VALUES ('','$tanggal','$jenis_sp[$i]','$id_sparepart[0]','$nama_sp[$i]','$merk_sp[$i]','$tahun_sp[$i]','$sisastok','$harga_sp[$i]','$banyak_sp[$i]','$ppn','$bayar','$sisa', 'lunas', '$pelanggan', $ainota[0],'$tanggal')") or die(mysql_error());

//     //TO JURNAL
    $h = mysql_query("SELECT hpp FROM hpp WHERE id_sparepart='$jenis_sp[$i]' AND nama_sparepart = '$nama_sp[$i]' AND merk = '$merk_sp[$i]' AND id_hpp = (SELECT MAX(id_hpp) FROM hpp WHERE id_sparepart='$jenis_sp[$i]')");
    $hpp = mysql_fetch_assoc($h);
    $nhpp = $hpp['hpp'];
    // echo $id_sparepart[0] ."+".$nhpp;

    mysql_query("INSERT INTO jurnal VALUES('', '$tanggal', '100', 'dr', '$total')") or die(mysql_error());//kas
    mysql_query("INSERT INTO jurnal VALUES('', '$tanggal', '120', 'cr', '$nhpp')") or die(mysql_error());//persediaan
    mysql_query("INSERT INTO jurnal VALUES('', '$tanggal', '400', 'cr', '$subtotal')") or die(mysql_error());//penjualan
    mysql_query("INSERT INTO jurnal VALUES('', '$tanggal', '250', 'cr', '$ppn')") or die(mysql_error());//ppn
    mysql_query("INSERT INTO jurnal VALUES('', '$tanggal', '500', 'dr', '$nhpp')") or die(mysql_error());//hpp

    // echo $total."+";
    // echo $nhpp."+";
    // echo $subtotal."+";
    // echo $ppn."+";

    //TO NOTA


    mysql_query("INSERT INTO nota VALUES ('', 'penjualan', '$idtrans[0]', '$tanggal','$tanggal')") or die (mysql_error());
    mysql_query("INSERT INTO data_nota VALUES ('', '$ainota[0]', '$nama_sp[$i]', '$jenis_sp[$i]', '$merk_sp[$i]', '$harga_sp[$i]', '$banyak_sp[$i]','$jumlah_sp[$i]', 'penjualan')") or die (mysql_error());

    $result = true;
    }//end loop
}
if($result) {
?>
<script>
  alert("Berhasil mengupdate data penjualan");
	window.location="data-penjualan.php";
</script>
<?php
}else{
?>
<script>
  alert("Gagal mengupdate data");
	window.location="penjualan.php";
</script>
<?php
}
 ?>
