<?php
include '../../../../keamanan/koneksi.php';

// Terima data dari formulir HTML
$judul = $_POST['judul'];
$tanggal = $_POST['tanggal'];
$isi = $_POST['isi'];

// Lakukan validasi data
if (empty($judul) || empty($tanggal) || empty($isi)) {
    echo "data_tidak_lengkap";
    exit();
}
$isi_program_data = str_replace('<br>', "\n", $isi);
$format = date('d-M-Y H:i', strtotime($tanggal));
// Buat query SQL untuk menambahkan data masyarakat ke dalam database
$query = "INSERT INTO pengumuman (judul, tanggal, isi) 
        VALUES ('$judul','$format', '$isi_program_data')";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
