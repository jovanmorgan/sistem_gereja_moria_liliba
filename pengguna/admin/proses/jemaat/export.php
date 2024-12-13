<?php
session_start();

// Periksa apakah pengguna sudah masuk atau belum
if (!isset($_SESSION['id_admin'])) {
    // Pengguna belum masuk, arahkan kembali ke halaman masuk.php
    header("Location: ../../../../berlangganan/login");
    exit; // Pastikan untuk menghentikan eksekusi skrip setelah mengarahkan
}
$id_kepala_keluarga = isset($_GET['id_kepala_keluarga']) ? $_GET['id_kepala_keluarga'] : '';
// Jika pengguna sudah masuk, Anda dapat melanjutkan menampilkan halaman admin.php seperti biasa
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../../../../images/logo_dinas.png">
    <title>
        Export Data Jenis Pelayanan | Gereja Moria Liliba
    </title>
    <link rel="icon" type="image/png" href="../../../../assets/img/gml.png">
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap4.min.css">
    <style>
        /* Style scrollbar */
        .table-responsive::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        .table-responsive::-webkit-scrollbar-thumb {
            background-color: #888;
            border-radius: 10px;
        }

        .table-responsive::-webkit-scrollbar-track {
            background-color: #f1f1f1;
        }

        .button-like {
            display: inline-block;
            padding: 5px 10px;
            background-color: #4e73df;
            color: white;
            border-radius: 5px;
        }
    </style>
</head>

