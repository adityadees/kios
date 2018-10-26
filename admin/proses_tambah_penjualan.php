<?php
include "config.php";

$no_faktur=$_POST['no_faktur'];
$total_belanja=$_POST['total_belanja'];
$jum_bayar=$_POST['jum_bayar'];

$query=mysqli_query($con,"INSERT INTO penjualan (no_faktur_penjualan,total_penjualan,jumlah_bayar,tgl_penjualan) values ('$no_faktur','$total_belanja','$jum_bayar',NOW())");

if($query){
	echo "<script>
	    window.open('faktur_penjualan.php?no_faktur=$no_faktur', '_blank');javascript:history.back();
		</script>";
}
else{
	echo"<script language='javascript'>
	window.alert('Proses penyimpanan gagal silahkan isi data kembali');javascript:history.back();</script>";
}
?>