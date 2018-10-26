<?php
include "config.php";
$no_faktur=$_GET['no_faktur'];
$sql=mysqli_query($con,"SELECT * FROM penjualan where no_faktur_penjualan='$no_faktur'");
$gsql=mysqli_fetch_array($sql);
$ntanggal=$gsql['tgl_penjualan'];
$query=mysqli_query($con,"SELECT * FROM rincian_penjualan INNER JOIN barang ON rincian_penjualan.kd_barang=barang.id where rincian_penjualan.no_faktur='$no_faktur'");

function grp($xrp)
{
  $yrp = "Rp " . number_format($xrp,0,',','.');
  return $yrp;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>CETAK FAKTUR</title>
  <style type="text/css">
  #faktur{
   height: 465px; width: 100%; overflow: scroll;
   font-family: Arial, Helvetica, sans-serif;
   font-size: 10px;}
   #n_faktur{
     background-color: #FFF; margin-top: 20px;}
     .tr_info{
       color: #000; font-weight: bold;}
       .tr_header_footer{
         color: #000; font-weight: bold;
         background-color: #CCC;}
         .tr_item{
           color: #000; background-color: #FFF;}
           h4{
            text-align:center;
          }
          p{
            text-align:center;
            margin-top:-10px;
          }
          .tm{
            text-align:center;
            margin-top:5px;
          }
        </style>
      </head>

      <body onload="print()">
        <div id="faktur">
          <table width="500" border="0" align="center" id="n_faktur">
            <tr>
              <td colspan="5"><H4>TOKO ...</H4></td>
            </tr>
            <tr><td colspan="5"><p>Jl Palembang Raya No. 11111</p></td></tr>
            <tr>
              <td><span class="tr_info">NO FAKTUR</span></td>
              <td colspan="5"><?php echo $no_faktur; ?>&nbsp;</td>
            </tr>
            <tr>
              <td><span class="tr_info">TGL FAKTUR</span></td>
              <td colspan="5"><?php echo date('d/m/Y h:i:s', strtotime($ntanggal));  ?></td>
            </tr>
            <tr class="tr_header_footer">
              <td>KD BRG</td>
              <td>NM BRG</td>
              <td>JML</td>
              <td>HRG</td>
              <td>SUB TOTAL</td>
            </tr>
            <?php 
            while($gqry=mysqli_fetch_array($query)):
              ?>
              <tr class="tr_item">
                <td><?php echo $gqry['kd_barang']; ?>&nbsp;</td>
                <td width="120px"><?php echo $gqry['nama']; ?>&nbsp;</td>
                <td><?php echo $gqry['jumlah_beli']; ?>&nbsp;</td>
                <td><?php echo grp($gqry['harga']); ?>&nbsp;</td>
                <td><?php echo grp($gqry['sub_total']); ?>&nbsp;</td>
              </tr>
            <?php endwhile; ?>
            <tr class="tr_header_footer">
              <td>TOTAL</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td><?php echo grp($gsql['total_penjualan']); ?>&nbsp;</td>
            </tr>
            <tr class="tr_header_footer">
              <td>Pembayaran</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td><?php echo grp($gsql['jumlah_bayar']); ?>&nbsp;</td>
            </tr>
            <tr class="tr_header_footer">
              <td>Kembalian</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td><?php echo grp(($gsql['jumlah_bayar']-$gsql['total_penjualan'])); ?>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="5"><div class="tm">TERIMA KASIH</div></td>
            </tr>
          </table>
        </div>
      </body>
      </html>