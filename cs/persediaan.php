<?php
include "../sesi.php";

$status = 1;
$cek = 0;
$cek1 = 0;
$hjual = 0;
$tjual = 0;
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Data persediaan - Levin Motor</title>

		<meta name="description" content="Dynamic tables and grids using jqGrid plugin" />

		<!-- page specific plugin styles -->


<?php
include '../assets/sebelum-content.php';
include '../sidenav/cs.html';
?>
<script type="text/javascript">
  $(document).ready(function(){
    $(".page-header").click(function(){
      alert("klik");
    });
    $(".jenissp").change(function(){
      var jenis = $(".jenissp").val();
      $.ajax({
        url : "query.php?action=jenis",
        data: "jenis="+jenis,
        cache: false,
        success : function(data){
          $("#keterangan").html(data);
        }
      });
    });
    $(".keterangan").change(function(){
      var keterangan = $(".keterangan").val();
      $.ajax({
        url : "query.php?action=keterangan",
        data: "keterangan="+keterangan,
        cache: false,
        success : function(data){
          $("#merk").html(data);
        }
      });
    });
    $(".merk").change(function(){
      var merk1 = $(".merk").val();
      var keterangan1 = $(".keterangan").val();
      $.ajax({
        url : "query.php?action=merk",
        data : {merk:merk1,keterangan:keterangan1},
        cache: false,
        success : function(data){
          $("#harga").val(data);
        }
      });
    });
  });
  $(document).ready(function(){
    $("#merk").change(function(){
      var merk = $("#merk").val();
      var jenis = $("#jenis").val();
      var nama = $('#keterangan').val();
      $.ajax({
        url   : "populate.php",
        data  : "jenis="+jenis+"&merk = "+merk+"nama="+nama,
        cache : false,
        success : function(data){
          $("#test").html(data);
          
          }
      });
    });
  });
</script>
<ul class="breadcrumb">
	<li>
		<i class="ace-icon fa fa-male home-icon"></i>
		<a href="#">Persediaan</a>
	</li>

	<li>
		<a href="#">Data Persediaan</a>
	</li>
