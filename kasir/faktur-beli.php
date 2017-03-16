<?php
include "../sesi.php";
$jasa = $_GET['jasa'];
$dp = $_GET['dp'];
?>

<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-body no-padding">
      <?php
      $qnota="SELECT id_data,nama_barang,tgl_transaksi,jenis,merk,harga,kwantitas,total,tgl_lunas,data_nota.tipe FROM nota,data_nota where nota.id_nota = data_nota.id_nota and id_transaksi = $jasa and nota.tipe = 'pembelian'";
      $rnota = mysql_query($qnota) or die(mysql_error());
      ?>
      <h2 align="center">CV LEVIN MOTOR SPORT</h2>
      <h2 align="center">Faktur Pembelian</h2>

      <div>

      </div>

      <table align="center" border="1" class="table table-striped table-bordered table-hover no-margin-bottom no-border-top">
        <thead>
          <th>No Nota</th>
          <th>Tanggal</th>
          <th>Jenis Sparepart</th>
          <th>Nama Sparepart</th>
          <th>Merk</th>
          <th>Tanggal Pelunasan</th>
          <th>Jumlah</th>
          <th>Harga</th>
          <th>Total</th>
        <tbody>
          <?php
          $subtotal = 0;
          if(mysql_num_rows($rnota) > 0) {
            while($baris=mysql_fetch_assoc($rnota)){
              $jasa=$baris['id_data'];
              $id_sparepart =$baris['jenis'];
              //$rmontir=mysql_fetch_array(mysql_query("select id_sparepart from sparepart where jenis_sparepart=$id_sparepart"));
              //$rlunas=mysql_fetch_array(mysql_query("select tgl_transaksi from nota where id_transaksi='$jasa'"));
          ?>
          <tr>
            <td><?=$baris['id_data']?></td>
            <td class="hidden-480"><?=$baris['tgl_transaksi']?></td>
            <td><?=$baris['jenis']?></td>
            <td><?=$baris['nama_barang']?></td>
            <td><?=$baris['merk']?></td>
            <td><?=$baris['tgl_lunas']?></td>
            <td><?=$baris['kwantitas']?></td>
            <td align="right"><?=$baris['harga']?></td>
            <td align="right"><?=$baris['total']?></td>
          </tr>
          <?php
          $subtotal += $baris['total'];
            }
          ?>
          <tr>
            <td colspan="8" align="right">SUBTOTAL</td>
            <td colspan="3" align="right"><?=$subtotal?></td>

          </tr>
          <tr>
            <td colspan="8" align="right">PPN</td>
            <td colspan="3" align="right"><?=$subtotal/10?></td>
          </tr>
          <tr>
            <td colspan="8" align="right">DP</td>
            <td colspan="3" align="right"><?=$dp?></td>
          </tr>
          <tr>
            <td colspan="8" align="right">TOTAL</td>
            <td colspan="3" align="right"><?=$total=$subtotal+($subtotal/10)-$rnota['dp']?></td>

          </tr>
          <?php
          }else{
            echo "<td colspan=6 align='center'>Belum Ada Perbaikan</td>";
          }
          ?>
        </tbody>
      </table>
    </div>

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
