<?php
include '../../../../keamanan/koneksi.php';

// Terima data dari formulir HTML
$id_majelis = $_POST['id_majelis'];
$nama = $_POST['nama'];
$umur = $_POST['umur'];
$alamat = $_POST['alamat'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$status = $_POST['status'];

// Lakukan validasi data
if (empty($id_majelis) || empty($nama) || empty($umur) || empty($alamat) || empty($jenis_kelamin) || empty($status)) {
    echo "data_tidak_lengkap";
    exit();
}
$alamat_program_data = str_replace('<br>', "\n", $alamat);
// Buat query SQL untuk mengupdate data
$query_update = "UPDATE majelis SET nama = '$nama', umur = '$umur', alamat = '$alamat', status = '$status' WHERE id_majelis = '$id_majelis'";

// Jalankan query
if (mysqli_query($koneksi, $query_update)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
