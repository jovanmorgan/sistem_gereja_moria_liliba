<?php
include '../../../../keamanan/koneksi.php';

// Terima data dari formulir HTML
$id_jenis_pelayanan = $_POST['id_jenis_pelayanan'];
$id_rayon = $_POST['id_rayon'];
$id_kepala_keluarga = $_POST['id_kepala_keluarga'];
$waktu = $_POST['waktu'];
$tempat = $_POST['tempat'];

// Lakukan validasi data
if (empty($id_jenis_pelayanan) || empty($id_rayon) || empty($waktu) || empty($tempat)) {
    echo "data_tidak_lengkap";
    exit();
}
$tempat_data = str_replace('<br>', "\n", $tempat);
$format = date('d-M-Y H:i', strtotime($waktu));
// Buat query SQL untuk menambahkan data masyarakat ke dalam database
$query = "INSERT INTO p_pelayanan (id_jenis_pelayanan, id_kepala_keluarga, id_rayon, waktu, tempat) 
        VALUES ('$id_jenis_pelayanan', '$id_kepala_keluarga', '$id_rayon', '$format', '$tempat_data')";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
