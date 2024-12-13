<?php
// Include database connection
include '../../../../keamanan/koneksi.php';

// Validate and sanitize id_rayon
$id_rayon = isset($_GET['id_rayon']) ? intval($_GET['id_rayon']) : 0;

// Query to retrieve kepala keluarga for the selected rayon
$query = "SELECT id_kepala_keluarga, nama FROM kepala_keluarga WHERE id_rayon = $id_rayon";
$result = $koneksi->query($query);

// Prepare an array to store kepala keluarga data
$kepala_keluarga = [];

// Fetch data and store in array
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $kepala_keluarga[] = [
            'id_kepala_keluarga' => $row['id_kepala_keluarga'],
            'nama' => $row['nama']
        ];
    }
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($kepala_keluarga);

// Close database connection
$koneksi->close();
