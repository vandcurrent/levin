<?php
include "../sesi.php";
$jasa = $_GET['jasa'];
?>

<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-body no-padding">
      <?php
      $qnota="SELECT id_jasa, tgl_masuk, no_polisi, id_montir, tgl_selesai, nama_barang, merk, harga, kwantitas, total FROM perbaikan, nota, data_nota where perbaikan.id_jasa = nota.id_transaksi AND nota.id_nota = data_nota.id_nota and id_transaksi = 1 AND nota.tipe != 'pembelian'";
      $rnota = mysql_query($qnota);
      ?>
      <center>
      <h2 align="center">CV LEVIN MOTOR SPORT</h2>
      <h2 align="center">Struk Jasa Perbaikan</h2>

      <div>

      </div>

      <table align="center" border="1" class="table table-striped table-bordered table-hover no-margin-bottom no-border-top">
        <thead>
          <th>Tanggal Masuk</th>
          <th>No Polisi</th>
          <th>Montir</th>
          <th>Tanggal Selesai</th>
          <th>Tanggal Pelunasan</th>
          <th>Daftar Perbaikan</th>
          <th>Jenis</th>
          <th>Jumlah</th>
          <th>Harga</th>
          <th>Total</th>
        <tbody>
          <?php
          $subtotal = 0;
          if(mysql_num_rows($rnota) > 0) {
            while($baris=mysql_fetch_assoc($rnota)){
              $jasa=$baris['id_jasa'];
              $id_montir=$baris['id_montir'];
              $rmontir=mysql_fetch_array(mysql_query("select nama_montir from montir where id_montir=$id_montir"));
              $rlunas=mysql_fetch_array(mysql_query("select tgl_transaksi from nota where id_transaksi=$jasa"));
          ?>
          <tr>
            <td><?=$baris['tgl_masuk']?></td>
            <td><?=$baris['no_polisi']?></td>
            <td><?=$rmontir['nama_montir']?></td>
            <td><?=$baris['tgl_selesai']?></td>
            <td><?=$rlunas['tgl_transaksi']?></td>
            <td><?=$baris['nama_barang']?></td>
            <td><?=$baris['merk']?></td>
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
            echo "<td colspan=6 align='center'>Belum Ada Perbaikan</td>";
          }
          ?>
        </tbody>
        <tfoot>
          <tr><td style="border:none;" colspan="7">&nbsp;</td><td colspan="3" style="border:none;" align="center">Tanda Terima</td></tr>
          <tr><td style="border:none;" colspan="9">&nbsp;</td></tr>
          <tr><td style="border:none;" colspan="9">&nbsp;</td></tr>
          <tr><td style="border:none;" colspan="9">&nbsp;</td></tr>
          <tr>
            <td colspan="7" style="border:none;"></td>
            <td colspan="3" align="center" style="border:none;"><u>
              <?php
                $rnama=mysql_fetch_array(mysql_query("SELECT nama_pelanggan FROM pelanggan, kendaraan_pelanggan, perbaikan WHERE perbaikan.no_polisi = kendaraan_pelanggan.no_polisi AND kendaraan_pelanggan.id_pelanggan = pelanggan.id_pelanggan AND perbaikan.id_jasa ='$jasa'"));
                echo $rnama[0];
              ?>
            </u></td>
          </tr>
        </tfoot>
      </table>
    </div>

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
