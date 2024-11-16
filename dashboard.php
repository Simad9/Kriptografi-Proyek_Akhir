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
    <div class="col-10 p-3 bg-putih-secondary pt-5">
      <h3 class="text-center mb-3">Dashboard Page</h3>
      <table class="table table-striped">
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>Type</th>
          <th class="w-20">Join Date</th>
          <th class="w-20">End Date</th>
          <th class="w-15">Action</th>
        </tr>
        <tr>
          <td>1</td>
          <td>Nama</td>
          <td>Type</td>
          <td>Join Date</td>
          <td>Ex Date</td>
          <td>
            <a href="kartu.php?id=?"><button type=" button" class="btn btn-ijo-primary text-white"><i class="bi bi-eye"></i></button></a>
            <a href="hapus.php?id=?"><button type="button" class="btn btn-danger"><i class="bi bi-trash"></i></button></a>
            <a href="kartu/Wijdan Foto.png" download><button type="button" class="btn btn-ijo-primary text-white"><i class="bi bi-download"></i></button></a>
          </td>
        </tr>
      </table>
    </div>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>