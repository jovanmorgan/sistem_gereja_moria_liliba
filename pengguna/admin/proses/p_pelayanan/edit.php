<?php
include '../../../../keamanan/koneksi.php';

// Terima data dari formulir HTML
$id_p_pelayanan = $_POST['id_p_pelayanan'];
$id_jenis_pelayanan = $_POST['id_jenis_pelayanan'];
$id_rayon = $_POST['id_rayon'];
$waktu = $_POST['waktu'];
$tempat = $_POST['tempat'];

// Lakukan validasi data
if (empty($id_jenis_pelayanan) || empty($id_rayon) || empty($waktu) || empty($tempat)) {
    echo "data_tidak_lengkap";
    exit();
}
$tempat_data = str_replace('<br>', "\n", $tempat);
$format = date('d-M-Y H:i', strtotime($waktu));
// Buat query SQL untuk mengupdate data
$query_update = "UPDATE p_pelayanan SET id_jenis_pelayanan = '$id_jenis_pelayanan', id_rayon = '$id_rayon', waktu = '$format', tempat = '$tempat_data' WHERE id_p_pelayanan = '$id_p_pelayanan'";

// Jalankan query
if (mysqli_query($koneksi, $query_update)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
