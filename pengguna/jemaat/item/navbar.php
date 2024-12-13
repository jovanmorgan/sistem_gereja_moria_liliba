<?php include 'nama_halaman.php'; ?>

<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
  data-scroll="true">
  <div class="container-fluid py-1 px-3">
    <?php
    if (basename($_SERVER['PHP_SELF'], ".php") != 'dashboard') {
      echo '<nav aria-label="breadcrumb">
      <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="dashboard">Dashboard</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">';
      echo getPageTitle();
      echo '</li>
      </ol>
      <h6 class="font-weight-bolder mb-0">';
      echo getPageTitle();
      echo '</h6>
    </nav>';
    } else {
      echo ' <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Dashboard kepala_keluarga</a>
            </li>
          </ol>
        </nav>';
    }
    ?>

    <div class=" mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
          <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
            </div>
          </a>
        </li>
        <li class="nav-item dropdown pe-2 d-flex align-items-center">
          <!-- Dropdown content here -->
        </li>
        <li class="nav-item d-flex align-items-center">
          <a href="profile" class="nav-link text-body font-weight-bold px-0 d-flex align-items-center">

            <?php
            // Lakukan koneksi ke database
            include '../../keamanan/koneksi.php';

            // Periksa apakah session id_kepala_keluarga telah diset
            if (isset($_SESSION['id_kepala_keluarga'])) {
              $id_kepala_keluarga = $_SESSION['id_kepala_keluarga'];

              // Query SQL untuk mengambil data kepala_keluarga berdasarkan id_kepala_keluarga dari session
              $query = "SELECT * FROM kepala_keluarga WHERE id_kepala_keluarga = '$id_kepala_keluarga'";
              $result = mysqli_query($koneksi, $query);

              // Periksa apakah query berhasil dieksekusi
              if ($result) {
                // Periksa apakah terdapat data kepala_keluarga
                if (mysqli_num_rows($result) > 0) {
                  // Ambil data kepala_keluarga sebagai array asosiatif
                  $kepala_keluarga = mysqli_fetch_assoc($result);
                  ?>
                  <?php if (!empty($kepala_keluarga['fp'])): ?>
                    <img alt="Profile Picture" class="rounded-circle" width="30" height="30"
                      src="data_fp/<?php echo $kepala_keluarga['fp']; ?>" alt="Edit Foto Profile">
                  <?php else: ?>
                    <img alt="Profile Picture" class="rounded-circle" width="30" height="30" src="../../assets/img/akun.png"
                      alt="Edit Foto Profile">
                  <?php endif; ?>
                  <?php
                } else {
                  // Jika tidak ada data kepala_keluarga
                  echo "Tidak ada data kepala_keluarga.";
                }
              } else {
                // Jika query tidak berhasil dieksekusi
                echo "Gagal mengambil data kepala_keluarga: " . mysqli_error($koneksi);
              }
            } else {
              // Jika session id_kepala_keluarga tidak diset
              echo "Session id_kepala_keluarga tidak tersedia.";
            }

            // Tutup koneksi ke database
            mysqli_close($koneksi);
            ?>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>