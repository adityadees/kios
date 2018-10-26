<?php
include 'config.php';
require('../assets/pdf/fpdf.php');
$pdf = new FPDF("L","cm","A4");

$pdf->SetMargins(2,1,1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',11);
$pdf->Image('../logo/sowleh.png',1,1,2,2);
$pdf->SetX(4);            
$pdf->MultiCell(19.5,0.5,'Toko ...',0,'L');
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'Telpon : 0022XXXXXXX',0,'L');    
$pdf->SetFont('Arial','B',10);
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'JL. Palembang...',0,'L');
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'Email : aaaa@aaa.com',0,'L');
$pdf->Line(1,3.1,28.5,3.1);
$pdf->SetLineWidth(0.1);      
$pdf->Line(1,3.2,28.5,3.2);   
$pdf->SetLineWidth(0);
$pdf->ln(1);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(25.5,0.7,"Laporan Data Penjualan",0,10,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,0.7,"Di cetak pada : ".date("D-d/m/Y"),0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(2, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(7, 0.8, 'Nama Barang', 1, 0, 'C');
$pdf->Cell(7, 0.8, 'Jenis', 1, 0, 'C');
$pdf->Cell(5.5, 0.8, 'Harga', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'jumlah', 1, 1, 'C');
$pdf->SetFont('Arial','',10);
$no=1;
if(isset($_GET['tgl_penjualan'])){
$ntgl=$_GET['tgl_penjualan'];
	$query=mysqli_query($con,"select * from rincian_penjualan inner join penjualan on rincian_penjualan.no_faktur=penjualan.no_faktur_penjualan inner join barang on rincian_penjualan.kd_barang=barang.id   where tgl_penjualan like '%$ntgl%'order by penjualan.tgl_penjualan desc");

while($lihat=mysqli_fetch_array($query)){
	$pdf->Cell(2, 0.8, $no , 1, 0, 'C');
	$pdf->Cell(7, 0.8, $lihat['nama'],1, 0, 'C');
	$pdf->Cell(7, 0.8, $lihat['jenis'], 1, 0,'C');
	$pdf->Cell(5.5, 0.8, $lihat['harga'],1, 0, 'C');
	$pdf->Cell(3, 0.8, $lihat['jumlah_beli'], 1, 1,'C');

	$no++;
}

}
else {
	$query=mysqli_query($con,"select * from rincian_penjualan inner join penjualan on rincian_penjualan.no_faktur=penjualan.no_faktur_penjualan inner join barang on rincian_penjualan.kd_barang=barang.id order by penjualan.tgl_penjualan desc");

while($lihat=mysqli_fetch_array($query)){
	$pdf->Cell(2, 0.8, $no , 1, 0, 'C');
	$pdf->Cell(7, 0.8, $lihat['nama'],1, 0, 'C');
	$pdf->Cell(7, 0.8, $lihat['jenis'], 1, 0,'C');
	$pdf->Cell(5.5, 0.8, $lihat['harga'],1, 0, 'C');
	$pdf->Cell(3, 0.8, $lihat['jumlah_beli'], 1, 1,'C');

	$no++;
}



}
$pdf->Output("laporan_buku.pdf","I");

?>

