<div class="card-body px-0 pb-2" id="dataTable">
    <div class="table-responsive p-0">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nomor</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Umur</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Alamat</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jenis Kelamin</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
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
                $count_query = "SELECT COUNT(*) AS total FROM majelis" . $search_sql;
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
                $data_query = "SELECT * FROM majelis" . $search_sql . " ORDER BY id_majelis DESC LIMIT " . $starting_limit . ", " . $results_per_page;
                $result = mysqli_query($koneksi, $data_query);

                $counter = 1;
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $alamat_sambung = str_replace(array("\r", "\n"), '', nl2br($row['alamat']));
                        echo "<tr>";
                        echo "<td class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>" . $counter . "</span></td>";
                        echo "<td class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>" . $row['nama'] . "</span></td>";
                        echo "<td class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>" . $row['umur'] . "</span></td>";
                        echo "<td class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>" . $alamat_sambung . "</span></td>";
                        echo "<td class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>" . $row['jenis_kelamin'] . "</span></td>";
                        echo "<td class='align-middle text-center'>";
                        echo "<a href='javascript:;' class='text-secondary font-weight-bold text-xs' data-toggle='tooltip' data-original-title='Edit user' onclick='openEditModal(
                              \"" . $row['id_majelis'] . "\",
                              \"" . $row['nama'] . "\",
                              \"" . $row['umur'] . "\",
                              \"" . $alamat_sambung . "\",
                              \"" . $row['jenis_kelamin'] . "\"
                        )'><i class='fas fa-edit' style='font-size: 24px; color: green;'></i></a>";
                        echo "<a href='javascript:;' style='margin-left: 30px;' class='text-secondary font-weight-bold text-xs' data-toggle='tooltip' data-original-title='Delete user' onclick='hapus(\"" . $row['id_majelis'] . "\")'>";
                        echo "<i class='fas fa-trash fa-2x' style='color: red;'></i>";
                        echo "</a>";
                        echo "</td>";
                        echo "</tr>";
                        $counter++;
                    }
                } else {
                    echo "<tr><td colspan='6' class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>TIdak Ada Data Yang Ditemukan..</span></td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-5">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <?php if ($page > 1) : ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $page - 1; ?>&search_query=<?php echo $search_query; ?>" aria-label="Previous">
                            <span aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                    <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                        <a class="page-link <?php if ($i == $page) echo 'text-white bg-dark';
                                            else echo 'text-dark'; ?>" href="?page=<?php echo $i; ?>&search_query=<?php echo $search_query; ?>">
                            <?php echo $i; ?>
                        </a>
                    </li>
                <?php endfor; ?>
                <?php if ($page < $total_pages) : ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $page + 1; ?>&search_query=<?php echo $search_query; ?>" aria-label="Next">
                            <span aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>

    </div>
    <!-- End Pagination -->
</div>