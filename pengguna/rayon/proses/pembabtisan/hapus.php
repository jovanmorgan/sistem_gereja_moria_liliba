<?php
include '../../../../keamanan/koneksi.php';

// Terima ID pembabtisan yang akan dihapus dari formulir HTML
$id_pembabtisan = $_POST['id']; // Ubah menjadi $_GET jika menggunakan metode GET

// Lakukan validasi data
if (empty($id_pembabtisan)) {
    echo "data_tidak_lengkap";
    exit();
}

// Buat query SQL untuk menghapus data pembabtisan berdasarkan ID
$query_delete_pembabtisan = "DELETE FROM pembabtisan WHERE id_pembabtisan = '$id_pembabtisan'";

// Jalankan query untuk menghapus data
if (mysqli_query($koneksi, $query_delete_pembabtisan)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
