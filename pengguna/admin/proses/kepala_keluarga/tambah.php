<?php
include '../../../../keamanan/koneksi.php';

// Terima data dari formulir HTML
$nama = $_POST['nama'];
$no_hp = $_POST['no_hp'];
$id_rayon = $_POST['id_rayon'];
$username = $_POST['username'];
$password = $_POST['password'];

// Lakukan validasi data
if (empty($nama) || empty($no_hp) || empty($id_rayon) || empty($username) || empty($password)) {
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
$check_query_admin = "SELECT * FROM admin WHERE username = '$username'";
$result_admin = mysqli_query($koneksi, $check_query_admin);
if (mysqli_num_rows($result_admin) > 0) {
    echo "error_username_exists"; // Kirim respon "error_email_exists" jika email sudah terdaftar
    exit();
}
// Cek apakah username sudah ada di database
$check_query_kepala_keluarga = "SELECT * FROM kepala_keluarga WHERE username = '$username'";
$result_kepala_keluarga = mysqli_query($koneksi, $check_query_kepala_keluarga);
if (mysqli_num_rows($result_kepala_keluarga) > 0) {
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

// Buat query SQL untuk menambahkan data masyarakat ke dalam database
$query = "INSERT INTO kepala_keluarga (nama, id_rayon, no_hp, username, password) 
        VALUES ('$nama','$id_rayon', '$no_hp', '$username', '$password')";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
