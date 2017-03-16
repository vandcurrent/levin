<?php
include "../sesi.php";

$qsparepart = mysql_query("SELECT * FROM sparepart");
$detailp = array();
$sparepart = "<select class='form-control limited' name='id_sparepart' id='id_sparepart' onchange='detsparepart(this.value)'>".
              "<option value=''>----- Pilih ID Sparepart -----</option>";
while($baris = mysql_fetch_assoc($qsparepart)) {
  $id = $baris['id_sparepart'];
  $sparepart .= "<option value='".$id."'>".$id.' = '.$baris['nama_sparepart'].' | '.$baris['merk'].'</option>';
  $detailp[$id][] = $baris['jenis_sparepart'];
  $detailp[$id][] = $baris['nama_sparepart'];
  $detailp[$id][] = $baris['merk'];
  $detailp[$id][] = $baris['tahun'];
  $detailp[$id][] = $baris['harga'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Pembelian Sparepart - Levin Motor</title>

		<meta name="description" content="Montir" />

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
		<i class="ace-icon fa fa-wrench home-icon"></i>
		<a href="#">Sparepart</a>
	</li>

	<li>
		<a href="#">Pembelian Sparepart</a>
	</li>
</ul><!-- /.breadcrumb -->
<?php
include '../assets/seting.html';
?>
								<!-- PAGE CONTENT MULAI -->
								<div class="page-header">
									<h1>
										Pembelian Sparepart
										<small>
											<i class="ace-icon fa fa-angle-double-right"></i>
											Masukan Data Spaprepart Yang Dibeli
										</small>
									</h1>
								</div><!-- /.page-header -->
                <div class="row">
                  <form name ="belisparepart" id="belisparepart" method="POST" action="proses-beli.php">
                                  <div class="col-sm-12">
                                    <div class="widget-box">
                                      <div class="widget-header">
                                        <h4 class="widget-title">Tambah Sparepart</h4>
                                      </div>

                                      <div class="widget-body">
                                        <div class="widget-main no-padding">
                                            <!-- <legend>Form</legend> -->
                                            <fieldset style="padding:16px;">
                                              <script>
                                                function tipesparepart(a) {
                                                  if (a == 'stok') {
                                                    document.getElementById("input_sparepart").innerHTML= "<?=$sparepart?>";
                                                    document.getElementById("jenis_sparepart").disabled = true;
                                                    document.getElementById("nama_sparepart").disabled = true;
                                                    document.getElementById("merk").disabled = true;
                                                    document.getElementById("tahun").disabled = true;
                                                    document.getElementById("harga").disabled = true;
                                                    document.getElementById("jenis_sparepart").value = '';
                                                    document.getElementById("nama_sparepart").value = '';
                                                    document.getElementById("merk").value = '';
                                                    document.getElementById("tahun").value = '';
                                                    document.getElementById("harga").value = '';
                                                  }else {
                                                    document.getElementById("input_sparepart").innerHTML= "<input class='form-control' type='text' name='id_sparepart' id='id_sparepart'>";
                                                    document.getElementById("jenis_sparepart").disabled = false;
                                                    document.getElementById("nama_sparepart").disabled = false;
                                                    document.getElementById("merk").disabled = false;
                                                    document.getElementById("tahun").disabled = false;
                                                    document.getElementById("harga").disabled = false;
                                                    document.getElementById("jenis_sparepart").value = '';
                                                    document.getElementById("nama_sparepart").value = '';
                                                    document.getElementById("merk").value = '';
                                                    document.getElementById("tahun").value = '<?=date('Y')?>';
                                                    document.getElementById("harga").value = '';
                                                  }
                                                }
                                                var detailp = <?=json_encode($detailp)?>;
                                                function detsparepart(a) {
                                                    document.getElementById("jenis_sparepart").value = detailp[a][0];
                                                    document.getElementById("nama_sparepart").value = detailp[a][1];
                                                    document.getElementById("merk").value = detailp[a][2];
                                                    document.getElementById("tahun").value = detailp[a][3];
                                                    document.getElementById("harga").value = detailp[a][4];
                                                }
                                              </script>
                                              <select class="form-control limited" name="tipe_beli" onchange="tipesparepart(this.value)">
                                               <option value="baru">Barang Baru</option>
                                     					 <option value="stok">Tambah Stok</option>
                                     				  </select>

                                              <label>ID Sparepart</label>
                                              <div id="input_sparepart">
                                                <input class="form-control" type="text" name="id_sparepart" id="id_sparepart">
                                              </div>

                                              <label>Jenis Sparepart</label>
                                              <select class="form-control" name="jenis_sparepart" id="jenis_sparepart" required>
                                                <option value="" selected>--- Pilih Jenis ---</option>
                                                <option value="mesin">Mesin</option>
                                                <option value="aksesoris">aksesoris</option>
                                                <option value="ban&velk">Ban&Velk</option>
                                                <option value="olie">Olie</option>
                                              </select>

                                              <label>Nama Sparepart</label>
                                              <input class="form-control" type="text" name="nama_sparepart" id="nama_sparepart" required>

                                              <label>Merk Sparepart</label>
                                              <input class="form-control" type="text" name="merk" id="merk" required>

                                              <label>Tahun</label>
                                              <input class="form-control" type="number" value="<?=date('Y')?>" name="tahun" id="tahun" required>

                                              <label>Harga</label>
                                              <input class="form-control" type="number" name="harga" id="harga" required>

                                              <label>Stok</label>
                                              <input class="form-control" type="number" name="stok" id="stok" required>

                                              <label>Supplier</label>
                                              <select class="form-control" name="supplier" id="supplier" required>
                                                <option value="" selected>--- Pilih Supplier ---</option>
                                                <?php
                                                $rsupp = mysql_query("SELECT id_supplier,nama_supplier FROM supplier");
                                                while ($row = mysql_fetch_assoc($rsupp)) {
                                                  $idsupp = $row['id_supplier'];
                                                  echo "<option value='$idsupp'>$idsupp".'. '.$row['nama_supplier']."</option>";
                                                }
                                                ?>
                                              </select>

                                            </fieldset>

                                          </div>
                                        </div>
                                      </div>
                                  </div>
                                  <div class="col-sm-12">
                                  <div class="form-actions center">
                                    <input type="submit" class="btn btn-sm btn-success">
                                  </div>
                                </div>
                                </form>
                								</div>
							<!-- PAGE CONTENT SELESAI -->

<?php
include '../assets/setelah-content.php';
?>

<!-- script page -->

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

	var o = document.getElementById("sparepart");
	o.className += "active ";
	o.className += "open ";
	var z = document.getElementById("pembelian-sparepart");
	z.className += "active ";

</script>
</body>
</html>
