<?php
include '../../../../keamanan/koneksi.php';

// Terima data dari formulir HTML
$jenis_pelayanan = $_POST['jenis_pelayanan'];

// Lakukan validasi data
if (empty($jenis_pelayanan)) {
    echo "data_tidak_lengkap";
    exit();
}
// Buat query SQL untuk menambahkan data masyarakat ke dalam database
$query = "INSERT INTO jenis_pelayanan (jenis_pelayanan) 
        VALUES ('$jenis_pelayanan')";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
