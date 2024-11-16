<?php
// === FUNCTION LOGIN & REGISTER ===
function register()
{
  global $konek;
  $username = $_POST["username"];
  $password = $_POST['password'];
  $rePassword = $_POST['re-password'];

  if ($password != $rePassword) {
    echo "<script>alert('Password Tidak Sama')</script>";
    return;
  }

  $password = hash('sha256', $password); // Menggunakan SHA-256 untuk hashing password
  $sql = "INSERT INTO user VALUES ('','$username','$password', 'pegawai')";
  $hasil = $konek->query($sql);
  if ($hasil) {
    echo "<script>alert('Berhasil Registrasi')</script>";
    header("Location: login.php");
  } else {
    header("Location: register.php?status=error");
  }
}

function login()
{
  global $konek;
  $username = $_POST["username"];
  $password = $_POST['password'];
  $password_hash = hash('sha256', $password); // Menggunakan SHA-256 untuk hashing password

  echo $password_hash;
  $sql = "SELECT * FROM user WHERE password = '$password_hash' AND username = '$username'";
  $hasil = mysqli_query($konek, $sql);

  if ($hasil) {
    $_SESSION["user"] = $username;
    $_SESSION["login"] = true;

    $data = mysqli_fetch_assoc($hasil);
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
