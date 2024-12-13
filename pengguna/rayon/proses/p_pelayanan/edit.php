<?php
include '../../../../keamanan/koneksi.php';

// Terima data dari formulir HTML
$id_p_pelayanan = $_POST['id_p_pelayanan'];
$id_jenis_pelayanan = $_POST['id_jenis_pelayanan'];
$id_rayon = $_POST['id_rayon'];

// Lakukan validasi data
if (empty($id_jenis_pelayanan) || empty($id_rayon)) {
    echo "data_tidak_lengkap";
    exit();
}
// Buat query SQL untuk mengupdate data
$query_update = "UPDATE p_pelayanan SET id_jenis_pelayanan = '$id_jenis_pelayanan', id_rayon = '$id_rayon' WHERE id_p_pelayanan = '$id_p_pelayanan'";

// Jalankan query
if (mysqli_query($koneksi, $query_update)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
