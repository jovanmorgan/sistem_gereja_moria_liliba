<?php
include '../../keamanan/koneksi.php'; // Sesuaikan path ke file koneksi.php
include 'nama_halaman.php';

// Fungsi untuk mengecek nama halaman
function isKKPage()
{
    return basename($_SERVER['PHP_SELF']) === 'kk.php';
}

function isJemaatPage()
{
    return basename($_SERVER['PHP_SELF']) === 'jemaat.php';
}

// Ambil id_rayon dari parameter GET atau POST
$id_rayon = isset($_GET['id_rayon']) ? $_GET['id_rayon'] : '';

// Ambil id_kepala_keluarga dari parameter GET atau POST
$id_kepala_keluarga = isset($_GET['id_kepala_keluarga']) ? $_GET['id_kepala_keluarga'] : '';

// Variabel untuk nama rayon
$nama_rayon = '';
// Variabel untuk nama kepala keluarga
$nama_kepala_keluarga = '';

// Query untuk mengambil nama_rayon berdasarkan id_rayon, hanya jika ada id_rayon
if (!empty($id_rayon)) {
    $query_nama_rayon = "SELECT nama_rayon FROM rayon WHERE id_rayon = $id_rayon";
    $result_nama_rayon = mysqli_query($koneksi, $query_nama_rayon);

    if ($result_nama_rayon && mysqli_num_rows($result_nama_rayon) > 0) {
        $row_nama_rayon = mysqli_fetch_assoc($result_nama_rayon);
        $nama_rayon = $row_nama_rayon['nama_rayon'];
    } else {
        $nama_rayon = 'Rayon Tidak Ditemukan';
    }
} else {
    $nama_rayon = 'Nama Rayon Tidak Tersedia';
}

// Query untuk mengambil nama kepala keluarga berdasarkan id_kepala_keluarga, hanya jika ada id_kepala_keluarga
if (!empty($id_kepala_keluarga)) {
    $query_nama_kepala_keluarga = "SELECT nama FROM kepala_keluarga WHERE id_kepala_keluarga = $id_kepala_keluarga";
    $result_nama_kepala_keluarga = mysqli_query($koneksi, $query_nama_kepala_keluarga);

    if ($result_nama_kepala_keluarga && mysqli_num_rows($result_nama_kepala_keluarga) > 0) {
        $row_nama_kepala_keluarga = mysqli_fetch_assoc($result_nama_kepala_keluarga);
        $nama_kepala_keluarga = $row_nama_kepala_keluarga['nama'];
    } else {
        $nama_kepala_keluarga = 'Kepala Keluarga Tidak Ditemukan';
    }
} else {
    $nama_kepala_keluarga = 'Nama Kepala Keluarga Tidak Tersedia';
}
?>

<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
        <h3 class="text-white text-capitalize ps-3 text-center">Data <?php echo getPageTitle(); ?></h3>
        <?php if (isKKPage()) : ?>
            <h5 class="text-white text-capitalize ps-3 text-center">Rayon: <?php echo $nama_rayon; ?></h5>
        <?php endif; ?>
        <?php if (isJemaatPage()) : ?>
            <h5 class="text-white text-capitalize ps-3 text-center">Kepala Keluarga: <?php echo $nama_kepala_keluarga; ?></h5>
        <?php endif; ?>
    </div>
</div>