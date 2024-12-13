<?php
include '../../../../keamanan/koneksi.php';

// Terima data dari formulir HTML
$id_p_pelayanan = $_POST['id_p_pelayanan'];
$id_pendeta = $_POST['id_pendeta'];
$tempat = $_POST['tempat'];
$waktu = $_POST['waktu'];

// Lakukan validasi data
if (empty($id_p_pelayanan) || empty($id_pendeta) || empty($tempat) || empty($waktu)) {
    echo "data_tidak_lengkap";
    exit();
}
$tempat_program_data = str_replace('<br>', "\n", $tempat);
$format = date('d-M-Y H:i', strtotime($waktu));
// Buat query SQL untuk menambahkan data masyarakat ke dalam database
$query = "INSERT INTO pelayanan (id_p_pelayanan, id_pendeta, tempat, waktu) 
        VALUES ('$id_p_pelayanan','$id_pendeta', '$tempat_program_data', '$format')";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
