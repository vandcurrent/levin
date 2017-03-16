<?php
include "../sesi.php";

//$jno=strlen($row["id_penjualan"]);

$jsArray = "var SparePartArray = new Array();\n";

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>Pembelian - Levin Motor</title>

    <meta name="description" content="penjualan" />

    <!-- page specific plugin styles -->
    <link rel="stylesheet" href="../assets/css/jquery-ui.custom.min.css" />
    <link rel="stylesheet" href="../assets/css/chosen.min.css" />
    <link rel="stylesheet" href="../assets/css/datepicker.min.css" />
    <link rel="stylesheet" href="../assets/css/bootstrap-timepicker.min.css" />
    <link rel="stylesheet" href="../assets/css/daterangepicker.min.css" />
    <link rel="stylesheet" href="../assets/css/bootstrap-datetimepicker.min.css" />
    <link rel="stylesheet" href="../assets/css/colorpicker.min.css" />

<?php

include '../assets/sebelum-content.php';
include '../sidenav/gudang.html';
?>
<ul class="breadcrumb">
  <li>
    <i class="ace-icon fa fa-home home-icon"></i>
    <a href="#">Sparepart</a>
  </li>

  <li>
    <a href="#">Pembelian</a>
  </li>
</ul><!-- /.breadcrumb -->
<?php
include '../assets/seting.html';
?>
                <!-- PAGE CONTENT MULAI -->
                <div class="page-header">
                  <h1>
                    Pembelian
                    <small>
                      <i class="ace-icon fa fa-angle-double-right"></i>
                      Masukan Data Yang Tertera Dari Faktur Pembelian Sparepart
                    </small>
                  </h1>
                </div><!-- /.page-header -->

                <div class="row">
                  <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->


                        <table align="center">
                <form role="form" name="permintaan_barang" method="POST" action="proses-beli.php" >
                       <div class="form-group">
                          <label>
                      <tr>
                         <td>Tanggal</td>
                         <td><input class="form-control" required type="text" name="tanggal" readonly value="<?php echo date('d F Y'); ?>"/> </td>
                      </tr>
                      <tr>
                        <td>No Nota</td>
                        <td><input type="text" name="nomer" id="nomer" class="form-control" required ></td>
                      </tr>
                      <tr>
                         <td>Jenis Sparepart</td>
                         <td><select class="form-control" name="jenis" tabindex="-1" id="jenis" required>
                           <option value="">Jenis Sparepart</option>
                           <?php
                              $sql = mysql_query("SELECT * FROM sparepart");
                              while ($row = mysql_fetch_assoc($sql)){
                                      echo "<option value='".$row['id_sparepart']."'>".$row['jenis_sparepart']."</option>";
                              }
                            ?>
                         </select>
                         </td>
                      </tr>

                      <tr>
                         <td>ID sparepart</td>
                         <td><input class="form-control" type="text" name="id_sparepart" autocomplete="off" list="listsp" id="id_sparepart" readonly></td>
                         <datalist id="listsp">
                           <?=$listid?>
                         </datalist>
                      </tr>

                      <tr>
                         <td>Nama Sparepart</td>
                         <td><input class="form-control" type="text" name="nama_sparepart" id="nama_sparepart" required tabindex="-1"></td>
                      </tr>
                      <tr>
                         <td>Merk</td>
                         <td><input class="form-control" type="text" name="merk" id="merk" tabindex="-1" required></td>
                      </tr>

                      <tr>
                         <td>Tahun</td>
                         <td><input class="form-control" type="text" name="tahun" id="tahun" tabindex="-1" required></td>
                      </tr>

                      <tr>
                         <td>Harga</td>
                         <td><input class="form-control" type="number" name="harga" id="harga" tabindex="-1" required></td>
                      </tr>

                      <tr>
                         <td>Banyaknya</td>
                         <td><input class="form-control" type="number" name="banyaknya" id="banyaknya" onChange="getwords()" required></td>
                      </tr>

                      <tr>
                         <td>Jumlah</td>
                         <td><input class="form-control" type="number" name="jumlah"  id="jumlah" readonly></td>
                      </tr>
                      <tr>
                         <td>PPN 10%</td>
                         <td><input class="form-control" type="number" name="ppn"  id="ppn" readonly></td>
                      </tr>
                      <tr>
                         <td>Total Bayar Ditambah PPN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                         <td><input class="form-control" type="number" name="totalbayarppn"  id="totalbayarppn" readonly></td>
                      </tr>
                      <tr>
                         <td>Uang Bayar</td>
                         <td><input class="form-control" type="number" name="bayar" min="0" id="bayar" onChange="getwords2()" required></td>
                      </tr>
                      <tr>
                         <td>Kembalian</td>
                         <td><input class="form-control" type="number" name="kembali"  id="kembali" min="0" readonly></td>
                      </tr>

                      <tr>
                         <td>Sisa</td>
                         <td><input class="form-control" type="number" name="sisa"  id="sisa" min="0" readonly=""></td>
                      </tr>
                      <tr><td height="30"></td><tr>
                    </label>
                          </div>

                          <div class="panel-body">
                            <div class="input-group has-feedback">

                          

                          <tr><td> </td></tr>
                    <tr>
                    <td></td>
                            <td>
                          <button type="reset" name="reset" class="btn btn-danger" value="Reset">
                                      <span></span>&nbsp;&nbsp;Reset
                                    </button> &nbsp;&nbsp;
                                    <button type="submit" name="submit" class="btn btn-primary" value="submit">
                                      <span></span>&nbsp;&nbsp;Submit
                                    </button>
                                  </div>
                          </td>
                        </tr>


                  </form>
                  </table>

                  <!-- PAGE CONTENT ENDS -->
                  </div><!-- /.col -->
                </div><!-- /.row -->
                <!-- PAGE CONTENT SELESAI -->

