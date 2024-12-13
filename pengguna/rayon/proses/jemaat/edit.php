<?php
include '../../../../keamanan/koneksi.php';

// Terima data dari formulir HTML
$id_jemaat = $_POST['id_jemaat'];
$nama = $_POST['nama'];
$no_hp = $_POST['no_hp'];
$id_rayon = $_POST['id_rayon'];
$alamat = $_POST['alamat'];
$jenis_kelamin = $_POST['jenis_kelamin'];

// Lakukan validasi data
if (empty($id_jemaat) || empty($nama) || empty($no_hp) || empty($id_rayon) || empty($alamat) || empty($jenis_kelamin)) {
    echo "data_tidak_lengkap";
    exit();
}

$alamat_program_data = str_replace('<br>', "\n", $alamat);
// Buat query SQL untuk mengupdate data
$query_update = "UPDATE jemaat SET nama = '$nama', no_hp = '$no_hp', id_rayon = '$id_rayon', alamat = '$alamat', jenis_kelamin = '$jenis_kelamin' WHERE id_jemaat = '$id_jemaat'";

// Jalankan query
if (mysqli_query($koneksi, $query_update)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
