<?php
include '../../../../keamanan/koneksi.php';

// Terima data dari formulir HTML
$id_pembabtisan = $_POST['id_pembabtisan'];
$nama = $_POST['nama'];
$umur = $_POST['umur'];
$jenis_kelamin = $_POST['jenis_kelamin'];

// Lakukan validasi data
if (empty($id_pembabtisan) || empty($nama) || empty($umur) || empty($jenis_kelamin)) {
    echo "data_tidak_lengkap";
    exit();
}
// Buat query SQL untuk mengupdate data
$query_update = "UPDATE pembabtisan SET nama = '$nama', umur = '$umur' WHERE id_pembabtisan = '$id_pembabtisan'";

// Jalankan query
if (mysqli_query($koneksi, $query_update)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
