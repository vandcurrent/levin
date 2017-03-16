<?php
include "../sesi.php";

  $tipe = $_POST['tipe'];

  //$id_sparepart=$_POST['id_sparepart'];
  //$stok=$_POST['stok'];
  $tanggal = date("Y-m-d");
  $jenis_sparepart=$_POST['jenis'];
  $nama_sparepart=$_POST['keterangan'];
  $merk=$_POST['merk'];
  $jumlah=$_POST['jumlah'];
  $qty=$_POST['qty'];
  $tahun=date('Y');
  $harga=$_POST['harga'];
  $batas = sizeof($jenis_sparepart);
  $row = $_POST['row'];
  $result = false;
  $result2 = false;
  $result3 = false;
  $kredit = false;
  $bayar = $_POST['bayar'];
  $subtotal = $_POST['subtotal'];
  $ppn = $_POST['ppn'];
  $total = $_POST['total'];
  $sisa = $_POST['sisa'];
  $supplier = $_POST['elek'];
  $row = $row - 4;
  //echo $row;
  //echo $supplier;

//id transaksi
$idt = mysql_query("SELECT MAX(id_transaksi) +1 FROM nota") or die (mysql_error());
$idtrans = mysql_fetch_array($idt);

$ainota = mysql_fetch_array(mysql_query("SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'cv_levin' AND TABLE_NAME = 'nota'"));

