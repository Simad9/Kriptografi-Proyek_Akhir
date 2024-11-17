<?php
session_start();

if (!isset($_SESSION['login']) && $_SESSION['role'] != 'admin') {
  header("Location: login.php?status=belum_login");
  exit;
}

include 'logic/file_func.php';

if (isset($_POST["submit"])) {
  $dekripsi_file =  dekripsi_file();
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

      <h3 class="mt-3">Dekripsi File - Test</h3>
      <p class="mb-3 card-text">Silahkan Masukan file. File akan dienkripsi</p>
      <form class="card" action="" method="post" enctype="multipart/form-data">
        <div class="card-body">
          <div class="mb-3">
            <label for="nama" class="form-label">File : </label>
            <input type="file" class="form-control" id="nama" name="file" required>
            <p class="card-text mt-2">Silahkan masukan Kartu yang telah dibuat</p>
          </div>
          <hr>
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
          <!-- BUTTON -->
          <div class="d-flex gap-3">
            <button type="submit" name="submit" class="btn btn-ijo-primary text-white w-100">Enkripsi</button>
            <button type="reset" class="btn btn-ijo-primary-outline w-100">Reset</button>
          </div>
          <?php if (isset($dekripsi_file)) : ?>
            <div>
              <a href="uploads/file_dekripsi/<?= $dekripsi_file['download'] ?>" download><button type="button" class="btn btn-ijo-primary-outline w-100 mt-3">Download</button></a>
            </div>
          <?php endif ?>
        </div>
      </form>

    </div>
    <!-- END MAIN CONTENT -->
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>