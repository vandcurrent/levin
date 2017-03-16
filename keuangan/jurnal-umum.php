<?php
include "../sesi.php";
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Jurnal Umum - Levin Motor</title>

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
include '../sidenav/keuangan.html';
?>
<ul class="breadcrumb">
	<li>
		<i class="ace-icon fa fa-home home-icon"></i>
		<a href="#">Laporan</a>
	</li>

	<li>
		<a href="#">Jurnal Umum</a>
	</li>
</ul><!-- /.breadcrumb -->
<?php
include '../assets/seting.html';
?>
								<!-- PAGE CONTENT MULAI -->
								<div class="page-header">
									<h1>
										Input Jurnal
										<small>
											<i class="ace-icon fa fa-angle-double-right"></i>
											Isikan Data Pengeluaran Operasional
										</small>
									</h1>
								</div><!-- /.page-header -->

								<div class="row">
									<div class="col-xs-12">
										<!-- PAGE CONTENT BEGINS -->

                    <table align="center">
                    				<form role="form" name = "jurnal_umum"  method="POST" action="proses-jurnal.php">

                    				<div class="form-group">
                    				<label>
                    					<tr>
                    						<td>Tanggal</td>
                    						<td><input class="form-control" type="date" format name="tanggal" required/></td>
                    					</tr>
                                             <tr>
                                                  <td>Nama Akun Kredit</td>
                                                  <td>
                                                       <select class="form-control" name="akun_cr">
                                                            <option>Pilih Akun</option>
                                                            <option value="600">Biaya Gaji</option>
                                                            <option value="610">Biaya Listrik</option>
                                                            <option value="620">Biaya Telepon dan Internet</option>
                                                            <option value="630">Biaya Peralatan</option>
                                                       </select>
                                                  </td>
                                             </tr>
                    					<tr>
                                                  <td>Nama Akun Debit</td>
                                                  <td>
                                                       <select class="form-control" name="akun_dr">
                                                            <option>Pilih Akun</option>
                                                            <option value="100">Kas</option>
                                                            <option value="200">Hutang</option>
                                                       </select>
                                                  </td>
                                             </tr>
                                             <!--
                                             <tr>
                                                  <td>Keterangan</td>
                                                  <td><input type="text" name="keterangan" class="form-control" required></td>
                                             </tr>
                                             -->
                                             <tr>
                                                  <td>Biaya</td>
                                                  <td><input type="number" step="1000" name="biaya" class="form-control" required></td>
                                             </tr>
                                             <tr><td>&nbsp;</td><td></td></tr>
                                             <tr>
                                                  <td></td>
                                                  <td><button type="reset" name="reset" class="btn btn-danger" value="Reset">
                                                                           <span></span>Reset
                                                                      </button> &nbsp;&nbsp;
                                                                      <button type="submit" name="submit" class="btn btn-primary" value="submit">
                                                                           <span></span>Submit
                                                                      </button>
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

	var o = document.getElementById("laporan");
	o.className += "active ";
	o.className += "open ";
	var z = document.getElementById("jurnam-umum");
	z.className += "active ";

</script>
</body>
</html>