<body translate="no">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h3 class="text-center">Data Jenis Pelayanan</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered display nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nomor</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Rayon</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Kepala Keluarga</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jenis Kelamin</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Alamat</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nomor Hp</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tempat Lahir</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Lahir</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status Baptis</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status Sidi</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status Nikah</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status Keluarga</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Nikah</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pendidikan Terakhir</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tahun Pendidikan Terakhir</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pekerjaan</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Usaha Sampingan</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status Sosial</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pendapatan</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status Diakonia</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Diakonia</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Bantuan Pemerintah</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kondisi Rumah</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kepemilikan Rumah</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status BPJS</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Biaya BPJS</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Etnis</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Golongan Darah</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Agama Sebelumnya</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Gereja Sebelumnya</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status Jemaat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include '../../../../keamanan/koneksi.php';

                                    // Define how many results you want per page
                                    $results_per_page = 10;

                                    // Get search query from URL if it exists
                                    $search_query = isset($_GET['search_query']) ? $_GET['search_query'] : '';

                                    // Find out the number of results stored in the database
                                    $search_sql = !empty($search_query) ? " AND (jemaat.nama LIKE '%$search_query%' OR 
                    rayon.nama_rayon LIKE '%$search_query%' OR 
                    kepala_keluarga.nama LIKE '%$search_query%' OR 
                    jemaat.jenis_kelamin LIKE '%$search_query%' OR 
                    jemaat.alamat LIKE '%$search_query%' OR 
                    jemaat.no_hp LIKE '%$search_query%' OR 
                    jemaat.tempat_lahir LIKE '%$search_query%' OR 
                    jemaat.tanggal_lahir LIKE '%$search_query%' OR 
                    jemaat.status_baptis LIKE '%$search_query%' OR 
                    jemaat.status_sidi LIKE '%$search_query%' OR 
                    jemaat.status_nikah LIKE '%$search_query%' OR 
                    jemaat.status_keluarga LIKE '%$search_query%' OR 
                    jemaat.tanggal_nikah LIKE '%$search_query%' OR 
                    jemaat.pendidikan_terakhir LIKE '%$search_query%' OR 
                    jemaat.tahun_pendidikan_terakhir LIKE '%$search_query%' OR 
                    jemaat.pekerjaan LIKE '%$search_query%' OR 
                    jemaat.usaha_sampingan LIKE '%$search_query%' OR 
                    jemaat.status_sosial LIKE '%$search_query%' OR 
                    jemaat.pendapatan LIKE '%$search_query%' OR 
                    jemaat.status_diakonia LIKE '%$search_query%' OR 
                    jemaat.diakonia LIKE '%$search_query%' OR 
                    jemaat.bantuan_pemerintah LIKE '%$search_query%' OR 
                    jemaat.kondisi_rumah LIKE '%$search_query%' OR 
                    jemaat.kepemilikan_rumah LIKE '%$search_query%' OR 
                    jemaat.status_bpjs LIKE '%$search_query%' OR 
                    jemaat.biaya_bpjs LIKE '%$search_query%' OR 
                    jemaat.etnis LIKE '%$search_query%' OR 
                    jemaat.golongan_darah LIKE '%$search_query%' OR 
                    jemaat.agama_sebelumnya LIKE '%$search_query%' OR 
                    jemaat.gereja_sebelumnya LIKE '%$search_query%')" : '';
                                    $count_query = "SELECT COUNT(*) AS total FROM jemaat LEFT JOIN rayon ON jemaat.id_rayon = rayon.id_rayon LEFT JOIN kepala_keluarga ON jemaat.id_kepala_keluarga = kepala_keluarga.id_kepala_keluarga WHERE 1=1" . $search_sql;
                                    $result = mysqli_query($koneksi, $count_query);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_results = $row['total'];

                                    // Determine the total number of pages available
                                    $total_pages = ceil($total_results / $results_per_page);

                                    // Determine which page number visitor is currently on
                                    $page = isset($_GET['page']) ? $_GET['page'] : 1;

                                    // Determine the SQL LIMIT starting number for the results on the displaying page
                                    $starting_limit = ($page - 1) * $results_per_page;

                                    // Retrieve selected results from the database
                                    $data_query = "SELECT jemaat.*, rayon.nama_rayon AS nama_rayon, kepala_keluarga.nama AS nama_kk 
        FROM jemaat 
        LEFT JOIN rayon ON jemaat.id_rayon = rayon.id_rayon 
        LEFT JOIN kepala_keluarga ON jemaat.id_kepala_keluarga = kepala_keluarga.id_kepala_keluarga
        WHERE 1=1" . $search_sql . " ORDER BY id_jemaat DESC LIMIT " . $starting_limit . ", " . $results_per_page;
                                    $result = mysqli_query($koneksi, $data_query);

                                    $counter = 1;
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $id_jemaat = $row['id_jemaat'];
                                            $alamat_sambung = str_replace(array("\r", "\n"), '', nl2br($row['alamat']));
                                            echo "<tr>";
                                            echo "<td class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>" . $counter . "</span></td>";
                                            echo "<td class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>" . $row['nama_rayon'] . "</span></td>";
                                            echo "<td class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>" . $row['nama_kk'] . "</span></td>";
                                            echo "<td class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>" . $row['nama'] . "</span></td>";
                                            echo "<td class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>" . $row['jenis_kelamin'] . "</span></td>";
                                            echo "<td class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>" . $alamat_sambung . "</span></td>";
                                            echo "<td class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>" . $row['no_hp'] . "</span></td>";
                                            echo "<td class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>" . $row['tempat_lahir'] . "</span></td>";
                                            echo "<td class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>" . $row['tanggal_lahir'] . "</span></td>";
                                            echo "<td class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>" . $row['status_baptis'] . "</span></td>";
                                            echo "<td class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>" . $row['status_sidi'] . "</span></td>";
                                            echo "<td class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>" . $row['status_nikah'] . "</span></td>";
                                            echo "<td class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>" . $row['status_keluarga'] . "</span></td>";
                                            echo "<td class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>" . $row['tanggal_nikah'] . "</span></td>";
                                            echo "<td class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>" . $row['pendidikan_terakhir'] . "</span></td>";
                                            echo "<td class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>" . substr($row['tahun_pendidikan_terakhir'], 0, 4) . "</span></td>";
                                            echo "<td class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>" . $row['pekerjaan'] . "</span></td>";
                                            echo "<td class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>" . $row['usaha_sampingan'] . "</span></td>";
                                            echo "<td class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>" . $row['status_sosial'] . "</span></td>";
                                            echo "<td class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>" . $row['pendapatan'] . "</span></td>";
                                            echo "<td class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>" . $row['status_diakonia'] . "</span></td>";
                                            echo "<td class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>" . $row['diakonia'] . "</span></td>";
                                            echo "<td class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>" . $row['bantuan_pemerintah'] . "</span></td>";
                                            echo "<td class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>" . $row['kondisi_rumah'] . "</span></td>";
                                            echo "<td class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>" . $row['kepemilikan_rumah'] . "</span></td>";
                                            echo "<td class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>" . $row['status_bpjs'] . "</span></td>";
                                            echo "<td class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>" . $row['biaya_bpjs'] . "</span></td>";
                                            echo "<td class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>" . $row['etnis'] . "</span></td>";
                                            echo "<td class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>" . $row['golongan_darah'] . "</span></td>";
                                            echo "<td class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>" . $row['agama_sebelumnya'] . "</span></td>";
                                            echo "<td class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>" . $row['gereja_sebelumnya'] . "</span></td>";
                                            echo "<td class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>" . $row['status_jemaat'] . "</span></td>";
                                            echo "</tr>";
                                            $counter++;
                                        }
                                    } else {
                                        echo "<tr><td colspan='35' class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>Tidak Ada Data Yang Ditemukan..</span></td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tautan ke file jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Tautan ke file JavaScript DataTables -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap4.min.js"></script>
    <!-- Tautan ke file JavaScript untuk ekspor -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'pdfHtml5',
                        text: 'PDF A3',
                        customize: function(doc) {
                            doc.pageSize = 'A3';
                            doc.content[1].table.headerRows = 1;
                            doc.content[1].table.body[0].forEach(function(col) {
                                col.fillColor = '#cccccc';
                            });
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: 'PDF A4',
                        customize: function(doc) {
                            doc.pageSize = 'A4';
                            doc.content[1].table.headerRows = 1;
                            doc.content[1].table.body[0].forEach(function(col) {
                                col.fillColor = '#cccccc';
                            });
                        }
                    },
                    'copy', 'csv', 'excel', 'print'
                ]
            });
        });
    </script>
</body>

</html>