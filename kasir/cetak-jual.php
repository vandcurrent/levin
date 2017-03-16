<?php
include "../sesi.php";
$jasa = $_GET['jasa'];
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
            <td colspan="7" align="right">TOTAL</td>
            <td colspan="3" align="right"><?=$total=$subtotal+($subtotal/10)-$rnota['dp']?></td>

          </tr>
          <?php
          }else{
            echo "<td colspan=6 align='center'>Belum Ada Penjualan</td>";
          }
          ?>
        </tbody>
        <tfoot>
          <tr><td style="border:none;" colspan="7">&nbsp;</td><td colspan="2" style="border:none;">Tanda Terima</td></tr>
          <tr><td style="border:none;" colspan="9">&nbsp;</td></tr>
          <tr><td style="border:none;" colspan="9">&nbsp;</td></tr>
          <tr><td style="border:none;" colspan="9">&nbsp;</td></tr>
          <tr>
            <td colspan="7" style="border:none;"></td>
            <td colspan="2" align="center" style="border:none;"><u>
              <?php
                $rnama=mysql_fetch_array(mysql_query("SELECT nama_pelanggan FROM pelanggan, penjualan WHERE pelanggan.id_pelanggan = penjualan.id_pelanggan AND penjualan.no_nota  ='$jasa'"));
                echo $rnama[0];
              ?>
            </u></td>
          </tr>
        </tfoot>
      </table>
    </div>

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