for($i = 0; $i < $row; $i++){

  //echo $idtrans[0];
  if ($tipe[$i] == 'baru') {
      
      //TO SPAREPART
      $q = "INSERT INTO sparepart values (
        '',
        '$jenis_sparepart[$i]',
        '$nama_sparepart[$i]',
        '$merk[$i]',
        '2016',
        '$harga[$i]',
        '$qty[$i]'
      )";
        mysql_query($q) or die (mysql_error());

      $s = mysql_query("SELECT id_sparepart FROM sparepart WHERE jenis_sparepart='$jenis_sparepart[$i]' AND nama_sparepart = '$nama_sparepart[$i]' AND merk = '$merk[$i]'");
      $id_sparepart= mysql_fetch_array($s);
      //TO STOK
      mysql_query("INSERT INTO stok VALUES ('', '$id_sparepart[0]','$tanggal','','$qty[$i]','$harga[$i]','$jumlah[$i]','$qty[$i]','$harga[$i]','$jumlah[$i]','pembelian')") or die(mysql_error());

      //TO NOTA
      

      mysql_query("INSERT INTO nota VALUES ('', 'pembelian', '$idtrans[0]', '$tanggal', '$tanggal')") or die (mysql_error());
      mysql_query("INSERT INTO data_nota VALUES ('', '$ainota[0]', '$nama_sparepart[$i]', '$jenis_sparepart[$i]', '$merk[$i]', '$harga[$i]', '$qty[$i]','$jumlah[$i]', 'pembelian')") or die (mysql_error());

      //TO PEMBELIAN
      if($bayar<$total)
      {
        //echo "kredit";
        mysql_query("INSERT INTO pembelian VALUES ('', '$tanggal', '$jenis_sparepart[$i]', '$nama_sparepart[$i]', '$merk[$i]', '$tahun[$i]', '$harga[$i]','$qty[$i]','$ppn', '$bayar', '$sisa', 'belum', '$total', '$ainota[0]','','$supplier')") or die(mysql_error());
        //TO JURNAL
        mysql_query("INSERT INTO jurnal VALUES ('', '$tanggal', '100', 'cr', $bayar)"); //kas
        mysql_query("INSERT INTO jurnal VALUES ('', '$tanggal', '200', 'cr', $sisa)"); //utang dagang
        mysql_query("INSERT INTO jurnal VALUES ('', '$tanggal', '250', 'dr', $ppn)"); //ppn
        mysql_query("INSERT INTO jurnal VALUES ('', '$tanggal', '120', 'dr', $jumlah[$i])"); //persediaan

        $kredit = true;
      }
      else
      {
        mysql_query("INSERT INTO pembelian VALUES ('', '$tanggal', '$jenis_sparepart[$i]', '$nama_sparepart[$i]', '$merk[$i]', '$tahun[$i]', '$harga[$i]','$qty[$i]','$ppn', '0', '$sisa', 'lunas', '$jumlah[$i]', '$ainota[0]','$tanggal','$supplier')") or die (mysql_error());

        //TO JURNAL
        mysql_query("INSERT INTO jurnal VALUES ('', '$tanggal', '100', 'cr', $total)") or die (mysql_error()); //kas
        mysql_query("INSERT INTO jurnal VALUES ('', '$tanggal', '250', 'dr', $ppn)") or die (mysql_error()); //ppn
        mysql_query("INSERT INTO jurnal VALUES ('', '$tanggal', '120', 'dr', $jumlah[$i])") or die (mysql_error()); //persediaan
      }
      $result = true;

  }else if ($tipe[$i] == 'restok'){
    $s = mysql_query("SELECT id_sparepart FROM sparepart WHERE jenis_sparepart='$jenis_sparepart[$i]' AND nama_sparepart = '$nama_sparepart[$i]' AND merk = '$merk[$i]'");
    $id_sparepart= mysql_fetch_array($s);

    //TO SPAREPART
    $c = mysql_query("SELECT stok FROM sparepart WHERE jenis_sparepart='$jenis_sparepart[$i]' AND nama_sparepart='$nama_sparepart[$i]' AND merk='$merk[$i]'");
    $cekstok = mysql_fetch_array($c);
    //echo $cekstok[0];
    $fstok = $cekstok[0] + $qty[$i];
    //echo $fstok;
    // echo $jenis_sparepart[$i];
    // echo $nama_sparepart[$i];
    // echo $merk[$i];
    // echo $id_sparepart[0];
    //$q = "UPDATE sparepart SET stok = $fstok WHERE jenis_sparepart = '$jenis_sparepart[$i]'' AND nama_sparepart = '$nama_sparepart[$i]'' AND merk = '$merk[$i]'";
    mysql_query("UPDATE sparepart SET stok = '$fstok' WHERE jenis_sparepart = '$jenis_sparepart[$i]' AND nama_sparepart = '$nama_sparepart[$i]' AND merk = '$merk[$i]'") or die (mysql_error());

    $q2 = mysql_query("INSERT INTO stok VALUES ('', '$id_sparepart[0]','$tanggal','','$qty[$i]','$harga[$i]','$jumlah[$i]','$qty[$i]','$harga[$i]','$jumlah[$i]','pembelian')") or die (mysql_error());

    //TO NOTAa
    // $ainota = mysql_fetch_array(mysql_query("SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'cv_levin' AND TABLE_NAME = 'nota'"));

    mysql_query("INSERT INTO nota VALUES ('', 'pembelian', '$idtrans[0] + 1', '$tanggal', '$tanggal')") or die (mysql_error());
    mysql_query("INSERT INTO data_nota VALUES ('', '$ainota[0]', '$nama_sparepart[$i]', '$jenis_sparepart[$i]', '$merk[$i]', '$harga[$i]', '$qty[$i]','$jumlah[$i]', 'pembelian')") or die (mysql_error());

    //TO PEMBELIAN
    if($bayar<$total)
    {
      //echo "ngutang";
      mysql_query("INSERT INTO pembelian VALUES ('', '$tanggal', '$jenis_sparepart[$i]', '$nama_sparepart[$i]', '$merk[$i]', '$tahun[$i]', '$harga[$i]','$qty[$i]','$ppn', '$bayar', '$sisa', 'belum', '$total', '$ainota[0]', '', '$supplier')") or die (mysql_error());

      //TO JURNAL
      mysql_query("INSERT INTO jurnal VALUES ('', '$tanggal', '100', 'cr', $bayar)") or die (mysql_error()); //kas
      mysql_query("INSERT INTO jurnal VALUES ('', '$tanggal', '200', 'cr', $sisa)") or die (mysql_error()); //utang dagang
      mysql_query("INSERT INTO jurnal VALUES ('', '$tanggal', '250', 'dr', $ppn)") or die (mysql_error()); //ppn
      mysql_query("INSERT INTO jurnal VALUES ('', '$tanggal', '120', 'dr', $jumlah[$i])") or die (mysql_error()); //persediaan

      $kredit = true;
    }
    else
    {
      //echo "cash";
      mysql_query("INSERT INTO pembelian VALUES ('', '$tanggal', '$jenis_sparepart[$i]', '$nama_sparepart[$i]', '$merk[$i]', '$tahun[$i]', '$harga[$i]','$qty[$i]','$ppn', '', '$sisa', 'lunas', '$jumlah[$i]', '$ainota[0]','$tanggal','$supplier')") or die (mysql_error());

      //TO JURNAL
      mysql_query("INSERT INTO jurnal VALUES ('', '$tanggal', '100', 'cr', $total)") or die (mysql_error()); //kas
      mysql_query("INSERT INTO jurnal VALUES ('', '$tanggal', '250', 'dr', $ppn)") or die (mysql_error()); //ppn
      mysql_query("INSERT INTO jurnal VALUES ('', '$tanggal', '120', 'dr', $jumlah[$i])") or die (mysql_error()); //persediaan
    }

    $result2 = true;
  }

  else if ($tipe[$i] == 'retur'){
    $s = mysql_query("SELECT id_sparepart FROM sparepart WHERE jenis_sparepart='$jenis_sparepart[$i]' AND nama_sparepart = '$nama_sparepart[$i]' AND merk = '$merk[$i]'");
    $id_sparepart= mysql_fetch_array($s);

    //TO SPAREPART
    $c = mysql_query("SELECT stok FROM sparepart WHERE jenis_sparepart='$jenis_sparepart[$i]' AND nama_sparepart='$nama_sparepart[$i]' AND merk='$merk[$i]'");
    $cekstok = mysql_fetch_array($c);
    //echo $cekstok[0];
    $fstok = $cekstok[0] - $qty[$i];
    $q = "UPDATE sparepart SET stok = '$fstok' WHERE jenis_sparepart = '$jenis_sparepart[$i]' AND nama_sparepart = '$nama_sparepart[$i]' AND merk = '$merk[$i]'";
    mysql_query($q);

    $q2 = mysql_query("INSERT INTO stok VALUES ('', '$id_sparepart[0]','$tanggal','','$qty[$i]','$harga[$i]','$jumlah[$i]','$qty[$i]','$harga[$i]','$jumlah[$i]','retur')") or die (mysql_error());

      //TO NOTA
      // $ainota = mysql_fetch_array(mysql_query("SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'cv_levin' AND TABLE_NAME = 'nota'"));

      mysql_query("INSERT INTO nota VALUES ('', 'retur', '$idtrans[0] + 1', '$tanggal', '')") or die (mysql_error());
      mysql_query("INSERT INTO data_nota VALUES ('', '$ainota[0]', '$nama_sparepart[$i]', '$jenis_sparepart[$i]', '$merk[$i]', '$harga[$i]', '$qty[$i]','$jumlah[$i]', 'retur')") or die (mysql_error());

      //TO JURNAL
      mysql_query("INSERT INTO jurnal VALUES ('', '$tanggal', '100', 'dr', $total)") or die (mysql_error()); //kas
      mysql_query("INSERT INTO jurnal VALUES ('', '$tanggal', '520', 'cr', $total)") or die (mysql_error()); //retur
      }

      $result3 = true;
  }

