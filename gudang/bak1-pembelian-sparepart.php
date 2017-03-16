<?php
include "../sesi.php";

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
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Data Perbaikan - Levin Motor</title>

		<meta name="description" content="Dynamic tables and grids using jqGrid plugin" />

		<!-- page specific plugin styles -->
    <style>
    #simple-table tr td{
      padding:0;
      vertical-align: middle;
    }
    #simple-table tr td input{
      padding:0;
      width:100%;
      height:100%;
    }
    #simple-table tr td button{
      padding:0;
      width:100%;
      height:100%;
    }
    </style>
<?php
include '../assets/sebelum-content.php';
include '../sidenav/gudang.html';
?>
<ul class="breadcrumb">
	<li>
		<i class="ace-icon fa fa-wrench home-icon"></i>
		<a href="#">Sparepart</a>
	</li>

	<li>
		<a href="#">Pembelian</a>
	</li>
</ul><!-- /.breadcrumb -->
<?php
include '../assets/seting.html';
?>
								<!-- PAGE CONTENT MULAI -->
                <div class="page-header">
    							<h1>
    								Pembelian
    								<small>
    									<i class="ace-icon fa fa-angle-double-right"></i>
    									Masukan Data Yang Tertera Dari Faktur Pembelian Sparepart
    								</small>
    							</h1>
    						</div><!-- /.page-header -->

    						<div class="row">
    							<div class="col-xs-12">
    								<!-- PAGE CONTENT BEGINS -->
    										<!-- div.table-responsive -->

    										<!-- div.dataTables_borderWrap -->
    										<div>
                      <table id="simple-table" class="table table-striped table-bordered table-hover">
											<thead>
												<tr>
                          <th></th>
                          <th width="12%">Jenis</th>
                          <th width="25%">Nama Sparepart</th>
                          <th>Merk</th>
                          <th width="15%">Harga</th>
                          <th width="5%">Q</th>
                          <th width="15%">Total</th>
                          <th>Tipe</th>
												</tr>
											</thead>

											<tbody>
											</tbody>
                      <tfoot>
                      <tr>
                        <td colspan="6" align="right"><b>SUBTOTAL :</b></td>
                        <td align="right"><input class="subtotal" type="number" name="ppn" value="0"></td>
                        <td><button class="btn btn-minier btn-white btn-info btn-bold" type="button" onclick="barisbaru()">+ Sparepart Baru<botton></td>
                      </tr>
                      <tr>
                        <td colspan="6" align="right"><b>PPN :</b></td>
                        <td align="right"><input class="ppn" type="number" name="ppn" value="0"></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td colspan="6" align="right"><b>TOTAL :</b></td>
                        <td align="right"><input class="total" type="number" name="total" value="0"></td>
                        <td><button class="btn btn-minier btn-white btn-inverse btn-bold" type="button" onclick="barisstok()">+ Stok Sparepart<botton></td>
                      </tr>
                      <tr>
                        <td colspan="6" align="right"><b>BAYAR :</b></td>
                        <td align="right"><input type="number" name="bayar" value="0"></td>
                        <td></td>
                      </tr>
                      </tfoot>
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

var o = document.getElementById("sparepart");
o.className += "active ";
o.className += "open ";
var o = document.getElementById("pembelian");
o.className += "active ";

var sparepart = <?=json_encode($spart)?>;
var merkpart = <?=json_encode($merkpart)?>;

$('.simple-table').on('change', '.jenissp', function(){
	var $row = $(this).closest("tr");
	var a = this.options[this.selectedIndex].text;
	$row.find('.keterangan').html(sparepart[a]);
	$row.find('.merk').html("<option value=''>Pilih Merk</option>");
	$row.find('.harga').val(0).trigger("change");
});

$('.simple-table').on('change', '.keterangan', function(){
	var a = this.options[this.selectedIndex].text;
	$(this).closest("tr").find('.merk').html(merkpart[a]);
	$(this).closest("tr").find('.harga').val(0).trigger("change");
});

