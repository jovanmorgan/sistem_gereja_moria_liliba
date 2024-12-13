<?php
include '../../../../keamanan/koneksi.php';

// Terima data dari formulir HTML
$id_pelayanan = $_POST['id_pelayanan'];
$id_p_pelayanan = $_POST['id_p_pelayanan'];
$id_pendeta = $_POST['id_pendeta'];
$tempat = $_POST['tempat'];
$waktu = $_POST['waktu'];

// Lakukan validasi data
if (empty($id_pelayanan) || empty($id_p_pelayanan) || empty($id_pendeta) || empty($tempat) || empty($waktu)) {
    echo "data_tidak_lengkap";
    exit();
}
$tempat_data = str_replace('<br>', "\n", $tempat);
$format = date('d-M-Y', strtotime($waktu));
// Buat query SQL untuk mengupdate data
$query_update = "UPDATE pelayanan SET id_p_pelayanan = '$id_p_pelayanan', id_pendeta = '$id_pendeta', tempat = '$tempat_data', waktu = '$format' WHERE id_pelayanan = '$id_pelayanan'";

// Jalankan query
if (mysqli_query($koneksi, $query_update)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
