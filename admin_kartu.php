<?php
session_start();

if (!isset($_SESSION['login']) && $_SESSION['role'] != 'admin') {
  header("Location: login.php?status=belum_login");
  exit;
}

include 'logic/koneksi.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "SELECT * FROM data WHERE id_data = $id";
  $hasil = $konek->query($sql);
  $data = $hasil->fetch_assoc();
} else {
  header("Location: admin_penduduk.php");
}

include 'logic/text_func.php';
if (isset($_POST['submit'])) {
  $dekripsi_data = array(
    "nama" => teks_dekrip($data["nama"], $id),
    "gender" => teks_dekrip($data["gender"], $id),
    "tgl_lhr" => teks_dekrip($data["tgl_lhr"], $id),
    "alamat" => teks_dekrip($data["alamat"], $id),
    "noHp" => teks_dekrip($data["noHp"], $id),
  );
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Manggil component head -->
  <?php include 'component/head.php'; ?>
  <title>Dukcapil Supernova</title>
</head>

<body class="container-fluid  bg-putih-secondary">

  <div class="row">
    <!-- Menampilkan data ke tampilannya -->
    <!-- MAIN CONTENT -->
    <div class="p-3">
      <h3 class="text-center mb-3">Kartu Penduduk</h3>
      <div class="d-flex gap-3 justify-content-center">
        <!-- Form Kunci -->

        <form class=" border rounded border-dark p-3 bg-putih-primary" action="" method="post">
          <h5 class="text-center">Kunci</h5>
          <hr>
          <div class="mb-3">
            <label for="kunci-caesar" class="form-label">Kunci Tradisonal (Caesar Cipher)</label>
            <input type="number" class="form-control w-100" id="kunci-caesar" name="kunci-caesar" placeholder="Masukan Kunci (Angka)" required>
          </div>
          <div class="mb-3">
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
          <div class="d-grid">
            <button type="submit" name="submit" class="btn btn-ijo-primary text-white">Submit</button>
          </div>
        </form>

        <!-- Tampilan Kartu -->
        <?php
        if (!isset($dekripsi_data)) : ?>
          <div class=" border rounded border-dark p-3 bg-putih-primary ">
            <h5 class="text-center">Penduduk Supernova</h5>
            <hr>
            <div class="d-flex gap-5 justify-content-center align-items-center">
              <div class="w-100 gap-1">
                <p class="mb-1">Nama : <?= $data['nama'] ?></p>
                <p class="mb-1">Gender : <?= $data['gender'] ?></p>
                <p class="mb-1">Tanggal Lahir : <?= $data['tgl_lhr'] ?></p>
                <p class="mb-1">Alamat : <?= $data['nama'] ?></p>
                <p class="mb-1">No Hp : <?= $data['noHp'] ?></p>
              </div>
              <div class="me-5">
                <img src="img/img-card.png" alt="logo-dummy" class="rounded" style="width: 200px;;">
              </div>
            </div>
          </div>
        <?php else : ?>
          <div class=" border rounded border-dark p-3 bg-putih-primary ">
            <h5 class="text-center">Penduduk Supernova</h5>
            <hr>
            <div class="d-flex gap-5 justify-content-center align-items-center">
              <div class="w-100 gap-1">
                <p class="mb-1">Nama : <?= $dekripsi_data['nama'] ?></p>
                <p class="mb-1">Gender : <?= $dekripsi_data['gender'] ?></p>
                <p class="mb-1">Tanggal Lahir : <?= $dekripsi_data['tgl_lhr'] ?></p>
                <p class="mb-1">Alamat : <?= $dekripsi_data['alamat'] ?></p>
                <p class="mb-1">No Hp : <?= $dekripsi_data['noHp'] ?></p>
              </div>
              <div class="me-5">
                <img src="<?= $data['urlFoto'] ?>" alt="logo-dummy" class="w-100 rounded">
              </div>
            </div>
          </div>
        <?php endif ?>



      </div>

    </div>

    <div class="d-flex gap-3 justify-content-center">
      <a href="admin_penduduk.php"><button class="btn btn-ijo-primary text-white">Kembali Ke Dashboard</button></a>
    </div>
    <!-- END MAIN CONTENT -->
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>