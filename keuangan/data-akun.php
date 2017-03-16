<?php
include "../sesi.php";
$i ="";
$sqlselect="SELECT * FROM akun";
$result = mysql_query($sqlselect);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Data Akun - Levin Motor</title>

		<meta name="description" content="Dynamic tables and grids using jqGrid plugin" />

		<!-- page specific plugin styles -->

<?php
include '../assets/sebelum-content.php';
include '../sidenav/keuangan.html';
?>
<ul class="breadcrumb">
	<li>
		<i class="ace-icon fa fa-male home-icon"></i>
		<a href="#">Akun</a>
	</li>

	<li>
		<a href="#">Data Akun</a>
	</li>
</ul><!-- /.breadcrumb -->
<?php
include '../assets/seting.html';
?>
								<!-- PAGE CONTENT MULAI -->
                <div class="page-header">
    							<h1>
    								Data Akun
    								<small>
    									<i class="ace-icon fa fa-angle-double-right"></i>
    									Tabel Data Akun
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
                        <table>
                          <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                          <thead>
                            <tr>
                                <th></th>
                                <th>No</th>
                                <th>Kode Akun</th>
                                <th>Nama Akun</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                                <th></th>
                              </tr>

                            </thead>
                            <tbody>
                              <?php
                              $i++;
                              while ($row = mysql_fetch_assoc($result)) {

                              ?>
                               <tr>
                                <td class="center">
                                  <label class="pos-rel">
                                    <input type="checkbox" class="ace" />
                                    <span class="lbl"></span>
                                  </label>
                                </td>
                                  <td><?php echo $i;?></td>
                                  <td><?php echo $row['kode_akun'];?></td>
                                  <td><?php echo $row['nama_akun'];?></td>
                                  <td><?php   $ket_akun = substr($row['kode_akun'], 0,2);
                                                          $ket_akun1 = substr($row['kode_akun'], 0,1);
                                                          if ($ket_akun1==1) {
                                                            echo "Aktiva Lancar";
                                                          }elseif($ket_akun1==2){
                                                            echo "Utang Lancar";
                                                          }elseif($ket_akun1==3){
                                                            echo "Modal";
                                                          }elseif($ket_akun1==4){
                                                            echo "Pendapatan";
                                                          }elseif($ket_akun1==5){
                                                            echo "Beban";
                                                          }elseif($ket_akun1==6) {
                                                            echo "Beban Operasional";
                                                          }elseif($ket_akun1==7){
                                                            echo "Pendapatan di luar Usaha";
                                                          }elseif($ket_akun1==8) {
                                                            echo "Biaya di luar usaha";
                                                          }
                                                        ?>
                                  </td>

                                  <td>
                                      <div class="action-buttons">
                                        <a class="blue" href="ubah-akun.php?kode_akun=<?=$row['kode_akun']?>">
                                          <i class="ace-icon fa fa-pencil bigger-130"></i>
                                          <span class="hidden-sm hidden-xs">Edit</span>
                                        </a>
                                  </td>
                                  <td></td>
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

var o = document.getElementById("akun");
o.className += "active ";
o.className += "open ";
var o = document.getElementById("data-akun");
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