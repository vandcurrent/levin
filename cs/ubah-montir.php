<?php
include "../sesi.php";

$id_montir=$_GET['id_montir'];

$sqlselect="SELECT * FROM montir where id_montir='$id_montir'";
$result = mysql_query($sqlselect);
$row=mysql_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Ubah Data Montir - Levin Motor</title>

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
		<a href="#">Montir</a>
	</li>

	<li>
		<a href="#">Ubah Data Montir</a>
	</li>
</ul><!-- /.breadcrumb -->
<?php
include '../assets/seting.html';
?>
								<!-- PAGE CONTENT MULAI -->
								<div class="page-header">
									<h1>
										Data Montir
										<small>
											<i class="ace-icon fa fa-angle-double-right"></i>
										    Ubah Data Montir
										</small>
									</h1>
								</div><!-- /.page-header -->

								<div class="row">
									<div class="col-xs-12">
										<!-- PAGE CONTENT BEGINS -->
                    <form role="form" name="edit-montir" method="POST" action="proses-edit-montir.php">
<table align="center">
<div class="form-group">
    <label>
<tr>
<td>ID Montir</td>
<td><input class="form-control" type ="text" name ="id_montir" value="<?php echo $row['id_montir'];?>" readonly></td>
</tr>

<tr>
<td>Nama Montir</td>
<td><input class="form-control" type ="text" name ="nama_montir" value="<?php echo $row['nama_montir'];?>"></td>
</tr>

<tr>
<td>Alamat Montir</td>
<td><input class="form-control" type ="text" name ="alamat_montir" value="<?php echo $row['alamat_montir'];?>"></td>
</tr>

<tr>
<td>No. Telepon</td>
<td><input class="form-control" type ="text" name ="telpon_montir" value="<?php echo $row['telpon_montir'];?>"></td>
</tr>

<tr>
<td>Banyaknya</td>
<td><input class="form-control" type ="text" name ="banyak_mobil" value="<?php echo $row['banyak_mobil'];?>" readonly></td>
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
                <span></span>&nbsp;&nbsp;Reset
              </button> &nbsp;&nbsp;
              <button type="submit" name="submit" class="btn btn-primary" value="submit">
                <span></span>&nbsp;&nbsp;Submit
              </button>
            </div>
    </td>
  </tr>
</table>
</form>

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

	var o = document.getElementById("montir");
	o.className += "active ";
	o.className += "open ";
	var z = document.getElementById("data-montir");
	z.className += "active ";

</script>
</body>
</html>
