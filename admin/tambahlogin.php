<?php 
include 'header.php';
?>

<center><h3><span class="glyphicon glyphicon-user"></span>  Tambah User</h3></center>
<br/><br/>
<body>
<div class="container">
		<?php 
		if(isset($_GET['pesan'])){
			if($_GET['pesan'] == "gagal"){
				echo "<div style='margin-bottom:-55px' class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-warning-sign'></span>  Login Gagal !! Username dan Password Salah !!</div>";
			}
		}
		?>
		<div class="panel panel-default">
			<form action="prosestambah.php" method="post">
				<div class="col-md-4 col-md-offset-4 kotak">
					<h3>Tambah User</h3>
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
						<input type="text" class="form-control" placeholder="Username" name="uname">
					</div>
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
						<input type="password" class="form-control" placeholder="Password" name="pass">
					</div>
					<div class="input-group">			
						<input type="submit" class="btn btn-primary" value="Daftar">
					</div>
				</div>
			</form>
		</div>
	</div>
</body>

<?php 
include 'footer.php';

?>