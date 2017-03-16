<?php
include "../sesi.php";

  $tanggal = date("Y-m-d", strtotime($_POST['tanggal']));
  $jenis_sp = $_POST['jenis'];
  $id_sp = $_POST['id_sparepart'];
  $nama_sp = $_POST['nama_sparepart'];
  $merk_sp = $_POST['merk'];
  $tahun_sp = $_POST['tahun'];
  $harga_sp = $_POST['harga'];
  $banyak_sp = $_POST['banyaknya'];
  $jumlah_sp = $_POST['jumlah'];
  $ppn= $_POST['ppn'];
  $total = $_POST['totalbayarppn'];
  $bayar = $_POST['bayar'];
  $sisa=$_POST['sisa'];
  $result = false;
  $nomer = $_POST['nomer'];
  $tipe = $_POST['tipe'];
  //$tanggal = date('Y-m-d');


if($banyak_sp <= 0)
{
  ?>
  <script>
  alert("Tidak ada barang yang dibeli. <br> Transaksi GAGAL");
  window.location="pembelian-sparepart.php";
</script>
  <?php
}
else if($bayar < $total)
{
      $aitrans = mysql_fetch_array(mysql_query("SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'cv_levin' AND TABLE_NAME = 'sparepart'"));
      $ainota = mysql_fetch_array(mysql_query("SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'cv_levin' AND TABLE_NAME = 'nota'"));
      $sql = mysql_query("SELECT COUNT(nama_sparepart) FROM sparepart WHERE id_sparepart='$id_sp' AND nama_sparepart='$nama_sp'") or die (mysql_error());
      $cekstatus = mysql_fetch_array($sql);

      $sql2 = mysql_query("SELECT stok FROM sparepart WHERE id_sparepart='$id_sp' AND nama_sparepart='$nama_sp'") or die (mysql_error());
      $cekstok = mysql_fetch_array($sql2);
      $fstok = $cekstok[0] + $banyak_sp;

      //echo $cekstatus[0]."asd<br>";
      if ($cekstatus[0])
      {
        mysql_query("UPDATE sparepart SET stok = $fstok WHERE id_sparepart='$id_sp' AND nama_sparepart='$nama_sp") or die (mysql_error());
        mysql_query("INSERT INTO stok VALUES ('', '$id_sp','$tanggal','','$banyak_sp','$harga_sp','$jumlah_sp','$banyak_sp','$harga_sp','$jumlah_sp','pembelian')") or die (mysql_error());
        mysql_query("INSERT INTO nota VALUES ('', 'pembelian', '$nomer', '$tanggal', '')") or die (mysql_error());
        mysql_query("INSERT INTO data_nota VALUES ('', '$ainota[0]', '$nama_sp', '$jenis_sp', '$merk_sp', '$harga_sp', '$banyak_sp','$jumlah_sp', 'pembelian')") or die (mysql_error());
        mysql_query("INSERT INTO pembelian VALUES ('', '$tanggal', '$id_sp', '$nama_sp', '$merk_sp', '$tahun_sp', '$harga_sp','$banyak_sp','$ppn', '$bayar', '$sisa', 'belum', '$jumlah_sp', '$nomer', '')") or die (mysql_error());
        $result = true;
      }
      else
      {
        mysql_query("INSERT INTO sparepart VALUES ('','$id_sp','$nama_sp','$merk_sp','$tahun_sp','$harga_sp','$banyak_sp','$nomer')") or die (mysql_error());
        mysql_query("INSERT INTO stok values ('', '$id_sp','$tanggal','','$banyak_sp','$harga_sp','$jumlah_sp','$banyak_sp','$harga_sp','$jumlah_sp','pembelian')") or die (mysql_error()); 
        mysql_query("INSERT INTO nota VALUES ('', 'pembelian', '$nomer', '$tanggal', '')") or die (mysql_error());
        mysql_query("INSERT INTO data_nota VALUES ('', '$ainota[0]', '$nama_sp', '$jenis_sp', '$merk_sp', '$harga_sp', '$banyak_sp','$jumlah_sp', 'pembelian')") or die (mysql_error());
        mysql_query("INSERT INTO pembelian VALUES ('', '$tanggal', '$id_sp', '$nama_sp', '$merk_sp', '$tahun_sp', '$harga_sp','$banyak_sp','$ppn', '$bayar', '$sisa', 'belum', '$jumlah_sp', '$nomer','')") or die (mysql_error());
        $result = true;
      }
      if($result) {
      ?>
      <script>
        alert("Barang dibeli secara kredit. <br>Berhasil menyimpan sparepart yang dibeli");
        window.location="data-sparepart.php";
      </script>
      <?php
      }else{
      ?>
      <script>
        alert("Gagal menyimpan data");
        window.location="pembelian-sparepart.php";
      </script>
      <?php
      }
}
else
{
      $aitrans = mysql_fetch_array(mysql_query("SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'cv_levin' AND TABLE_NAME = 'sparepart'"));
      $ainota = mysql_fetch_array(mysql_query("SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'cv_levin' AND TABLE_NAME = 'nota'"));
      $sql = mysql_query("SELECT COUNT(nama_sparepart) FROM sparepart WHERE id_sparepart='$id_sp' AND nama_sparepart='$nama_sp'") or die (mysql_error());
      $cekstatus = mysql_fetch_array($sql);

      $sql2 = mysql_query("SELECT stok FROM sparepart WHERE id_sparepart='$id_sp' AND nama_sparepart='$nama_sp'") or die (mysql_error());
      $cekstok = mysql_fetch_array($sql2);
      $fstok = $cekstok[0] + $banyak_sp;

      //echo $cekstatus[0]."asd<br>";
      if ($cekstatus[0])
      {
        mysql_query("UPDATE sparepart SET stok = $fstok WHERE id_sparepart='$id_sp' AND nama_sparepart='$nama_sp") or die (mysql_error());
        mysql_query("INSERT INTO stok VALUES ('', '$id_sp','$tanggal','','$banyak_sp','$harga_sp','$jumlah_sp','$banyak_sp','$harga_sp','$jumlah_sp','pembelian')") or die (mysql_error());
        mysql_query("INSERT INTO nota VALUES ('', 'pembelian', '$nomer', '$tanggal', '')") or die (mysql_error());
        mysql_query("INSERT INTO data_nota VALUES ('', '$ainota[0]', '$nama_sp', '$jenis_sp', '$merk_sp', '$harga_sp', '$banyak_sp', '$jumlah_sp','pembelian')") or die (mysql_error());
        mysql_query("INSERT INTO pembelian VALUES ('', '$tanggal', '$id_sp', '$nama_sp', '$merk_sp', '$tahun_sp', '$harga_sp','$banyak_sp','$ppn', '', '$sisa', 'lunas', '$jumlah_sp', '$nomer','$tanggal')") or die (mysql_error());
        $result = true;
      }
      else
      {
        mysql_query("INSERT INTO sparepart VALUES ('','$id_sp','$nama_sp','$merk_sp','$tahun_sp','$harga_sp','$banyak_sp','$nomer')") or die (mysql_error());
        mysql_query("INSERT INTO stok values ('', '$id_sp','$tanggal','','$banyak_sp','$harga_sp','$jumlah_sp','$banyak_sp','$harga_sp','$jumlah_sp','pembelian')") or die (mysql_error()); 
        mysql_query("INSERT INTO nota VALUES ('', 'pembelian', '$nomer', '$tanggal', '')") or die (mysql_error());
        mysql_query("INSERT INTO data_nota VALUES ('', '$ainota[0]', '$nama_sp', '$jenis_sp', '$merk_sp', '$harga_sp', '$banyak_sp', 'total','pembelian')") or die (mysql_error());
        mysql_query("INSERT INTO pembelian VALUES ('', '$tanggal', '$id_sp', '$nama_sp', '$merk_sp', '$tahun_sp', '$harga_sp','$banyak_sp','$ppn', '', '$sisa', 'lunas', '$total', '$nomer', '$tanggal')") or die (mysql_error());
        $result = true;
      }
      if($result) {
      ?>
      <script>
        alert("Berhasil menyimpan sparepart yang dibeli");
        window.location="data-sparepart.php";
      </script>
      <?php
      }else{
      ?>
      <script>
        alert("Gagal menyimpan data");
        window.location="pembelian-sparepart.php";
      </script>
      <?php
      }
}
?>