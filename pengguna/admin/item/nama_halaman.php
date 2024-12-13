<?php
if (!function_exists('getPageTitle')) {
    function getPageTitle()
    {
        $current_page = basename($_SERVER['PHP_SELF'], ".php");
        $titles = [
            'dashboard' => 'Dashboard',
            'jemaat' => 'Jemaat',
            'rayon' => 'Rayon',
            'jadwal_pelayanan' => 'Jadwal Pelayanan',
            'jenis_pelayanan' => 'Jenis Pelayanan',
            'pengumuman' => 'Pengumuman',
            'pendeta' => 'Pendeta',
            'permohonan_pelayanan' => 'Permohonan Pelayanan',
            'pembabtisan' => 'pembaptisan',
            'katekasasi' => 'Katekasasi',
            'majelis' => 'Majelis',
            'kk' => 'kepala Keluarga',
            'profile' => 'Profile',
            'logout' => 'Logout'
        ];

        return isset($titles[$current_page]) ? $titles[$current_page] : 'Halaman Pelayanan';
    }
}
