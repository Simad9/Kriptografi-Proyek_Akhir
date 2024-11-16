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
} else if (isset($_POST['file_submit'])) {
  file_kripto();
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
    <input type="text" name="password" id="password" required>
    <input type="submit" name="login" value="Submit">
  </form>
  <h1>Register</h1>
  <p>Dibuat type text biar keliatan</p>
  <form action="" method="post">
    <label for="password">password :</label>
    <input type="text" name="password" id="password" required>
    <input type="submit" name="register" value="Submit">
  </form>
  <hr>

  <!-- TEXT -->
  <h1>Kirim Text</h1>
  <p>text (metode = ) Enkrip</p>
  <form action="" method="post">
    <label for="Pesan">Pesan :</label>
    <input type="text" name="pesan" id="Pesan" name="pesan" required>
    <input type="submit" name="enkrip_teks" value="Submit">
  </form>
  <p>text (metode = ) Dekrip</p>
  <form action="" method="post">
    <label for="Pesan">Pesan :</label>
    <input type="text" name="pesan" id="Pesan" name="pesan" required>
    <input type="submit" name="dekrip_teks" value="Submit">
  </form>
  <hr>

  <!-- GAMBAR -->
  <h1>Gambar steganografi</h1>
  <form action="" method="post" enctype="multipart/form-data">
    <label for="Gambar">Gambar :</label>
    <input type="file" name="gambar" id="Gambar" accept="image/png" required>
    <br>
    <label for="pesean">pesean disisipkan :</label>
    <input type="text" name="pesan" id="pesean" required>
    <input type="submit" name="enkrip_gambar" value="Submit">
  </form>
  <form action="" method="post" enctype="multipart/form-data">
    <br><br>
    <label for="Gambar">Gambar Yang ada pesan :</label>
    <input type="file" name="gambar" id="Gambar" required>
    <input type="submit" name="dekrip_gambar" value="Submit">
    <p>Pesannya adalah : </p>
  </form>
  <hr>

  <!-- FILE -->
  <h1>File</h1>
  <!-- Form Upload -->
  <form action="index.php" method="POST" enctype="multipart/form-data">
    <label for="file">Pilih file:</label>
    <input type="file" name="file" id="file" required>
    <br><br>
    <label for="action">Pilih tindakan:</label>
    <select name="action" id="action" required>
      <option value="encrypt">Enkripsi</option>
      <option value="decrypt">Dekripsi</option>
    </select>
    <br><br>
    <button type="submit" name="file_submit">Proses</button>
  </form>
  <hr>

</body>

</html>