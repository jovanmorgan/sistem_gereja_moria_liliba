<?php
session_start();

// Periksa apakah pengguna sudah masuk atau belum
if (!isset($_SESSION['id_admin'])) {
    // Pengguna belum masuk, arahkan kembali ke halaman masuk.php
    header("Location: ../../../../berlangganan/login");
    exit; // Pastikan untuk menghentikan eksekusi skrip setelah mengarahkan
}
// Jika pengguna sudah masuk, Anda dapat melanjutkan menampilkan halaman kepala_keluarga.php seperti biasa
?>
<div class="card-body px-0 pb-2" id="dataTable">
    <div class="table-responsive p-0">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nomor
                    </th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama
                        Rayon</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama
                        Kepala Keluarga</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama
                    </th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jenis
                        Kelamin</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Alamat
                    </th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nomor
                        Hp</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tempat
                        Lahir</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Tanggal Lahir</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status
                        Baptis</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status
                        Sidi</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status
                        Nikah</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status
                        Keluarga</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Tanggal Nikah</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Pendidikan Terakhir</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Tahun Pendidikan Terakhir</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Pekerjaan</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Usaha
                        Sampingan</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status
                        Sosial</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Pendapatan</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status
                        Diakonia</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Diakonia</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Bantuan Pemerintah</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Kondisi Rumah</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Kepemilikan Rumah</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status
                        BPJS</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Biaya
                        BPJS</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Etnis
                    </th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Golongan Darah</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Agama
                        Sebelumnya</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Gereja
                        Sebelumnya</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status
                        Jemaat</th>
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
                        echo "<td class='align-middle text-center'>";
                        echo "<a href='javascript:;' class='text-secondary font-weight-bold text-xs' data-toggle='tooltip' data-original-title='Edit user' onclick='openEditModal(
                          \"" . $row['id_jemaat'] . "\",
                          \"" . htmlspecialchars($row['nama'], ENT_QUOTES) . "\",
                          \"" . $row['id_rayon'] . "\",
                          \"" . $row['id_kepala_keluarga'] . "\",
                          \"" . $row['no_hp'] . "\",
                          \"" . $row['jenis_kelamin'] . "\",
                          \"" . htmlspecialchars($alamat_sambung, ENT_QUOTES) . "\",
                          \"" . $row['tempat_lahir'] . "\",
                          \"" . $row['tanggal_lahir'] . "\",
                          \"" . $row['status_baptis'] . "\",
                          \"" . $row['status_sidi'] . "\",
                          \"" . $row['status_nikah'] . "\",
                          \"" . $row['status_keluarga'] . "\",
                          \"" . $row['tanggal_nikah'] . "\",
                          \"" . $row['pendidikan_terakhir'] . "\",
                          \"" . $row['tahun_pendidikan_terakhir'] . "\",
                          \"" . $row['pekerjaan'] . "\",
                          \"" . $row['usaha_sampingan'] . "\",
                          \"" . $row['status_sosial'] . "\",
                          \"" . $row['pendapatan'] . "\",
                          \"" . $row['status_diakonia'] . "\",
                          \"" . $row['diakonia'] . "\",
                          \"" . $row['bantuan_pemerintah'] . "\",
                          \"" . $row['kondisi_rumah'] . "\",
                          \"" . $row['kepemilikan_rumah'] . "\",
                          \"" . $row['status_bpjs'] . "\",
                          \"" . $row['biaya_bpjs'] . "\",
                          \"" . $row['etnis'] . "\",
                          \"" . $row['golongan_darah'] . "\",
                          \"" . $row['agama_sebelumnya'] . "\",
                          \"" . $row['gereja_sebelumnya'] . "\",
                          \"" . $row['status_jemaat'] . "\"
                  )'><i class='fas fa-edit' style='font-size: 24px; color: green;'></i></a>";

                        echo "<a href='javascript:;' style='margin-left: 30px;' class='text-secondary font-weight-bold text-xs' data-toggle='tooltip' data-original-title='Delete user' onclick='hapus(\"" . $row['id_jemaat'] . "\")'>";
                        echo "<i class='fas fa-trash fa-2x' style='color: red;'></i>";
                        echo "</a>";
                        echo "</td>";
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
                    <li class="page-item <?php if ($i == $page)
                                                echo 'active'; ?>">
                        <a class="page-link <?php if ($i == $page)
                                                echo 'text-white bg-dark';
                                            else
                                                echo 'text-dark'; ?>" href="?page=<?php echo $i; ?>&search_query=<?php echo $search_query; ?>">
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