<?php
include "../sesi.php";


if(!isset($_POST['bulan'])) $_POST['bulan']="";
if(!isset($_POST['tahun'])) $_POST['tahun']="";

$bulan      = $_POST['bulan'];
$tahun      = $_POST['tahun'];

$tgl_cari   = $tahun."-".$bulan;
// $sum_penjualan    = mysql_fetch_array(mysql_query("SELECT SUM(nominal) as penjualan FROM jurnal WHERE kode_akun = '4100' AND tanggal_jurnal LIKE '%$tgl_cari%' "));
// $sum_pembelian     = mysql_fetch_array(mysql_query("SELECT SUM(nominal) as pembelian FROM jurnal WHERE kode_akun = '5100' AND tanggal_jurnal LIKE '%$tgl_cari%' "));
$sum_penjualan = mysql_fetch_array(mysql_query("SELECT SUM(nominal) as penjualan FROM jurnal WHERE kode_akun = '400' AND tanggal_jurnal LIKE '%$tgl_cari%'"));
$sum_hpp = mysql_fetch_array(mysql_query("SELECT SUM(nominal) as hpp FROM jurnal WHERE kode_akun = '500' AND tanggal_jurnal LIKE '%$tgl_cari%'"));
$sum_listrik = mysql_fetch_array(mysql_query("SELECT SUM(nominal) as listrik FROM jurnal WHERE kode_akun = '610' AND tanggal_jurnal LIKE '%$tgl_cari%'"));
$sum_telpon = mysql_fetch_array(mysql_query("SELECT SUM(nominal) as telpon FROM jurnal WHERE kode_akun = '620' AND tanggal_jurnal LIKE '%$tgl_cari%'"));
$sum_peralatan = mysql_fetch_array(mysql_query("SELECT SUM(nominal) as peralatan FROM jurnal WHERE kode_akun = '630' AND tanggal_jurnal LIKE '%$tgl_cari%'"));
$sum_gj = mysql_fetch_array(mysql_query("SELECT SUM(nominal) as gj FROM jurnal WHERE kode_akun = '600' AND tanggal_jurnal LIKE '%$tgl_cari%'"));
$sum_pen = mysql_fetch_array(mysql_query("SELECT SUM(nominal) as pendapatan FROM jurnal WHERE kode_akun = '410' AND tanggal_jurnal LIKE '%$tgl_cari%'"));
// echo $sum_pendapatan['pendapatan'];

$result1=mysql_query("SELECT SUM(total_bayar) as total_bayar FROM beban_operasional WHERE tanggal_operasional LIKE '%$tgl_cari%' ");
echo mysql_error($conn);
$sum_biaya_usaha = mysql_fetch_array($result1);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>Laporan Laba Rugi - Levin Motor</title>

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
include '../sidenav/pemilik.html';
?>
<ul class="breadcrumb">
  <li>
    <i class="ace-icon fa fa-male home-icon"></i>
    <a href="#">Laporan Laba Rugi</a>
  </li>

  <li>
    <a href="#">Laporan Laba Rugi</a>
  </li>
