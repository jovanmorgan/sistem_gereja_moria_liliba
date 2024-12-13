<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>About - Gereja Moriana</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Tempo
  * Template URL: https://bootstrapmade.com/tempo-free-onepage-bootstrap-theme/
  * Updated: Mar 17 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top header-inner-pages">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo"><a href="index.html">GML</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto " href="index.php">Home</a></li>
          <li><a class="nav-link scrollto active" href="#about">About</a></li>
          <li><a class="nav-link scrollto" href="index.php#contact">Contact</a></li>
          <li><a class="nav-link scrollto" href="../berlangganan/login.php">Login</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="index.html">Home</a></li>
          <li>About</li>
        </ol>
        <h2>About</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">
        <div class="row">
          <div class="col-lg-12">
            <div class="sidebar">
              <h3 class="sidebar-title">Search</h3>
              <div class="sidebar-item search-form">
                <form action="" method="GET" class="ms-md-auto pe-md-3 d-flex align-items-center m-2 w-100 w-md-auto">
                  <div class="input-group input-group-outline w-100">
                    <input type="text" class="form-control" name="search_query" style="width: 100%;">
                    <button type="submit"><i class="bi bi-search"></i></button>
                  </div>
                </form>
              </div><!-- End sidebar search form-->
            </div><!-- End sidebar -->
          </div><!-- End blog sidebar -->

          <?php
          include '../keamanan/koneksi.php';

          // Define how many results you want per page
          $results_per_page = 4;

          // Get search query from URL if it exists
          $search_query = isset($_GET['search_query']) ? $_GET['search_query'] : '';

          // Find out the number of results stored in the database
          $search_sql = !empty($search_query) ? " WHERE pelayanan.waktu LIKE '%$search_query%' OR pelayanan.tempat LIKE '%$search_query%' OR rayon.nama_rayon LIKE '%$search_query%' OR pendeta.nama LIKE '%$search_query%' OR jenis_pelayanan.jenis_pelayanan LIKE '%$search_query%'" : '';
          $count_query = "SELECT COUNT(*) AS total FROM pelayanan
                      LEFT JOIN p_pelayanan ON pelayanan.id_p_pelayanan = p_pelayanan.id_p_pelayanan
                      LEFT JOIN rayon ON p_pelayanan.id_rayon = rayon.id_rayon
                      LEFT JOIN pendeta ON pelayanan.id_pendeta = pendeta.id_pendeta
                      LEFT JOIN jenis_pelayanan ON p_pelayanan.id_jenis_pelayanan = jenis_pelayanan.id_jenis_pelayanan" . $search_sql;
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
          $data_query = "SELECT pelayanan.id_p_pelayanan, pelayanan.waktu, pelayanan.tempat, pendeta.nama AS nama_pendeta, rayon.nama_rayon, jenis_pelayanan.jenis_pelayanan
                     FROM pelayanan
                     LEFT JOIN p_pelayanan ON pelayanan.id_p_pelayanan = p_pelayanan.id_p_pelayanan
                     LEFT JOIN rayon ON p_pelayanan.id_rayon = rayon.id_rayon
                     LEFT JOIN pendeta ON pelayanan.id_pendeta = pendeta.id_pendeta
                     LEFT JOIN jenis_pelayanan ON p_pelayanan.id_jenis_pelayanan = jenis_pelayanan.id_jenis_pelayanan" . $search_sql . " 
                     ORDER BY pelayanan.id_p_pelayanan DESC LIMIT " . $starting_limit . ", " . $results_per_page;
          $result = mysqli_query($koneksi, $data_query);

          $counter = 1;
          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              $tempat_sambung = str_replace(array("\r", "\n"), '', nl2br($row['tempat']));
          ?>
              <div class="col-lg-6 entries">
                <article class="entry">
                  <h2 class="entry-title">
                    <?php echo $row['jenis_pelayanan']; ?>
                  </h2>
                  <hr>
                  <div class="col-lg-12 entry-meta">
                    <ul style="list-style: none; padding: 0;">
                      <!-- berikan icon Jenis Pelayanan -->
                      <li class="col-12" style="display: none; align-items: center; margin-bottom: 10px;">
                        <i class="bi bi-tag" style="margin-right: 10px;"></i> Jenis Pelayanan : <?php echo $row['jenis_pelayanan']; ?>
                      </li>
                      <!-- berikan icon Pendeta -->
                      <li class="col-12" style="display: flex; align-items: center; margin-bottom: 10px;">
                        <i class="bi bi-person" style="margin-right: 10px;"></i> Nama Pendeta : <?php echo $row['nama_pendeta']; ?>
                      </li>
                      <!-- berikan icon Rayon -->
                      <li class="col-12" style="display: flex; align-items: center; margin-bottom: 10px;">
                        <i class="bi bi-building" style="margin-right: 10px;"></i> Nama Rayon : <?php echo $row['nama_rayon']; ?>
                      </li>
                      <!-- berikan icon waktu -->
                      <li class="col-12" style="display: flex; align-items: center; margin-bottom: 10px;">
                        <i class="bi bi-clock" style="margin-right: 10px;"></i> Waktu : <?php echo $row['waktu']; ?>
                      </li>
                      <!-- berikan icon alamat -->
                      <li class="col-12" style="display: flex; align-items: center; margin-bottom: 10px;">
                        <i class="bi bi-geo-alt" style="margin-right: 10px;"></i> Tempat : <?php echo $tempat_sambung; ?>
                      </li>
                    </ul>
                  </div>
                  <hr>
                </article><!-- End blog entry -->
              </div><!-- End blog entries list -->
          <?php
              $counter++;
            }
          } else {
            echo "<h3 class='text-center'>Tidak Ada Data Yang Ditemukan..</h3>";
          }
          ?>

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
          <?php
          // Close the database connection
          mysqli_close($koneksi);
          ?>
        </div>
      </div>
    </section><!-- End Blog Section -->


  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>Tempo</h3>
            <p>
              Liliba<br>
              Ntt, Kupang<br>
              <strong>Phone:</strong> +62 844 3492 9433<br>
              <strong>Email:</strong> gereja_moria_liliba@gmail.com<br>
            </p>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Contact</a></li>
            </ul>
          </div>

        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          &copy; Dibuat Oleh <strong><span>Oliva</span></strong> Untuk Gereja Moria Liliba
        </div>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>