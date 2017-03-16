<?php
include "../sesi.php";

$query = mysql_query("SELECT * FROM akun");

if(!isset($_POST['pilih_akun'])) $_POST['pilih_akun']="";
if(!isset($_POST['bulan'])) $_POST['bulan']="";
if(!isset($_POST['tahun'])) $_POST['tahun']="";

	$pilih_akun = $_POST['pilih_akun'];
	$bulan = $_POST['bulan'];
	$tahun = $_POST['tahun'];
	$cari  = $bulan."-".$tahun;

	$search = mysql_query("SELECT * FROM jurnal INNER JOIN akun ON jurnal.kode_akun = akun.kode_akun WHERE jurnal.kode_akun = '$pilih_akun' AND month(jurnal.tanggal_jurnal) = '$bulan' AND year(jurnal.tanggal_jurnal) = '$tahun' ");
	$akun = mysql_fetch_array(mysql_query("SELECT * FROM jurnal INNER JOIN akun ON jurnal.kode_akun = akun.kode_akun WHERE jurnal.kode_akun = '$pilih_akun'"));
  $cakun = $akun['kode_akun'];

	$saldo_debet  = 0;
	$saldo_kredit = 0;
	$saldo_awal   = 0;
  $bulanf = $bulan - 1;
$q="SELECT * FROM jurnal JOIN akun ON jurnal.kode_akun = akun.kode_akun WHERE jurnal.kode_akun = '$pilih_akun' AND month(jurnal.tanggal_jurnal) = '$bulanf' AND year(jurnal.tanggal_jurnal) = '$tahun'";
	$sql_saldo = mysql_query($q);
	while ($data_saldo = mysql_fetch_array($sql_saldo)) {
		if ($data_saldo['posisi_dr_cr']=="dr") {
			$saldo_debet = $saldo_debet + $data_saldo['nominal'];
		}elseif($data_saldo['posisi_dr_cr']=="cr"){
			$saldo_kredit = $saldo_kredit + $data_saldo['nominal'];
		}
	}
	$saldo_awal = $saldo_debet - $saldo_kredit;
  // echo $saldo_awal;
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Buku Besar - Levin Motor</title>

    <script type="text/javascript">
    $(document).ready(function() {
      $('#tgl').datepicker({
        numberOfMonths: 2,
        dateFormat: "mm yy",
        showButtonPanel: true
      });
    });
  </script>

		<meta name="description" content="Dynamic tables and grids using jqGrid plugin" />

		<!-- page specific plugin styles -->

<?php
include '../assets/sebelum-content.php';
include '../sidenav/keuangan.html';
?>
<ul class="breadcrumb">
	<li>
		<i class="ace-icon fa fa-male home-icon"></i>
		<a href="#">Jurnal</a>
	</li>

	<li>
		<a href="#">Jurnal</a>
	</li>
