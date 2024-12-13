<?php
session_start();

// Periksa apakah pengguna sudah masuk atau belum
if (!isset($_SESSION['id_admin'])) {
    // Pengguna belum masuk, arahkan kembali ke halaman masuk.php
    header("Location: ../../../../berlangganan/login");
    exit; // Pastikan untuk menghentikan eksekusi skrip setelah mengarahkan
}

// Lakukan koneksi ke database
include '../../../../keamanan/koneksi.php';

// Buat PDF dengan FPDF
require('../../fpdf/fpdf.php');

class PDF extends FPDF
{
    function Header()
    {
        // Hanya tampilkan header di halaman pertama
        if ($this->PageNo() == 1) {
            // Logo
            $this->Image('../../../../assets/img/gml.png', 10, 8, 20); // Ganti 'path/to/logo.png' dengan path yang benar tempat di mana kehangatan dan kasih menyatukan kita dalam iman

            // Font Times New Roman bold 16 untuk nama sekolah
            $this->SetFont('Times', 'B', 14);
            $this->Cell(0, 3, 'GEREJA MORIA LILIBA', 0, 1, 'C'); // Nama sekolah
            $this->Cell(0, 9, 'TEMPAT DIMANA KEHANGATAN ', 0, 1, 'C'); // Nama sekolah
            $this->Cell(0, 3, 'DAN KASIH MENYATUKAN KITA DALAM IMAN', 0, 1, 'C'); // Nama sekolah
            $this->SetFont('Times', '', 12);
            $this->Cell(0, 12, 'Jln. Timor Raya no. 17-18 / Kelurahan Kelapa Lima / Kecamatan Kelapa Lima', 0, 1, 'C'); // Nama sekolah

            // Garis di bawah informasi siswa
            $this->SetDrawColor(0, 0, 0);
            $this->SetLineWidth(0.5);
            $this->Line(1, $this->GetY() + 1, 200, $this->GetY() + 1); // Ubah koordinat dan panjang garis sesuai kebutuhan

            // Pindah ke baris baru untuk konten setelah header
            $this->Ln(15);
        }
    }

    function Footer()
    {


        // Tanda tangan
        $this->SetY(-75);
        $this->SetFont('Times', 'B', 10);
        $this->Cell(95, 10, 'Sekretaris', 0, 0, 'C');
        $this->Cell(95, 10, 'Ketua Majelis', 0, 1, 'C');
        $this->SetY(-45);
        // Garis untuk tanda tangan
        $this->Cell(95, 10, 'Pnt.Ledosow Salean', 0, 0, 'C');
        $this->Cell(95, 10, 'Pdt. Vivi M.J.I Siar-Ballo, S.Th.M.Th', 0, 1, 'C');
        $this->Line(40, $this->GetY(), 75, $this->GetY()); // Garis untuk Sekretaris
        $this->Line(135, $this->GetY(), 173, $this->GetY()); // Garis untuk Ketua Majelis
        // Posisi 1,5 cm dari bawah
        $this->SetY(-25); // Menurunkan posisi footer untuk memberi ruang tanda tangan
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Nomor halaman
        $this->Cell(0, 10, 'Halaman ' . $this->PageNo(), 0, 0, 'C');
    }
}

// Buat objek PDF
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Times', '', 8); // Times New Roman regular 12

// Menambahkan header tabel
$pdf->SetFillColor(200, 220, 255);
$pdf->SetFont('Times', 'B', 8);
$pdf->Cell(10, 10, 'Nomor', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Permohonan', 1, 0, 'C', true);
$pdf->Cell(70, 10, 'Nama Pendeta', 1, 0, 'C', true);
$pdf->Cell(25, 10, 'Waktu', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Tempat', 1, 1, 'C', true);

// Ambil data dari database dan tambahkan ke tabel PDF
$results_per_page = 10;
$search_query = isset($_GET['search_query']) ? $_GET['search_query'] : '';
$search_sql = !empty($search_query) ? " WHERE jenis_pelayanan.jenis_pelayanan LIKE '%$search_query%' OR pendeta.nama LIKE '%$search_query%'" : '';
$count_query = "SELECT COUNT(*) AS total FROM pelayanan LEFT JOIN p_pelayanan ON pelayanan.id_p_pelayanan = p_pelayanan.id_p_pelayanan JOIN jenis_pelayanan ON p_pelayanan.id_jenis_pelayanan = jenis_pelayanan.id_jenis_pelayanan JOIN pendeta ON pelayanan.id_pendeta = pendeta.id_pendeta" . $search_sql;
$result = mysqli_query($koneksi, $count_query);
$row = mysqli_fetch_assoc($result);
$total_results = $row['total'];

$total_pages = ceil($total_results / $results_per_page);
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$starting_limit = ($page - 1) * $results_per_page;

$data_query = "SELECT pelayanan.*, p_pelayanan.id_jenis_pelayanan AS ijp, pendeta.nama AS nama_pendeta, jenis_pelayanan.jenis_pelayanan AS jenis_pelayanan FROM pelayanan LEFT JOIN p_pelayanan ON pelayanan.id_p_pelayanan = p_pelayanan.id_p_pelayanan JOIN jenis_pelayanan ON p_pelayanan.id_jenis_pelayanan = jenis_pelayanan.id_jenis_pelayanan JOIN pendeta ON pelayanan.id_pendeta = pendeta.id_pendeta" . $search_sql . " ORDER BY id_pelayanan DESC LIMIT " . $starting_limit . ", " . $results_per_page;
$result = mysqli_query($koneksi, $data_query);

$counter = 1;
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $tempat_sambung = str_replace(array("\r", "\n"), '', nl2br($row['tempat']));
        $waktu = $row['waktu'];
        $data_waktu = date('Y-m-d\TH:i', strtotime($waktu));

        $pdf->Cell(10, 10, $counter, 1);
        $pdf->Cell(30, 10, $row['jenis_pelayanan'], 1);
        $pdf->Cell(70, 10, $row['nama_pendeta'], 1);
        $pdf->Cell(25, 10, $data_waktu, 1);
        $pdf->Cell(30, 10, $tempat_sambung, 1);
        $pdf->Ln();

        $counter++;
    }
} else {
    $pdf->Cell(190, 10, 'Tidak Ada Data Yang Ditemukan..', 1, 1, 'C');
}

// Tutup koneksi ke database
mysqli_close($koneksi);

// Output PDF
$pdf->Output();
