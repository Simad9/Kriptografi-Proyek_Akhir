<?php
session_start();

if (!isset($_SESSION['login']) && $_SESSION['role'] != 'admin') {
  header("Location: login.php?status=belum_login");
  exit;
}

include 'logic/steganografi_func.php';

if (isset($_POST["submit"])) {
  $pesan = gambar_dekrip();
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
    <?php require 'component/navbar_admin.php'; ?>
    <!-- END NAVBAR -->

    <!-- MAIN CONTENT -->
    <div class="col-10 p-3 bg-putih-secondary">

      <!-- ISI NOTIFIKASI -->

      <h3 class="mt-3">Foto Steganografi</h3>
      <p class="mb-3 card-text">Silahkan Masukan gambar dan pesan. Gambar akan di beri pesan, dengan metode Steganografi</p>
      <form class="card" action="" method="post" enctype="multipart/form-data">
        <div class="card-body">
          <div class="d-flex gap-3 pe-3">
            <?php if (!isset($pesan)) : ?>
              <!-- Tempat Foto -->
              <div class="col-6 d-flex flex-column">
                <div class="mb-3">
                  <label for="foto" class="form-label">Foto</label>
                  <input type="file" class="form-control" name="gambar" accept="image/*" id="foto" required>
                </div>
                <div class="mb-3 d-flex justify-content-center">
                  <img src="img/img-card.png" class="w-25" id="preview" alt="Preview Foto">
                </div>
              </div>
              <!-- Tempat Pesan -->
              <div class="col-6 ">
                <div class="mb-3">
                  <label for="pesan" class="form-label">Pesan</label>
                  <textarea class="form-control" rows="7" id="pesan" class-="pe-3" name="pesan" disabled placeholder="Masukan Foto Steganografi"></textarea>
                </div>
              </div>
            <?php else : ?>
              <!-- Tempat Pesan -->
              <div class="col-12 ">
                <div class="mb-3">
                  <label for="pesan" class="form-label">Pesan</label>
                  <textarea class="form-control" rows="7" id="pesan" class-="pe-3" name="pesan" disabled><?= $pesan ?></textarea>
                </div>
              </div>
            <?php endif ?>

            <!-- BUTTON -->
          </div>
          <div class="d-flex gap-3">
            <button type="submit" name="submit" class="btn btn-ijo-primary text-white w-100">Steganografi</button>
            <button type="reset" class="btn btn-ijo-primary-outline w-100" id="reset" onclick="clearForm()">Reset</button>
          </div>
        </div>
      </form>

    </div>
    <!-- END MAIN CONTENT -->
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script>
    // Event untuk pratinjau gambar saat file diunggah
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

    // Fungsi untuk membersihkan form
    function clearForm() {
      window.location.href = window.location.pathname;
    }
  </script>
</body>

</html>