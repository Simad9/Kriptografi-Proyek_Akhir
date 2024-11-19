<?php
session_start();

if (!isset($_SESSION['login']) && $_SESSION['role'] != 'admin') {
  header("Location: login.php?status=belum_login");
  exit;
}
// === FUNCTION LOGIN & REGISTER ===
function register()
{
  global $konek;

  // mengangkap data form
  $username = mysqli_real_escape_string($konek, $_POST["username"]);
  $password = mysqli_real_escape_string($konek, $_POST['password']);
  $rePassword = mysqli_real_escape_string($konek, $_POST['re-password']);

  // cek apakah password sama
  if ($password != $rePassword) {
    echo "<script>alert('Password Tidak Sama')</script>";
    return;
  }

  // enkripsi password, menggunakan sha256
  $password = hash('sha256', $password);

  // menyimpan data
  $sql = "INSERT INTO user VALUES ('','$username','$password', 'pegawai')";
  $hasil = $konek->query($sql);

  // control handler
  if ($hasil) {
    header("Location: login.php?status=success");
  } else {
    header("Location: register.php?status=error");
  }
}

function login()
{
  global $konek;

  // mengangkap data form
  $username = mysqli_real_escape_string($konek, $_POST["username"]);
  $password =  mysqli_real_escape_string($konek, $_POST['password']);

  // enkripsi password, menggunakan sha256
  $password_hash = hash('sha256', $password);

  // cek data di database
  $sql = "SELECT * FROM user WHERE password = '$password_hash' AND username = '$username'";
  $hasil = mysqli_query($konek, $sql);

  // control handler
  if ($hasil) {

    // pemberian session
    $_SESSION["login"] = true;
    $data = mysqli_fetch_assoc($hasil);

    // direct sesuai role
    if ($data["role"] == "admin") {
      $_SESSION["role"] = 'admin';
      header("Location: admin_penduduk.php");
    } else {
      header("Location: foto.php");
    }
  } else {
    header("Location: login.php?status=error");
  }
}
