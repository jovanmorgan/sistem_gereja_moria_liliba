<?php
include '../../../../keamanan/koneksi.php';

// Terima data dari formulir HTML
$id_jenis_pelayanan = $_POST['id_jenis_pelayanan'];
$id_rayon = $_POST['id_rayon'];

// Lakukan validasi data
if (empty($id_jenis_pelayanan) || empty($id_rayon)) {
    echo "data_tidak_lengkap";
    exit();
}
// Buat query SQL untuk menambahkan data masyarakat ke dalam database
$query = "INSERT INTO p_pelayanan (id_jenis_pelayanan, id_rayon) 
        VALUES ('$id_jenis_pelayanan', '$id_rayon')";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
