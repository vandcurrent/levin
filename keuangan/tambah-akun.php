<?php
include "../sesi.php";
$i ="";
$sqlselect="SELECT * FROM akun";
$qsql = mysql_query($sqlselect);
$result = mysql_fetch_array($qsql);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Tambah Akun - Levin Motor</title>

		<meta name="description" content="akun" />

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
include '../sidenav/keuangan.html';
?>
<ul class="breadcrumb">
	<li>
		<i class="ace-icon fa fa-home home-icon"></i>
		<a href="#">Akun</a>
	</li>

	<li>
		<a href="#">Data Akun</a>
	</li>
</ul><!-- /.breadcrumb -->
<?php
include '../assets/seting.html';
?>
								<!-- PAGE CONTENT MULAI -->
								<div class="page-header">
									<h1>
										Tambah Akun
										<small>
											<i class="ace-icon fa fa-angle-double-right"></i>
											Isikan Data Akun
										</small>
									</h1>
								</div><!-- /.page-header -->

								<div class="row">
									<div class="col-xs-12">
										<!-- PAGE CONTENT BEGINS -->

                    <	<table align="center">
				<form role="form" name = "dataakun"  method="POST" action="proses_akun.php">

				<div class="form-group">
					<label>

					<tr>
						<td>Kode Akun</td>
						<td><input class="form-control" type="number" min="4" name="kode_akun"  required/></td>
					</tr>

					<tr>
						<td>Nama Akun</td>
						<td><input class="form-control" type="text" name= "nama_akun" required/></td>
					</tr>


					</label>

					</div>

					<div class="panel-body">
						<div class="input-group has-feedback">
						<td>
					<button type="reset" name="reset" class="btn btn-danger" value="Reset">
											<span></span>&nbsp;&nbsp;Reset
										</button> &nbsp;&nbsp;
										<button type="submit" name="submit" class="btn btn-primary" value="submit">
											<span></span>&nbsp;&nbsp;Submit
										</button>
									</div>
					</td>


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

	var o = document.getElementById("akun");
	o.className += "active ";
	o.className += "open ";
	var z = document.getElementById("tambah-akun");
	z.className += "active ";

</script>
</body>
</html>
