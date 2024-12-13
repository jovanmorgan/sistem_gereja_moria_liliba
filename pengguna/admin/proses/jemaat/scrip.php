<?php
include '../../keamanan/koneksi.php';

$id_rayon = isset($_GET['id_rayon']) ? $_GET['id_rayon'] : '';

$where_clause = $id_rayon ? "WHERE id_rayon = '$id_rayon'" : "";

// Query untuk data pendidikan
$pendidikan_query = "SELECT CONCAT(pendidikan_terakhir, ' ', tahun_pendidikan_terakhir) AS pendidikan_tahun, COUNT(*) AS total FROM jemaat $where_clause GROUP BY pendidikan_tahun";
$pendidikan_result = mysqli_query($koneksi, $pendidikan_query);
$pendidikan_data = [];
while ($row = mysqli_fetch_assoc($pendidikan_result)) {
    $pendidikan_data[$row['pendidikan_tahun']] = $row['total'];
}

// Query untuk data status nikah
$status_nikah_query = "SELECT status_nikah, COUNT(*) AS total FROM jemaat $where_clause GROUP BY status_nikah";
$status_nikah_result = mysqli_query($koneksi, $status_nikah_query);
$status_nikah_data = [];
while ($row = mysqli_fetch_assoc($status_nikah_result)) {
    $status_nikah_data[$row['status_nikah']] = $row['total'];
}

// Query untuk data pekerjaan
$pekerjaan_query = "SELECT pekerjaan, COUNT(*) AS total FROM jemaat $where_clause GROUP BY pekerjaan";
$pekerjaan_result = mysqli_query($koneksi, $pekerjaan_query);
$pekerjaan_data = [];
while ($row = mysqli_fetch_assoc($pekerjaan_result)) {
    $pekerjaan_data[$row['pekerjaan']] = $row['total'];
}

// Query untuk data pendapatan
$pendapatan_query = "SELECT pendapatan FROM jemaat $where_clause";
$pendapatan_result = mysqli_query($koneksi, $pendapatan_query);
$pendapatan_data = [];
while ($row = mysqli_fetch_assoc($pendapatan_result)) {
    $pendapatan = str_replace('.', '', $row['pendapatan']);
    $pendapatan = str_replace(',', '.', $pendapatan);
    $pendapatan = floatval($pendapatan);
    $pendapatan_data[] = $pendapatan;
}

// Mengirim data dalam format JSON
echo json_encode([
    'pendidikan' => ['labels' => array_keys($pendidikan_data), 'counts' => array_values($pendidikan_data)],
    'status_nikah' => ['labels' => array_keys($status_nikah_data), 'counts' => array_values($status_nikah_data)],
    'pekerjaan' => ['labels' => array_keys($pekerjaan_data), 'counts' => array_values($pekerjaan_data)],
    'pendapatan' => ['labels' => array_fill(0, count($pendapatan_data), ''), 'counts' => $pendapatan_data]
]);
