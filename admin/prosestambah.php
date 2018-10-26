<?php

	include_once("config.php");
	$uname =$_POST['uname'];
	$pass =md5($_POST['pass']);

	if(($uname=="") && $pass=="")
	{
		printf("Silahkan isi username dan password yang anda inginkan!");
	}
	else
{
	$query = "INSERT INTO admin(uname,pass ) VALUES ('$uname', '$pass')";
	$hasil = mysqli_query($con,$query);

	if (!$query)
{
	die("penyimpanan gagal!!!");
}
		
	else 
	{
		echo ("berhasil mendaftar!!");
		print("Kembali ke Halaman Login");
		?>
		<a href="tambahlogin.php">
		<input type="button" value="login">
		</a>
		<?php
	}
	
}
?>