<?php
include "../sesi.php";

if(!isset($_POST['bulan'])) $_POST['bulan']="";
if(!isset($_POST['tahun'])) $_POST['tahun']="";

$bulan = $_POST['bulan'];
$tahun = $_POST['tahun'];
$cari  = $bulan."-".$tahun;
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Jurnal - Levin Motor</title>

		<meta name="description" content="Dynamic tables and grids using jqGrid plugin" />

		<!-- page specific plugin styles -->
		<script type="text/javascript">
		$(document).ready(function() {
			$('#tgl').datepicker({
				numberOfMonths: 2,
				dateFormat: "mm yy",
				showButtonPanel: true
			});
		});
		</script>


<?php
include '../assets/sebelum-content.php';
include '../sidenav/keuangan.html';
?>
<ul class="breadcrumb">
	<li>
		<i class="ace-icon fa fa-file-text home-icon"></i>
		<a href="#">Laporan</a>
	</li>

	<li>
		<a href="#">Daftar Jurnal</a>
	</li>
</ul><!-- /.breadcrumb -->
<?php
include '../assets/seting.html';
?>
								<!-- PAGE CONTENT MULAI -->
                <div class="page-header">
    							<h1>
    								Jurnal
    								<small>
    									<i class="ace-icon fa fa-angle-double-right"></i>
    									Periode <?php=$bulan." ".$tahun?>
    								</small>
    							</h1>
    						</div><!-- /.page-header -->

    						<div class="row">
          <div class="col-xs-8">
        <form role="form" action="" method="POST">
          <table border="0">
            <tr>
              <th>Bulan</th>
              <td width="30" align="center"> : </td>
              <td>
                <select required name="bulan" class="form-control">
                  <option value="">----- Pilih Bulan -----</option>
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
              <td width="20">&nbsp;</td>
              <th>Tahun</th>
              <td width="30" align="center"> : </td>
              <td>
                <select required name="tahun" class="form-control">
                  <option value="">----- Pilih Tahun -----</option>
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
        </form>
    </div>
    								<!-- PAGE CONTENT BEGINS -->

    										<div class="clearfix">
    											<div class="pull-right tableTools-container"></div>
    										</div>

    										<!-- div.table-responsive -->

    										<!-- div.dataTables_borderWrap -->
    										<div>
    											<table id="dynamic-table" class="table table-striped table-bordered table-hover">
					            		<thead>
					            				<tr class="bg-primary">
                                <th width="1"></th>
						            				<th width="50" style="text-align:center;">No</th>
						            				<th width="150" style="text-align:center;">Tanggal</th>
						            				<th width="80" style="text-align:center;">Ref</th>
						            				<th width="250" style="text-align:center;">Keterangan</th>
						            				<th width="150" style="text-align:center;">Debet</th>
						            				<th width="150" style="text-align:center;">Kredit</th>                  
                                <th width="1"></th>
					            				</tr>
    												</thead>

                            <?php
                              // $query_dr = mysql_query("SELECT SUM(nominal) as nominal_dr FROM jurnal WHERE posisi_dr_cr = 'dr' AND month(tanggal_jurnal)='$bulan' and year(tanggal_jurnal)='$tahun'");
                              // $query_cr = mysql_query("SELECT SUM(nominal) as nominal_cr FROM jurnal WHERE posisi_dr_cr = 'cr' AND month(tanggal_jurnal)='$bulan' and year(tanggal_jurnal)='$tahun'");
                              // $sum_dr = mysql_fetch_array(mysql_query("SELECT SUM(nominal) as nominal_dr FROM jurnal WHERE posisi_dr_cr = 'dr' AND month(tanggal_jurnal)='$bulan' and year(tanggal_jurnal)='$tahun'"));
                              // $sum_cr = mysql_fetch_array(mysql_query("SELECT SUM(nominal) as nominal_cr FROM jurnal WHERE posisi_dr_cr = 'cr' AND month(tanggal_jurnal)='$bulan' and year(tanggal_jurnal)='$tahun' "));
                              $cbulan = "_____".$bulan."___";
                              $ctahun = $tahun."%";
                              $qcr = mysql_query("SELECT * FROM jurnal WHERE tanggal_jurnal LIKE '$cbulan' AND tanggal_jurnal LIKE '$ctahun'");
                              //$jurnal = mysql_fetch_array($qcr);

                              //echo $cbulan."+".$ctahun;

      		            				$no =1;
      		            				if(isset($_POST['go_cari']) && $_POST['go_cari']=="cari"){
      		            					while($jurnal = mysql_fetch_array($qcr)){
                                  $ak = mysql_query("SELECT nama_akun FROM akun WHERE kode_akun = '$jurnal[kode_akun]'");
                                  $akun = mysql_fetch_assoc($ak);
                                  $akun2 = $akun['nama_akun'];
      		            			?>
      		            			<tr>
                              <td></td>
      		            				<td width="50" style="text-align:center;"><?php echo $no; ?></td>
      		            				<td width="150" style="text-align:center;"><?php echo $jurnal['tanggal_jurnal']?></td>
      		            				<td width="80" style="text-align:center;"><?php echo $jurnal['kode_akun'] ?></td>
      		            				<td width="250">&nbsp;&nbsp;<?php echo $akun2; ?></td>
      		            				<?php
														   if($jurnal['posisi_dr_cr']=="dr"){
      		            				?>
      		            				<td width="250" align="right"><div style="float:left;">Rp</div><?php echo number_format($jurnal['nominal'],2,',','.'); ?></td>
                              <td></td>
      		            				<?php
      		            				}
      		            				else if($jurnal['posisi_dr_cr']=="cr"){
                              ?>
                              <td></td>
                              <td width="250" align="right"><div style="float:left;">Rp</div><?php echo number_format($jurnal['nominal'],2,',','.'); ?></td>
                              <?php
                              }
          		            		?>
                              <td></td>
      		            			</tr>
      		            			<?php
      			            				$no++;
      			            				}
      		            				}//while 1
      		            			?>
      		            		</tbody>
      		            	</table>


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
var o = document.getElementById("jurnal");
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
