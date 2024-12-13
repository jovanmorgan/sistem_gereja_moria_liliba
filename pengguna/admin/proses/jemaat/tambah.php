<?php
// Koneksi ke database
include '../../../../keamanan/koneksi.php';

// Ambil data dari form
$nama = $_POST['nama'];
$id_rayon = $_POST['id_rayon'];
$id_kepala_keluarga = $_POST['id_kepala_keluarga'];
$no_hp = $_POST['no_hp'];
$alamat = $_POST['alamat'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$tempat_lahir = $_POST['tempat_lahir'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$status_baptis = $_POST['status_baptis'];
$status_sidi = $_POST['status_sidi'];
$status_nikah = $_POST['status_nikah'];
$status_keluarga = $_POST['status_keluarga'];
$tanggal_nikah = $_POST['tanggal_nikah'];
$pendidikan_terakhir = $_POST['pendidikan_terakhir'];
$tahun_pendidikan_terakhir = $_POST['tahun_pendidikan_terakhir'];
$pekerjaan = $_POST['pekerjaan'];
$usaha_sampingan = $_POST['usaha_sampingan'];
$status_sosial = $_POST['status_sosial'];
$pendapatan = $_POST['pendapatan'];
$status_diakonia = $_POST['status_diakonia'];
$diakonia = $_POST['diakonia'];
$bantuan_pemerintah = $_POST['bantuan_pemerintah'];
$kondisi_rumah = $_POST['kondisi_rumah'];
$kepemilikan_rumah = $_POST['kepemilikan_rumah'];
$status_bpjs = $_POST['status_bpjs'];
$biaya_bpjs = $_POST['biaya_bpjs'];
$etnis = $_POST['etnis'];
$golongan_darah = $_POST['golongan_darah'];
$agama_sebelumnya = $_POST['agama_sebelumnya'];
$gereja_sebelumnya = $_POST['gereja_sebelumnya'];
$status_jemaat = $_POST['status_jemaat'];

// Query untuk menambahkan data ke tabel jemaat
$query = "INSERT INTO jemaat (nama, id_rayon, id_kepala_keluarga, no_hp, alamat, jenis_kelamin, tempat_lahir, tanggal_lahir, status_baptis, status_sidi, status_nikah, status_keluarga, tanggal_nikah, pendidikan_terakhir, tahun_pendidikan_terakhir, pekerjaan, usaha_sampingan, status_sosial, pendapatan, status_diakonia, diakonia, bantuan_pemerintah, kondisi_rumah, kepemilikan_rumah, status_bpjs, biaya_bpjs, etnis, golongan_darah, agama_sebelumnya, gereja_sebelumnya, status_jemaat) VALUES ('$nama', '$id_rayon', '$id_kepala_keluarga', '$no_hp', '$alamat', '$jenis_kelamin', '$tempat_lahir', '$tanggal_lahir', '$status_baptis', '$status_sidi', '$status_nikah', '$status_keluarga', '$tanggal_nikah', '$pendidikan_terakhir', '$tahun_pendidikan_terakhir', '$pekerjaan', '$usaha_sampingan', '$status_sosial', '$pendapatan', '$status_diakonia', '$diakonia', '$bantuan_pemerintah', '$kondisi_rumah', '$kepemilikan_rumah', '$status_bpjs', '$biaya_bpjs', '$etnis', '$golongan_darah', '$agama_sebelumnya', '$gereja_sebelumnya', '$status_jemaat')";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi
$koneksi->close();
