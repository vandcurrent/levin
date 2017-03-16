<?php
include "../sesi.php";
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Beranda - Levin Motor</title>

		<meta name="description" content="Beranda" />

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
		<a href="beranda.php">Beranda</a>
	</li>

</ul><!-- /.breadcrumb -->
<?php
include '../assets/seting.html';
?>
								<!-- PAGE CONTENT MULAI -->
								<div class="page-header">
									<h1>
										Beranda
										<small>
											<i class="ace-icon fa fa-angle-double-right"></i>
										Sistem Perhitungan Penjualan Sparepart dan Jasa Perbaikan Kendaraan
										</small>
									</h1>
								</div><!-- /.page-header -->

								<div class="row">
									<div class="col-xs-12">
										<!-- PAGE CONTENT BEGINS -->
									<div>
										<center>
										<img src="logo2.png" />
									</center>
									<br>

										CV Levin Motor Sport salah satu badan usaha yang bergerak dalam bidang jasa dan dagang
										mulai dari penjualan oli, penjualan sparepart, bentuk-bentuk variasi dan perbaikan jasa kendaraan.
										Banyak macam-macam sparepart seperti balance weight, busi, filter bensin, filter oli, filter udara dan lain-lain.
										CV Levin Motor Sport mempunyai keunggulan yang menarik dalam melayani customer dengan baik serta pengerjaannya yang rapi dan halus.
										Selain itu, CV Levin Motor Sport juga selalu mengutamakan kualitas bukan kuantitas.

									</div>
									<br>
									<center>
									<img src="bengkel.jpg" />
									<img src="bengkel7.png" />
									<img src="bengkel4.png" />
								</center>
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

	var o = document.getElementById("beranda");
	o.className += "active ";

</script>
</body>
</html>
