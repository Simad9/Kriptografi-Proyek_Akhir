<?php
session_start();
if (!isset($_SESSION['login'])) {
  header("Location: login.php?status=belum_login");
  exit;
}

include 'logic/koneksi.php';
include 'logic/text_func.php';

if (isset($_POST["submit"])) {
  teks_enkrip();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Manggil component head -->
  <?php include 'component/head.php'; ?>
  <title>Dukcapil Supernova</title>
</head>

<body class="container-fluid">

  <div class="row">
    <!-- Manggil component navbar -->
    <!-- NAVBAR KIRI -->
    <?php require 'component/navbar.php'; ?>
    <!-- END NAVBAR -->

    <!-- MAIN CONTENT -->
    <div class="col-10 p-3 bg-putih-secondary">

      <!-- ISI NOTIFIKASI -->

      <h3 class=" mt-3">Tambah Data</h3>
      <p class="mb-3 card-text">Silahkan Masukan data. Data yang krusial akan di enkripsi</p>
      <form class="card" action="" method="post" enctype="multipart/form-data">
        <div class="card-body">
          <div class="d-flex gap-3">

            <!-- Bagian Data -->
            <div class="col-8 ">
              <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan Nama">
              </div>
              <div class="row">
                <div class="mb-3 col-3">
                  <label class="form-label">Gender</label>
                  <div class="d-flex gap-3">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" id="man" value="Pria" name="gender" checked>
                      <label for="man" class="form-label">Pria</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" id="women" value="Wanita" name="gender">
                      <label for="women" class="form-label">Wanita</label>
                    </div>
                  </div>
                </div>
                <div class="mb-3 col-4">
                  <label for="tglLahir" class="form-label">Tanggal Lahir</label>
                  <input type="date" class="form-control" id="tglLahir" name="tgl_lhr">
                </div>
                <div class="mb-3 col-5">
                  <label for="noHp" class="form-label">Nomor Handphone</label>
                  <input type="text" class="form-control" id="noHp" name="noHp" placeholder="Masukan Nomor Handphone">
                </div>
              </div>
              <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" rows="3" id="alamat" name="alamat" placeholder="Masukan Alamat"></textarea>
              </div>
            </div>

            <!-- Bagian Foto -->
            <div class="col-4 d-flex flex-column pe-3">
              <div class="mb-3">
                <label for="foto" class="form-label">Foto</label>
                <input type="file" class="form-control" name="foto" placeholder="Input payment nominal" id="foto" accept="image/*">
              </div>
              <div class="mb-3 d-flex justify-content-center">
                <img src="img/img-card.png" class="w-50" id="preview" alt="Preview Foto">
              </div>
            </div>

          </div>
          <hr>
          <div class="row">
            <!-- Bagian Kunci -->
            <div class="mb-3 col-6">
              <label for="kunci-caesar" class="form-label">Kunci Tradisonal (Caesar Cipher)</label>
              <input type="number" class="form-control" id="kunci-caesar" name="kunci-caesar" placeholder="Masukan Kunci (Angka)" required>
            </div>
            <div class="mb-3 col-6">
              <label for="nama" class="form-label">Kunci Modern (AES)</label>
              <div class="d-flex gap-3">
                <div class="form-check">
                  <input class="form-check-input" type="radio" id="A" value="A" name="kunci-aes" checked>
                  <label for="A" class="form-label">Kunci Tipe A</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" id="B" value="B" name="kunci-aes">
                  <label for="B" class="form-label">Kunci Tipe B</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" id="C" value="C" name="kunci-aes">
                  <label for="C" class="form-label">Kunci Tipe C</label>
                </div>
              </div>
            </div>
            
          </div>


          <!-- BUTTON -->
          <div class="d-flex gap-3">
            <button type="submit" name="submit" class="btn btn-ijo-primary text-white w-100">Submit</button>
            <button type="reset" class="btn btn-ijo-primary-outline w-100">Reset</button>
          </div>
        </div>
      </form>

    </div>
    <!-- END MAIN CONTENT -->
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script>
    document.getElementById('foto').addEventListener('change', function(event) {
      const file = event.target.files[0]; // Ambil file yang diunggah
      if (file) {
        const reader = new FileReader(); // Membuat FileReader untuk membaca file
        reader.onload = function(e) {
          const preview = document.getElementById('preview');
          preview.src = e.target.result; // Mengubah atribut src elemen img
        };
        reader.readAsDataURL(file); // Membaca file sebagai URL data
      }
    });
  </script>
</body>

</html>