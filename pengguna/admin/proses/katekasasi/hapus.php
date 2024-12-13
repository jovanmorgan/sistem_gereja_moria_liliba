<?php
include '../../../../keamanan/koneksi.php';

// Terima ID katekasasi yang akan dihapus dari formulir HTML
$id_katekasasi = $_POST['id']; // Ubah menjadi $_GET jika menggunakan metode GET

// Lakukan validasi data
if (empty($id_katekasasi)) {
    echo "data_tidak_lengkap";
    exit();
}

// Buat query SQL untuk menghapus data katekasasi berdasarkan ID
$query_delete_katekasasi = "DELETE FROM katekasasi WHERE id_katekasasi = '$id_katekasasi'";

// Jalankan query untuk menghapus data
if (mysqli_query($koneksi, $query_delete_katekasasi)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
