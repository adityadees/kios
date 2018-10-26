<?php 
include 'header.php';
$date=date('ymd');
$query=mysqli_query($con,"SELECT count(no_faktur_penjualan) as maxid FROM penjualan ");
$result=mysqli_fetch_array($query);
$maxid=$result['maxid'];
$no_urut=substr($maxid,-5);
$new_urut=$no_urut+1;
$no_faktur="FR".$date.sprintf("%05s",$new_urut);
$newtanggal=date('d M Y');
$gtotal=mysqli_query($con,"select SUM(sub_total) as total_akhir from rincian_penjualan WHERE no_faktur='$no_faktur'");
$gto=mysqli_fetch_array($gtotal);
?>
<div class="row">
	<div class="col-md-12">
		<h3><span class="glyphicon glyphicon-briefcase"></span>  Tambah Penjualan</h3>
		<a class="btn" href="barang_laku.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
	</div>
</div>
<div class="row">
	<div class="col-md-12">

		<br>
		<form method=POST action='$aksi?module=checkin&act=input_checkin'>
			<div class="col-md-4">
				<div class="panel panel-info">
					<div class="panel-heading">Nama Barang</div>
					<div class="panel-body">
						<div class="form-group">
							<input type='text' class="form-control" name='name' onkeyup='autoComplete();' id='inputan' placeholder="Masukan Nama Barang"><div id='hasil'></div>
						</div>
					</div>
				</div>
			</div>

		</form>  

		<form action="proses_tambah_rinci.php" method="POST">
			<div class="col-md-8">	
				<div class="panel panel-danger">
					<div class="panel-heading">Nama Barang</div>
					<div class="panel-body">
						
						<input type="hidden" name="no_faktur" value="<?php echo $no_faktur;?>" class="form-control">
						<input type="hidden" name="id" id="id" class="form-control">
						<div class="form-group col-md-4">
							<input type="text" name='nama' id='nama' placeholder="Nama Item" class="form-control" readonly="readonly" required>
						</div>
						<div class="form-group col-md-3">
							<input type="text" name='harga' id='harga' placeholder="Harga" class="form-control" readonly="readonly">
						</div>
						<div class="form-group col-md-3">
							<input type="number" name='jumlah_beli'  placeholder="Jumlah Beli" class="form-control" required>
						</div>
						<div class="form-group col-md-2">
							<input type='submit' value="Tambah" class="form-control btn btn-success">
						</div>

					</div>
				</div>
			</div>	 
		</form>  
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="col-md-12">
			<div class="panel panel-success">
				<div class="panel-heading">Rincian Pembelian</div>
				<div class="panel-body">
					<form method="POST" action="proses_tambah_penjualan.php">
						<table class="table table-bordered">
							<tr>
								<td>No Transaksi</td>
								<td><input type="text" name="no_faktur" value="<?php echo $no_faktur;?>" class="form-control" readonly="readonly"></td>
								<td colspan="3"></td>
							</tr>
							<tr>
								<td>Tanggal</td>
								<td><input type="text" name="tanggal" value="<?php echo $newtanggal; ?>" readonly="readonly" class="form-control"></td>
								<td colspan="3"></td>
							</tr>
							<tr>
								<td>No</td>
								<td>Nama Barang</td>
								<td>Jumlah</td>
								<td>Total</td>
							</tr>
							<?php 
							$cquery=mysqli_query($con,"SELECT * FROM rincian_penjualan INNER JOIN barang ON rincian_penjualan.kd_barang=barang.id where no_faktur='$no_faktur'");
							$no=1;
							while($gquery=mysqli_fetch_array($cquery)):
								?>
								<tr>
									<td><?php echo $no++; ?></td>
									<td><?php echo $gquery['nama']; ?></td>
									<td><?php echo $gquery['jumlah_beli']; ?></td>
									<td><?php echo grp($gquery['sub_total']); ?></td>
									<td><a href="proses_hapus_rinci.php?no_faktur=<?php echo $no_faktur."&kd_barang=".$gquery['kd_barang'];?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">X</a>

									</td>
								</tr>
							<?php endwhile;?>
							<tr>
								<td colspan="3">Yang harus dibayar</td>
								<td colspan="2"><?php echo grp($gto['total_akhir']);?></td>
							</tr>
							<input type="hidden" name="total_belanja"  id="total_belanja"  value="<?php echo $gto['total_akhir']; ?>" readonly="readonly" />
							<input name="kembalian" type="hidden" id="kembalian" readonly="readonly" />
							<tr>
								<td colspan="3">Jumlah Uang yang dibayar</td>
								<td colspan="2"><input name="jum_bayar" type="number" id="jum_bayar" onkeyup="calc()" class="form-control"/></td>
							</tr>
							<tr>
								<td colspan="3">Kembalian</td>
								<td colspan="2"><div class="col-md-1">Rp.</div><div id="kbl" class="col-md-2"></div></td>
							</tr>
							<tr>
								<td colspan="5"><input type="submit" value="Selesai" class="btn btn-info pull-right"></td>
							</tr>
						</table>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
function grp($xrp)
{
	$yrp = "Rp " . number_format($xrp,2,',','.');
	return $yrp;
}
?>
<script language="JavaScript">
	var ajaxRequest;
    function getAjax() { //fungsi untuk mengecek AJAX pada browser
    	try {
    		ajaxRequest = new XMLHttpRequest();
    	} catch (e) {
    		try {
    			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
    		}
    		catch (e) {
    			try {
    				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
    			} catch (e) {
    				alert("Your browser broke!");
    				return false;
    			}
    		}
    	}
    }
    function autoComplete() { //fungsi menangkap input search dan menampilkan hasil search
    	getAjax();
    	input = document.getElementById('inputan').value;if (input == "") {
    		document.getElementById("hasil").innerHTML = "";
    	}
    	else {
    		ajaxRequest.open("GET","ajax_cari.php?input="+input);
    		ajaxRequest.onreadystatechange = function() {
    			document.getElementById("hasil").innerHTML = ajaxRequest.responseText;
    		}
    		ajaxRequest.send(null);
    	}
    }
    function autoInsert(id, nama,harga) { //fungsi mengisi input text dengan hasil pencarian yang dipilih
    	document.getElementById("inputan").value = nama;
    	document.getElementById("id").value = id;
    	document.getElementById("nama").value = nama;
    	document.getElementById("harga").value = harga;
    	document.getElementById("hasil").innerHTML = "";
    }


    function calc(){
    	var jb=document.getElementById('jum_bayar').value;
    	var tb=document.getElementById('total_belanja').value;
    	var hasil = jb-tb;
    	document.getElementById('kembalian').value = hasil;    
    	document.getElementById("kbl").innerHTML = hasil;}
    </script>
