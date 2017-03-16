<?php
include "../sesi.php";
$i ="";
$sqlselect="SELECT * FROM pegawai GROUP BY id_pegawai DESC";
$qsql = mysql_query($sqlselect);
$result = mysql_fetch_array($qsql);
$cek=$result['id_pegawai']+1;
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
$nonono = ('PG').$no.$cek;
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Tambah Pelanggan - Levin Motor</title>

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
		<i class="ace-icon fa fa-home home-icon"></i>
		<a href="#">Pelanggan</a>
	</li>

	<li>
		<a href="#">Input Pelanggan</a>
	</li>
</ul><!-- /.breadcrumb -->
<?php
include '../assets/seting.html';
?>
								<!-- PAGE CONTENT MULAI -->
								<div class="page-header">
									<h1>
										Tambah PElanggan
										<small>
											<i class="ace-icon fa fa-angle-double-right"></i>
											Isikan Data Pelanggan
										</small>
									</h1>
								</div><!-- /.page-header -->

								<div class="row">
									<div class="col-xs-12">
										<!-- PAGE CONTENT BEGINS -->

                    <table align="center">
                    				<form role="form" name = "data_pegawai"  method="POST" action="proses-tambah-pelanggan.php">

                    				<div class="form-group">
                    				<label>
                    					<tr>
                    						<td>Nama Pelanggan</td>
                    						<td><input class="form-control" type="text" name="nama" pattern="[A-Za-z].{2,}" required/></td>
                    					</tr>

                    					<tr>
                    						<td>Alamat Pelanggan</td>
                    						<td><input class="form-control" type="text" name="alamat" required/></td>
                    					</tr>


                    					<tr>
                    						<td>No.Telepon</td>
                    						<td><input class="form-control" type="number" name="telpon" minlength="5" maxlength="15" required/></td>
                    					</tr>


                    					<tr>
                    						<td>Email</td>
                    						<td><input class="form-control" type="text" name="email" minlength="2" maxlength="35" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required/></td>
                    					</tr>
                    					</label>
                    					</div>


                    					<div class="panel-body">


                    						<div class="input-group has-feedback">

                    					<tr><tr>

                    					<tr></tr>

                    					<tr>
                    						<td>

                    					<button type="reset" name="reset" class="btn btn-danger" value="Reset">
                    											<span></span>Reset
                    										</button> &nbsp;&nbsp;
                    										<button type="submit" name="submit" class="btn btn-primary" value="submit">
                    											<span></span>Submit
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
	var z = document.getElementById("tambah-pelanggan");
	z.className += "active ";
</script>
</body>
</html>
