<?php
session_start();

// Hapus sesi id_pendeta jika ada
if (isset($_SESSION['id_pendeta'])) {
    unset($_SESSION['id_pendeta']);
}

// Redirect pengguna kembali ke halaman login
header("Location: ../../berlangganan/login");
exit;
