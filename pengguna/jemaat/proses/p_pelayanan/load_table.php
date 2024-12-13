<?php
session_start();

// Periksa apakah pengguna sudah masuk atau belum
if (!isset($_SESSION['id_kepala_keluarga'])) {
    // Pengguna belum masuk, arahkan kembali ke halaman masuk.php
    header("Location: ../../../../berlangganan/login");
    exit; // Pastikan untuk menghentikan eksekusi skrip setelah mengarahkan
}

// Jika pengguna sudah masuk, Anda dapat melanjutkan menampilkan halaman kepala_keluarga.php seperti biasa
$id_kk = $_SESSION['id_kepala_keluarga'];
?>


<div class="card-body px-0 pb-2" id="dataTable">
    <div class="table-responsive p-0">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nomor
                    </th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jenis
                        Pelayanan</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama
                        Rayon</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Waktu
                    </th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tempat
                    </th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status
                    </th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi
                    </th>
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
                $search_sql = !empty($search_query) ? " AND (jenis_pelayanan.jenis_pelayanan LIKE '%$search_query%' OR p_pelayanan.id_rayon LIKE '%$search_query%')" : '';
                $count_query = "SELECT COUNT(*) AS total FROM p_pelayanan 
                    LEFT JOIN jenis_pelayanan ON p_pelayanan.id_jenis_pelayanan = jenis_pelayanan.id_jenis_pelayanan 
                    LEFT JOIN rayon ON p_pelayanan.id_rayon = rayon.id_rayon 
                    WHERE p_pelayanan.id_kepala_keluarga = '$id_kk'" . $search_sql;
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
                $data_query = "SELECT p_pelayanan.*, jenis_pelayanan.jenis_pelayanan AS djp, rayon.nama_rayon AS nama_rayon 
                   FROM p_pelayanan 
                   LEFT JOIN jenis_pelayanan ON p_pelayanan.id_jenis_pelayanan = jenis_pelayanan.id_jenis_pelayanan 
                   LEFT JOIN rayon ON p_pelayanan.id_rayon = rayon.id_rayon 
                   WHERE p_pelayanan.id_kepala_keluarga = '$id_kk'" . $search_sql . " 
                   ORDER BY id_p_pelayanan DESC LIMIT " . $starting_limit . ", " . $results_per_page;
                $result = mysqli_query($koneksi, $data_query);

                $counter = 1;
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $tempat_sambung = str_replace(array("\r", "\n"), '', nl2br($row['tempat']));
                        $waktu = $row['waktu'];
                        $data_waktu = date('Y-m-d\TH:i', strtotime($waktu));
                        echo "<tr>";
                        echo "<td class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>" . $counter . "</span></td>";
                        echo "<td class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>" . $row['djp'] . "</span></td>";
                        echo "<td class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>" . $row['nama_rayon'] . "</span></td>";
                        echo "<td class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>" . $row['waktu'] . "</span></td>";
                        echo "<td class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>" . $tempat_sambung . "</span></td>";
                        echo "<td class='align-middle text-center'>";

                        // Check the status and set the button text and icon accordingly
                        if (empty($row['status'])) {
                            $button_text = "Belum Diteruskan";
                            $button_icon = "fas fa-times fa-2x";
                            $disabled = "disabled";
                            $button_class = "text-primary";
                            $onclick = "onclick='editStatus(\"" . $row['id_p_pelayanan'] . "\", \"" . $row['status'] . "\")'";
                        } elseif ($row['status'] == "Disetujui") {
                            $button_text = "Sudah Diteruskan";
                            $button_icon = "fas fa-check fa-2x";
                            $disabled = "disabled";
                            $button_class = "text-success";
                            $onclick = ""; // No onclick function
                        } else {
                            $button_text = "Edit Status";
                            $button_icon = "fas fa-times fa-2x";
                            $disabled = "";
                            $button_class = "text-primary";
                            $onclick = "onclick='editStatus(\"" . $row['id_p_pelayanan'] . "\", \"" . $row['status'] . "\")'";
                        }

                        echo "<a href='javascript:;' style='margin-left: 30px;' class='$button_class font-weight-bold text-xs' data-toggle='tooltip' data-original-title='$button_text' $disabled $onclick>";
                        echo "<i class='$button_icon'></i> $button_text";
                        echo "</a>";
                        echo "<td class='align-middle text-center'>";
                        echo "<a href='javascript:;' class='btn btn-success text-white font-weight-bold text-xs' data-toggle='tooltip' data-original-title='Edit user' onclick='openEditModal(
      \"" . $row['id_p_pelayanan'] . "\",
      \"" . $row['id_jenis_pelayanan'] . "\",
      \"" . $data_waktu . "\",
      \"" . $tempat_sambung . "\"
)'>Edit</a>";
                        echo "<a href='javascript:;' style='margin-left: 30px;' class='text-white btn btn-danger font-weight-bold text-xs' data-toggle='tooltip' data-original-title='Delete user' onclick='hapus(\"" . $row['id_p_pelayanan'] . "\")'>";
                        echo "Hapus";
                        echo "</a>";
                        echo "</td>";

                        echo "</tr>";
                        $counter++;
                    }
                } else {
                    echo "<tr><td colspan='7' class='align-middle text-center'><span class='text-secondary text-xs font-weight-bold'>Tidak Ada Data Yang Ditemukan.</span></td></tr>";
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

<?php
// Close the database connection
mysqli_close($koneksi);
?>