<?php
include "../sesi.php";

$result=mysql_fetch_array(mysql_query("SELECT id_pelanggan FROM pelanggan ORDER BY id_pelanggan DESC"));
$cek=$result['id_pelanggan']+1;
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

$qkendaraan=mysql_query("SELECT nama_kendaraan FROM kendaraan group by nama_kendaraan");
$namakendaraan = '';
$mobil = array();
while($hasilmobil = mysql_fetch_array($qkendaraan)) {
  $namamobil = $hasilmobil['nama_kendaraan'];
  $qtipe = mysql_query("SELECT * FROM kendaraan WHERE nama_kendaraan LIKE '$namamobil'");
  $namakendaraan .= '<option value="'.$hasilmobil['nama_kendaraan'].'">'.$hasilmobil['nama_kendaraan'].'</option>'."\r\n";
  $mobil[$namamobil] = '<option value="">----- Pilih Tipe Mobil -----</option>'."\r\n";
  while($hasiltipe = mysql_fetch_array($qtipe)) {
    $mobil[$namamobil] .= '<option value="'.$hasiltipe['tipe_kendaraan'].'">'.$hasiltipe['tipe_kendaraan'].'</option>'."\r\n";
  }
}

$qpelanggan=mysql_query("SELECT * FROM pelanggan");
$detailp = array();
$pelanggans = "<select class='form-control limited' name='id_pelanggan' id='id_pelanggan' onchange='detpelanggan(this.value)'>".
              "<option value=''>----- Pilih Pelanggan -----</option>";
while($baris = mysql_fetch_assoc($qpelanggan)) {
  $id = $baris['id_pelanggan'];
  $jno=strlen($id);
  if($jno==1)
  { $no='000'; }
  elseif($jno==2)
  { $no='00'; }
  elseif($jno==3)
  { $no='0'; }
  elseif($jno=4)
  { $no=''; }
  $pelanggans .= "<option value='".$id."'>".'P'.date('dmy').$no.$id.' = '.$baris['nama_pelanggan'].'</option>';
  $detailp[$id][] = $baris['nama_pelanggan'];
  $detailp[$id][] = $baris['alamat_pelanggan'];
  $detailp[$id][] = $baris['telpon_pelanggan'];
  $detailp[$id][] = $baris['email_pelanggan'];
}

?>

<!DOCTYPE html>
<html lang="en">
	<head>

  <style type="text/css">

.kotak{
  width: 397.5px;
  height: 550px;
  border: 2px solid;
  display:none;
}

.kotak2{
  width:200px;
  height: 50px;
  border: 2px solid;
  float: left;
}


</style>
<script>
function kendaraan(){
document.getElementById("kotak4").style.color = "black";
document.getElementById("kotak4").style.fontSize = 20;
document.getElementById("kotak4").style.textAlign = "left";
document.getElementById("kotak4").style.borderColor = "black";
document.getElementById("kotak").style.borderBottom = "0px";
document.getElementById("kotak").style.borderRight = "0px";
document.getElementById("kotak5").style.display = "none";
document.getElementById("kotak6").style.display = "none";
document.getElementById("kotak4").style.display = "block";
document.getElementById("kotak2").style.borderBottom = "2px solid";
document.getElementById("kotak3").style.borderBottom = "2px solid";
}

function pelanggan(){
document.getElementById("kotak5").style.color = "black";
document.getElementById("kotak5").style.fontSize = 20;
document.getElementById("kotak5").style.textAlign = "left";
document.getElementById("kotak5").style.borderColor = "black";
document.getElementById("kotak2").style.borderBottom = "0px";
document.getElementById("kotak4").style.display = "none";
document.getElementById("kotak6").style.display = "none";
document.getElementById("kotak5").style.display = "block";
document.getElementById("kotak").style.borderBottom = "2px solid";
document.getElementById("kotak3").style.borderBottom = "2px solid";
}
</script>
</head>

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
		<i class="ace-icon fa fa-cogs home-icon"></i>
		<a href="#">Perbaikan</a>
	</li>

	<li>
		<a href="#">Tambah Kendaraan</a>
	</li>
