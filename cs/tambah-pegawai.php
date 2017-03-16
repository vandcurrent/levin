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
		<title>Tambah Pegawai - Levin Motor</title>

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
		<a href="#">Pegawai</a>
	</li>

	<li>
		<a href="#">Data Pegawai</a>
	</li>
</ul><!-- /.breadcrumb -->
<?php
include '../assets/seting.html';
?>
								<!-- PAGE CONTENT MULAI -->
								<div class="page-header">
									<h1>
										Tambah Pegawai
										<small>
											<i class="ace-icon fa fa-angle-double-right"></i>
											Isikan Data pegawai
										</small>
									</h1>
								</div><!-- /.page-header -->

								<div class="row">
									<div class="col-xs-12">
										<!-- PAGE CONTENT BEGINS -->

                    <table align="center">
                    				<form role="form" name = "data_pegawai"  method="POST" action="proses-pegawai.php">

                    				<div class="form-group">
                    				<label>
                    					<tr>
                    						<td>ID pegawai</td>
                    						<td><input class="form-control" type="text" name="id_pegawai" readonly value="<?=$nonono;?>"  required/></td>
                    					</tr>

                    					<tr>
                    						<td>Nama Pegawai</td>
                    						<td><input class="form-control" type="text" name="nama_pegawai" pattern="[A-Za-z].{2,}" required/></td>
                    					</tr>

                    					<tr>
                    						<td>Alamat Pegawai</td>
                    						<td><input class="form-control" type="text" name="alamat_pegawai" required/></td>
                    					</tr>


                    					<tr>
                    						<td>No.Telepon</td>
                    						<td><input class="form-control" type="number" name="telpon_pegawai" minlength="5" maxlength="15" required/></td>
                    					</tr>


                    					<tr>
                    						<td>Username</td>
                    						<td><input class="form-control" type="text" name="username" minlength="2" maxlength="30" required/></td>
                    					</tr>

                    					<tr>
                    						<td>Password</td>
                    						<td><input class="form-control" type="password" name="password" required/></td>
                    					</tr>

                    					<tr>
                    						<td>Level</td>
                    						<td>
                    						    				<select class="form-control" required name="level">
                    						    					<option value="">----- Pilih Level -----</option>
                    						    					<option value="01">CS</option>
                    						    					<option value="02">GUDANG</option>
                    						    					<option value="03">KEUANGAN</option>
                    												<option value="04">KASIR</option>
                    										</td>
                    					</tr>

                    					<tr>
                    						<td>Status</td>
                    						<td><input  type ="radio" name= "status" value="aktif" checked>aktif</td>
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

	var o = document.getElementById("pegawai");
	o.className += "active ";
	o.className += "open ";
	var z = document.getElementById("tambah-pegawai");
	z.className += "active ";

</script>
</body>
</html>
