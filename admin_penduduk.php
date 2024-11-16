<?php
session_start();

if (!isset($_SESSION['login']) && $_SESSION['role'] != 'admin') {
  header("Location: login.php?status=belum_login");
  exit;
}

require 'logic/koneksi.php';
require 'logic/tampilan.php';

$sql = "SELECT * FROM data";
$hasil = $konek->query($sql);
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
    <div class="col-10 p-3 bg-putih-secondary pt-5">
      <h3 class="text-center mb-3">Data Penduduk Terdaftar</h3>
      <table class="table table-striped">
        <tr class="text-center">
          <th>No</th>
          <th>Nama</th>
          <th>Gender</th>
          <th>Tanggal Lahir</th>
          <th>No Hp</th>
          <th>Alamat</th>
          <th>Aksi</th>
        </tr>
        <?php
        $i = 1;
        while ($data = $hasil->fetch_assoc()) : ?>
          <tr class="text-center">
            <td><?= $i++ ?></td>
            <td><?= potongString($data['nama'], 10) ?></td>
            <td><?= potongString($data['gender'], 10) ?></td>
            <td><?= potongString($data['tgl_lhr'], 10) ?></td>
            <td><?= potongString($data['noHp'], 10) ?></td>
            <td><?= potongString($data['alamat'], 10) ?></td>
            <td>
              <a href="admin_kartu.php?id=<?= $data['id_data'] ?>"><button type=" button" class="btn btn-ijo-primary text-white"><i class="bi bi-eye"></i></button></a>
              <a href="logic/hapus.php?id=<?= $data['id_data'] ?>&tabel=data"><button type="button" class="btn btn-danger"><i class="bi bi-trash"></i></button></a>
            </td>
          </tr>
        <?php endwhile; ?>
      </table>
    </div>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>