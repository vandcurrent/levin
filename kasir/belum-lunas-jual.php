<?php
include "../sesi.php";
$qperbaikan="SELECT * FROM penjualan where status like 'belum'";
$rperbaikan = mysql_query($qperbaikan);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>Belum Lunas - Levin Motor</title>

    <meta name="description" content="Dynamic tables and grids using jqGrid plugin" />

    <!-- page specific plugin styles -->

<?php
include '../assets/sebelum-content.php';
include '../sidenav/kasir.html';
?>
<ul class="breadcrumb">
  <li>
    <i class="ace-icon fa fa-file-text-o home-icon"></i>
    <a href="#">Belum Lunas</a>
  </li>
</ul><!-- /.breadcrumb -->
<?php
include '../assets/seting.html';
?>
                <!-- PAGE CONTENT MULAI -->
                <div class="page-header">
                  <h1>
                    Belum Lunas
                    <small>
                      <i class="ace-icon fa fa-angle-double-right"></i>
                      Tabel Daftar Penjualan Sparepart Belum Lunas
                    </small>
                  </h1>
                </div><!-- /.page-header -->

                <div class="row">
                  <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->

                        <div class="clearfix">
                          <div class="pull-right tableTools-container"></div>
                        </div>

                        <!-- div.table-responsive -->

                        <!-- div.dataTables_borderWrap -->
                        <div>
                          <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                            <thead>
                              <tr>
                                <th>No Nota</th>
                                <th class="hidden-480">Tanggal</th>
                                <th>Jenis Sparepart</th>
                                <th>Nama Pelanggan</th>
                                <th class="hidden-480">Quantity</th>
                                <th class="hidden-480">DP</th>
                                <th></th>
                              </tr>
                            </thead>

                            <tbody>
                              <?php
                                while($row=mysql_fetch_assoc($rperbaikan)){
                                $jasa=$row['no_nota'];
                                $pel=$row['id_pelanggan'];
                                $id_sparepart=$row['id_sparepart'];
                                $dpkirim =$row['bayar'];
                                $rmontir=mysql_fetch_array(mysql_query("select nama_pelanggan from pelanggan where id_pelanggan='$pel'"));
                              ?>
                              <tr>
                                <td><?=$row['no_nota']?></td>
                                <td class="hidden-480"><?=$row['tanggal']?></td>
                                <td><?=$row['jenis_sparepart']?></td>
                                <td><?=$rmontir['nama_pelanggan']?></td>
                                <td><?=$row['banyaknya']?></td>
                                <td><?=$row['bayar']?></td>

                                <td>
                                  <div id="modal-table-<?=$row['no_nota']?>" class="modal fade" tabindex="-1">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header no-padding">
                                          <div class="table-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                              <span class="white">&times;</span>
                                            </button>
                                            Tabel Struk Penjualan Sparepart Dari Nota: <?=$row['no_nota']?>
                                          </div>
                                        </div>
                                        <div class="modal-body no-padding">
                                          <?php
                                          $penjualan = $row['no_nota'];
                                          //echo $pembelian;
                                          $qnota="SELECT id_data,nama_barang,jenis,merk,harga,kwantitas,total,data_nota.tipe FROM nota,data_nota where nota.id_nota = data_nota.id_nota and nota.id_nota = $penjualan and data_nota.tipe = 'penjualan'";
                                          $rnota = mysql_query($qnota) or die(mysql_error());
                                          ?>
                                          <table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top">
                                            <thead>
                                              <th>Nama Sparepart</th>
                                              <th>Merk</th>
                                              <th>Jumlah</th>
                                              <th>Harga</th>
                                              <th>Total</th>
                                              <th>Tipe</th>
                                            <tbody>
                                              <?php
                                              $subtotal = 0;
                                              $dp = $row['bayar'];
                                              if(mysql_num_rows($rnota) > 0) {

                                                while($baris=mysql_fetch_assoc($rnota)){

                                              ?>
                                              <tr>
                                                <td><?=$baris['nama_barang']?></td>
                                                <td><?=$baris['merk']?></td>
                                                <td><?=$baris['kwantitas']?></td>
                                                <td align="right"><?=$baris['harga']?></td>
                                                <td align="right"><?=$baris['total']?></td>
                                                <td><?=$baris['tipe']?></td>
                                              </tr>
                                              <?php
                                              $subtotal += $baris['total'];
                                                }
                                              ?>
                                              <tr>
                                                <td colspan="4" align="right">SUBTOTAL</td>
                                                <td align="right"><?=$subtotal?></td>
                                                <td></td>
                                              </tr>
                                              <tr>
                                                <td colspan="4" align="right">PPN</td>
                                                <td align="right"><?=$subtotal/10?></td>
                                                <td></td>
                                              </tr>
                                              <tr>
                                                <td colspan="4" align="right">TOTAL</td>
                                                <td align="right"><?=$total=$subtotal+($subtotal/10)?></td>
                                                <td align="center"></td>
                                              </tr>
                                              <tr>
                                                <td colspan="4" align="right">DP</td>
                                                <td align="right"><?=$dp?></td>
                                                <td align="center"><b>BAYAR :</b></td>
                                              </tr>
                                              <tr>
                                                <td colspan="4" align="right">SISA</td>
                                                <td align="right"><?=$total-$dp?><input type="hidden" name="sisa" value="<?=$$total-$dp;?>"></td>
                                                <form method="POST" action="proses-bayar-jual.php">
                                                <td style="padding:0;vertical-align: middle;">
                                                    <input style="padding:0;width:100%;height:100%" type="number" name="bayar"  >
                                                    <input type="text" style="display:none;" name="jasa" value="<?=$jasa?>">
                                                    <input type="text" style="display:none;" name="total" value="<?=$total-$dp?>">
                                                    <input type="submit" style="display:none"/>
                                                </td>
                                                </form>
                                              </tr>
                                              <?php
                                              }else{
                                                echo "<td colspan=6 align='center'>Belum Ada Penjualan</td>";
                                              }
                                              ?>
                                            </tbody>
                                          </table>
                                        </div>

                                      </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                  </div>
                                  <div class="action-buttons">
                                    <a class="green" href="#modal-table-<?=$row['no_nota']?>" data-toggle="modal">
                                      <i class="ace-icon fa fa-money bigger-130"></i>
                                      <span class="hidden-sm hidden-xs">Bayar</span>
                                    </a>
                                    <a class="grey" href="faktur-jual.php?jasa=<?=$jasa."&dp=".$dpkirim;?>">
                                    <i class="ace-icon fa fa-print bigger-130"></i>
                                    <span class="hidden-sm hidden-xs">Faktur</span>
                                    </a>
                                  </div>
                                </td>
                              </tr>
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

var o = document.getElementById("penjualan");
o.className += "open ";
var z = document.getElementById("belum-lunas");
z.className += "open ";
z.className += "active ";



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
