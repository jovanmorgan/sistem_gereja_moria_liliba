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
        <form id="form_tambah" action="proses/jemaat/tambah.php" method="POST" enctype="multipart/form-data">

          <label for="id_rayon-tambah">Rayon:</label>
          <select id="id_rayon-tambah" name="id_rayon" required onchange="fetchKepalaKeluarga()">
            <option value="" selected>Pilih Rayon</option>
            <?php
            include '../../keamanan/koneksi.php';
            $query = "SELECT id_rayon, nama_rayon FROM rayon";
            $result = $koneksi->query($query);
            if ($result) {
              while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id_rayon'] . "'>" . $row['nama_rayon'] . "</option>";
              }
              $result->free();
            } else {
              echo "Gagal mengeksekusi query: " . $koneksi->error;
            }
            $koneksi->close();
            ?>
          </select>

          <label for="id_kepala_keluarga-tambah">Kepala Keluarga:</label>
          <select id="id_kepala_keluarga-tambah" name="id_kepala_keluarga" required>
            <option value="" selected>Pilih Kepala Keluarga</option>
          </select>

          <label for="nama-tambah">Nama Jemaat:</label>
          <input type="text" id="nama-tambah" name="nama" required>

          <label for="no_hp-tambah">Nomor Hp:</label>
          <input type="number" min="0" id="no_hp-tambah" name="no_hp" required>

          <label for="alamat-tambah">Alamat:</label>
          <textarea id="alamat-tambah" name="alamat" required></textarea>

          <label for="jenis_kelamin-tambah">Jenis Kelamin:</label>
          <select id="jenis_kelamin-tambah" name="jenis_kelamin" required>
            <option value="" selected>Pilih Jenis Kelamin</option>
            <option value="pria">Pria</option>
            <option value="wanita">Wanita</option>
          </select>

          <label for="tempat_lahir-tambah">Tempat Lahir:</label>
          <input type="text" id="tempat_lahir-tambah" name="tempat_lahir" required>

          <label for="tanggal_lahir-tambah">Tanggal Lahir:</label>
          <input type="date" id="tanggal_lahir-tambah" name="tanggal_lahir" required>

          <label for="status_baptis-tambah">Status Baptis:</label>
          <select id="status_baptis-tambah" name="status_baptis" required>
            <option value="" selected>Pilih Status Baptis</option>
            <option value="Sudah">Sudah</option>
            <option value="Belum">Belum</option>
          </select>

          <label for="status_sidi-tambah">Status Sidi:</label>
          <select id="status_sidi-tambah" name="status_sidi" required>
            <option value="" selected>Pilih Status Sidi</option>
            <option value="Sudah">Sudah</option>
            <option value="Belum">Belum</option>
          </select>

          <label for="status_nikah-tambah">Status Nikah:</label>
          <select id="status_nikah-tambah" name="status_nikah" required>
            <option value="" selected>Pilih Status Nikah</option>
            <option value="Sudah">Sudah</option>
            <option value="Belum">Belum</option>
          </select>

          <label for="status_keluarga-tambah">Status Keluarga:</label>
          <select id="status_keluarga-tambah" name="status_keluarga" required>
            <option value="" selected>Pilih Status Keluarga</option>
            <option value="Sudah Berkeluarga">Sudah Berkeluarga</option>
            <option value="Belum Berkeluarga">Belum Berkeluarga</option>
          </select>

          <label for="tanggal_nikah-tambah">Tanggal Nikah:</label>
          <input type="text" id="tanggal_nikah-tambah" name="tanggal_nikah" required>


          <label for="pendidikan_terakhir-tambah">Pendidikan Terakhir:</label>
          <select id="pendidikan_terakhir-tambah" name="pendidikan_terakhir" required>
            <option value="" selected>Pilih Pendidikan Terakhir</option>
            <option value="SD">SD</option>
            <option value="SMP">SMP</option>
            <option value="SMA">SMA</option>
            <option value="D3">D3</option>
            <option value="S1">S1</option>
            <option value="S2">S2</option>
            <option value="S3">S3</option>
          </select>

          <label for="tahun_pendidikan_terakhir-tambah">Tahun Pendidikan Terakhir:</label>
          <input type="date" id="tahun_pendidikan_terakhir-tambah" name="tahun_pendidikan_terakhir" required>

          <label for="pekerjaan-tambah">Pekerjaan:</label>
          <select id="pekerjaan-tambah" required>
            <option value="" selected>Pilih Pekerjaan</option>
            <option value="PNS">PNS</option>
            <option value="Pegawai Swasta">Pegawai Swasta</option>
            <option value="Wirausaha">Wirausaha</option>
            <option value="Petani">Petani</option>
            <option value="Nelayan">Nelayan</option>
            <option value="Guru">Guru</option>
            <option value="Dokter">Dokter</option>
            <option value="Perawat">Perawat</option>
            <option value="Tentara">Tentara</option>
            <option value="Polisi">Polisi</option>
            <option value="Pilot">Pilot</option>
            <option value="Pramugari">Pramugari</option>
            <option value="Karyawan">Karyawan</option>
            <option value="Freelancer">Freelancer</option>
            <option value="Pelajar">Pelajar</option>
            <option value="Mahasiswa">Mahasiswa</option>
            <option value="Lainnya">Lainnya</option>
          </select>

          <div id="pekerjaan-lainnya-container" style="display: none; width: 100%;">
            <label for="pekerjaan-lainnya">Pekerjaan Lainnya:</label>
            <input type="text" id="pekerjaan-lainnya" placeholder="Masukkan pekerjaan Anda">
          </div>

          <script>
            document.getElementById('pekerjaan-tambah').addEventListener('change', function() {
              var pekerjaanLainnyaContainer = document.getElementById('pekerjaan-lainnya-container');
              var pekerjaanLainnyaInput = document.getElementById('pekerjaan-lainnya');

              if (this.value === 'Lainnya') {
                pekerjaanLainnyaContainer.style.display = 'block';
                pekerjaanLainnyaInput.setAttribute('name', 'pekerjaan');
                pekerjaanLainnyaInput.required = true;
                this.removeAttribute('name');
              } else {
                pekerjaanLainnyaContainer.style.display = 'none';
                pekerjaanLainnyaInput.removeAttribute('name');
                pekerjaanLainnyaInput.required = false;
                this.setAttribute('name', 'pekerjaan');
              }
            });
          </script>


          <label for="usaha_sampingan-tambah">Usaha Sampingan:</label>
          <input type="text" id="usaha_sampingan-tambah" name="usaha_sampingan" required>

          <label for="status_sosial-tambah">Status Sosial:</label>
          <input type="text" id="status_sosial-tambah" name="status_sosial" required>

          <label for="pendapatan-tambah">Pendapatan:</label>
          <input type="text" id="pendapatan-tambah" name="pendapatan" required>

          <label for="status_diakonia-tambah">Status Diakonia:</label>
          <select id="status_diakonia-tambah" name="status_diakonia" required>
            <option value="" selected>Pilih Status Diakonia</option>
            <option value="Penerima Diakonia">Penerima Diakonia</option>
            <option value="Bukan Penerima Diakonia">Bukan Penerima Diakonia</option>
          </select>

          <label for="diakonia-tambah">Diakonia:</label>
          <input type="text" id="diakonia-tambah" name="diakonia" required>

          <label for="bantuan_pemerintah-tambah">Bantuan Pemerintah:</label>
          <input type="text" id="bantuan_pemerintah-tambah" name="bantuan_pemerintah" required>

          <label for="kondisi_rumah-tambah">Kondisi Rumah:</label>
          <input type="text" id="kondisi_rumah-tambah" name="kondisi_rumah" required>

          <label for="kepemilikan_rumah-tambah">Kepemilikan Rumah:</label>
          <input type="text" id="kepemilikan_rumah-tambah" name="kepemilikan_rumah" required>

          <label for="status_bpjs-tambah">Status BPJS:</label>
          <select id="status_bpjs-tambah" name="status_bpjs" required>
            <option value="" selected>Pilih Status BPJS</option>
            <option value="Aktif">Aktif</option>
            <option value="Non-Aktif">Non-Aktif</option>
          </select>

          <label for="biaya_bpjs-tambah">Biaya BPJS:</label>
          <input type="text" id="biaya_bpjs-tambah" name="biaya_bpjs" required>

          <label for="etnis-tambah">Etnis:</label>
          <input type="text" id="etnis-tambah" name="etnis" required>

          <label for="golongan_darah-tambah">Golongan Darah:</label>
          <select id="golongan_darah-tambah" name="golongan_darah" required>
            <option value="" selected>Pilih Golongan Darah</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="AB">AB</option>
            <option value="O">O</option>
          </select>

          <label for="agama_sebelumnya-tambah">Agama Sebelumnya:</label>
          <input type="text" id="agama_sebelumnya-tambah" name="agama_sebelumnya" required>

          <label for="gereja_sebelumnya-tambah">Gereja Sebelumnya:</label>
          <input type="text" id="gereja_sebelumnya-tambah" name="gereja_sebelumnya" required>

          <label for="status_jemaat-tambah">Status Jemaat:</label>
          <select id="status_jemaat-tambah" name="status_jemaat" required>
            <option value="" selected>Pilih Status Jemaat</option>
            <option value="Aktif">Aktif</option>
            <option value="Non-Aktif">Non-Aktif</option>
          </select>

          <button type="submit" class="btn btn-primary m-1">Submit</button>
        </form>
      </div>
    </div>


    <script>
      // Function to fetch kepala keluarga based on selected rayon
      function fetchKepalaKeluarga() {
        var id_rayon = document.getElementById('id_rayon-tambah').value;
        var selectKepalaKeluarga = document.getElementById('id_kepala_keluarga-tambah');
        selectKepalaKeluarga.innerHTML = '<option value="" selected>Pilih Kepala Keluarga</option>';

        // Make AJAX request
        if (id_rayon !== '') {
          var xhr = new XMLHttpRequest();
          xhr.open('GET', 'proses/jemaat/data_kk.php?id_rayon=' + id_rayon, true);

          xhr.onload = function() {
            if (xhr.status == 200) {
              var data = JSON.parse(xhr.responseText);
              data.forEach(function(kepala) {
                var option = document.createElement('option');
                option.value = kepala.id_kepala_keluarga;
                option.textContent = kepala.nama;
                selectKepalaKeluarga.appendChild(option);
              });
            } else {
              console.error('Request failed. Status: ' + xhr.status);
            }
          };

          xhr.send();
        }
      }
    </script>

    <div id="popup-edit" class="popup">
      <div class="popup-content">
        <span class="close" onclick="closePopupEdit()">&times;</span>
        <hr>
        <h2>Edit Data</h2>
        <form id="form_edit" action="proses/jemaat/edit.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" id="id_jemaat-edit" name="id_jemaat" required>

          <label for="id_rayon-edit">Rayon :</label>
          <select id="id_rayon-edit" name="id_rayon" required onchange="fetchKepalaKeluargaEdit()">
            <option value="" selected>Pilih Rayon</option>
            <?php
            // Menggunakan include untuk menyertakan file koneksi
            include '../../keamanan/koneksi.php';

            // Query untuk mendapatkan data rayon
            $query = "SELECT id_rayon, nama_rayon FROM rayon";
            $result = $koneksi->query($query);

            // Periksa apakah query berhasil dieksekusi
            if ($result) {
              // Loop melalui hasil query dan tambahkan setiap opsi ke dalam select
              while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id_rayon'] . "'>" . $row['nama_rayon'] . "</option>";
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

          <label for="id_kepala_keluarga-edit">Kepala Keluarga :</label>
          <select id="id_kepala_keluarga-edit" name="id_kepala_keluarga" required>
            <option value="" selected>Pilih Kepala Keluarga</option>
            <!-- Opsi kepala keluarga akan diisi secara dinamis setelah rayon dipilih menggunakan AJAX -->
          </select>

          <label for="nama-edit">Nama Jemaat:</label>
          <input type="text" id="nama-edit" name="nama" required>

          <label for="no_hp-edit">Nomor Hp :</label>
          <input type="number" min="0" id="no_hp-edit" name="no_hp" required>

          <label for="alamat-edit">Alamat:</label>
          <textarea id="alamat-edit" name="alamat" required></textarea>

          <label for="jenis_kelamin-edit">Jenis Kelamin:</label>
          <select id="jenis_kelamin-edit" name="jenis_kelamin" required>
            <option value="" selected>Pilih Jenis Kelamin</option>
            <option value="pria">Pria</option>
            <option value="wanita">Wanita</option>
          </select>

          <label for="tempat_lahir-edit">Tempat Lahir:</label>
          <input type="text" id="tempat_lahir-edit" name="tempat_lahir" required>

          <label for="tanggal_lahir-edit">Tanggal Lahir:</label>
          <input type="date" id="tanggal_lahir-edit" name="tanggal_lahir" required>

          <label for="status_baptis-edit">Status Baptis:</label>
          <select id="status_baptis-edit" name="status_baptis" required>
            <option value="" selected>Pilih Status Baptis</option>
            <option value="Sudah">Sudah</option>
            <option value="Belum">Belum</option>
          </select>

          <label for="status_sidi-edit">Status Sidi:</label>
          <select id="status_sidi-edit" name="status_sidi" required>
            <option value="" selected>Pilih Status Sidi</option>
            <option value="Sudah">Sudah</option>
            <option value="Belum">Belum</option>
          </select>

          <label for="status_nikah-edit">Status Nikah:</label>
          <select id="status_nikah-edit" name="status_nikah" required>
            <option value="" selected>Pilih Status Nikah</option>
            <option value="Sudah">Sudah</option>
            <option value="Belum">Belum</option>
          </select>

          <label for="status_keluarga-edit">Status Keluarga:</label>
          <select id="status_keluarga-edit" name="status_keluarga" required>
            <option value="" selected>Pilih Status Keluarga</option>
            <option value="Sudah Berkeluarga">Sudah Berkeluarga</option>
            <option value="Belum Berkeluarga">Belum Berkeluarga</option>
          </select>

          <label for="tanggal_nikah-edit">Tanggal Nikah:</label>
          <input type="text" id="tanggal_nikah-edit" name="tanggal_nikah" required>

          <label for="pendidikan_terakhir-edit">Pendidikan Terakhir:</label>
          <select id="pendidikan_terakhir-edit" name="pendidikan_terakhir" required>
            <option value="" selected>Pilih Pendidikan Terakhir</option>
            <option value="SD">SD</option>
            <option value="SMP">SMP</option>
            <option value="SMA">SMA</option>
            <option value="D3">D3</option>
            <option value="S1">S1</option>
            <option value="S2">S2</option>
            <option value="S3">S3</option>
          </select>

          <label for="tahun_pendidikan_terakhir-edit"> Tahun Pendidikan Terakhir:</label>
          <input type="date" id="tahun_pendidikan_terakhir-edit" name="tahun_pendidikan_terakhir" required>

          <!-- Bagian Edit Pekerjaan -->
          <label for="pekerjaan-edit">Pekerjaan:</label>
          <select id="pekerjaan-edit" name="pekerjaan" required>
            <option value="" selected>Pilih Pekerjaan</option>
            <option value="PNS">PNS</option>
            <option value="Pegawai Swasta">Pegawai Swasta</option>
            <option value="Wirausaha">Wirausaha</option>
            <option value="Petani">Petani</option>
            <option value="Nelayan">Nelayan</option>
            <option value="Guru">Guru</option>
            <option value="Dokter">Dokter</option>
            <option value="Perawat">Perawat</option>
            <option value="Tentara">Tentara</option>
            <option value="Polisi">Polisi</option>
            <option value="Pilot">Pilot</option>
            <option value="Pramugari">Pramugari</option>
            <option value="Karyawan">Karyawan</option>
            <option value="Freelancer">Freelancer</option>
            <option value="Pelajar">Pelajar</option>
            <option value="Mahasiswa">Mahasiswa</option>
            <option value="Lainnya">Lainnya</option>
          </select>

          <div id="pekerjaan-edit-lainnya-container" style="display: none;">
            <label for="pekerjaan-edit-lainnya">Pekerjaan Lainnya:</label>
            <input type="text" id="pekerjaan-edit-lainnya" placeholder="Masukkan pekerjaan Anda">
          </div>
          <script>
            document.getElementById('pekerjaan-edit').addEventListener('change', function() {
              var pekerjaanEditLainnyaContainer = document.getElementById('pekerjaan-edit-lainnya-container');
              var pekerjaanEditLainnyaInput = document.getElementById('pekerjaan-edit-lainnya');

              if (this.value === 'Lainnya') {
                pekerjaanEditLainnyaContainer.style.display = 'block';
                pekerjaanEditLainnyaInput.setAttribute('name', 'pekerjaan');
                pekerjaanEditLainnyaInput.required = true;
                this.removeAttribute('name');
              } else {
                pekerjaanEditLainnyaContainer.style.display = 'none';
                pekerjaanEditLainnyaInput.removeAttribute('name');
                pekerjaanEditLainnyaInput.required = false;
                this.setAttribute('name', 'pekerjaan');
              }
            });
          </script>
          <label for="usaha_sampingan-edit">Usaha Sampingan:</label>
          <input type="text" id="usaha_sampingan-edit" name="usaha_sampingan" required>

          <label for="status_sosial-edit">Status Sosial:</label>
          <input type="text" id="status_sosial-edit" name="status_sosial" required>

          <label for="pendapatan-edit">Pendapatan:</label>
          <input type="text" id="pendapatan-edit" name="pendapatan" required>

          <label for="status_diakonia-edit">Status Diakonia:</label>
          <select id="status_diakonia-edit" name="status_diakonia" required>
            <option value="" selected>Pilih Status Diakonia</option>
            <option value="Penerima Diakonia">Penerima Diakonia</option>
            <option value="Bukan Penerima Diakonia">Bukan Penerima Diakonia</option>
          </select>

          <label for="diakonia-edit">Diakonia:</label>
          <input type="text" id="diakonia-edit" name="diakonia" required>

          <label for="bantuan_pemerintah-edit">Bantuan Pemerintah:</label>
          <input type="text" id="bantuan_pemerintah-edit" name="bantuan_pemerintah" required>

          <label for="kondisi_rumah-edit">Kondisi Rumah:</label>
          <input type="text" id="kondisi_rumah-edit" name="kondisi_rumah" required>

          <label for="kepemilikan_rumah-edit">Kepemilikan Rumah:</label>
          <input type="text" id="kepemilikan_rumah-edit" name="kepemilikan_rumah" required>

          <label for="status_bpjs-edit">Status BPJS:</label>
          <select id="status_bpjs-edit" name="status_bpjs" required>
            <option value="" selected>Pilih Status BPJS</option>
            <option value="Aktif">Aktif</option>
            <option value="Non-Aktif">Non-Aktif</option>
          </select>

          <label for="biaya_bpjs-edit">Biaya BPJS:</label>
          <input type="text" id="biaya_bpjs-edit" name="biaya_bpjs" required>

          <label for="etnis-edit">Etnis:</label>
          <input type="text" id="etnis-edit" name="etnis" required>

          <label for="golongan_darah-edit">Golongan Darah:</label>
          <select id="golongan_darah-edit" name="golongan_darah" required>
            <option value="" selected>Pilih Golongan Darah</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="AB">AB</option>
            <option value="O">O</option>
          </select>

          <label for="agama_sebelumnya-edit">Agama Sebelumnya:</label>
          <input type="text" id="agama_sebelumnya-edit" name="agama_sebelumnya" required>

          <label for="gereja_sebelumnya-edit">Gereja Sebelumnya:</label>
          <input type="text" id="gereja_sebelumnya-edit" name="gereja_sebelumnya" required>

          <label for="status_jemaat-edit">Status Jemaat:</label>
          <select id="status_jemaat-edit" name="status_jemaat" required>
            <option value="" selected>Pilih Status Jemaat</option>
            <option value="Aktif">Aktif</option>
            <option value="Non-Aktif">Non-Aktif</option>
          </select>


          <button type="submit" class="btn btn-primary m-1">Submit</button>
        </form>
      </div>
    </div>

    <script>
      // Function to populate kepala keluarga options for edit form based on selected rayon
      function fetchKepalaKeluargaEdit() {
        var id_rayon = document.getElementById('id_rayon-edit').value;
        var selectKepalaKeluarga = document.getElementById('id_kepala_keluarga-edit');
        selectKepalaKeluarga.innerHTML = '<option value="" selected>Pilih Kepala Keluarga</option>';

        // Make AJAX request
        if (id_rayon !== '') {
          var xhr = new XMLHttpRequest();
          xhr.open('GET', 'proses/jemaat/data_kk.php?id_rayon=' + id_rayon, true);

          xhr.onload = function() {
            if (xhr.status == 200) {
              var data = JSON.parse(xhr.responseText);
              data.forEach(function(kepala) {
                var option = document.createElement('option');
                option.value = kepala.id_kepala_keluarga;
                option.textContent = kepala.nama;
                selectKepalaKeluarga.appendChild(option);
              });
            } else {
              console.error('Request failed. Status: ' + xhr.status);
            }
          };

          xhr.send();
        }
      }

      // Function to open edit modal and populate with selected jemaat data
      function openEditModal(id_jemaat, nama, id_rayon, id_kepala_keluarga, no_hp, jenis_kelamin, alamat, tempat_lahir, tanggal_lahir, status_baptis, status_sidi, status_nikah, status_keluarga, tanggal_nikah, pendidikan_terakhir, tahun_pendidikan_terakhir, pekerjaan, usaha_sampingan, status_sosial, pendapatan, status_diakonia, diakonia, bantuan_pemerintah, kondisi_rumah, kepemilikan_rumah, status_bpjs, biaya_bpjs, etnis, golongan_darah, agama_sebelumnya, gereja_sebelumnya, status_jemaat) {
        document.getElementById('id_jemaat-edit').value = id_jemaat;
        document.getElementById('nama-edit').value = nama;
        document.getElementById('id_rayon-edit').value = id_rayon;
        fetchKepalaKeluargaEdit(); // Populate kepala keluarga options based on id_rayon
        document.getElementById('id_kepala_keluarga-edit').value = id_kepala_keluarga;
        document.getElementById('no_hp-edit').value = no_hp;
        document.getElementById('alamat-edit').value = alamat;
        document.getElementById('jenis_kelamin-edit').value = jenis_kelamin;
        document.getElementById('tempat_lahir-edit').value = tempat_lahir;
        document.getElementById('tanggal_lahir-edit').value = tanggal_lahir;
        document.getElementById('status_baptis-edit').value = status_baptis;
        document.getElementById('status_sidi-edit').value = status_sidi;
        document.getElementById('status_nikah-edit').value = status_nikah;
        document.getElementById('status_keluarga-edit').value = status_keluarga;
        document.getElementById('tanggal_nikah-edit').value = tanggal_nikah;
        document.getElementById('pendidikan_terakhir-edit').value = pendidikan_terakhir;
        document.getElementById('tahun_pendidikan_terakhir-edit').value = tahun_pendidikan_terakhir;
        document.getElementById('pekerjaan-edit').value = pekerjaan;
        document.getElementById('usaha_sampingan-edit').value = usaha_sampingan;
        document.getElementById('status_sosial-edit').value = status_sosial;
        document.getElementById('pendapatan-edit').value = pendapatan;
        document.getElementById('status_diakonia-edit').value = status_diakonia;
        document.getElementById('diakonia-edit').value = diakonia;
        document.getElementById('bantuan_pemerintah-edit').value = bantuan_pemerintah;
        document.getElementById('kondisi_rumah-edit').value = kondisi_rumah;
        document.getElementById('kepemilikan_rumah-edit').value = kepemilikan_rumah;
        document.getElementById('status_bpjs-edit').value = status_bpjs;
        document.getElementById('biaya_bpjs-edit').value = biaya_bpjs;
        document.getElementById('etnis-edit').value = etnis;
        document.getElementById('golongan_darah-edit').value = golongan_darah;
        document.getElementById('agama_sebelumnya-edit').value = agama_sebelumnya;
        document.getElementById('gereja_sebelumnya-edit').value = gereja_sebelumnya;
        document.getElementById('status_jemaat-edit').value = status_jemaat;
        openPopupEdit(); // Open the edit popup modal
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
              <a href="proses/jemaat/export?id_kepala_keluarga=<?php echo $id_kepala_keluarga; ?>" target="_blank" class="btn btn-info m-2">
                EXPORT
              </a>
              <!-- Form Pencarian -->
              <div class="ms-md-auto pe-md-3 d-flex align-items-center m-2 w-100 w-md-auto">
                <form action="" method="GET" class="ms-md-auto pe-md-3 d-flex align-items-center m-2 w-100 w-md-auto">
                  <div class="input-group input-group-outline w-100">
                    <input type="hidden" name="id_kepala_keluarga" value="<?php echo htmlspecialchars($id_kepala_keluarga); ?>">
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
                    include '../../keamanan/koneksi.php';

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
                        <a class="page-link" href="?page=<?php echo $page - 1; ?>&search_query=<?php echo urlencode($search_query); ?>&id_kepala_keluarga=<?php echo urlencode($id_kepala_keluarga); ?>" aria-label="Previous">
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
                                              echo 'text-dark'; ?>" href="?page=<?php echo $i; ?>&search_query=<?php echo urlencode($search_query); ?>&id_kepala_keluarga=<?php echo urlencode($id_kepala_keluarga); ?>">
                          <?php echo $i; ?>
                        </a>
                      </li>
                    <?php endfor; ?>
                    <?php if ($page < $total_pages) : ?>
                      <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $page + 1; ?>&search_query=<?php echo urlencode($search_query); ?>&id_kepala_keluarga=<?php echo urlencode($id_kepala_keluarga); ?>" aria-label="Next">
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
        xhr.open('POST', 'proses/jemaat/tambah.php', true);
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
        xhr.open('POST', 'proses/jemaat/edit.php', true);
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

            xhr.open('POST', 'proses/jemaat/hapus.php', true);
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
      xhrTable.open('GET', 'proses/jemaat/load_table.php', true);
      xhrTable.send();
    }

    function formatNumber(input) {
      // Menghilangkan karakter selain digit
      let value = input.value.replace(/\D/g, '');

      // Memformat angka dengan titik setiap tiga digit
      let formattedValue = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

      // Mengupdate nilai input dengan format yang benar
      input.value = formattedValue;
    }

    document.addEventListener('DOMContentLoaded', function() {
      const pendapatanTambah = document.getElementById('pendapatan-tambah');
      const pendapatanEdit = document.getElementById('pendapatan-edit');

      pendapatanTambah.addEventListener('input', function() {
        formatNumber(pendapatanTambah);
      });

      pendapatanEdit.addEventListener('input', function() {
        formatNumber(pendapatanEdit);
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