</ul><!-- /.breadcrumb -->
<?php
include '../assets/seting.html';
?>
								<!-- PAGE CONTENT MULAI -->
								<div class="page-header">
									<h1>
										Tambah Kendaraan
										<small>
											<i class="ace-icon fa fa-angle-double-right"></i>
											Isikan Data Pelanggan Dan Kendaraan Yang Akan Ditambahkan
										</small>
									</h1>
								</div><!-- /.page-header -->
                <div class="row">
                  <form name ="tambah-kendaraan"  method="POST" action="proses-pelanggan.php">
                                  <div class="col-sm-6">
                                    <div class="widget-box">
                                      <div class="widget-header">
                                        <h4 class="widget-title">Data Pelanggan</h4>
                                      </div>

                                      <div class="widget-body">
                                        <div class="widget-main no-padding">
                                            <!-- <legend>Form</legend> -->
                                            <fieldset style="padding:16px;">
                                              <script>
                                                function tipepelanggan(a) {
                                                  if (a == 'terdaftar') {
                                                    document.getElementById("input_pelanggan").innerHTML= "<?=$pelanggans?>";
                                                    document.getElementById("nama_pelanggan").readOnly = true;
                                                    document.getElementById("alamat_pelanggan").readOnly = true;
                                                    document.getElementById("telpon_pelanggan").readOnly = true;
                                                    document.getElementById("email_pelanggan").readOnly = true;
                                                  }else {
                                                    document.getElementById("input_pelanggan").innerHTML= "<input class='form-control' type='text' name='id_pelanggan' id='id_pelanggan' readonly value='<?=$nonono;?>'>";
                                                    document.getElementById("nama_pelanggan").readOnly = false;
                                                    document.getElementById("alamat_pelanggan").readOnly = false;
                                                    document.getElementById("telpon_pelanggan").readOnly = false;
                                                    document.getElementById("email_pelanggan").readOnly = false;
                                                    document.getElementById("nama_pelanggan").value = '';
                                                    document.getElementById("alamat_pelanggan").value = '';
                                                    document.getElementById("telpon_pelanggan").value = '';
                                                    document.getElementById("email_pelanggan").value = '';
                                                  }
                                                }
                                                var detailp = <?=json_encode($detailp)?>;
                                                function detpelanggan(a) {
                                                    document.getElementById("nama_pelanggan").value = detailp[a][0];
                                                    document.getElementById("alamat_pelanggan").value = detailp[a][1];
                                                    document.getElementById("telpon_pelanggan").value = detailp[a][2];
                                                    document.getElementById("email_pelanggan").value = detailp[a][3];
                                                }
                                              </script>
                                              <select class="form-control limited" name="tipe_pelanggan" onchange="tipepelanggan(this.value)">
                                               <option value="baru">Baru</option>
                                     					 <option value="terdaftar">Terdaftar</option>
                                     				  </select>

                                              <label>ID pelanggan</label>
                                              <div id="input_pelanggan">
                                                <input class="form-control" type="text" name="id_pelanggan" id="id_pelanggan" readonly value="<?=$nonono;?>">
                                              </div>

                                              <label>Nama pelanggan</label>
                                              <input class="form-control" type="text" name="nama_pelanggan" id="nama_pelanggan" pattern="[A-Za-z].{2,}" required>

                                              <label>Alamat pelanggan</label>
                                              <input class="form-control" type="text" name="alamat_pelanggan" id="alamat_pelanggan" minlength="2" required>

                                              <label>No.Telepon</label>
                                              <input class="form-control" type="number" name="telpon_pelanggan" id="telpon_pelanggan" minlength="3" maxlength="15" required>

                                              <label>Email</label>
                                              <input class="form-control" type="email" name="email_pelanggan" id="email_pelanggan" required>

                                            </fieldset>

                                          </div>
                                        </div>
                                      </div>
                                  </div>

                                  <div class="col-sm-6">
                										<div class="widget-box">
                											<div class="widget-header">
                												<h4 class="widget-title">Data Kendaraan</h4>
                											</div>

                											<div class="widget-body">
                												<div class="widget-main no-padding">
                														<!-- <legend>Form</legend> -->
                														<fieldset style="padding:16px;">
                															<label>No.polisi</label>
                															<input class="form-control limited" type="text" name="no_polisi" minlength="2" maxlength="10" required>
 
                                              <label>No. mesin</label>
                															<input class="form-control limited" type="text" name="no_mesin" minlength="9" maxlength="19" required>

                                              <label>No. rangka</label>
                															<input class="form-control limited" type="text" name="no_rangka" minlength="9" maxlength="19" required>

                                              <label>Merk Kendaraan</label>
                                              <select class="form-control limited" name="nama_kendaraan" id="nama_kendaraan" onchange="pilihantipe(this.value)" required>
                                     					 <option value="">----- Pilih Merk Mobil -----</option>
                                     					 <?=$namakendaraan?>
                                     				  </select>
                                              <script>
                                                var namamobil = <?=json_encode($mobil)?>;
                                                function pilihantipe(mobil) {
                                                    document.getElementById("tipe_kendaraan").innerHTML = namamobil[mobil];
                                                }
                                              </script>

                                              <label>Tipe Kendaraan</label>
                                              <select class="form-control limited" name="tipe_kendaraan" id="tipe_kendaraan" required>
                                      					 <option value="">----- Pilih Tipe Mobil -----</option>
                                      				 </select>

                                               <label>Transmisi</label>
                                               <select class="form-control limited" required name="transmisi" required>
                       						    					<option value="">----- Pilih Transmisi -----</option>
                       						    					<option value="manual">Manual</option>
                       						    					<option value="automatic">Automatic</option>
                       						    					<option value="triptonic">Triptonic</option>
                                               </select>

                                               <label>Tahun</label>
                                               <select class="form-control limited" required name="tahun" required>
                                        			 <option value="">----- Pilih Tahun -----</option>
                                        					<?php
                                        						    						for ($i=date('Y'); $i >= 1980 ; $i--) {
                                                                      echo "
                                        						    								<option value='".$i."'>".$i."</option>
                                        						    							";
                                        						    						}
                                        						    					?>
                                        				</select>

                                                <label>Warna</label>
                                                <input class="form-control limited" type="color" name="warna" value="#ff0000" required>

                                                <label>KM</label>
                                                <input class="form-control limited" type="number" name="KM" required>

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

	var o = document.getElementById("perbaikan");
	o.className += "active ";
	o.className += "open ";
	var z = document.getElementById("tambah-perbaikan");
	z.className += "active ";

</script>
</body>
</html>
