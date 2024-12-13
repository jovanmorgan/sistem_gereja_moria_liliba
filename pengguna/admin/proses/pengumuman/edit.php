<?php
include '../../../../keamanan/koneksi.php';

// Terima data dari formulir HTML
$id_pengumuman = $_POST['id_pengumuman'];
$judul = $_POST['judul'];
$tanggal = $_POST['tanggal'];
$isi = $_POST['isi'];

// Lakukan validasi data
if (empty($id_pengumuman) || empty($judul) || empty($tanggal) || empty($isi)) {
    echo "data_tidak_lengkap";
    exit();
}

$isi_program_data = str_replace('<br>', "\n", $isi);
$format = date('d-M-Y H:i', strtotime($tanggal));
// Buat query SQL untuk mengupdate data
$query_update = "UPDATE pengumuman SET judul = '$judul', tanggal = '$format', isi = '$isi_program_data' WHERE id_pengumuman = '$id_pengumuman'";

// Jalankan query
if (mysqli_query($koneksi, $query_update)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
