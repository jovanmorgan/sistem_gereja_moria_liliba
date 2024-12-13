<?php
session_start();

// Periksa apakah pengguna sudah masuk atau belum
if (!isset($_SESSION['id_pendeta'])) {
    // Pengguna belum masuk, arahkan kembali ke halaman masuk.php
    header("Location: ../../../../berlangganan/login");
    exit; // Pastikan untuk menghentikan eksekusi skrip setelah mengarahkan
}

// Jika pengguna sudah masuk, Anda dapat melanjutkan menampilkan halaman pendeta.php seperti biasa
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../../../../images/logo_dinas.png">
    <title>
        Export Data pendeta | Gereja Moria Liliba
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
                        <h3 class="text-center">Data pendeta</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered display nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nomor
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama
                                            Rayon</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jenis
                                            Kelamin</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Alamat
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Username</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Password</th>
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
                                    $search_sql = !empty($search_query) ? " WHERE nama LIKE '%$search_query%' OR umur LIKE '%$search_query%' OR alamat LIKE '%$search_query%' OR jenis_kelamin LIKE '%$search_query%'" : '';
                                    $count_query = "SELECT COUNT(*) AS total FROM pendeta" . $search_sql;
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
                                    $data_query = "SELECT * FROM pendeta" . $search_sql . " ORDER BY id_pendeta DESC LIMIT " . $starting_limit . ", " . $results_per_page;
                                    $result = mysqli_query($koneksi, $data_query);

                                    $counter = 1;
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $alamat_sambung = str_replace(array("\r", "\n"), '', nl2br($row['alamat']));
                                            echo "<tr>";
                                            echo "<td class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>" . $counter . "</span></td>";
                                            echo "<td class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>" . $row['nama'] . "</span></td>";
                                            echo "<td class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>" . $row['jenis_kelamin'] . "</span></td>";
                                            echo "<td class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>" . $alamat_sambung . "</span></td>";
                                            echo "<td class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>" . $row['username'] . "</span></td>";
                                            echo "<td class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>" . $row['password'] . "</span></td>";
                                            echo "</tr>";
                                            $counter++;
                                        }
                                    } else {
                                        echo "<tr><td colspan='7' class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>TIdak Ada Data Yang Ditemukan..</span></td></tr>";
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