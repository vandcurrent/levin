<?php
include "../sesi.php";
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Statistik Penjualan - Levin Motor</title>

		<meta name="description" content="Beranda" />

		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="../assets/css/jquery-ui.custom.min.css" />
		<link rel="stylesheet" href="../assets/css/chosen.min.css" />
		<link rel="stylesheet" href="../assets/css/datepicker.min.css" />
		<link rel="stylesheet" href="../assets/css/bootstrap-timepicker.min.css" />
		<link rel="stylesheet" href="../assets/css/daterangepicker.min.css" />
		<link rel="stylesheet" href="../assets/css/bootstrap-datetimepicker.min.css" />
		<link rel="stylesheet" href="../assets/css/colorpicker.min.css" />

		<link href="../assets/css/xcharts.min.css" rel="stylesheet">
		<link href="../assets/css/style.css" rel="stylesheet">

		<!-- Include bootstrap css -->
		<link href="../assets/css/daterangepicker.css" rel="stylesheet">
		<link href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.2.2/css/bootstrap.min.css" rel="stylesheet" />

    </head>
    <body>

			    <?php
			include '../assets/sebelum-content.php';
			include '../sidenav/pemilik.html';
			?>

								<div class="page-header">
									<h1>
										Statistik
										<small>
											<i class="ace-icon fa fa-angle-double-right"></i>
											Statistik Penjualan
										</small>
									</h1>
								</div><!-- /.page-header -->
		<div id="content">

			<form class="form-horizontal">
			  <fieldset>
		        <div class="input-prepend">
		          <span class="add-on"><i class="icon-calendar"></i></span><input type="text" name="range" id="range" />
		        </div>
			  </fieldset>
			</form>

			<div id="placeholder">
				<figure id="chart"></figure>
			</div>

		</div>

		<?php
		include '../assets/setelah-content.php';
		?>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

		<!-- xcharts includes -->
		<script src="//cdnjs.cloudflare.com/ajax/libs/d3/2.10.0/d3.v2.js"></script>
		<script src="../assets/js/xcharts.min.js"></script>

		<!-- The daterange picker bootstrap plugin -->
		<script src="../assets/js/sugar.min.js"></script>
		<script src="../assets/js/daterangepicker.js"></script>

		<!-- Our main script file -->
		<script src="../assets/js/script.js"></script>

		<!-- BSA AdPacks code. Please ignore and remove.-->
        <script src="http://cdn.tutorialzine.com/misc/adPacks/v1.js" async></script>
    </body>
</html>
<?php

// Set up the ORM library
require_once('graph-conn.php');

try{
	// Insert records for the last 30 days for demo purposes.
	// Delete this block if you want to disable this functionality.

	for($i = 0; $i < 30; $i++){
		$sales = ORM::for_table('penjualan')->create();
		$sales->date = date('Y-m-d', time() - $i*24*60*60);
		$sales->sales_order = rand(0, 100);
		$sales->save();
	}

}
catch(PDOException $e){}

?>
