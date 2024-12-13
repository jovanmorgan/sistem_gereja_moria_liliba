<?php
session_start();
// Periksa apakah pengguna sudah masuk atau belum
if (!isset($_SESSION['id_kepala_keluarga'])) {
  // Pengguna belum masuk, arahkan kembali ke halaman masuk.php
  header("Location: ../../berlangganan/login");
  exit; // Pastikan untuk menghentikan eksekusi skrip setelah mengarahkan
}
include '../../keamanan/koneksi.php';

// Jika pengguna sudah masuk, Anda dapat melanjutkan menampilkan halaman kepala_keluarga.php seperti biasa
$id_kk = $_SESSION['id_kepala_keluarga'];

// Perbaikan query untuk join tabel rayon dan kepala_keluarga
$data_query = "SELECT kepala_keluarga.*, rayon.nama_rayon AS nama_rayon 
               FROM kepala_keluarga 
               LEFT JOIN rayon ON kepala_keluarga.id_rayon = rayon.id_rayon 
               WHERE kepala_keluarga.id_kepala_keluarga = $id_kk";
$result = mysqli_query($koneksi, $data_query);

// Periksa apakah query berhasil
if ($result && mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  $id_rayon = $row['id_rayon'];
  $nama_rayon = $row['nama_rayon'];
  $nama = $row['nama']; // Gantilah dengan field yang sesuai dengan nama kartu keluarga
} else {
  // Tangani jika data tidak ditemukan
  $id_rayon = '';
  $nama_rayon = '';
  $nama = '';
}
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
        <form id="form_tambah" action="proses/p_pelayanan/tambah.php" method="POST" enctype="multipart/form-data">

          <label for="id_rayon">Nama Rayon :</label>
          <input type="hidden" id="id_rayon-tambah" name="id_rayon" value="<?php echo htmlspecialchars($id_rayon); ?>" required>
          <input type="text" id="" name="" value="<?php echo htmlspecialchars($nama_rayon); ?>" required>

          <label for="nkk">Nama Kartu Keluarga :</label>
          <input type="text" id="nkk-tambah" name="nkk" value="<?php echo htmlspecialchars($nama); ?>" required>

          <input type="hidden" id="id_kepala_keluarga-tambah" name="id_kepala_keluarga" value="<?php echo $id_kk; ?>" required>
          <label for="id_jenis_pelayanan-tambah">Jenis Pelayanan:</label>
          <select id="id_jenis_pelayanan-tambah" name="id_jenis_pelayanan" required>
            <option value="" selected>Pilih Jenis Pelayanan</option>
            <?php
            // Menggunakan include untuk menyertakan file koneksi
            include '../../keamanan/koneksi.php';

            // Query untuk mendapatkan data jenis_pelayanan
            $query = "SELECT id_jenis_pelayanan, jenis_pelayanan FROM jenis_pelayanan";
            $result = $koneksi->query($query);

            // Periksa apakah query berhasil dieksekusi
            if ($result) {
              // Loop melalui hasil query dan tambahkan setiap opsi ke dalam select
              while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id_jenis_pelayanan'] . "'>" . $row['jenis_pelayanan'] . "</option>";
              }
              // Bebaskan hasil query
              $result->free();
            } else {
              echo "Gagal mengeksekusi query: " . $koneksi->error;
            }

            // Tutup koneksi
            $koneksi->close();
            ?>
          </select>

          <label for="waktu">Waktu :</label>
          <input type="datetime-local" id="waktu-tambah" name="waktu" required>

          <label for="tempat">Keterangan :</label>
          <textarea id="tempat-tambah" name="tempat" required></textarea>

          <button type="submit" class="btn btn-primary m-1">Submit</button>
        </form>
      </div>
    </div>

    <div id="popup-edit" class="popup">
      <div class="popup-content">
        <span class="close" onclick="closePopupEdit()">&times;</span>
        <hr>
        <h2>Edit Data</h2>
        <form id="form_edit" action="proses/p_pelayanan/edit.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" id="id_p_pelayanan-edit" name="id_p_pelayanan" required>
          <input type="hidden" id="id_kepala_keluarga-edit" name="id_kepala_keluarga" value="<?php echo $id_kk; ?>" required>

          <label for="id_rayon">Nama Rayon :</label>
          <input type="hidden" id="id_rayon-edit" name="id_rayon" value="<?php echo htmlspecialchars($id_rayon); ?>" required>
          <input type="text" value="<?php echo htmlspecialchars($nama_rayon); ?>" required>

          <label for="nkk">Nama Kartu Keluarga :</label>
          <input type="text" id="nkk-edit" name="nkk" value="<?php echo htmlspecialchars($nama); ?>" required>

          <label for="id_jenis_pelayanan-edit">Jenis Pelayanan:</label>
          <select id="id_jenis_pelayanan-edit" name="id_jenis_pelayanan" required>
            <option value="" selected>Pilih Jenis Pelayanan</option>
            <?php
            // Menggunakan include untuk menyertakan file koneksi
            include '../../keamanan/koneksi.php';

            // Query untuk mendapatkan data jenis_pelayanan
            $query = "SELECT id_jenis_pelayanan, jenis_pelayanan FROM jenis_pelayanan";
            $result = $koneksi->query($query);

            // Periksa apakah query berhasil dieksekusi
            if ($result) {
              // Loop melalui hasil query dan editkan setiap opsi ke dalam select
              while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id_jenis_pelayanan'] . "'>" . $row['jenis_pelayanan'] . "</option>";
              }
              // Bebaskan hasil query
              $result->free();
            } else {
              echo "Gagal mengeksekusi query: " . $koneksi->error;
            }

            // Tutup koneksi
            $koneksi->close();
            ?>
          </select>

          <label for="waktu">Waktu :</label>
          <input type="datetime-local" id="waktu-edit" name="waktu" required>

          <label for="tempat">Keterangan :</label>
          <textarea id="tempat-edit" name="tempat" required></textarea>
          <button type="submit" class="btn btn-primary m-1">Submit</button>
        </form>
      </div>
    </div>

    <!-- js edit -->
    <script>
      function openEditModal(id_p_pelayanan, id_jenis_pelayanan, waktu, tempat) {
        tempat_data = tempat.replace(/<br\s*\/?>/gi, '\n');
        // Isi data ke dalam form edit
        document.getElementById('id_p_pelayanan-edit').value = id_p_pelayanan;
        document.getElementById('id_jenis_pelayanan-edit').value = id_jenis_pelayanan;
        document.getElementById('waktu-edit').value = waktu;
        document.getElementById('tempat-edit').value = tempat_data;
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

              <a href="proses/p_pelayanan/export" target="_blank" class="btn btn-info m-2">
                EXPORT
              </a>

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
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nomor</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jenis Pelayanan</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Rayon</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Waktu</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Keterangan</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
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

    document.addEventListener('DOMContentLoaded', function() {
      document.getElementById('form_tambah').addEventListener('submit', function(event) {
        event.preventDefault(); // Menghentikan aksi default form submit

        var form = this;
        var formData = new FormData(form);

        // Tampilkan elemen .loading sebelum mengirimkan permintaan AJAX
        loding.style.display = 'flex';

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'proses/p_pelayanan/tambah.php', true);
        xhr.onload = function() {
          // Sembunyikan elemen .loading setelah permintaan AJAX selesai
          loding.style.display = 'none';

          if (xhr.status === 200) {
            var response = xhr.responseText.trim();
            console.log(response); // Debugging

            if (response === 'success') {
              form.reset();
              closePopupTambah()
              loadTable();
              swal("Berhasil!", "Data berhasil ditambahkan", "success").then(() => {});
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
    document.addEventListener('DOMContentLoaded', function() {
      document.getElementById('form_edit').addEventListener('submit', function(event) {
        event.preventDefault(); // Menghentikan aksi default form submit

        var form = this;
        var formData = new FormData(form);
        // Tampilkan elemen .loading sebelum mengirimkan permintaan AJAX
        loding.style.display = 'flex';

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'proses/p_pelayanan/edit.php', true);
        xhr.onload = function() {

          // Sembunyikan elemen .loading setelah permintaan AJAX selesai
          loding.style.display = 'none';

          if (xhr.status === 200) {
            var response = xhr.responseText.trim();
            console.log(response); // Debugging

            if (response === 'success') {
              form.reset();
              closePopupEdit()
              loadTable();
              swal("Berhasil!", "Data berhasil diedit", "success").then(() => {});
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

            xhr.open('POST', 'proses/p_pelayanan/hapus.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {

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
      xhrTable.onreadystatechange = function() {
        if (xhrTable.readyState == 4 && xhrTable.status == 200) {
          // Perbarui konten tabel dengan respons dari server
          document.getElementById('dataTable').innerHTML = xhrTable.responseText;
        }
      };
      xhrTable.open('GET', 'proses/p_pelayanan/load_table.php', true);
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