<?php
include 'header.php';
?>
<script src="//cdn.jsdelivr.net/webshim/1.14.5/polyfiller.js"></script>
<script>
	webshims.setOptions('forms-ext', {types: 'date'});
	webshims.polyfill('forms forms-ext');
</script>
<h3><span class="glyphicon glyphicon-briefcase"></span>  Data Laporan Penjualan</h3>
<form action="" method="get">
	<div class="input-group col-md-5 col-md-offset-7">
		<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-calendar"></span></span>

		<input type="date" name="tanggal" class="form-control" placeholder="Double Klick" onchange="this.form.submit()">
		
	</div>

</form>
<br/>

<br/>
<?php 
if(isset($_GET['tanggal'])){
	$ntgl=$_GET['tanggal'];
	echo "<h4> Data Penjualan Tanggal  <a style='color:blue'> ". date('d/m/Y',strtotime($_GET['tanggal']))."</a></h4>";
	echo "<a href='lap_barang.php?tgl_penjualan=$ntgl' class='btn btn-primary ' target='blank'><span class='glyphicon glyphicon-print '></span>Cetak</a>";
}else {
	echo "<a href='lap_barang.php' target='blank' class='btn btn-primary ' ><span class='glyphicon glyphicon-print '></span> Cetak</a>";
}
?>
<div class="clearfix" style="margin-top:20px"></div>
<table class="table">
	<tr>
		<th>No</th>
		<th>Tanggal</th>
		<th>Nama Barang</th>
		<th>Harga Terjual /pc</th>
		<th>Total Harga</th>
		<th>Jumlah</th>			
	</tr>
	<?php 
	if(isset($_GET['tanggal'])){
		$tanggal=mysqli_real_escape_string($con,$_GET['tanggal']);
		$brg=mysqli_query($con,"select * from rincian_penjualan inner join penjualan on rincian_penjualan.no_faktur=penjualan.no_faktur_penjualan inner join barang on rincian_penjualan.kd_barang=barang.id   where tgl_penjualan like '%$tanggal%'order by penjualan.tgl_penjualan desc");
	}else{
		$brg=mysqli_query($con,"select * from rincian_penjualan inner join penjualan on rincian_penjualan.no_faktur=penjualan.no_faktur_penjualan inner join barang on rincian_penjualan.kd_barang=barang.id order by penjualan.tgl_penjualan desc");
	}
	$no=1;
	while($b=mysqli_fetch_array($brg)){

		?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo date('d/m/Y h:i:s', strtotime($b['tgl_penjualan'])); ?></td>
			<td><?php echo $b['nama'] ?></td>
			<td>Rp.<?php echo number_format($b['harga']) ?>,-</td>
			<td>Rp.<?php echo number_format($b['total_penjualan']) ?>,-</td>
			<td><?php echo $b['jumlah_beli'] ?></td>
		</tr>

		<?php 
	}
	?>
</table>


<script type="text/javascript">
	$(document).ready(function(){
		$("#tgl").datepicker({dateFormat : 'yy/mm/dd'});							
	});
</script>
<?php include 'footer.php'; ?>