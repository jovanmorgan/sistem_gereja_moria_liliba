<?php
include '../../../../keamanan/koneksi.php';

// Terima data dari formulir HTML
$id_jemaat = $_POST['id_jemaat'];
$nama = $_POST['nama'];
$no_hp = $_POST['no_hp'];
$id_rayon = $_POST['id_rayon'];
$id_kepala_keluarga = $_POST['id_kepala_keluarga'];
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

// Lakukan validasi data
if (empty($id_jemaat) || empty($nama) || empty($no_hp) || empty($id_rayon) || empty($id_kepala_keluarga) || empty($alamat) || empty($jenis_kelamin) || empty($tempat_lahir) || empty($tanggal_lahir) || empty($status_baptis) || empty($status_sidi) || empty($status_nikah) || empty($status_keluarga) || empty($tanggal_nikah) || empty($pendidikan_terakhir) || empty($pekerjaan) || empty($usaha_sampingan) || empty($status_sosial) || empty($pendapatan) || empty($status_diakonia) || empty($diakonia) || empty($bantuan_pemerintah) || empty($kondisi_rumah) || empty($kepemilikan_rumah) || empty($status_bpjs) || empty($biaya_bpjs) || empty($etnis) || empty($golongan_darah) || empty($agama_sebelumnya) || empty($gereja_sebelumnya) || empty($status_jemaat)) {
    echo "data_tidak_lengkap";
    exit();
}

// Escape semua nilai input untuk mencegah SQL Injection
$nama = mysqli_real_escape_string($koneksi, $nama);
$alamat = mysqli_real_escape_string($koneksi, $alamat);
$tempat_lahir = mysqli_real_escape_string($koneksi, $tempat_lahir);
$diakonia = mysqli_real_escape_string($koneksi, $diakonia);
$agama_sebelumnya = mysqli_real_escape_string($koneksi, $agama_sebelumnya);
$gereja_sebelumnya = mysqli_real_escape_string($koneksi, $gereja_sebelumnya);

// Buat query SQL untuk mengupdate data
$query_update = "UPDATE jemaat SET 
                nama = '$nama', 
                no_hp = '$no_hp', 
                id_rayon = '$id_rayon', 
                id_kepala_keluarga = '$id_kepala_keluarga', 
                alamat = '$alamat', 
                jenis_kelamin = '$jenis_kelamin', 
                tempat_lahir = '$tempat_lahir', 
                tanggal_lahir = '$tanggal_lahir', 
                status_baptis = '$status_baptis', 
                status_sidi = '$status_sidi', 
                status_nikah = '$status_nikah', 
                status_keluarga = '$status_keluarga', 
                tanggal_nikah = '$tanggal_nikah', 
                pendidikan_terakhir = '$pendidikan_terakhir', 
                tahun_pendidikan_terakhir = '$tahun_pendidikan_terakhir', 
                pekerjaan = '$pekerjaan', 
                usaha_sampingan = '$usaha_sampingan', 
                status_sosial = '$status_sosial', 
                pendapatan = '$pendapatan', 
                status_diakonia = '$status_diakonia', 
                diakonia = '$diakonia', 
                bantuan_pemerintah = '$bantuan_pemerintah', 
                kondisi_rumah = '$kondisi_rumah', 
                kepemilikan_rumah = '$kepemilikan_rumah', 
                status_bpjs = '$status_bpjs', 
                biaya_bpjs = '$biaya_bpjs', 
                etnis = '$etnis', 
                golongan_darah = '$golongan_darah', 
                agama_sebelumnya = '$agama_sebelumnya', 
                gereja_sebelumnya = '$gereja_sebelumnya', 
                status_jemaat = '$status_jemaat' 
                WHERE id_jemaat = '$id_jemaat'";

// Jalankan query
if (mysqli_query($koneksi, $query_update)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
