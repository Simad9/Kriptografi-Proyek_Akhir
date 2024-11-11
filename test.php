<?php
include 'function.php';
if (isset($_POST['register'])) {
  register();
} else if (isset($_POST['login'])) {
  login();
} else if (isset($_POST['enkrip_teks'])) {
  teks_enkrip();
} else if (isset($_POST['dekrip_teks'])) {
  teks_dekrip();
} else if (isset($_POST['enkrip_gambar'])) {
  gambar_enkrip();
} else if (isset($_POST['dekrip_gambar'])) {
  gambar_dekrip();
} else if (isset($_POST['enkrip_file'])) {
  file_enkrip();
} else if (isset($_POST['dekrip_file'])) {
  file_dekrip();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Test</title>
</head>

<body>
  <!-- <?php include "component/pengantar.php" ?> -->
  <!-- Login -->
  <h1>Login</h1>
  <p>Dibuat type text biar keliatan</p>
  <form action="" method="post">
    <label for="password">password :</label>
    <input type="text" name="password" id="password">
    <input type="submit" name="login" value="Submit">
  </form>
  <h1>Register</h1>
  <p>Dibuat type text biar keliatan</p>
  <form action="" method="post">
    <label for="password">password :</label>
    <input type="text" name="password" id="password">
    <input type="submit" name="register" value="Submit">
  </form>
  <hr>

  <!-- TEXT -->
  <h1>Kirim Text</h1>
  <p>text (metode = ) Enkrip</p>
  <form action="" method="post">
    <label for="Pesan">Pesan :</label>
    <input type="text" name="Pesan" id="Pesan" name="pesan">
    <input type="submit" name="enkrip_teks" value="Submit">
  </form>
  <p>text (metode = ) Dekrip</p>
  <form action="" method="post">
    <label for="Pesan">Pesan :</label>
    <input type="text" name="Pesan" id="Pesan" name="pesan">
    <input type="submit" name="dekrip_teks" value="Submit">
  </form>
  <hr>

  <!-- GAMBAR -->
  <h1>Gambar steganografi</h1>
  <form action="" method="post" enctype="multipart/form-data">
    <label for="Gambar">Gambar :</label>
    <input type="file" name="Gambar" id="Gambar">
    <br>
    <label for="pesean">pesean disisipkan :</label>
    <input type="text" name="pesan" id="pesean">
    <input type="submit" name="enkrip_gambar" value="Submit">
  </form>
  <form action="" method="post" enctype="multipart/form-data">
    <br><br>
    <label for="Gambar">Gambar Yang ada pesan :</label>
    <input type="file" name="Gambar" id="Gambar">
    <input type="submit" name="dekrip_gambar" value="Submit">
    <p>Pesannya adalah : </p>
  </form>
  <hr>

  <!-- FILE -->
  <h1>File</h1>
  <p>Enkrip</p>
  <form action="" method="post" enctype="multipart/form-data">
    <label for="File">File :</label>
    <input type="file" name="File" id="File">
  </form>
  <p>Dekrip</p>
  <form action="" method="post" enctype="multipart/form-data">
    <label for="File">File :</label>
    <input type="file" name="File" id="File">
  </form>
  <hr>

</body>

</html>