$sjual = 0;
$sbeli = 0;
$qty =0; $tqty = 0;
$harga =0; $tharga = 0;
$total =0; $ttotal = 0;
$jtotal = 0;
// echo "a";
$selectall = "SELECT * FROM sparepart group by nama_sparepart";
$sselectall = mysql_query($selectall) or die(mysql_error());
while ($all = mysql_fetch_array($sselectall)) {
      $n = $all['nama_sparepart'];
      $j = $all['jenis_sparepart'];
      $m = $all['merk'];     
      //echo $j ."+". $n ."+". $m;
      $sqlselect= "SELECT * FROM stok, sparepart where stok.id_sparepart = sparepart.id_sparepart and sparepart.jenis_sparepart='$j' and sparepart.nama_sparepart = '$n' and merk = '$m'";
      $result = mysql_query($sqlselect) or die(mysql_error());
      $numrows = mysql_num_rows($result);
      while ($row = mysql_fetch_assoc($result)) {
            
            $numrows --;
            //$snama = mysql_query("SELECT * FROM sparepart WHERE id_sparepart = '$id[$i]'") or die(mysql_error());
            // $bnama = mysql_fetch_array($snama);
            // $tnama = $bnama['nama_sparepart'];
            //echo $row['tipe'] ."asd";
            if ($sbeli == 1 && $row['tipe']=='penjualan')
            {
              $qty = $qty + $tqty;
              $total = $total + $ttotal;
              $harga = round($total / $qty,0);
              $hjual = $harga;
              $tqty = 0;
              $tharga = 0;
              $ttotal = 0;
              $sbeli = 0;
              $jtotal = $total;
            }
            else if($sjual == 1 && $row['tipe']=='pembelian'){
              $qty = $qty - $tqty;
              $total1 = $total;
              $total = $jtotal - $ttotal;
              //$harga = round($total / $qty,0);
              $tqty = 0;
              $tharga = 0;
              $ttotal = 0;
              $sjual = 0;
            }
            // echo $jtotal;
            if ($row['tipe']=='pembelian'){
              $sbeli = 1;
              $tqty = $tqty + $row['s-qty'];
              $tharga = $tharga + $row['s-harga'];
              $ttotal = $ttotal + $row['s-total']; 
            }
            else if ($row['tipe']=='penjualan') {
              $sjual = 1;
              $tqty = $tqty + $row['s-qty'];
              $tharga = $tharga + $row['s-harga'];
              $ttotal = $ttotal + ($hjual * $row['s-qty']); 
            }

            if ($numrows == 0 && $row['tipe']=='penjualan'){
              $qty = $qty - $tqty;
              $total = $total - $ttotal;
              $harga = round($total / $qty, 0);
            }
            else if ($numrows == 0 && $row['tipe'] == 'pembelian'){
              $qty = $qty + $tqty;
              $harga = $harga + $tharga;
              $total = $total + $ttotal;
              $harga = round($total / $qty, 0);
            }
             // echo $total;
            // echo $harga;
            // echo "b";
      }
      mysql_query("INSERT INTO hpp VALUES ('', '$j', '$n', '$m', '$harga')") or die(mysql_error());
}

if($result || $result2 || $result3) {
?>
<script>
  alert("Berhasil menyimpan data Sparepart yang dibeli");
  window.location="data-sparepart.php";
</script>
<?php
}
else{
?>
<script>
  alert("Gagal menyimpan data");
  window.location="pembelian-sparepart.php";
</script>
<?php
}
?>