</ul><!-- /.breadcrumb -->
<?php
include '../assets/seting.html';
?>


								<!-- PAGE CONTENT MULAI -->
                <div class="page-header">
    							<h1>
                    Laporan Persediaan

    								<small>
    									<i class="ace-icon fa fa-angle-double-right"></i>
    								Data Persediaan
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
                        <?php
                        $qjenis = mysql_query("SELECT jenis_sparepart FROM sparepart GROUP BY jenis_sparepart");
                          $jnspart = "<option value=''>Pilih Jenis</option>";
                          while($rjenis=mysql_fetch_assoc($qjenis)){
                            $jns = $rjenis['jenis_sparepart'];
                            $jnspart .= "<option value='$jns'>$jns</option>";
                            $qsparepart = mysql_query("SELECT nama_sparepart FROM sparepart WHERE jenis_sparepart = '$jns' GROUP BY nama_sparepart");
                            $spart[$jns] = "<option value=''>Pilih Sparepart</option>";
                              while($rsparepart=mysql_fetch_assoc($qsparepart)){
                                $nama = $rsparepart['nama_sparepart'];
                                $spart[$jns] .= "<option value='".$nama."'>".$nama."</option>";
                            }
                          }
                          $merkpart = array();
                          $qmerk = mysql_query("SELECT nama_sparepart FROM sparepart GROUP BY nama_sparepart");
                          while($rmerk=mysql_fetch_assoc($qmerk)){
                            $nama = $rmerk['nama_sparepart'];
                            $merkpart[$nama] = "<option value=''>Pilih Merk</option>";
                            $rmerk = mysql_query("SELECT merk FROM sparepart where nama_sparepart LIKE '$nama' ");
                            while($hasil=mysql_fetch_assoc($rmerk)){
                              $merkpart[$nama] .= "<option value='".$hasil['merk']."'>".$hasil['merk']."</option>";
                            }
                          }
                          ?>
                          <form method="POST">
                          <table id="simple-table" class="table table-striped table-bordered table-hover">
                              <tr>
                                <td>
                                  <select id="jenissp" class='jenissp' name='jenis' style='margin:0;padding:0;height:100%;width:100%'><?=$jnspart?></select>
                                </td>
                                <td>
                                  <select id="keterangan" class='keterangan' name='keterangan' style='margin:0;padding:0;height:100%;width:100%'><option value=''>Pilih Sparepart</option></select>
                                </td>
                                <td>
                                  <select id="merk" class='merk' name='merk' style='margin:0;padding:0;height:100%;width:100%'><option value=''>Pilih Merk</option></select>
                                </td>
                                <td><button type="submit" name="submit"  class="btn btn-primary">Tampilkan</button></td>
                              </tr>
                              
                          </table>
                          </form>
                          <?php
                          if (isset($_POST['submit'])) {
                            $jenis = $_POST['jenis'];
                            $nama = $_POST['keterangan'];
                            $merk = $_POST['merk'];

                            // echo $jenis ."+". $merk ."+". $nama;
                            ?>

    											<table class="table table-striped table-bordered table-hover">
    												<thead>
    													<tr>
    														<th rowspan="2">Sparepart</th>
																<th rowspan="2">Tanggal</th>
																<th rowspan="2">Keterangan</th>
																<th colspan="3">Pembelian</th>
    														<th colspan="3">Penjualan</th>
																<th colspan="3">Saldo</th>
    													</tr>
															<tr>
																<th>Q</th>
    														<th>harga</th>
    														<th>total</th>
																<th>Q</th>
    														<th>harga</th>
    														<th>total</th>
																<th>Q</th>
    														<th>harga</th>
    														<th>total</th>
    													</tr>
    												</thead>
														<tbody>
                            <?php
                              $sjual = 0;
                              $sbeli = 0;
                              $qty =0; $tqty = 0;
                              $harga =0; $tharga = 0;
                              $total =0; $ttotal = 0;
                              $jtotal = 0;

                              //echo $jenis;
                              $idj = mysql_query("SELECT id_sparepart FROM sparepart where jenis_sparepart= '$jenis' AND nama_sparepart= '$nama'");
                              $id_spa = mysql_fetch_assoc($idj);
                              $id = $id_spa['id_sparepart'];
                              //echo $id;

                              $sqlselect="SELECT * FROM stok, sparepart where stok.id_sparepart = sparepart.id_sparepart AND sparepart.nama_sparepart = '$nama' AND sparepart.jenis_sparepart = '$jenis' AND sparepart.merk='$merk'";
                              $result = mysql_query($sqlselect);
                              $numrows = mysql_num_rows($result);
                              //$snama = $result['nama_sparepart'];
                              
															while ($row = mysql_fetch_assoc($result)) {
                                $numrows --;
                                $snama = mysql_query("SELECT * FROM sparepart WHERE id_sparepart = '$id[$i]'") or die(mysql_error());
                                $bnama = mysql_fetch_array($snama);
                                $tnama = $bnama['nama_sparepart'];
                                //echo $tnama ."a";
                                if ($sbeli == 1 && $row['tipe']=='penjualan')
                                {
                                  $qty = $qty + $tqty;
                                  $total = $total + $ttotal;
                                  $harga = round($total / $qty,0);
                                  $hjual = $harga;
                                  $tqty = 0;
                                  $tharga = 0;
                                  $ttotal = 0;
                                  $sbeli = 0;
                                  $jtotal = $total;
                                ?>
                                <tr>
                                  <td align="center" colspan="9" align="right">TOTAL</td>
                                  <td align="center"><?=$qty;?></td>
                                  <td align="right">
                                    <div style="float:left;">Rp</div>
                                    <?php echo number_format($harga,2,',','.'); ?>
                                  </td>
                                  <td align="right">
                                    <div style="float:left;">Rp</div>
                                    <?php echo number_format($total,2,',','.'); ?>
                                  </td>
                                  
                                </tr>
                                <?php
                                }
                                else if($sjual == 1 && $row['tipe']=='pembelian'){
                                  $qty = $qty - $tqty;
                                  $total1 = $total;
                                  $total = $jtotal - $ttotal;
                                  //$harga = round($total / $qty,0);
                                  $tqty = 0;
                                  $tharga = 0;
                                  $ttotal = 0;
                                  $sjual = 0;
                                ?>
                                <tr>
                                  <td align="center" colspan="9" align="right">TOTAL</td>
                                  <td align="center"><?=$qty;?></td>
                                  <td align="right">
                                    <div style="float:left;">Rp</div>
                                    <?php echo number_format($harga,2,',','.'); ?>
                                  </td><td align="right">
                                    <div style="float:left;">Rp</div>
                                    <?php echo number_format($total,2,',','.'); ?>
                                  </td>
                                  
                                </tr>

                                  <?php
                                }

                                if ($row['tipe']=='pembelian'){
                              $sbeli = 1;
                              ?>
                              <tr>
                                  <td align="center"><?=$tnama;?></td>
                                  <td align="center"><?=$row['tanggal'];?></td>
                                  <td align="center"><?=$row['keterangan'];?></td>
                                  <td align="center"><?=$row['qty'];?></td>
                                  <td align="right">
                                    <div style="float:left;">Rp</div>
                                    <?php echo number_format($row['harga'],2,',','.'); ?>
                                  </td>
                                  <td align="right">
                                    <div style="float:left;">Rp</div>
                                    <?php echo number_format($row['total'],2,',','.'); ?>
                                  </td>
                                  <td align="center">0</td>
                                  <td align="center">0</td>
                                  <td align="center">0</td>
                                  <td align="center"><?=$row['s-qty'];?></td>
                                  <td align="right">
                                    <div style="float:left;">Rp</div>
                                    <?php echo number_format($row['s-harga'],2,',','.'); ?>
                                  </td>
                                  <td align="right">
                                    <div style="float:left;">Rp</div>
                                    <?php echo number_format($row['s-total'],2,',','.'); ?>
                                    </td>
                                  </td>
                                  
                              
                              <?php
                              $tqty = $tqty + $row['s-qty'];
                              $tharga = $tharga + $row['s-harga'];
                              $ttotal = $ttotal + $row['s-total']; 
                              ?>
                              
                              </tr>
                              <?php }
                              //$cek ++;
                              //$cek1 = 0;
                              else
                              if ($row['tipe']=='penjualan') {
                              $sjual = 1;
                              ?>
                              <tr>
                                  <td align="center"><?=$tnama;?></td>
                                  <td align="center"><?=$row['tanggal'];?></td>
                                  <td align="center"><?=$row['keterangan'];?></td>
                                  <td align="center">0</td>
                                  <td align="center">0</td>
                                  <td align="center">0</td>
                                  <td align="center"><?=$row['qty'];?></td>
                                  <td align="right">
                                    <div style="float:left;">Rp</div>
                                    <?php echo number_format($hjual,2,',','.'); ?>
                                  </td>
                                  <td align="right">
                                    <div style="float:left;">Rp</div>
                                    <?php echo number_format(($hjual*$row['qty']),2,',','.'); ?>
                                  </td>
                                  <td align="center"><?=$row['s-qty'];?></td>
                                  <td align="right">
                                    <div style="float:left;">Rp</div>
                                    <?php echo number_format($hjual,2,',','.'); ?>
                                  </td>
                                  <td align="right">
                                    <div style="float:left;">Rp</div>
                                    <?php echo number_format(($hjual*$row['s-qty']),2,',','.'); ?>
                                  </td>

                              
                              <?php
                              //$cek = 0;
                              //$cek1 ++;
                              
                              $tqty = $tqty + $row['s-qty'];
                              $tharga = $tharga + $row['s-harga'];
                              $ttotal = $ttotal + ($hjual * $row['s-qty']); 
                              ?>
                              
                              </tr>
                              <?php }

                              if ($numrows == 0 && $row['tipe']=='penjualan'){
                                  $qty = $qty - $tqty;
                                  $total = $total - $ttotal;
                                  $harga = round($total / $qty, 0);
                                ?>
                                <tr>
                                  <td align="center" colspan="9" align="right">TOTAL</td>
                                  <td align="center"><?=$qty;?></td>
                                  <td align="right">
                                    <div style="float:left;">Rp</div>
                                    <?php echo number_format($harga,2,',','.'); ?>
                                  </td>
                                  <td align="right">
                                    <div style="float:left;">Rp</div>
                                    <?php echo number_format($total,2,',','.'); ?>
                                  </td>
                                </tr>
                                  <?php
                                }
                                else if ($numrows == 0 && $row['tipe'] == 'pembelian'){
                                  $qty = $qty + $tqty;
                                  $harga = $harga + $tharga;
                                  $total = $total + $ttotal;
                                  $harga = round($total / $qty, 0);
                                ?>
                                <tr>
                                  <td align="center" colspan="9" align="right">TOTAL</td>
                                  <td align="center"><?=$qty;?></td>
                                  <td align="right">
                                    <div style="float:left;">Rp</div>
                                    <?php echo number_format($harga,2,',','.'); ?>
                                  </td>
                                  <td align="right">
                                    <div style="float:left;">Rp</div>
                                    <?php echo number_format($total,2,',','.'); ?>
                                  </td>
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

var sparepart = <?=json_encode($spart)?>;
var merkpart = <?=json_encode($merkpart)?>;

$('#simple-table').on('change', '.jenissp', function(){
  var $row = $(this).closest("tr");
  var a = this.options[this.selectedIndex].text;
  $row.find('.keterangan').html(sparepart[a]);
  $row.find('.merk').html("<option value=''>Pilih Merk</option>");
  $row.find('.harga').val(0).trigger("change");
});

$('#simple-table').on('change', '.keterangan', function(){
  var a = this.options[this.selectedIndex].text;
  $(this).closest("tr").find('.merk').html(merkpart[a]);
  $(this).closest("tr").find('.harga').val(0).trigger("change");
});

$('#simple-table').on('change', '.merk', function(){
  var $row = $(this).closest("tr");
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        var harga = xmlhttp.responseText;
        $row.find('.harga').val(harga).trigger("change");
      }
  };
  var jenis = $row.find('.jenissp').val();
  var nama = $row.find('.keterangan').val();
  var merk = $(this).val();
  xmlhttp.open("GET", "harga.php?j=" + jenis + "&k=" + nama + "&m=" + merk, true);
  xmlhttp.send();
});

var o = document.getElementById("persediaan");
o.className += "active ";
o.className += "open ";

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