</ul><!-- /.breadcrumb -->
<?php
include '../assets/seting.html';
?>
								<!-- PAGE CONTENT MULAI -->
                <div class="page-header">
    							<h1>
    								Buku Besar
    								<small>
    									<i class="ace-icon fa fa-angle-double-right"></i>
    									Buku Besar
    								</small>
    							</h1>
    						</div><!-- /.page-header -->

    						<div class="row">
          <div class="col-xs-8">

    </div>
    								<!-- PAGE CONTENT BEGINS -->

                    <form class="form" action="" method="POST">
          <table border="0" style="height:100px;">
            <tr>
              <th>Akun</th>
              <td width="30"> : </td>
              <td>
                  <select required name="pilih_akun" id="akun" class="form-control">
                    <option value="">-- Pilih Akun --</option>
                    <?php
                      while ($data_akun = mysql_fetch_array($query)) {
                        echo "
                          <option value='$data_akun[kode_akun]'>$data_akun[nama_akun]</option>
                        ";
                      }
                    ?>
                  </select>
              </td>
            </tr>
            <tr>
              <th>Pilih Tanggal</th>
              <td width="30"> : </td>
              <td>
                <select required name="bulan" class="form-control">
                    <option value="">-- Pilih Bulan --</option>
                    <option value="01">Januari</option>
                    <option value="02">Februari</option>
                    <option value="03">Maret</option>
                    <option value="04">April</option>
                    <option value="05">Mei</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">Agustus</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                  </select>
                </td>

                <td width="20" align="center">&nbsp;</td>
                <td>
                  <select required name="tahun" class="form-control">
                    <option value="">-- Pilih Tahun --</option>
                    <?php
                      for ($i=2012; $i <= date('Y') ; $i++) {
                        echo "
                          <option value='".$i."'>".$i."</option>
                        ";
                      }
                    ?>
                  </select>
                </td>
                <td>&nbsp;</td>
                <td>
                  <button name="go_cari" value="cari" class="btn btn-info">
                    <span class="glyphicon glyphicon-search"></span> Cari
                </button>
                </td>
            </tr>
          </table>

        </form> <br /><br />
        <h3 align="center">CV Levin Motor Sport</h3>
        <h4 align="center">Buku Besar <?php echo $akun['nama_akun']; ?></h4>
        <h5 align="center">Periode <?php echo $bulan." ".$tahun; ?></h5> <hr style="width:700px;" />
        <?php
          if(isset($_POST['go_cari']) && $_POST['go_cari']=="cari"){
        ?>
        <table id="simple-table" class="table table-striped table-bordered table-hover" align="center">
          <thead>
            <tr>
              <th>Kode Akun : <?php echo $akun['kode_akun']; ?></th>
              <th colspan="5"></th>
              <th>Nama Akun : <?php echo $akun['nama_akun']; ?></th>
            </tr>
            <tr align="right">
              <th rowspan="2" width="120" style="text-align:center;">Tanggal</th>
              <th rowspan="2" width="200" style="text-align:center;">Keterangan</th>
              <th rowspan="2" width="80" style="text-align:center;">Ref</th>
              <th rowspan="2" width="150" style="text-align:center;">Debet</th>
              <th rowspan="2" width="150" style="text-align:center;">Kredit</th>
              <th colspan="2" align="center">Saldo</th>
            </tr>
            <tr>
              <th width="150">Debet</th>
              <th width="150">Kredit</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td colspan="3"></td>
              <td colspan="2" align="center">Saldo Awal</td>
                <?php
                  if ($cakun == 100 || $cakun == 110 || $cakun == 120 || $cakun == 130 || $cakun == 500 || $cakun == 600 || $cakun == 610 || $cakun == 620 || $cakun == 630 || $cakun == 310 || $cakun == 250){
                    if (saldo_awal < 0)
                    {
                      ?>
                        <td></td>
                        <td align="right">( <?php echo "Rp&nbsp;". number_format(($saldo_awal * (-1)),2,',','.'); ?> )</td>
                      <?php
                    }
                    else
                    {
                      ?>
                        <td align="right"><?php echo "Rp&nbsp;". number_format($saldo_awal,2,',','.'); ?></td>
                        <td></td>
                      <?php
                    }
                  }
                  else if($cakun == 200 || $cakun == 300 || $cakun == 400 || $cakun == 410 || $cakun == 520 || $cakun == 250){
                    if (saldo_awal < 0)
                    {
                      ?>
                        <td></td>
                        <td align="right">( <?php echo "Rp&nbsp;". number_format(($saldo_awal * (-1)),2,',','.'); ?> )</td>
                      <?php
                    }
                    else
                    {
                      ?>
                        <td align="right"><?php echo "Rp&nbsp;". number_format($saldo_awal,2,',','.'); ?></td>
                        <td></td>
                      <?php
                    }
                  }

                  
                ?>
              </td>
            </tr>
            <?php
            $itung = $saldo_awal;
            $titung = 0;
            while($data = mysql_fetch_array($search)){
            if ($cakun == 100 || $cakun == 110 || $cakun == 120 || $cakun == 130 || $cakun == 500 || $cakun == 600 || $cakun == 610 || $cakun == 620 || $cakun == 630 || $cakun == 310 || $cakun == 250){
            ?>
            <tr>
              <td width="120"><?php echo $data['tanggal_jurnal']; ?></td>
              <td width="200"><?php echo $data['nama_akun']; ?></td>
              <td width="80">JU-1</td>
              <?php
                if($data['posisi_dr_cr']=="dr"){
              ?>
              <td width="150" style="text-align:right;"><?php echo "Rp&nbsp;". number_format($data['nominal'],2,',','.'); ?></td>
              <td align="center">-</td>
              <?php
              $itung = $itung + $data['nominal'];
                }else if($data['posisi_dr_cr']=="cr"){
              ?>
              <td align="center">-</td>
              <td width="150" style="text-align:right;"><?php echo "Rp&nbsp;". number_format($data['nominal'],2,',','.'); ?></td>
              <?php
              $itung = $itung - $data['nominal'];
              }
              if($itung < 0)
              {
                $nm = $itung *(-1);
                ?>
                <td align="center">-</td>
                <td width="180" style="text-align:right;"><?php echo "Rp&nbsp;". number_format($nm,2,',','.'); ?></td>
              <?php
              }
              else{
              ?>
                <td width="180" style="text-align:right;"><?php echo "Rp&nbsp;". number_format($itung,2,',','.'); ?></td>
                <td align="center">-</td>
              <?php
              }
            ?>
            </tr>
            <?php
            }
            else if($cakun == 200 || $cakun == 300 || $cakun == 400 || $cakun == 410 || $cakun == 520 || $cakun == 250){
            ?>
            <tr>
              <td width="120"><?php echo $data['tanggal_jurnal']; ?></td>
              <td width="200"><?php echo $data['nama_akun']; ?></td>
              <td width="80">JU-1</td>
              <?php
                if($data['posisi_dr_cr']=="dr"){
              ?>
              <td width="150" style="text-align:right;"><?php echo "Rp&nbsp;". number_format($data['nominal'],2,',','.'); ?></td>
              <td align="center">-</td>
              <?php
              $itung = $itung - $data['nominal'];
                }else if($data['posisi_dr_cr']=="cr"){
              ?>
              <td align="center">-</td>
              <td width="150" style="text-align:right;"><?php echo "Rp&nbsp;". number_format($data['nominal'],2,',','.'); ?></td>
              <?php
              $itung = $itung + $data['nominal'];
              }
              if($itung < 0)
              {
                $nm = $itung *(-1);
                ?>
                <td width="180" style="text-align:right;"><?php echo "Rp&nbsp;". number_format($nm,2,',','.'); ?></td>
                <td align="center">-</td>
              <?php
              }
              else{
              ?>
                <td align="center">-</td>
                <td width="180" style="text-align:right;"><?php echo "Rp&nbsp;". number_format($itung,2,',','.'); ?></td>
              <?php
              }
            ?>
            </tr> 
            <?php
            }
          }
            ?>
          </tbody>
        </table>
        <?php
          }
        ?>

    								</div><!-- PAGE CONTENT ENDS -->
    							</div><!-- /.col -->
    						</div><!-- /.row -->
								<!-- PAGE CONTENT SELESAI -->

