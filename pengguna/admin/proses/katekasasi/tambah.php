<?php
include '../../../../keamanan/koneksi.php';

// Terima data dari formulir HTML
$nama = $_POST['nama'];
$umur = $_POST['umur'];
$alamat = $_POST['alamat'];
$jenis_kelamin = $_POST['jenis_kelamin'];

// Lakukan validasi data
if (empty($nama) || empty($umur) || empty($alamat) || empty($jenis_kelamin)) {
    echo "data_tidak_lengkap";
    exit();
}
$alamat_program_data = str_replace('<br>', "\n", $alamat);
// Buat query SQL untuk menambahkan data masyarakat ke dalam database
$query = "INSERT INTO katekasasi (nama, umur, alamat, jenis_kelamin) 
        VALUES ('$nama','$umur', '$alamat_program_data', '$jenis_kelamin')";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
