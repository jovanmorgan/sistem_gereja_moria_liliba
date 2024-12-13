<?php
include '../../../../keamanan/koneksi.php';

// Terima ID pengumuman yang akan dihapus dari formulir HTML
$id_pengumuman = $_POST['id']; // Ubah menjadi $_GET jika menggunakan metode GET

// Lakukan validasi data
if (empty($id_pengumuman)) {
    echo "data_tidak_lengkap";
    exit();
}

// Buat query SQL untuk menghapus data pengumuman berdasarkan ID
$query_delete_pengumuman = "DELETE FROM pengumuman WHERE id_pengumuman = '$id_pengumuman'";

// Jalankan query untuk menghapus data
if (mysqli_query($koneksi, $query_delete_pengumuman)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
