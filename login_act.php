<?php 
session_start();
include 'admin/config.php';
$uname=$_POST['uname'];
$pass=md5($_POST['pass']);
$query=mysqli_query($con,"select * from admin where uname='$uname' and pass='$pass'")or die(mysql_error());
if(mysqli_num_rows($query)==1){
	$_SESSION['uname']=$uname;
	header("location:admin/index.php");
}else{
	header("location:index.php?pesan=gagal")or die(mysql_error());
	// mysql_error();
}
// echo $pas;
 ?>