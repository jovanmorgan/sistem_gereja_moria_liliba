<?php
include '../../../../keamanan/koneksi.php';

// Terima ID jenis_pelayanan yang akan dihapus dari formulir HTML
$id_jenis_pelayanan = $_POST['id']; // Ubah menjadi $_GET jika menggunakan metode GET

// Lakukan validasi data
if (empty($id_jenis_pelayanan)) {
    echo "data_tidak_lengkap";
    exit();
}

// Buat query SQL untuk menghapus data jenis_pelayanan berdasarkan ID
$query_delete_jenis_pelayanan = "DELETE FROM jenis_pelayanan WHERE id_jenis_pelayanan = '$id_jenis_pelayanan'";

// Jalankan query untuk menghapus data
if (mysqli_query($koneksi, $query_delete_jenis_pelayanan)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
