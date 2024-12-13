<?php
include '../../../../keamanan/koneksi.php';

// Terima ID p_pelayanan yang akan dihapus dari formulir HTML
$id_p_pelayanan = $_POST['id']; // Ubah menjadi $_GET jika menggunakan metode GET

// Lakukan validasi data
if (empty($id_p_pelayanan)) {
    echo "data_tidak_lengkap";
    exit();
}

// Buat query SQL untuk menghapus data p_pelayanan berdasarkan ID
$query_delete_p_pelayanan = "DELETE FROM p_pelayanan WHERE id_p_pelayanan = '$id_p_pelayanan'";

// Jalankan query untuk menghapus data
if (mysqli_query($koneksi, $query_delete_p_pelayanan)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
