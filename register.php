<?php
session_start();
session_destroy();
include 'logic/koneksi.php';
include 'logic/auth.php';

if (isset($_POST['submit'])) {
  register();
}

switch (isset($_GET['status'])) {
  case 'error':
    echo "<script>alert('ada yang salah')</script>";
    break;
  default:
    break;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Manggil component head -->
  <?php include 'component/head.php'; ?>
  <title>Dukcapil Library | Login</title>
</head>

<body>
  <div class="container-fluid">
    <div class="row">
      <!-- MAIN CONTENT -->
      <div class="col-md-6">
        <div class="d-flex justify-content-center align-items-center h-100">
          <div class="w-100 p-5">

            <!-- ISI NOTIFIKASI  -->

            <div class="col-10 p-3 w-100">
              <h3 class="text-center mb-4">Register</h3>
              <form action="" method="post">
                <div class="mb-3">
                  <label for="username" class="form-label">Username</label>
                  <input type="text" class="form-control" id="username" name="username" placeholder="Input Username">
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Input Password">
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Re-Password</label>
                  <input type="password" class="form-control" id="password" name="re-password" placeholder="Input Re-Password">
                </div>
                <div class="d-grid">
                  <button type="submit" name="submit" class="btn btn-login">Register</button>
                </div>
                <p class="mt-3 ">Sudah Punya Akun? <a href="login.php">Login</a></p>
              </form>

            </div>
          </div>

        </div>

      </div>

      <div class="col-md-6 bg-abu-abu shadow">
        <img src="img/img-login.jpg" alt="logo-dummy" class="w-100">
      </div>
    </div>


</body>

</html>