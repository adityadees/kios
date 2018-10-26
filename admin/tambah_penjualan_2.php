<?php 
include 'header.php';
?>

<?php

$tgl = $_POST['tgl'];
$nama_barang = $_POST['nama'];

$sql = "SELECT * FROM BARANG WHERE nama='$nama_barang'"

 ?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Tambah Penjualan (2)</h3>
<a class="btn" href="barang_laku.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>

<form action="barang_laku_act.php" method="post">	
<center><table>
						<h3>Nama Barang:</h3>
						<h4><?php
							$hasil = mysqli_query($con,$sql);
							while($b= mysqli_fetch_array($hasil))
							{
								?>
								<tr>
									<td><b>Tanggal</b></td>
									<td><b>Nama Barang</b></td>
									<td><b>Harga Satuan</b></td>
								</tr>
								<tr>
									<td><input type="text" name="tgl" value="<?php echo $tgl ?>"></td>
									<td><input type="text" name="nama" value="<?php echo $nama_barang ?>"></td>
									<td><input type="text" name="harga" value="<?php echo $b['harga']; ?>"></td>
									
								</tr>

								<?php							}
						 ?></h4>	</table>	</center>						
							
						<div class="form-group">
							<label>Jumlah</label>
							<input name="jumlah" type="text" class="form-control" placeholder="Jumlah" autocomplete="off">
						</div>																	

								

					
					<div class="modal-footer">
						<a href="barang_laku.php"><button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button></a>
						<input type="reset" class="btn btn-danger" value="Reset">												
						<input type="submit" class="btn btn-primary" value="Lanjut">
					</div>
				</form>

 <script type="text/javascript">
        $(document).ready(function(){

            $('#tgl').datepicker({dateFormat: 'yy/mm/dd'});

        });
    </script>
<?php 
include 'footer.php';

?>