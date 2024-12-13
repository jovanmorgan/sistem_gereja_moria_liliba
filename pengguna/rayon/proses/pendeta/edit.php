<?php
include '../../../../keamanan/koneksi.php';

// Terima data dari formulir HTML
$id_pendeta = $_POST['id_pendeta'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$username = $_POST['username'];
$password = $_POST['password'];

// Lakukan validasi data
if (empty($id_pendeta) || empty($nama) || empty($alamat) || empty($jenis_kelamin) || empty($username) || empty($password)) {
    echo "data_tidak_lengkap";
    exit();
}


// Cek apakah username sudah ada di database
$check_query_rayon = "SELECT * FROM rayon WHERE username = '$username'";
$result_rayon = mysqli_query($koneksi, $check_query_rayon);
if (mysqli_num_rows($result_rayon) > 0) {
    echo "error_username_exists"; // Kirim respon "error_email_exists" jika email sudah terdaftar
    exit();
}
// Cek apakah username sudah ada di database
$check_query_rayon = "SELECT * FROM rayon WHERE username = '$username'";
$result_rayon = mysqli_query($koneksi, $check_query_rayon);
if (mysqli_num_rows($result_rayon) > 0) {
    echo "error_username_exists"; // Kirim respon "error_email_exists" jika email sudah terdaftar
    exit();
}
// Cek apakah username sudah ada di database
$check_query_pendeta = "SELECT * FROM pendeta WHERE username = '$username' AND id_pendeta != '$id_pendeta'";
$result_pendeta = mysqli_query($koneksi, $check_query_pendeta);
if (mysqli_num_rows($result_pendeta) > 0) {
    echo "error_username_exists"; // Kirim respon "error_email_exists" jika email sudah terdaftar
    exit();
}
// Cek apakah username sudah ada di database
$check_query_rayon = "SELECT * FROM rayon WHERE username = '$username'";
$result_rayon = mysqli_query($koneksi, $check_query_rayon);
if (mysqli_num_rows($result_rayon) > 0) {
    echo "error_username_exists"; // Kirim respon "error_email_exists" jika email sudah terdaftar
    exit();
}

if (strlen($password) < 8) {
    echo "error_password_length"; // Kirim respon "error_password_length" jika panjang password kurang dari 8 karakter
    exit();
}

// Tambahkan logika untuk memeriksa password
if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/", $password)) {
    echo "error_password_strength"; // Kirim respon "error_password_strength" jika password tidak memenuhi syarat
    exit();
}


$alamat_program_data = str_replace('<br>', "\n", $alamat);
// Buat query SQL untuk mengupdate data
$query_update = "UPDATE pendeta SET nama = '$nama', alamat = '$alamat_program_data', jenis_kelamin = '$jenis_kelamin', username = '$username', password = '$password' WHERE id_pendeta = '$id_pendeta'";

// Jalankan query
if (mysqli_query($koneksi, $query_update)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
