<?php
session_start();

// Periksa apakah pengguna sudah masuk atau belum
if (!isset($_SESSION['id_rayon'])) {
    // Pengguna belum masuk, arahkan kembali ke halaman masuk.php
    header("Location: ../../../../berlangganan/login");
    exit; // Pastikan untuk menghentikan eksekusi skrip setelah mengarahkan
}
$id_rayon = isset($_GET['id_rayon']) ? $_GET['id_rayon'] : '';
// Jika pengguna sudah masuk, Anda dapat melanjutkan menampilkan halaman rayon.php seperti biasa
?>

<div class="card-body px-0 pb-2" id="dataTable">
    <div class="table-responsive p-0">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nomor
                    </th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama
                    </th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nomor Hp
                    </th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Username
                    </th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Password
                    </th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Detail
                        Jemaat</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi
                    </th>
                </tr>
            </thead>

            <tbody>
                <?php
                // Jika pengguna sudah masuk, Anda dapat melanjutkan menampilkan halaman rayon.php seperti biasa
                include '../../../../keamanan/koneksi.php';

                // Define how many results you want per page
                $results_per_page = 10;

                // Get search query from URL if it exists
                $search_query = isset($_GET['search_query']) ? $_GET['search_query'] : '';

                // Find out the number of results stored in the database
                $search_sql = !empty($search_query) ? " AND (nama LIKE '%$search_query%' OR no_hp LIKE '%$search_query%' OR username LIKE '%$search_query%' OR password LIKE '%$search_query%')" : '';
                $count_query = "SELECT COUNT(*) AS total FROM rayon WHERE id_rayon = '$id_rayon'" . $search_sql;
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
                $data_query = "SELECT * FROM rayon WHERE id_rayon = '$id_rayon'" . $search_sql . " ORDER BY id_rayon DESC LIMIT " . $starting_limit . ", " . $results_per_page;
                $result = mysqli_query($koneksi, $data_query);

                $counter = 1;
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id_rayon = $row['id_rayon'];
                        echo "<tr>";
                        echo "<td class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>" . $counter . "</span></td>";
                        echo "<td class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>" . $row['nama'] . "</span></td>";
                        echo "<td class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>" . $row['no_hp'] . "</span></td>";
                        echo "<td class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>" . $row['username'] . "</span></td>";
                        echo "<td class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>" . $row['password'] . "</span></td>";
                        echo "<td class='align-middle text-center'>";
                        echo "<a href='jemaat.php?id_rayon=" . $id_rayon . "' class='text-secondary font-weight-bold text-xs' data-toggle='tooltip' data-original-title='Detail KK'>";
                        echo "<i class='fas fa-users fa-2x' style='color: blue;'></i> ";
                        echo "</a>";
                        echo "</td>";
                        echo "<td class='align-middle text-center'>";
                        echo "<a href='javascript:;' class='text-secondary font-weight-bold text-xs' data-toggle='tooltip' data-original-title='Edit user' onclick='openEditModal(
                                      \"" . $row['id_rayon'] . "\",
                                      \"" . $row['nama'] . "\",
                                      \"" . $row['no_hp'] . "\",
                                      \"" . $row['username'] . "\",
                                      \"" . $row['password'] . "\"
                                )'><i class='fas fa-edit' style='font-size: 24px; color: green;'></i></a>";
                        echo "<a href='javascript:;' style='margin-left: 30px;' class='text-secondary font-weight-bold text-xs' data-toggle='tooltip' data-original-title='Delete user' onclick='hapus(\"" . $row['id_rayon'] . "\")'>";
                        echo "<i class='fas fa-trash fa-2x' style='color: red;'></i>";
                        echo "</a>";
                        echo "</td>";
                        echo "</tr>";
                        $counter++;
                    }
                } else {
                    echo "<tr><td colspan='6' class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>Tidak Ada Data Yang Ditemukan..</span></td></tr>";
                }
                ?>

            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-5">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <?php if ($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $page - 1; ?>&search_query=<?php echo $search_query; ?>"
                            aria-label="Previous">
                            <span aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php if ($i == $page)
                        echo 'active'; ?>">
                        <a class="page-link <?php if ($i == $page)
                            echo 'text-white bg-dark';
                        else
                            echo 'text-dark'; ?>"
                            href="?page=<?php echo $i; ?>&search_query=<?php echo $search_query; ?>">
                            <?php echo $i; ?>
                        </a>
                    </li>
                <?php endfor; ?>
                <?php if ($page < $total_pages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $page + 1; ?>&search_query=<?php echo $search_query; ?>"
                            aria-label="Next">
                            <span aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
    <!-- End Pagination -->
</div>

<?php
// Close the database connection
mysqli_close($koneksi);
?>