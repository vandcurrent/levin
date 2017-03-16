<?php
include "../sesi.php";
$jasa = $_GET['jasa'];
$dp = $_GET['dp'];
?>

<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-body no-padding">
      <?php
      $qnota="SELECT * FROM penjualan, nota, data_nota where penjualan.no_nota = nota.id_nota AND nota.id_nota = data_nota.id_nota and no_nota = $jasa";
      $rnota = mysql_query($qnota) or die(mysql_error());
      ?>
      <center>
      <h2 align="center">CV LEVIN MOTOR SPORT</h2>
      <h2 align="center">Struk Penjualan</h2>

      <div>

      </div>

      <table align="center" border="1" class="table table-striped table-bordered table-hover no-margin-bottom no-border-top">
        <thead>
          <th>Tanggal</th>
          <th>Nama Pelanggan</th>
          <th>Jenis Sparepart</th>
          <th>Nama Sparepart</th>
          <th>Merk Sparepart</th>
          <th>Tanggal Lunas</th>
          <th>Jumlah</th>
          <th>Harga</th>
          <th>Total</th>
        <tbody>
          <?php
          $subtotal = 0;
          if(mysql_num_rows($rnota) > 0) {
            while($baris=mysql_fetch_assoc($rnota)){
              $jasa=$baris['no_nota'];
              $id_sparepart=$baris['id_sparepart'];
              $pel=$baris['id_pelanggan'];
              $rmontir=mysql_fetch_array(mysql_query("select jenis_sparepart from sparepart where id_sparepart=$id_sparepart"));
              $rlunas=mysql_fetch_array(mysql_query("select nama_pelanggan from pelanggan where id_pelanggan=$pel"));
          ?>
          <tr>
            <td><?=$baris['tanggal']?></td>
            <td><?=$rlunas['nama_pelanggan']?></td>
            <td><?=$rmontir['jenis_sparepart']?></td>
            <td><?=$baris['nama_sparepart']?></td>
            <td><?=$baris['merk']?></td>
            <td><?=$baris['tanggal_lunas']?></td>
            <td><?=$baris['kwantitas']?></td>
            <td align="right"><?=$baris['harga']?></td>
            <td align="right"><?=$baris['total']?></td>
          </tr>
          <?php
          $subtotal += $baris['total'];
            }
          ?>
          <tr>
            <td colspan="7" align="right">SUBTOTAL</td>
            <td colspan="3" align="right"><?=$subtotal?></td>

          </tr>
          <tr>
            <td colspan="7" align="right">PPN</td>
            <td colspan="3" align="right"><?=$subtotal/10?></td>
          </tr>
          <tr>
            <td colspan="7" align="right">DP</td>
            <td colspan="3" align="right"><?=$dp?></td>
          </tr>
          <tr>
            <td colspan="7" align="right">TOTAL</td>
            <td colspan="3" align="right"><?=$total=$subtotal+($subtotal/10)-$rnota['dp']?></td>

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
  