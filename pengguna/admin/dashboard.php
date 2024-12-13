<?php
session_start();

// Periksa apakah pengguna sudah masuk atau belum
if (!isset($_SESSION['id_admin'])) {
  // Pengguna belum masuk, arahkan kembali ke halaman masuk.php
  header("Location: ../../admin/login");
  exit; // Pastikan untuk menghentikan eksekusi skrip setelah mengarahkan
}

// Jika pengguna sudah masuk, Anda dapat melanjutkan menampilkan halaman admin.php seperti biasa
?>

<!DOCTYPE html>
<html lang="en">

<!-- head -->
<?php include 'item/head.php'; ?>
<!-- akhir head -->

<body translate="no" class="g-sidenav-show  bg-gray-200">

  <!-- sidebar -->
  <?php include 'item/sidebar.php'; ?>
  <!-- akhir sidebar -->

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <?php include 'item/navbar.php'; ?>
    <!-- End Navbar -->
    <?php
    include '../../keamanan/koneksi.php';

    // Menangkap nilai id_rayon yang dipilih
    $id_rayon = isset($_GET['id_rayon']) ? $_GET['id_rayon'] : '';

    // Query untuk menghitung jumlah data dari setiap tabel
    $count_queries = [
      "jenis_pelayanan" => "SELECT COUNT(*) AS total FROM jenis_pelayanan",
      "katekasasi" => "SELECT COUNT(*) AS total FROM katekasasi",
      "majelis" => "SELECT COUNT(*) AS total FROM majelis",
      "pelayanan" => "SELECT COUNT(*) AS total FROM pelayanan",
      "pembabtisan" => "SELECT COUNT(*) AS total FROM pembabtisan",
      "pendeta" => "SELECT COUNT(*) AS total FROM pendeta",
      "pengumuman" => "SELECT COUNT(*) AS total FROM pengumuman",
      "p_pelayanan" => "SELECT COUNT(*) AS total FROM p_pelayanan",
      "rayon" => "SELECT COUNT(*) AS total FROM rayon",
    ];

    // Menambahkan kondisi WHERE id_rayon jika ada nilai yang dipilih dan kolom id_rayon ada dalam tabel
    $tables_with_id_rayon = ['jemaat']; // Daftar tabel yang memiliki kolom id_rayon

    if ($id_rayon !== '') {
      foreach ($count_queries as $key => &$query) {
        if (in_array($key, $tables_with_id_rayon)) {
          $query .= " WHERE id_rayon = '$id_rayon'";
        }
      }
    }

    // Query untuk mengambil data rayon
    $rayon_query = "SELECT id_rayon, nama_rayon FROM rayon";
    $rayon_result = mysqli_query($koneksi, $rayon_query);

    $rayon_data = [];
    while ($row = mysqli_fetch_assoc($rayon_result)) {
      $rayon_data[] = $row;
    }

    // Menyimpan hasil query dalam array
    $counts = [];
    foreach ($count_queries as $key => $query) {
      $result = mysqli_query($koneksi, $query);
      $row = mysqli_fetch_assoc($result);
      $counts[$key] = $row['total'];
    }

    // Query untuk menghitung jumlah data pendidikan terakhir
    $pendidikan_query = "SELECT CONCAT(pendidikan_terakhir, ' ', tahun_pendidikan_terakhir) AS pendidikan_tahun, COUNT(*) AS total FROM jemaat";
    if ($id_rayon !== '') {
      $pendidikan_query .= " WHERE id_rayon = '$id_rayon'";
    }
    $pendidikan_query .= " GROUP BY pendidikan_tahun";
    $pendidikan_result = mysqli_query($koneksi, $pendidikan_query);

    $pendidikan_data = [];
    while ($row = mysqli_fetch_assoc($pendidikan_result)) {
      $pendidikan_data[$row['pendidikan_tahun']] = $row['total'];
    }

    $pendidikan_labels = json_encode(array_keys($pendidikan_data));
    $pendidikan_counts = json_encode(array_values($pendidikan_data));

    // Query untuk menghitung jumlah data status nikah
    $status_nikah_query = "SELECT status_nikah, COUNT(*) AS total FROM jemaat";
    if ($id_rayon !== '') {
      $status_nikah_query .= " WHERE id_rayon = '$id_rayon'";
    }
    $status_nikah_query .= " GROUP BY status_nikah";
    $status_nikah_result = mysqli_query($koneksi, $status_nikah_query);

    $status_nikah_data = [];
    while ($row = mysqli_fetch_assoc($status_nikah_result)) {
      $status_nikah_data[$row['status_nikah']] = $row['total'];
    }

    $status_nikah_labels = json_encode(array_keys($status_nikah_data));
    $status_nikah_counts = json_encode(array_values($status_nikah_data));

    // Query untuk menghitung jumlah data pekerjaan
    $pekerjaan_query = "SELECT pekerjaan, COUNT(*) AS total FROM jemaat";
    if ($id_rayon !== '') {
      $pekerjaan_query .= " WHERE id_rayon = '$id_rayon'";
    }
    $pekerjaan_query .= " GROUP BY pekerjaan";
    $pekerjaan_result = mysqli_query($koneksi, $pekerjaan_query);

    $pekerjaan_data = [];
    while ($row = mysqli_fetch_assoc($pekerjaan_result)) {
      $pekerjaan_data[$row['pekerjaan']] = $row['total'];
    }

    $pekerjaan_labels = json_encode(array_keys($pekerjaan_data));
    $pekerjaan_counts = json_encode(array_values($pekerjaan_data));

    // Query untuk mengambil data pendapatan
    $pendapatan_query = "SELECT pendapatan FROM jemaat";
    if ($id_rayon !== '') {
      $pendapatan_query .= " WHERE id_rayon = '$id_rayon'";
    }
    $pendapatan_result = mysqli_query($koneksi, $pendapatan_query);

    $pendapatan_data = [];
    while ($row = mysqli_fetch_assoc($pendapatan_result)) {
      // Memproses data pendapatan untuk format yang sesuai
      // Misalnya: menghilangkan karakter non-digit dan menambahkan titik
      $pendapatan = str_replace('.', '', $row['pendapatan']); // menghilangkan titik
      $pendapatan = str_replace(',', '.', $pendapatan); // mengubah koma menjadi titik
      $pendapatan = floatval($pendapatan); // mengubah string menjadi float
      $pendapatan_data[] = $pendapatan;
    }

    $pendapatan_counts = json_encode($pendapatan_data);
    ?>

    <div class="container-fluid py-4">
      <div class="container">
        <!-- Sambutan -->
        <div class="row justify-content-center">
          <div class="col-12 col-md-10 col-lg-12 my-4">
            <div class="bg-white p-5 rounded shadow-lg">
              <h2 class="font-weight-bold text-center">Selamat Datang <br> di Sistem Website Gereja Moria Liliba</h2>
              <p class="text-muted text-center">Kami senang menyambut Anda di sini. Mari kita bersama-sama menjelajahi
                data <br> dan informasi penting mengenai gereja kita.</p>
            </div>
          </div>
        </div>

        <!-- Pilih Data Rayon -->
        <div class="row justify-content-center">
          <div class="col-12 col-md-10 col-lg-12 my-4">
            <div class="bg-white p-5 rounded shadow-lg">
              <h4 class="text-center">Pilih data rayon</h4>
              <hr>
              <select id="rayonSelect" class="form-control" style="color: black;">
                <option value="">Semua Rayon</option>
                <?php foreach ($rayon_data as $rayon) : ?>
                  <option value="<?php echo $rayon['id_rayon']; ?>" <?php echo $id_rayon === $rayon['id_rayon'] ? 'selected' : ''; ?>><?php echo $rayon['nama_rayon']; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>

        <!-- Grafik Pendidikan -->
        <div class="row justify-content-center">
          <div class="col-12 col-md-10 col-lg-12 my-4">
            <div class="bg-white p-5 rounded shadow-lg">
              <h4 class="text-center">Jumlah Jemaat Berdasarkan Pendidikan Terakhir</h4>
              <hr>
              <canvas id="pendidikanChart"></canvas>
              <!-- <a href="proses/jemaat/exportPendidikanChart" id="exportPendidikanChart" class="btn btn-primary mt-3">Export to PDF</a> -->
            </div>
          </div>
        </div>

        <!-- Grafik Pie untuk Status Nikah dan Pekerjaan -->
        <div class="row justify-content-center">
          <div class="col-6 col-md-10 col-lg-6 my-4">
            <div class="bg-white p-5 rounded shadow-lg">
              <h4 class="text-center">Jumlah Status Pernikahan</h4>
              <hr>
              <canvas id="statusNikahChart"></canvas>
              <!-- <a href="proses/jemaat/exportStatusNikahChart" id="exportStatusNikahChart" class="btn btn-primary mt-3">Export to PDF</a> -->
            </div>
          </div>
          <div class="col-6 col-md-10 col-lg-6 my-4">
            <div class="bg-white p-5 rounded shadow-lg">
              <h4 class="text-center">Jumlah Pekerjaan</h4>
              <hr>
              <canvas id="pekerjaanChart"></canvas>
              <!-- <a href="proses/jemaat/exportPekerjaanChart" id="exportPekerjaanChart" class="btn btn-primary mt-3">Export to PDF</a> -->
            </div>
          </div>
        </div>

        <!-- Grafik Pendapatan -->
        <div class="row justify-content-center">
          <div class="col-12 col-md-10 col-lg-12 my-4">
            <div class="bg-white p-5 rounded shadow-lg">
              <h4 class="text-center">Distribusi Pendapatan Jemaat</h4>
              <hr>
              <canvas id="pendapatanChart"></canvas>
              <!-- <a href="proses/jemaat/exportPendapatanChart" id="exportPendapatanChart" class="btn btn-primary mt-3">Export to PDF</a> -->
            </div>
          </div>
        </div>

        <!-- bagian total data -->
        <div class="row mt-4">
          <!-- Card Pendeta -->
          <div class="col-xl-3 col-sm-6 mb-xl-0 mt-4">
            <a href="pendeta" class="text-decoration-none">
              <div class="card shadow-lg border-0" style="border-radius: 1rem; overflow: hidden;">
                <div class="card-header p-3 pt-5 position-relative" style="background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);">
                  <div class="icon icon-lg icon-shape bg-white shadow-primary text-center border-radius-xl position-absolute" style="top: 10px; left: 50%; transform: translateX(-50%);">
                    <i class="material-icons opacity-10 text-gradient-primary">person</i>
                  </div>
                  <div class="text-end pt-4 text-white mt-3">
                    <p class="text-sm mb-0 text-center font-weight-bold">Pendeta</p>
                  </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                  <p class="mb-0">
                    Jumlah Data Pendeta <span class="text-success text-sm font-weight-bolder"><?php echo $counts['pendeta']; ?> </span> pada
                    Gereja Moria Liliba
                  </p>
                </div>
              </div>
            </a>
          </div>

          <!-- Card Majelis -->
          <div class="col-xl-3 col-sm-6 mb-xl-0 mt-4">
            <a href="majelis" class="text-decoration-none">
              <div class="card shadow-lg border-0" style="border-radius: 1rem; overflow: hidden;">
                <div class="card-header p-3 pt-5 position-relative" style="background: linear-gradient(135deg, #ff6a00 0%, #ee0979 100%);">
                  <div class="icon icon-lg icon-shape bg-white shadow-primary text-center border-radius-xl position-absolute" style="top: 10px; left: 50%; transform: translateX(-50%);">
                    <i class="material-icons opacity-10 text-gradient-primary">people_outline</i>
                  </div>
                  <div class="text-end pt-4 text-white mt-3">
                    <p class="text-sm mb-0 text-center font-weight-bold">Majelis</p>
                  </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                  <p class="mb-0">
                    Jumlah Data Majelis <span class="text-success text-sm font-weight-bolder"><?php echo $counts['majelis']; ?> </span> pada
                    Gereja Moria Liliba
                  </p>
                </div>
              </div>
            </a>
          </div>

          <!-- Card Rayon -->
          <div class="col-xl-3 col-sm-6 mb-xl-0 mt-4">
            <a href="rayon" class="text-decoration-none">
              <div class="card shadow-lg border-0" style="border-radius: 1rem; overflow: hidden;">
                <div class="card-header p-3 pt-5 position-relative" style="background: linear-gradient(135deg, #00c6ff 0%, #0072ff 100%);">
                  <div class="icon icon-lg icon-shape bg-white shadow-primary text-center border-radius-xl position-absolute" style="top: 10px; left: 50%; transform: translateX(-50%);">
                    <i class="material-icons opacity-10 text-gradient-primary">location_city</i>
                  </div>
                  <div class="text-end pt-4 text-white mt-3">
                    <p class="text-sm mb-0 text-center font-weight-bold">Rayon</p>
                  </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                  <p class="mb-0">
                    Jumlah Data Rayon <span class="text-success text-sm font-weight-bolder"><?php echo $counts['rayon']; ?> </span> pada
                    Gereja Moria Liliba
                  </p>
                </div>
              </div>
            </a>
          </div>

          <!-- Card Permohonan Pelayanan -->
          <div class="col-xl-3 col-sm-6 mb-xl-0 mt-4">
            <a href="permohonan_pelayanan" class="text-decoration-none">
              <div class="card shadow-lg border-0" style="border-radius: 1rem; overflow: hidden;">
                <div class="card-header p-3 pt-5 position-relative" style="background: linear-gradient(135deg, #00c6ff 0%, #0072ff 100%);">
                  <div class="icon icon-lg icon-shape bg-white shadow-primary text-center border-radius-xl position-absolute" style="top: 10px; left: 50%; transform: translateX(-50%);">
                    <i class="material-icons opacity-10 text-gradient-primary">assignment</i>
                  </div>
                  <div class="text-end pt-4 text-white mt-3">
                    <p class="text-sm mb-0 text-center font-weight-bold">Permohonan Pelayanan</p>
                  </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                  <p class="mb-0">
                    Jumlah Data Permohonan Pelayanan <span class="text-success text-sm font-weight-bolder"><?php echo $counts['p_pelayanan']; ?> </span> pada
                    Gereja Moria Liliba
                  </p>
                </div>
              </div>
            </a>
          </div>

          <!-- Card Jadwal Pelayanan -->
          <div class="col-xl-3 col-sm-6 mb-xl-0 mt-4">
            <a href="jadwal_pelayanan" class="text-decoration-none">
              <div class="card shadow-lg border-0" style="border-radius: 1rem; overflow: hidden;">
                <div class="card-header p-3 pt-5 position-relative" style="background: linear-gradient(135deg, #00c6ff 0%, #0072ff 100%);">
                  <div class="icon icon-lg icon-shape bg-white shadow-primary text-center border-radius-xl position-absolute" style="top: 10px; left: 50%; transform: translateX(-50%);">
                    <i class="material-icons opacity-10 text-gradient-primary">event_note</i>
                  </div>
                  <div class="text-end pt-4 text-white mt-3">
                    <p class="text-sm mb-0 text-center font-weight-bold">Jadwal Pelayanan</p>
                  </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                  <p class="mb-0">
                    Jumlah Data Jadwal Pelayanan <span class="text-success text-sm font-weight-bolder"><?php echo $counts['pelayanan']; ?> </span> pada
                    Gereja Moria Liliba
                  </p>
                </div>
              </div>
            </a>
          </div>

          <!-- Card Jenis Pelayanan -->
          <div class="col-xl-3 col-sm-6 mb-xl-0 mt-4">
            <a href="jenis_pelayanan" class="text-decoration-none">
              <div class="card shadow-lg border-0" style="border-radius: 1rem; overflow: hidden;">
                <div class="card-header p-3 pt-5 position-relative" style="background: linear-gradient(135deg, #00c6ff 0%, #0072ff 100%);">
                  <div class="icon icon-lg icon-shape bg-white shadow-primary text-center border-radius-xl position-absolute" style="top: 10px; left: 50%; transform: translateX(-50%);">
                    <i class="material-icons opacity-10 text-gradient-primary">category</i>
                  </div>
                  <div class="text-end pt-4 text-white mt-3">
                    <p class="text-sm mb-0 text-center font-weight-bold">Jenis Pelayanan</p>
                  </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                  <p class="mb-0">
                    Jumlah Data Jenis Pelayanan <span class="text-success text-sm font-weight-bolder"><?php echo $counts['jenis_pelayanan']; ?> </span>
                    pada Gereja Moria Liliba
                  </p>
                </div>
              </div>
            </a>
          </div>

          <!-- Card Pengumuman -->
          <div class="col-xl-3 col-sm-6 mb-xl-0 mt-4">
            <a href="pengumuman" class="text-decoration-none">
              <div class="card shadow-lg border-0" style="border-radius: 1rem; overflow: hidden;">
                <div class="card-header p-3 pt-5 position-relative" style="background: linear-gradient(135deg, #00c6ff 0%, #0072ff 100%);">
                  <div class="icon icon-lg icon-shape bg-white shadow-primary text-center border-radius-xl position-absolute" style="top: 10px; left: 50%; transform: translateX(-50%);">
                    <i class="material-icons opacity-10 text-gradient-primary">announcement</i>
                  </div>
                  <div class="text-end pt-4 text-white mt-3">
                    <p class="text-sm mb-0 text-center font-weight-bold">Pengumuman</p>
                  </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                  <p class="mb-0">
                    Jumlah Data Pengumuman <span class="text-success text-sm font-weight-bolder"><?php echo $counts['pengumuman']; ?> </span> pada
                    Gereja Moria Liliba
                  </p>
                </div>
              </div>
            </a>
          </div>

          <!-- Card pembabtisan -->
          <div class="col-xl-3 col-sm-6 mb-xl-0 mt-4">
            <a href="pembabtisan" class="text-decoration-none">
              <div class="card shadow-lg border-0" style="border-radius: 1rem; overflow: hidden;">
                <div class="card-header p-3 pt-5 position-relative" style="background: linear-gradient(135deg, #00c6ff 0%, #0072ff 100%);">
                  <div class="icon icon-lg icon-shape bg-white shadow-primary text-center border-radius-xl position-absolute" style="top: 10px; left: 50%; transform: translateX(-50%);">
                    <i class="material-icons opacity-10 text-gradient-primary">water</i>
                  </div>
                  <div class="text-end pt-4 text-white mt-3">
                    <p class="text-sm mb-0 text-center font-weight-bold">pembabtisan</p>
                  </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                  <p class="mb-0">
                    Jumlah Data pembabtisan <span class="text-success text-sm font-weight-bolder"><?php echo $counts['pembabtisan']; ?> </span> pada
                    Gereja Moria Liliba
                  </p>
                </div>
              </div>
            </a>
          </div>

          <!-- Card Katekasasi -->
          <div class="col-xl-3 col-sm-6 mb-xl-0 mt-4">
            <a href="katekasasi" class="text-decoration-none">
              <div class="card shadow-lg border-0" style="border-radius: 1rem; overflow: hidden;">
                <div class="card-header p-3 pt-5 position-relative" style="background: linear-gradient(135deg, #00c6ff 0%, #0072ff 100%);">
                  <div class="icon icon-lg icon-shape bg-white shadow-primary text-center border-radius-xl position-absolute" style="top: 10px; left: 50%; transform: translateX(-50%);">
                    <i class="material-icons opacity-10 text-gradient-primary">school</i>
                  </div>
                  <div class="text-end pt-4 text-white mt-3">
                    <p class="text-sm mb-0 text-center font-weight-bold">Katekasasi</p>
                  </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                  <p class="mb-0">
                    Jumlah Data Katekasasi <span class="text-success text-sm font-weight-bolder"><?php echo $counts['katekasasi']; ?> </span> pada
                    Gereja Moria Liliba
                  </p>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>

      <!-- footer -->
      <?php include 'item/footer.php'; ?>
      <!-- akhir footer -->
    </div>

  </main>
  <!--   Core JS Files   -->
  <script src="../../assets/js/core/popper.min.js"></script>
  <script src="../../assets/js/core/bootstrap.min.js"></script>
  <script src="../../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../../assets/js/material-dashboard.min=3.1.0"></script>
  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
  <script>
    document.getElementById('rayonSelect').addEventListener('change', function() {
      var selectedRayon = this.value;
      var url = window.location.href.split('?')[0] + '?id_rayon=' + selectedRayon;
      window.location.href = url;
    });

    // Data Pendidikan
    var pendidikanLabels = <?php echo $pendidikan_labels; ?>;
    var pendidikanCounts = <?php echo $pendidikan_counts; ?>;
    var ctxPendidikan = document.getElementById('pendidikanChart').getContext('2d');
    var pendidikanChart = new Chart(ctxPendidikan, {
      type: 'bar',
      data: {
        labels: pendidikanLabels,
        datasets: [{
          label: 'Jumlah Jemaat',
          data: pendidikanCounts,
          backgroundColor: 'rgba(54, 162, 235, 0.2)',
          borderColor: 'rgba(54, 162, 235, 1)',
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });

    // Data Status Nikah
    var statusNikahLabels = <?php echo $status_nikah_labels; ?>;
    var statusNikahCounts = <?php echo $status_nikah_counts; ?>;
    var ctxStatusNikah = document.getElementById('statusNikahChart').getContext('2d');
    var statusNikahChart = new Chart(ctxStatusNikah, {
      type: 'pie',
      data: {
        labels: statusNikahLabels,
        datasets: [{
          label: 'Jumlah Jemaat',
          data: statusNikahCounts,
          backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(255, 159, 64, 0.2)'
          ],
          borderColor: [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });

    // Data Pekerjaan
    var pekerjaanLabels = <?php echo $pekerjaan_labels; ?>;
    var pekerjaanCounts = <?php echo $pekerjaan_counts; ?>;
    var ctxPekerjaan = document.getElementById('pekerjaanChart').getContext('2d');
    var pekerjaanChart = new Chart(ctxPekerjaan, {
      type: 'bar',
      data: {
        labels: pekerjaanLabels,
        datasets: [{
          label: 'Jumlah Jemaat',
          data: pekerjaanCounts,
          backgroundColor: 'rgba(255, 206, 86, 0.2)',
          borderColor: 'rgba(255, 206, 86, 1)',
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });

    // Data Pendapatan
    var pendapatanCounts = <?php echo $pendapatan_counts; ?>;
    var ctxPendapatan = document.getElementById('pendapatanChart').getContext('2d');
    var pendapatanChart = new Chart(ctxPendapatan, {
      type: 'bar',
      data: {
        labels: Array.from({
          length: pendapatanCounts.length
        }, (_, i) => i + 1),
        datasets: [{
          label: 'Jumlah Pendapatan',
          data: pendapatanCounts,
          backgroundColor: 'rgba(153, 102, 255, 0.2)',
          borderColor: 'rgba(153, 102, 255, 1)',
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>

</body>

</html>