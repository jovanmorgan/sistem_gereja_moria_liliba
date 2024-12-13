<?php
include '../../../../keamanan/koneksi.php';

// Terima ID p_pelayanan yang akan dihapus dari formulir HTML
$id_p_pelayanan = $_POST['id'];
$status = "Disetujui";

// Lakukan validasi data
if (empty($id_p_pelayanan)) {
    echo "data_tidak_lengkap";
    exit();
}

// Buat query SQL untuk mengupdate data
$query_update = "UPDATE p_pelayanan SET status = '$status' WHERE id_p_pelayanan = '$id_p_pelayanan'";

// Jalankan query
if (mysqli_query($koneksi, $query_update)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