<?php
include '../assets/setelah-content.php';

?>

<!-- script page -->
<script src="../assets/js/jquery.dataTables.min.js"></script>
<script src="../assets/js/jquery.dataTables.bootstrap.min.js"></script>
<script src="../assets/js/dataTables.tableTools.min.js"></script>
<script src="../assets/js/dataTables.colVis.min.js"></script>

<!-- inline scripts page -->
<script type="text/javascript">

var o = document.getElementById("laporan");
o.className += "active ";
o.className += "open ";
var o = document.getElementById("buku-besar");
o.className += "active ";

jQuery(function($) {
  //initiate dataTables plugin
  var oTable1 =
  $('#dynamic-table')
  //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
  .dataTable( {
    bAutoWidth: false,
    "aoColumns": [
      { "bSortable": false },
      null, null,null, null, null,
      { "bSortable": false }
    ],
    "aaSorting": [],

    //,
    //"sScrollY": "200px",
    //"bPaginate": false,

    //"sScrollX": "100%",
    //"sScrollXInner": "120%",
    //"bScrollCollapse": true,
    //Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
    //you may want to wrap the table inside a "div.dataTables_borderWrap" element

    //"iDisplayLength": 50
    } );
  //oTable1.fnAdjustColumnSizing();


  //TableTools settings
  TableTools.classes.container = "btn-group btn-overlap";
  TableTools.classes.print = {
    "body": "DTTT_Print",
    "info": "tableTools-alert gritter-item-wrapper gritter-info gritter-center white",
    "message": "tableTools-print-navbar"
  }

  //initiate TableTools extension
  var tableTools_obj = new $.fn.dataTable.TableTools( oTable1, {
    "sSwfPath": "../assets/swf/copy_csv_xls_pdf.swf",

    "sRowSelector": "td:not(:last-child)",
    "sRowSelect": "multi",
    "fnRowSelected": function(row) {
      //check checkbox when row is selected
      try { $(row).find('input[type=checkbox]').get(0).checked = true }
      catch(e) {}
    },
    "fnRowDeselected": function(row) {
      //uncheck checkbox
      try { $(row).find('input[type=checkbox]').get(0).checked = false }
      catch(e) {}
    },

    "sSelectedClass": "success",
        "aButtons": [
      {
        "sExtends": "copy",
        "sToolTip": "Copy to clipboard",
        "sButtonClass": "btn btn-white btn-primary btn-bold",
        "sButtonText": "<i class='fa fa-copy bigger-110 pink'></i>",
        "fnComplete": function() {
          this.fnInfo( '<h3 class="no-margin-top smaller">Table copied</h3>\
            <p>Copied '+(oTable1.fnSettings().fnRecordsTotal())+' row(s) to the clipboard.</p>',
            1500
          );
        }
      },

      {
        "sExtends": "csv",
        "sToolTip": "Export to CSV",
        "sButtonClass": "btn btn-white btn-primary  btn-bold",
        "sButtonText": "<i class='fa fa-file-excel-o bigger-110 green'></i>"
      },

      {
        "sExtends": "pdf",
        "sToolTip": "Export to PDF",
        "sButtonClass": "btn btn-white btn-primary  btn-bold",
        "sButtonText": "<i class='fa fa-file-pdf-o bigger-110 red'></i>"
      },

      {
        "sExtends": "print",
        "sToolTip": "Print view",
        "sButtonClass": "btn btn-white btn-primary  btn-bold",
        "sButtonText": "<i class='fa fa-print bigger-110 grey'></i>",

        "sMessage": "<div class='navbar navbar-default'><div class='navbar-header pull-left'><a class='navbar-brand' href='#'><small>Optional Navbar &amp; Text</small></a></div></div>",

        "sInfo": "<h3 class='no-margin-top'>Print view</h3>\
              <p>Please use your browser's print function to\
              print this table.\
              <br />Press <b>escape</b> when finished.</p>",
      }
        ]
    } );
  //we put a container before our table and append TableTools element to it
    $(tableTools_obj.fnContainer()).appendTo($('.tableTools-container'));

  //also add tooltips to table tools buttons
  //addding tooltips directly to "A" buttons results in buttons disappearing (weired! don't know why!)
  //so we add tooltips to the "DIV" child after it becomes inserted
  //flash objects inside table tools buttons are inserted with some delay (100ms) (for some reason)
  setTimeout(function() {
    $(tableTools_obj.fnContainer()).find('a.DTTT_button').each(function() {
      var div = $(this).find('> div');
      if(div.length > 0) div.tooltip({container: 'body'});
      else $(this).tooltip({container: 'body'});
    });
  }, 200);



  //ColVis extension
  var colvis = new $.fn.dataTable.ColVis( oTable1, {
    "buttonText": "<i class='fa fa-search'></i>",
    "aiExclude": [0, 6],
    "bShowAll": true,
    //"bRestore": true,
    "sAlign": "right",
    "fnLabel": function(i, title, th) {
      return $(th).text();//remove icons, etc
    }

  });

  //style it
  $(colvis.button()).addClass('btn-group').find('button').addClass('btn btn-white btn-info btn-bold')

  //and append it to our table tools btn-group, also add tooltip
  $(colvis.button())
  .prependTo('.tableTools-container .btn-group')
  .attr('title', 'Show/hide columns').tooltip({container: 'body'});

  //and make the list, buttons and checkboxed Ace-like
  $(colvis.dom.collection)
  .addClass('dropdown-menu dropdown-light dropdown-caret dropdown-caret-right')
  .find('li').wrapInner('<a href="javascript:void(0)" />') //'A' tag is required for better styling
  .find('input[type=checkbox]').addClass('ace').next().addClass('lbl padding-8');



  /////////////////////////////////
  //table checkboxes
  $('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);

  //select/deselect all rows according to table header checkbox
  $('#dynamic-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
    var th_checked = this.checked;//checkbox inside "TH" table header

    $(this).closest('table').find('tbody > tr').each(function(){
      var row = this;
      if(th_checked) tableTools_obj.fnSelect(row);
      else tableTools_obj.fnDeselect(row);
    });
  });

  //select/deselect a row when the checkbox is checked/unchecked
  $('#dynamic-table').on('click', 'td input[type=checkbox]' , function(){
    var row = $(this).closest('tr').get(0);
    if(!this.checked) tableTools_obj.fnSelect(row);
    else tableTools_obj.fnDeselect($(this).closest('tr').get(0));
  });




    $(document).on('click', '#dynamic-table .dropdown-toggle', function(e) {
    e.stopImmediatePropagation();
    e.stopPropagation();
    e.preventDefault();
  });


  //And for the first simple table, which doesn't have TableTools or dataTables
  //select/deselect all rows according to table header checkbox
  var active_class = 'active';
  $('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
    var th_checked = this.checked;//checkbox inside "TH" table header

    $(this).closest('table').find('tbody > tr').each(function(){
      var row = this;
      if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
      else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
    });
  });

  //select/deselect a row when the checkbox is checked/unchecked
  $('#simple-table').on('click', 'td input[type=checkbox]' , function(){
    var $row = $(this).closest('tr');
    if(this.checked) $row.addClass(active_class);
    else $row.removeClass(active_class);
  });



  /********************************/
  //add tooltip for small view action buttons in dropdown menu
  $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});

  //tooltip placement on right or left
  function tooltip_placement(context, source) {
    var $source = $(source);
    var $parent = $source.closest('table')
    var off1 = $parent.offset();
    var w1 = $parent.width();

    var off2 = $source.offset();
    //var w2 = $source.width();

    if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
    return 'left';
  }

})
</script>
</body>
</html>
