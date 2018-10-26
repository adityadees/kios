<?php 
include 'config.php';
$id=$_GET['id'];
mysqli_query($con,"delete from pengeluaran where id ='$id'");
header("location:pengeluaran.php");

 ?>