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

<body translate="no" class="g-sidenav-show bg-gray-200">

  <!-- sidebar -->
  <?php include 'item/sidebar.php'; ?>
  <!-- akhir sidebar -->

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

    <div id="popup-tambah" class="popup">
      <div class="popup-content">
        <span class="close" onclick="closePopupTambah()">&times;</span>
        <hr>
        <h2>Tambah Data</h2>
        <form id="form_tambah" action="proses/katekasasi/tambah.php" method="POST" enctype="multipart/form-data">
          <label for="nama-tambah">Nama:</label>
          <input type="text" id="nama-tambah" name="nama" required>

          <label for="umur-tambah">Umur:</label>
          <input type="number" id="umur-tambah" name="umur" required>

          <label for="alamat-tambah">Alamat:</label>
          <textarea id="alamat-tambah" name="alamat" required></textarea>

          <label for="jenis_kelamin-tambah">Jenis Kelamin:</label>
          <select id="jenis_kelamin-tambah" name="jenis_kelamin" required>
            <option value="" selected>Pilih Jenis Kelamin</option>
            <option value="pria">Pria</option>
            <option value="wanita">Wanita</option>
          </select>

          <button type="submit" class="btn btn-primary m-1">Submit</button>
        </form>
      </div>
    </div>

    <div id="popup-edit" class="popup">
      <div class="popup-content">
        <span class="close" onclick="closePopupEdit()">&times;</span>
        <hr>
        <h2>Edit Data</h2>
        <form id="form_edit" action="proses/katekasasi/edit.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" id="id_katekasasi_edit" name="id_katekasasi" required>
          <label for="nama-edit">Nama:</label>
          <input type="text" id="nama_edit" name="nama" required>

          <label for="umur">Umur:</label>
          <input type="number" id="umur_edit" name="umur" required>

          <label for="alamat">Alamat:</label>
          <textarea id="alamat_edit" name="alamat" required></textarea>

          <label for="jenis_kelamin">Jenis Kelamin:</label>
          <select id="jenis_kelamin_edit" name="jenis_kelamin" required>
            <option value="" selected>Pilih Jenis Kelamin</option>
            <option value="pria">Pria</option>
            <option value="wanita">Wanita</option>
          </select>

          <button type="submit" class="btn btn-primary m-1">Submit</button>
        </form>
      </div>
    </div>

    <!-- js edit -->
    <script>
      function openEditModal(id_katekasasi, nama, umur, alamat, jenis_kelamin) {
        alamat_data = alamat.replace(/<br\s*\/?>/gi, '\n');
        // Isi data ke dalam form edit
        document.getElementById('id_katekasasi_edit').value = id_katekasasi;
        document.getElementById('nama_edit').value = nama;
        document.getElementById('umur_edit').value = umur;
        document.getElementById('alamat_edit').value = alamat_data;
        document.getElementById('jenis_kelamin_edit').value = jenis_kelamin;
        openPopupEdit();
      }
    </script>

    <!-- Navbar -->
    <?php include 'item/navbar.php'; ?>

    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card my-4">

            <!-- judul_table -->
            <?php include 'item/judul_table.php'; ?>
            <!-- akhir judul_table -->

            <div class="mt-3 p-3 d-flex flex-wrap align-items-center justify-content-center">
              <button class="btn btn-success m-1" onclick="openPopupTambah()">Tambah</button>

              <!-- tombol_export -->
              <?php include 'item/tombol_export.php'; ?>
              <!-- akhir tombol_export -->

              <div class="ms-md-auto pe-md-3 d-flex align-items-center m-2 w-100 w-md-auto">
                <form action="" method="GET" class="ms-md-auto pe-md-3 d-flex align-items-center m-2 w-100 w-md-auto">
                  <div class="input-group input-group-outline w-100">
                    <label class="form-label">Cari Data...</label>
                    <input type="text" class="form-control" name="search_query" style="width: 100%;">
                  </div>
                </form>
              </div>
            </div>
            <hr color="#000">

            <div class="card-body px-0 pb-2" id="dataTable">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nomor
                      </th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama
                      </th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Umur
                      </th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Alamat
                      </th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jenis
                        Kelamin</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi
                      </th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php
                    include '../../keamanan/koneksi.php';

                    // Define how many results you want per page
                    $results_per_page = 10;

                    // Get search query from URL if it exists
                    $search_query = isset($_GET['search_query']) ? $_GET['search_query'] : '';

                    // Find out the number of results stored in the database
                    $search_sql = !empty($search_query) ? " WHERE nama LIKE '%$search_query%' OR umur LIKE '%$search_query%' OR alamat LIKE '%$search_query%' OR jenis_kelamin LIKE '%$search_query%'" : '';
                    $count_query = "SELECT COUNT(*) AS total FROM katekasasi" . $search_sql;
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
                    $data_query = "SELECT * FROM katekasasi" . $search_sql . " ORDER BY id_katekasasi DESC LIMIT " . $starting_limit . ", " . $results_per_page;
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
                              \"" . $row['id_katekasasi'] . "\",
                              \"" . $row['nama'] . "\",
                              \"" . $row['umur'] . "\",
                              \"" . $alamat_sambung . "\",
                              \"" . $row['jenis_kelamin'] . "\"
                        )'><i class='fas fa-edit' style='font-size: 24px; color: green;'></i></a>";
                        echo "<a href='javascript:;' style='margin-left: 30px;' class='text-secondary font-weight-bold text-xs' data-toggle='tooltip' data-original-title='Delete user' onclick='hapus(\"" . $row['id_katekasasi'] . "\")'>";
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
                    <?php if ($page > 1): ?>
                      <li class="page-item">
                        <a class="page-link"
                          href="?page=<?php echo $page - 1; ?>&search_query=<?php echo $search_query; ?>"
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
                        <a class="page-link"
                          href="?page=<?php echo $page + 1; ?>&search_query=<?php echo $search_query; ?>"
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



          </div>
        </div>
      </div>
      <!-- footer -->
      <?php include 'item/footer.php'; ?>
      <!-- akhir footer -->
    </div>
  </main>
  <!--=============== LOADING ===============-->
  <div class="loading">
    <div class="circle"></div>
    <div class="circle"></div>
    <div class="circle"></div>
  </div>

  <style>
    .loading {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      display: none;
      /* Mula-mula, loading disembunyikan */
      justify-content: center;
      align-items: center;
      z-index: 9999;
      /* Menempatkan loading di atas elemen lain */
      height: 100vh;
      width: 100vw;
      background-color: rgba(255, 255, 255, 0.932);
      /* Menambahkan latar belakang semi transparan */
    }

    .circle {
      width: 20px;
      height: 20px;
      background-color: #41a506;
      border-radius: 50%;
      margin: 0 10px;
      animation: bounce 0.5s infinite alternate;
    }

    .circle:nth-child(2) {
      animation-delay: 0.2s;
    }

    .circle:nth-child(3) {
      animation-delay: 0.4s;
    }

    @keyframes bounce {
      from {
        transform: translateY(0);
      }

      to {
        transform: translateY(-20px);
      }
    }
  </style>

  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script>
    const loding = document.querySelector('.loading');

    document.addEventListener('DOMContentLoaded', function () {
      document.getElementById('form_tambah').addEventListener('submit', function (event) {
        event.preventDefault(); // Menghentikan aksi default form submit

        var form = this;
        var formData = new FormData(form);

        // Tampilkan elemen .loading sebelum mengirimkan permintaan AJAX
        loding.style.display = 'flex';

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'proses/katekasasi/tambah.php', true);
        xhr.onload = function () {
          // Sembunyikan elemen .loading setelah permintaan AJAX selesai
          loding.style.display = 'none';

          if (xhr.status === 200) {
            var response = xhr.responseText.trim();
            console.log(response); // Debugging

            if (response === 'success') {
              form.reset();
              closePopupTambah()
              loadTable();
              swal("Berhasil!", "Data berhasil ditambahkan", "success").then(() => { });
            } else if (response === 'data_tidak_lengkap') {
              swal("Error", "Data yang anda masukan belum lengkap", "info");
            } else {
              swal("Error", "Gagal menambahkan data", "error");
            }
          } else {
            swal("Error", "Terjadi kesalahan saat mengirim data", "error");
          }
        };
        xhr.send(formData);
      });
    });

    // logika untuk mengedit Data
    document.addEventListener('DOMContentLoaded', function () {
      document.getElementById('form_edit').addEventListener('submit', function (event) {
        event.preventDefault(); // Menghentikan aksi default form submit

        var form = this;
        var formData = new FormData(form);
        // Tampilkan elemen .loading sebelum mengirimkan permintaan AJAX
        loding.style.display = 'flex';

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'proses/katekasasi/edit.php', true);
        xhr.onload = function () {

          // Sembunyikan elemen .loading setelah permintaan AJAX selesai
          loding.style.display = 'none';

          if (xhr.status === 200) {
            var response = xhr.responseText.trim();
            console.log(response); // Debugging

            if (response === 'success') {
              form.reset();
              closePopupEdit()
              loadTable();
              swal("Berhasil!", "Data berhasil diedit", "success").then(() => { });
            } else if (response === 'data_tidak_lengkap') {
              swal("Error", "Data yang anda masukan belum lengkap", "info");
            } else {
              swal("Error", "Gagal mengedit data", "error");
            }
          } else {
            swal("Error", "Terjadi kesalahan saat mengirim data", "error");
          }
        };
        xhr.send(formData);
      });
    });

    // logika untuk menghapus data video
    function hapus(id) {
      swal({
        title: "Apakah Anda yakin?",
        text: "Setelah dihapus, Anda tidak akan dapat memulihkan data ini!",
        icon: "warning",
        buttons: ["Batal", "Ya, hapus!"],
        dangerMode: true,
      })
        .then((willDelete) => {
          if (willDelete) {
            // Jika pengguna mengonfirmasi untuk menghapus
            var xhr = new XMLHttpRequest();

            // Tampilkan elemen .loading sebelum mengirimkan permintaan AJAX
            loding.style.display = 'flex';

            xhr.open('POST', 'proses/katekasasi/hapus.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {

              // Sembunyikan elemen .loading setelah permintaan AJAX selesai
              loding.style.display = 'none';

              if (xhr.status === 200) {
                var response = xhr.responseText;
                if (response === 'success') {
                  swal("Sukses!", "Data berhasil dihapus.", "success")
                  loadTable();
                } else {
                  swal("Error", "Gagal menghapus Data.", "error");
                }
              } else {
                swal("Error", "Terjadi kesalahan saat mengirim data.", "error");
              }
            };
            xhr.send("id=" + id);
          } else {
            // Jika pengguna membatalkan penghapusan
            swal("Penghapusan dibatalkan", {
              icon: "info",
            });
          }
        });
    }

    function openPopup(popupId) {
      const popup = document.getElementById(popupId);
      const popupContent = popup.querySelector('.popup-content');
      popup.style.display = 'flex';
      setTimeout(() => {
        popup.style.right = '0';
        popupContent.style.right = '0';
      }, 10); // Slight delay to allow the display to change before starting animation
    }

    function closePopup(popupId) {
      const popup = document.getElementById(popupId);
      const popupContent = popup.querySelector('.popup-content');
      popup.style.right = '-100%';
      popupContent.style.right = '-100%';
      setTimeout(() => {
        popup.style.display = 'none';
      }, 500); // Duration of the animation
    }

    function openPopupTambah() {
      openPopup('popup-tambah');
    }

    function closePopupTambah() {
      closePopup('popup-tambah');
    }

    function openPopupEdit() {
      openPopup('popup-edit');
    }

    function closePopupEdit() {
      closePopup('popup-edit');
    }

    function loadTable() {
      var xhrTable = new XMLHttpRequest();
      xhrTable.onreadystatechange = function () {
        if (xhrTable.readyState == 4 && xhrTable.status == 200) {
          // Perbarui konten tabel dengan respons dari server
          document.getElementById('dataTable').innerHTML = xhrTable.responseText;
        }
      };
      xhrTable.open('GET', 'proses/katekasasi/load_table.php', true);
      xhrTable.send();
    }
  </script>

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