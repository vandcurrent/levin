<?php
include "../sesi.php";

$id_pegawai=$_GET['id'];

$sqlselect="SELECT * FROM pegawai where id_pegawai='$id_pegawai'";
	$result = mysql_query($sqlselect);
	$row=mysql_fetch_array($result);
	$cek=$row['id_pegawai'];
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
		<title>Ubah Data Pegawai - Levin Motor</title>

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
if ($bagian == 'Customer Service') {
	$nav = include '../sidenav/cs.html';
}else
if($bagian == 'Gudang'){
	$nav = include '../sidenav/gudang.html';
}else
if($bagian == 'Keuangan'){
	$nav = include '../sidenav/keuangan.html';
}else
if($bagian == 'Kasir'){
	$nav = include '../sidenav/kasir.html';
}
?>
<ul class="breadcrumb">
	<li>
		<i class="ace-icon fa fa-home home-icon"></i>
		<a href="#">Pegawai</a>
	</li>

	<li>
		<a href="#">Ubah Data Pegawai</a>
	</li>
</ul><!-- /.breadcrumb -->
<?php
include '../assets/seting.html';
?>
								<!-- PAGE CONTENT MULAI -->
								<div class="page-header">
									<h1>
										Data Pegawai
										<small>
											<i class="ace-icon fa fa-angle-double-right"></i>
										    Ubah Data pegawai
										</small>
									</h1>
								</div><!-- /.page-header -->

								<div class="row">
									<div class="col-xs-12">
										<!-- PAGE CONTENT BEGINS -->
                    <form role="form" name="proses-edit-pegawai" method="POST" action="proses-edit-pegawai.php">
  <table align="center">

  	<tr>
  	<td>ID Pegawai</td>
  		<td><input class="form-control" type ="text" name ="id" value="<?=$nonono?>" readonly><input type="hidden" value="<?=$row['id_pegawai'];?>" name="id_pegawai"></td>
  	</tr>

  	<tr>
  	<td>Nama Pegawai</td>
  		<td><input class="form-control" type ="text" name ="nama_pegawai" value="<?php echo $row['nama_pegawai'];?>"></td>
  	</tr>

  	<tr>
  	<td>Alamat pegawai</td>
  		<td><input class="form-control" type ="text" name ="alamat_pegawai" value="<?php echo $row['alamat_pegawai'];?>"></td>
  	</tr>

  	<tr>

  	<td>No. Telepon</td>
  		<td><input class="form-control" type ="text" name ="telpon_pegawai" value="<?php echo $row['telpon_pegawai'];?>"></td>
  	</tr>

  					</tr>
  					</label>
  					</div>


  					<div class="panel-body">


  						<div class="input-group has-feedback">

  					<tr><tr>

  					<tr></tr>

  					<tr>
  						<td>

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
	var z = document.getElementById("data-pegawai");
	z.className += "active ";

</script>
</body>
</html>