function barisbaru() {
		var x = document.getElementById("simple-table").rows.length-4;
    var table = document.getElementById("simple-table").getElementsByTagName('tbody')[0];
    var row = table.insertRow(-1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
		var cell4 = row.insertCell(3);
		var cell5 = row.insertCell(4);
		var cell6 = row.insertCell(5);
		var cell7 = row.insertCell(6);
		var cell8 = row.insertCell(7);
    cell1.innerHTML = '<button class="dltbaris btn btn-minier btn-danger btn-bold" type="button"></botton>';
    cell2.innerHTML = '<input name="jenis[]" type="text">';
		cell3.innerHTML = '<input type="text" name="nama[]">';
		cell4.innerHTML = '<input type="text" name="merk[]">';
		cell5.innerHTML = '<input class="harga" type="number" name="harga[]" step="100" value="0">';
		cell6.innerHTML = '<input class="q" type="number" name="q[]" value="1">';
		cell7.innerHTML = '<input class="jumlah" type="number" name="jumlah[]" step="100" value="0" readonly>';
		cell8.innerHTML = '<input name="tipe[]" type="text" value="baru" readonly>';
		aturbaris();
};

function barisstok() {
		var x = document.getElementById("simple-table").rows.length-4;
    var table = document.getElementById("simple-table").getElementsByTagName('tbody')[0];
    var row = table.insertRow(-1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
		var cell4 = row.insertCell(3);
		var cell5 = row.insertCell(4);
		var cell6 = row.insertCell(5);
		var cell7 = row.insertCell(6);
		var cell8 = row.insertCell(7);
    cell1.innerHTML = '<button class="dltbaris btn btn-minier btn-danger btn-bold" type="button"></botton>';
    cell2.innerHTML = "<select class='jenissp' name='jenis[]' style='margin:0;padding:0;height:100%;width:100%'><?=$jnspart?></select>";
		cell3.innerHTML = "<select class='keterangan' name='keterangan[]' style='margin:0;padding:0;height:100%;width:100%'><option value=''>Pilih Sparepart</option></select>";
		cell4.innerHTML = "<select class='merk' name='merk[]' style='margin:0;padding:0;height:100%;width:100%'><option value=''>Pilih Merk</option></select>";
		cell5.innerHTML = '<input class="harga" type="number" name="harga[]" step="100" value="0">';
		cell6.innerHTML = '<input class="q" type="number" name="q[]" value="0">';
		cell7.innerHTML = '<input class="jumlah" type="number" name="jumlah[]" step="100" value="0" readonly>';
		cell8.innerHTML = '<input name="tipe[]" type="text" value="restok" readonly>';
		aturbaris();
};

function minbaris(a) {
	document.getElementById("simple-table").deleteRow(a);
	aturbaris();
	$('.simple-table').closest("tr").find('.q').trigger("change");
};

function aturbaris(){
	$(".simple-table tr").each(function(){
			var currentIndex = $(this).index();
			var baris = currentIndex + 1;
			$(this).children().children("button.dltbaris").attr("onclick", "minbaris("+baris+")");
			$(this).children().children("button.dltbaris").html(baris);
	});
};

var kaskulasi = $('.simple-table').on('keyup keypress blur change', '.q, .harga', function(){
	var $row = $(this).closest("tr");
	var qty = parseFloat($row.find('.q').val());
	var price = parseFloat($row.find(".harga").val());
	total = qty * price;
	var dp = parseFloat($(".dp").val());
	$row.find('.jumlah').val(total);
	var sumjml = 0;
	$(this).closest("tbody").find(".jumlah").each(function () {
			var a = parseFloat(this.value);
			if (!isNaN(a) && a.length != 0) {
					sumjml += parseFloat(a);
			};
	});
	var ppn = sumjml/10;
	$(this).closest("table").find(".subtotal").val(sumjml);
	$(this).closest("table").find(".ppn").val(ppn);
	$(this).closest("table").find(".total").val(sumjml+ppn);
});

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
