<?php
session_start();

// Hapus sesi id_rayon jika ada
if (isset($_SESSION['id_rayon'])) {
    unset($_SESSION['id_rayon']);
}

// Redirect pengguna kembali ke halaman login
header("Location: ../../berlangganan/login");
exit;
