<?php
include '../../../../keamanan/koneksi.php';

// Terima data dari formulir HTML
$id_jenis_pelayanan = $_POST['id_jenis_pelayanan'];
// Terima data dari formulir HTML
$jenis_pelayanan = $_POST['jenis_pelayanan'];

// Lakukan validasi data
if (empty($jenis_pelayanan)) {
    echo "data_tidak_lengkap";
    exit();
}
// Buat query SQL untuk mengupdate data
$query_update = "UPDATE jenis_pelayanan SET jenis_pelayanan = '$jenis_pelayanan' WHERE id_jenis_pelayanan = '$id_jenis_pelayanan'";

// Jalankan query
if (mysqli_query($koneksi, $query_update)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
