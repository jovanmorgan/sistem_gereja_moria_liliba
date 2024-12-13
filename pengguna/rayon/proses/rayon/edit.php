<?php
include '../../../../keamanan/koneksi.php';

// Terima data dari formulir HTML
$id_rayon = $_POST['id_rayon'];
$nama_rayon = $_POST['nama_rayon'];
$alamat = $_POST['alamat'];
$id_majelis = $_POST['id_majelis'];
$username = $_POST['username'];
$password = $_POST['password'];

// Lakukan validasi data
if (empty($id_rayon) || empty($nama_rayon) || empty($alamat) || empty($id_majelis) || empty($username) || empty($password)) {
    echo "data_tidak_lengkap";
    exit();
}


// Cek apakah username sudah ada di database
$check_query = "SELECT * FROM pendeta WHERE username = '$username'";
$result = mysqli_query($koneksi, $check_query);
if (mysqli_num_rows($result) > 0) {
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
$check_query_rayon = "SELECT * FROM rayon WHERE username = '$username' AND id_rayon != '$id_rayon'";
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
$query_update = "UPDATE rayon SET nama_rayon = '$nama_rayon', alamat = '$alamat_program_data', id_majelis = '$id_majelis', username = '$username', password = '$password' WHERE id_rayon = '$id_rayon'";

// Jalankan query
if (mysqli_query($koneksi, $query_update)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
