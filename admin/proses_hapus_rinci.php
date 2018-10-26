<?php
include "config.php";

$no_faktur=$_GET['no_faktur'];
$kd_barang=$_GET['kd_barang'];

$cjml=mysqli_query($con,"SELECT * FROM rincian_penjualan where no_faktur='$no_faktur' && kd_barang='$kd_barang'");
$gjml=mysqli_fetch_array($cjml);
$njml=$gjml['jumlah_beli'];

$cjmlb=mysqli_query($con,"SELECT * FROM barang where id='$kd_barang'");
$gjmlb=mysqli_fetch_array($cjmlb);
$njmlb=$gjmlb['jumlah'];

$sstock=($njml+$njmlb);

$sql=mysqli_query($con,"UPDATE barang set jumlah='$sstock' where id='$kd_barang'");
$query=mysqli_query($con,"DELETE FROM rincian_penjualan where no_faktur='$no_faktur' && kd_barang='$kd_barang'");

if($sql&&$query){
	header('location:tambah_penjualan_1.php');
}
else{
	echo"<script language='javascript'>
	window.alert('Proses penyimpanan gagal silahkan isi data kembali');javascript:history.back();</script>";
}
?>