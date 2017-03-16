<?php
include "../sesi.php";

$id_pel = $_GET['id'];

$result=mysql_fetch_array(mysql_query("SELECT * FROM pelanggan WHERE id_pelanggan = $id_pel"));
$cek=$id_pel;
//baca jumlah karakter
$jno=strlen($cek);
if($jno==1)
{ $no='000'; }
elseif($jno==2)
{ $no='00'; }
elseif($jno==3)
{ $no='0'; }
elseif($jno=4)
{ $no=''; }
$nonono = 'P'.date('dmy').$no.$cek;

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Daftar Perbaikan - Levin Motor</title>

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
include '../sidenav/cs.html';
?>
<ul class="breadcrumb">
	<li>
		<i class="ace-icon fa fa-male home-icon"></i>
		<a href="#">Pelanggan</a>
	</li>

	<li>
		<a href="#">Ubah Pelanggan</a>
	</li>
</ul><!-- /.breadcrumb -->
<?php
include '../assets/seting.html';
?>
								<!-- PAGE CONTENT MULAI -->
								<div class="page-header">
									<h1>
										Ubah Pelanggan
										<small>
											<i class="ace-icon fa fa-angle-double-right"></i>
											Isikan Data Pelanggan Yang Akan Diubah
										</small>
									</h1>
								</div><!-- /.page-header -->
                <div class="row">
                  <form name ="tambah-kendaraan"  method="POST" action="proses-edit-pelanggan.php">
                    <div class="col-sm-12">
                                    <div class="widget-box">
                                      <div class="widget-header">
                                        <h4 class="widget-title">Data Pelanggan</h4>
                                      </div>

                                      <div class="widget-body">
                                        <div class="widget-main no-padding">
                                            <!-- <legend>Form</legend> -->
                                            <fieldset style="padding:16px;">
                                              <label>ID pelanggan</label>
                                              <div id="input_pelanggan">
                                                <input class="form-control" type="text" name="id_pelanggan" id="id_pelanggan" readonly value="<?=$nonono;?>">
                                                <input type="hidden" name="id" value="<?=$id_pel;?>">
                                              </div>

                                              <label>Nama pelanggan</label>
                                              <input class="form-control" type="text" name="nama" id="nama_pelanggan" pattern="[A-Za-z].{2,}" value="<?=$result['nama_pelanggan']?>" required>

                                              <label>Alamat pelanggan</label>
                                              <input class="form-control" type="text" name="alamat" id="alamat_pelanggan" minlength="2" value="<?=$result['alamat_pelanggan']?>" required>

                                              <label>No.Telepon</label>
                                              <input class="form-control" type="number" name="telpon" id="telpon_pelanggan" minlength="3" value="<?=$result['telpon_pelanggan']?>" maxlength="15" required>

                                              <label>Email</label>
                                              <input class="form-control" type="email" name="email" id="email_pelanggan" value="<?=$result['email_pelanggan']?>" required>

                                            </fieldset>

                                          </div>
                                        </div>
                                      </div>
                                  </div>
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

	var o = document.getElementById("pelanggan");
	o.className += "active ";
	o.className += "open ";
	var z = document.getElementById("data-pelanggan");
	z.className += "active ";

</script>
</body>
</html>