<?php
include '../assets/setelah-content.php';
?>

<!-- script page -->
<script src="jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $("#jenis").change(function(){
      var harga = $("#jenis").val();
      $.ajax({
        url   : "populate.php?action=harga",
        data  : "merk="+harga,
        cache : false,
        datatype: 'json',
        success : function(data){
          var res = JSON.parse(data);
          $("#id_sparepart").val(res.id_sparepart);
          $("#merk").val(res.merk);
          $("#tahun").val(res.tahun);
          $("#stok").val(res.stok);
          $("#harga").val(res.harga);
          }
      });
    });
  });

  <?php echo $jsArray; ?>
    function changeValue(id){
    document.getElementById('id_sparepart').value = SparePartArray[id].id_sparepart;
    document.getElementById('nama_sparepart').value = SparePartArray[id].nama_sparepart;
    document.getElementById('merk').value = SparePartArray[id].merk;
    document.getElementById('tahun').value = SparePartArray[id].tahun;
    document.getElementById('harga').value = SparePartArray[id].harga;
    document.getElementById('stok').value = SparePartArray[id].stok;
  };
</script>
<script type="text/javascript">
    function getwords(){
      harga = document.getElementById('harga').value;
      banyak = document.getElementById('banyaknya').value;
      var totaljual = (+harga)*(+banyak);
      console.log( totaljual );

      var a= document.getElementById('bayar').value;
      var b= document.getElementById('totalbayarppn').value;
      var c = b - a;

      //document.getElementById('diskon').value = ((hargadiskon/totaljual)*100).toFixed(2);
      document.getElementById('jumlah').value = totaljual;
      document.getElementById('ppn').value = totaljual*(10/100);
      document.getElementById('totalbayarppn').value = totaljual+(totaljual*(10/100));
      document.getElementById('sisa').value = c;
    }
    function getwords2(){
      totalbayarppn = document.getElementById('totalbayarppn').value;
      bayar = document.getElementById('bayar').value;

      document.getElementById('kembali').value = (+bayar)-(+totalbayarppn);
      document.getElementById('sisa').value = (+totalbayarppn)-(+bayar);
    }
</script>
<script>
/*function total(banyak){
  var a = parseInt(document.getElementById("harga").value);
  var c = a * banyak;
  document.getElementById("jumlah").value = c;
};*/

<?=$arrdetailspjs?>
function autodetailsp(idsp) {
  document.getElementById('nama_sparepart').value = arrdetailsp[idsp].nama_sparepart;
  document.getElementById('merk').value = arrdetailsp[idsp].merk;
  document.getElementById('tahun').value = arrdetailsp[idsp].tahun;
  document.getElementById('stok').value = arrdetailsp[idsp].stok;
  document.getElementById('harga').value = arrdetailsp[idsp].harga;
};
</script>
<!-- inline scripts page -->
<script src="../assets/js/jquery-ui.custom.min.js"></script>
<script src="../assets/js/jquery.ui.touch-punch.min.js"></script>
<script src="../assets/js/chosen.jquery.min.js"></script>
<script src="../assets/js/fuelux.spinner.min.js"></script>
<script src="../assets/js/bootstrap-datepicker.min.js"></script>
<script src="../assets/js/bootstrap-timepicker.min.js"></script>
<script src="../assets/js/moment.min.js"></script>
<script src="../assets/js/daterangepicker.min.js"></script>
<script src="../assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="../assets/js/bootstrap-colorpicker.min.js"></script>
<script src="../assets/js/jquery.knob.min.js"></script>
<script src="../assets/js/jquery.autosize.min.js"></script>
<script src="../assets/js/jquery.inputlimiter.1.3.1.min.js"></script>
<script src="../assets/js/jquery.maskedinput.min.js"></script>
<script src="../assets/js/bootstrap-tag.min.js"></script>

<script type="text/javascript">

var o = document.getElementById("penjualan");
o.className += "active ";
o.className += "open ";
var o = document.getElementById("data-penjualan");
o.className += "active ";

</script>
</body>
</html>
