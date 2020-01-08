<?php

include "config/koneksi.php";
include "fungsi.php";
require('fpdf/fpdf.php');

$query = mysqli_query($con,"SELECT * FROM transaksi
								WHERE id_transaksi = '$_GET[id_transaksi]'")or die(mysqli_error());
$num = mysqli_num_rows($query);
$data = mysqli_fetch_array($query);

if ($num == 0) {
	echo "<script language='javascript'>
				alert('Data penjualan tidak ditemukan atau masih kosong');
				window.location='transaksi.php';
	</script>";
}

$pdf = new FPDF();

$pdf->AddPage();

$pdf->SetFont('Arial','B',16);

$pdf->cell(190,7,'RUMAH MAKAN AKSEL',0,1,'C');

$pdf->SetFont('Arial','B',12);

$pdf->cell(190,7,'Perumahan Nuansa Hijau Block D No. 1, Ciomas, Bogor.',0,1,'C');

$pdf->Line(10,30,200,30);

$pdf->Ln(5);

$pdf->cell(10,7,'',0,1);

$pdf->SetFont('Arial','B',10);

include 'config/koneksi.php';
$isi = mysqli_query($con, "SELECT * FROM transaksi");
while ($row_edit = mysqli_fetch_array($isi)){
	// =============================================
	$pdf->cell(25,5,'id transaksi :',0,0);
    $pdf->Cell(25,5,$row_edit['id_transaksi'],0,1);
    $pdf->cell(25,5,'id user :',0,0);
    $pdf->Cell(25,5,$row_edit['id_user'],0,1);
    $pdf->cell(25,5,'Nama Pembeli:',0,0);
    $pdf->Cell(25,5,$row_edit['id_order'],0,1);
    $pdf->cell(25,5,'tanggal :',0,0);
    $pdf->Cell(25,5,$row_edit['tanggal'],0,1);
    $pdf->cell(25,5,'total bayar :',0,0);
    $pdf->Cell(25,5,$row_edit['total_bayar'],0,1);
  
	
    $pdf->Cell(0, 6, 'Barang yang dibeli tidak dapat dikembalikan, kecuali ada perjanjian.', 0, 1, 'C', 0);
}

$pdf->Output();

?>