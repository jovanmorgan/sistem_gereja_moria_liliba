<?php
include '../../../../keamanan/koneksi.php';

// Terima data dari formulir HTML
$id_katekasasi = $_POST['id_katekasasi'];
$nama = $_POST['nama'];
$umur = $_POST['umur'];
$alamat = $_POST['alamat'];
$jenis_kelamin = $_POST['jenis_kelamin'];

// Lakukan validasi data
if (empty($id_katekasasi) || empty($nama) || empty($umur) || empty($alamat) || empty($jenis_kelamin)) {
    echo "data_tidak_lengkap";
    exit();
}
$alamat_program_data = str_replace('<br>', "\n", $alamat);
// Buat query SQL untuk mengupdate data
$query_update = "UPDATE katekasasi SET nama = '$nama', umur = '$umur', alamat = '$alamat' WHERE id_katekasasi = '$id_katekasasi'";

// Jalankan query
if (mysqli_query($koneksi, $query_update)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
