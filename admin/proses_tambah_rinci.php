<?php
include "config.php";

$no_faktur=$_POST['no_faktur'];
$id=$_POST['id'];
$jumlah_beli=$_POST['jumlah_beli'];
$harga=$_POST['harga'];
$sub_total=($harga*$jumlah_beli);

$query=mysqli_query($con,"INSERT INTO rincian_penjualan (no_faktur,kd_barang,jumlah_beli,sub_total) VALUES ('$no_faktur','$id','$jumlah_beli','$sub_total')");
$cstock=mysqli_query($con,"SELECT jumlah FROM barang where id='$id'");
$gstock=mysqli_fetch_array($cstock);
$last_stock=$gstock['jumlah'];
$nstock=($last_stock-$jumlah_beli);
$upstock=mysqli_query($con,"UPDATE barang set jumlah='$nstock' where id='$id'");

if($query&&$upstock){
	header('location:tambah_penjualan_1.php');
}
else{
	echo"<script language='javascript'>
	window.alert('Proses penyimpanan gagal silahkan isi data kembali');javascript:history.back();</script>";
}
?>