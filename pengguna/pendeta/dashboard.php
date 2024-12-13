<?php
session_start();

// Periksa apakah pengguna sudah masuk atau belum
if (!isset($_SESSION['id_pendeta'])) {
  // Pengguna belum masuk, arahkan kembali ke halaman masuk.php
  header("Location: ../../berlangganan/login");
  exit; // Pastikan untuk menghentikan eksekusi skrip setelah mengarahkan
}

// Jika pengguna sudah masuk, Anda dapat melanjutkan menampilkan halaman pendeta.php seperti biasa
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

    // Menyimpan hasil query dalam array
    $counts = [];
    foreach ($count_queries as $key => $query) {
      $result = mysqli_query($koneksi, $query);
      $row = mysqli_fetch_assoc($result);
      $counts[$key] = $row['total'];
    }
    ?>

    <div class="container-fluid py-4">
      <div class="container">
        <!-- Sambutan -->
        <div class="row justify-content-center">
          <div class="col-12 col-md-10 col-lg-12 my-4">
            <div class="bg-white p-5 rounded shadow-lg">
              <h2 class="font-weight-bold text-center">Selamat Datang <br> di Sistem Website Gereja Moria Liliba</h2>
              <p class="text-muted text-center">Kami senang menyambut Anda di sini. Mari kita bersama-sama menjelajahi data <br> dan informasi penting mengenai gereja kita.</p>
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
                    Jumlah Data Pendeta <span class="text-success text-sm font-weight-bolder"><?php echo $counts['pendeta']; ?> </span> pada Gereja Moria Liliba
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
                    Jumlah Data Jadwal Pelayanan <span class="text-success text-sm font-weight-bolder"><?php echo $counts['pelayanan']; ?> </span> pada Gereja Moria Liliba
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
  <script src="../../assets/js/material-dashboard.min.js?v=3.1.0"></script>
</body>

</html>