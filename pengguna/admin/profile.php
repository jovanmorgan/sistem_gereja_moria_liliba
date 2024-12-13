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
        // Lakukan koneksi ke database
        include '../../keamanan/koneksi.php';

        // Periksa apakah session id_admin telah diset
        if (isset($_SESSION['id_admin'])) {
            $id_admin = $_SESSION['id_admin'];

            // Query SQL untuk mengambil data admin berdasarkan id_admin dari session
            $query = "SELECT * FROM admin WHERE id_admin = '$id_admin'";
            $result = mysqli_query($koneksi, $query);

            // Periksa apakah query berhasil dieksekusi
            if ($result) {
                // Periksa apakah terdapat data admin
                if (mysqli_num_rows($result) > 0) {
                    // Ambil data admin sebagai array asosiatif
                    $admin = mysqli_fetch_assoc($result);
                    ?>
                    <div class="container-fluid px-2 px-md-4">
                        <div class="page-header min-height-300 border-radius-xl mt-4"
                            style="background-image: url('../../assets/img/g1.jpg');">
                            <span class="mask bg-gradient-primary opacity-6"></span>
                        </div>
                        <div class="card card-body mx-3 mx-md-4 mt-n6">
                            <div class="row gx-4 mb-2">
                                <div class="col-auto">
                                    <div class="avatar avatar-xl position-relative">
                                        <a href="javascript:void(0)" onclick="document.getElementById('editFotoProfile').click()">
                                            <?php if (!empty($admin['fp'])): ?>
                                                <img alt="profile_image" class="w-100 border-radius-lg shadow-sm"
                                                    src="data_fp/<?php echo $admin['fp']; ?>" alt="Edit Foto Profile">
                                            <?php else: ?>
                                                <img alt="profile_image" class="w-100 border-radius-lg shadow-sm"
                                                    src="../../assets/img/akun.png" alt="Edit Foto Profile">
                                            <?php endif; ?>
                                        </a>
                                    </div>
                                </div>

                                <!-- Input file tersembunyi untuk memilih gambar -->
                                <input type="file" class="d-none" id="editFotoProfile" name="editFotoProfile" accept="image/*"
                                    onchange="previewAndUpdateProfile(this)">

                                <!-- Modal untuk memilih gambar profile -->
                                <div class="modal fade" id="editFotoProfileModal" tabindex="-1" role="dialog"
                                    aria-labelledby="editFotoProfileModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editFotoProfileModalLabel" style="font-size: 150%;">Edit
                                                    Foto Profile</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                                    onclick="location.reload();">
                                                    <span aria-hidden="true" style="font-size: 140%;">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="gambar">
                                                    <img id="editFotoProfilePreview" src="#" alt="Preview Foto Profile">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                                    onclick="location.reload();">Close</button>
                                                <button type="button" class="btn btn-primary" id="btnSaveProfile">Save
                                                    changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto my-auto">
                                    <div class="h-100">
                                        <h5 class="mb-1">
                                            <?php echo $admin['nama']; ?>
                                        </h5>
                                        <p class="mb-0 font-weight-normal text-sm">
                                            Username : <?php echo $admin['username']; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-xl-4">
                                    <div class="card card-plain h-100">
                                        <div class="card-header pb-0 p-3">
                                            <div class="row">
                                                <div class="col-md-8 d-flex align-items-center">
                                                    <h6 class="mb-0">Profile Information</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body p-3">
                                            <p class="text-sm">
                                                Selamat datang di akun admin Anda. Di sini, Anda dapat mengelola semua
                                                aspek Website Anda, termasuk data pengguna,
                                                pembaruan konten, dan pengaturan sistem. Pastikan informasi profil Anda selalu
                                                terbaru untuk menjamin komunikasi dan
                                                manajemen yang lancar.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-8">
                                    <div class="card card-plain h-100">
                                        <div class="card-header pb-0 p-3">
                                            <div class="row">
                                                <div class="col-md-12 d-flex align-items-center">
                                                    <h6 class="mb-0">Edit Profile</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body p-3">
                                            <form id="editDataFp">
                                                <input type="hidden" class="form-control" name="id_admin" id="id_admin"
                                                    value="<?php echo $admin['id_admin']; ?>">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="nama" class="form-control-label text-primary">Nama :</label>
                                                            <input class="form-control p-1" type="text" id="nama" name="nama"
                                                                value="<?php echo $admin['nama']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="username" class="form-control-label text-primary">Username
                                                                :</label>
                                                            <input class="form-control p-1" type="text" id="username"
                                                                name="username" value="<?php echo $admin['username']; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="password" class="form-control-label text-primary">Password
                                                                :</label>
                                                            <input class="form-control p-1" type="text" id="password"
                                                                name="password" value="<?php echo $admin['password']; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-4">
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-primary">Edit <i
                                                                class="fas fa-user-edit "></i></button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                } else {
                    // Jika tidak ada data admin
                    echo "Tidak ada data admin.";
                }
            } else {
                // Jika query tidak berhasil dieksekusi
                echo "Gagal mengambil data admin: " . mysqli_error($koneksi);
            }
        } else {
            // Jika session id_admin tidak diset
            echo "Session id_admin tidak tersedia.";
        }

        // Tutup koneksi ke database
        mysqli_close($koneksi);
        ?>
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

    <!-- js proses -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        // Variabel global untuk menyimpan instance Cropper
        var cropper;

        const loding = document.querySelector('.loading');

        // Fungsi untuk menampilkan gambar yang dipilih dan menampilkan modal
        function previewAndUpdateProfile(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#editFotoProfilePreview').attr('src', e.target.result);
                    $('#editFotoProfileModal').modal('show');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Fungsi untuk memotong gambar dan menyimpannya
        function cropImage() {
            var croppedCanvas = cropper.getCroppedCanvas({
                width: 200, // Tentukan lebar gambar yang diinginkan
                height: 200 // Tentukan tinggi gambar yang diinginkan
            });
            var croppedDataUrl = croppedCanvas.toDataURL();

            // Tampilkan elemen .loading sebelum mengirimkan permintaan AJAX
            loding.style.display = 'flex';

            // Simpan data gambar ke server menggunakan AJAX
            $.ajax({
                type: 'POST',
                url: 'fp/edit_fp.php',
                data: {
                    imageBase64: croppedDataUrl
                },
                success: function (response) {

                    // Sembunyikan elemen .loading setelah permintaan AJAX selesai
                    loding.style.display = 'none';

                    // Tampilkan sweet alert dengan pesan respon
                    swal("Sukses!", response, "success").then((value) => {
                        // Setelah pengguna menekan tombol "OK" pada SweetAlert, tampilkan alert
                        if (value) {
                            location.reload();
                        }
                    });
                },
                error: function (xhr, status, error) {
                    // Tampilkan sweet alert dengan pesan error
                    swal("Error!", xhr.responseText, "error");
                }
            });

            // Sembunyikan modal pemotongan gambar
            $('#editFotoProfileModal').modal('hide');
        }

        $(document).ready(function () {
            $('#editFotoProfileModal').on('shown.bs.modal', function () {
                // Inisialisasi Cropper setelah modal ditampilkan
                var containerWidth = $('.gambar').width();
                var containerHeight = $('.gambar').height();
                cropper = new Cropper($('#editFotoProfilePreview')[0], {
                    aspectRatio: 1, // 1:1 aspect ratio
                    viewMode: 1, // Crop mode
                    minContainerWidth: containerWidth, // Set minimum container width to match image container width
                    minContainerHeight: containerHeight, // Set minimum container height to match image container height
                });
            });

            $('#btnSaveProfile').on('click', function () {
                cropImage();
            });

            $('#editFotoProfileModal').on('hidden.bs.modal', function () {
                // Hapus cropper ketika modal ditutup
                if (cropper) {
                    cropper.destroy();
                }
            });
        });

        $(document).ready(function () {
            $('#editDataFp').on('submit', function (event) {
                event.preventDefault(); // Mencegah perilaku default form submit

                // Tangkap data formulir
                var formData = $('#editDataFp').serialize();
                // Kirim data formulir ke halaman proses_data_fp.php menggunakan AJAX

                // Tampilkan elemen .loading sebelum mengirimkan permintaan AJAX
                loding.style.display = 'flex';

                $.ajax({
                    type: 'POST',
                    url: 'fp/proses_data_fp.php',
                    data: formData, // Kirim data formulir yang telah ditangkap
                    success: function (response) {

                        // Sembunyikan elemen .loading setelah permintaan AJAX selesai
                        loding.style.display = 'none';

                        // Periksa apakah respons adalah 'success'
                        if (response === 'success') {
                            // Tampilkan sweet alert dengan pesan sukses
                            swal("Sukses!", "Data berhasil diperbarui", "success").then((value) => {
                                // Jika pengguna menekan tombol "OK", lakukan sesuatu
                                if (value) {
                                    location.reload(); // Muat ulang halaman
                                }
                            });
                        } else if (response === 'username_sudah_ada') {
                            // Jika username sudah ada, tampilkan pesan khusus
                            swal("Username Sudah Ada!", "Username yang Anda masukkan sudah terdaftar", "info");
                        } else {
                            // Jika respons adalah sesuatu yang tidak diharapkan, tampilkan pesan error
                            swal("Error!", response, "error");
                        }
                    },
                    error: function (xhr, status, error) {
                        // Tampilkan sweet alert dengan pesan error
                        swal("Error!", xhr.responseText, "error");
                    }
                });
            });
        });
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