<?php 
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: ../login.php");
  exit;
}
include '../fpdf/fpdf.php';
include '../koneksi.php';
$id_mhs = $_SESSION["id_mhs"];


$pdf=new FPDF("P", "cm", "A4");
$pdf->SetMargins(3,1,1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont("Arial", "B", 14);
$pdf->Cell(15.5, 0.7, "DATA LAPORAN KEUANGAN", 0,10,'C');
$pdf->ln();
$pdf->ln();

$pdf->SetFont("Arial", "B", 10);
$pdf->Cell(1,0.8,'No', 1,0);
$pdf->Cell(6,0.8, 'Nama Kategori', 1,0);
$pdf->Cell(7,0.8, 'Jumlah Pengeluaran', 1,0);
$pdf->SetFont('Arial', '', 10);
$no = 1;
$pdf->ln();
$query = "SELECT SUM(catatan_pengeluaran.nominal_catatan) as nominal_catatan, kategori.* FROM catatan_pengeluaran, kategori WHERE catatan_pengeluaran.id_mhs = $id_mhs AND catatan_pengeluaran.id_kategori=kategori.id_kategori";
$query .= " GROUP BY catatan_pengeluaran.id_kategori";
$tampil = mysqli_query($koneksi, $query);
// $nominal = $data['nominal_catatan'];

while ($hasil = mysqli_fetch_assoc($tampil)) {
  $pdf->Cell(1,0.8,$no, 1,0);
  $pdf->Cell(6,0.8,$hasil['nama_kategori'],1,0);
  $nominal = $hasil['nominal_catatan'];
  $pdf->Cell(7,0.8,"Rp. ".number_format("$nominal", 2, ",", "."),1,0);
  $pdf->ln();
    $no++;
}
$pdf->Output("laporan_mahasiswa.pdf", "I");


 ?>