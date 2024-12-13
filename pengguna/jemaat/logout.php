<?php
session_start();

// Hapus sesi id_kepala_keluarga jika ada
if (isset($_SESSION['id_kepala_keluarga'])) {
    unset($_SESSION['id_kepala_keluarga']);
}

// Redirect pengguna kembali ke halaman login
header("Location: ../../berlangganan/login");
exit;