</ul><!-- /.breadcrumb -->
<?php
include '../assets/seting.html';
?>
                <!-- PAGE CONTENT MULAI -->
                <div class="page-header">
                  <h1>
                    Laporan Laba Rugi
                    <small>
                      <i class="ace-icon fa fa-angle-double-right"></i>
                      Laporan Laba Rugi
                    </small>
                  </h1>
                </div><!-- /.page-header -->

                <div class="row">
          <div class="col-xs-8">

    </div>
                    <!-- PAGE CONTENT BEGINS -->

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
                            for ($i=2012; $i <= date('Y'); $i++) {
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
                    <h3 align="center">CV Levin Motor Sport</h3>
              <h4 align="center">Laporan Labar Rugi</h4>
              <h5 align="center">Periode <?php echo $tgl_cari;  ?></h5> <hr style="width:700px;" />
               <?php
                        if(isset($_POST['go_cari']) && $_POST['go_cari']=="cari"){
                      ?>
                      <table class="table table-bordered table-hover">
                        <tr>
                          <th width="800">Penjualan</th>
                          <td align="right">
                            <div style="float:left;">Rp</div>
                            <?php echo number_format($sum_penjualan['penjualan'],2,',','.'); ?>&nbsp;&nbsp;&nbsp;
                          </td>
                        </tr>
                        <tr>
                        <tr>
                          <th width="800">Pendapatan</th>
                          <td align="right">
                            <div style="float:left;">Rp</div>
                            <?php echo number_format($sum_pen['pendapatan'],2,',','.'); ?>&nbsp;&nbsp;&nbsp;
                          </td>
                        </tr>
                        <tr>
                          <th width="800">HPP</th>
                          <td align="right">
                            <div style="float:left;">Rp</div>
                            <u><?php echo number_format($sum_hpp['hpp'],2,',','.'); ?> &nbsp;- </u>
                          </td>
                        </tr>
                        <tr>
                          <th width="800">Laba Kotor</th>
                          <td align="right">
                            <div style="float:left;">Rp</div>
                            <?php echo number_format($total_lk = $sum_penjualan['penjualan'] + $sum_pen['pendapatan'] - $sum_hpp['hpp'],2,',','.'); ?>&nbsp;&nbsp;&nbsp;
                          </td>
                        </tr>
                        <tr>
                          <th width="800">Biaya Usaha :</th>
                          <td align="right">&nbsp;</td>
                        </tr>
                        <?php
                          //$sql = mysql_query("SELECT * FROM beban_operasional WHERE tanggal_operasional LIKE '%$tgl_cari%' ");
                          //while($data_op = mysql_fetch_array($sql)){
                        ?>
                        <tr>
                          <th width="800">Biaya Listrik</th>
                          <td align="right">
                            <div style="float:left;">Rp</div>
                            <div style="text-indent:20px;"><?php echo number_format($sum_listrik['listrik'],2,',','.'); ?></div>
                          </td>
                        </tr>
                        <tr>
                          <th width="800">Biaya Telepon & Internet</th>
                          <td align="right">
                            <div style="float:left;">Rp</div>
                            <div style="text-indent:20px;"><?php echo number_format($sum_telpon['telpon'],2,',','.'); ?></div>
                          </td>
                        </tr>
                        <tr>
                          <th width="800">Biaya Peralatan</th>
                          <td align="right">
                            <div style="float:left;">Rp</div>
                            <div style="text-indent:20px;"><?php echo number_format($sum_peralatan['peralatan'],2,',','.'); ?></div>
                          </td>
                        </tr>
                        <tr>
                          <th width="800">Biaya Gaji</th>
                          <td align="right">
                            <div style="float:left;">Rp</div>
                            <div style="text-indent:20px;"><?php echo number_format($sum_gj['gj'],2,',','.'); ?></div>
                          </td>
                        </tr>
                        <?php
                          //}
                        ?>
                        <tr>
                          <th width="800">Total Biaya Usaha</th>
                          <td align="right">
                            <div style="float:left;">Rp</div>
                            <u><?php echo number_format($total_bu = $sum_listrik['listrik'] + $sum_telpon['telpon'] + $sum_peralatan['peralatan'] + $sum_gj['gj'],2,',','.'); ?> &nbsp;- </u>
                          </td>
                        </tr>
                        <tr>
                          <th width="800">EBIT</th>
                          <td align="right">
                            <div style="float:left;">Rp</div>
                            <?php echo number_format($total_eb = $total_lk - $total_bu,2,',','.'); ?> &nbsp;
                          </td>
                        </tr>
                        <tr>
                          <th width="800">TAX</th>
                          <td align="right">
                            <div style="float:left;">Rp</div>
                            <?php echo number_format($total_tx = $total_eb * 0.05,2,',','.'); ?>&nbsp;&nbsp;&nbsp;
                          </td>
                        </tr>
                      <tr class="danger">
                          <th width="800">EAT</th>
                          <td align="right">
                            <div style="float:left;">Rp</div>
                            <?php echo number_format($total_eb - $total_tx,2,',','.'); ?>&nbsp;&nbsp;&nbsp;
                          </td>
                        </tr>
                      </table>
                      <?php
                        }
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

var o = document.getElementById("laba-rugi");
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
