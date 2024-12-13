<?php
include '../../../../keamanan/koneksi.php';

// Terima data dari formulir HTML
$nama = $_POST['nama'];
$no_hp = $_POST['no_hp'];
$id_rayon = $_POST['id_rayon'];
$alamat = $_POST['alamat'];
$jenis_kelamin = $_POST['jenis_kelamin'];

// Lakukan validasi data
if (empty($nama) || empty($no_hp) || empty($id_rayon) || empty($alamat) || empty($jenis_kelamin)) {
    echo "data_tidak_lengkap";
    exit();
}
$alamat_program_data = str_replace('<br>', "\n", $alamat);
// Buat query SQL untuk menambahkan data masyarakat ke dalam database
$query = "INSERT INTO jemaat (nama, id_rayon, no_hp, alamat, jenis_kelamin) 
        VALUES ('$nama','$id_rayon', '$no_hp', '$alamat_program_data', '$jenis_kelamin')";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
