<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Test</title>
</head>

<body>
  <?php include "pengantar.php" ?>

  <!-- Login -->
  <h1>Login</h1>
  <p>Dibuat type text biar keliatan</p>
  <form action="" method="post">
    <label for="password">password :</label>
    <input type="text" name="password" id="password">
  </form>
  <hr>
  <!-- TEXT -->
  <p>text (metode = )</p>
  <form action="" method="post">
    <label for="Pesan">Pesan :</label>
    <input type="text" name="Pesan" id="Pesan" name="pesan">
  </form>
  <hr>
  <!-- GAMBAR -->
  <p>Gambar steganografi</p>
  <form action="" method="post" enctype="multipart/form-data">
    <label for="Gambar">Gambar :</label>
    <input type="file" name="Gambar" id="Gambar">
  </form>
  <!-- FILE -->
  <p>File</p>
  <form action="" method="post" enctype="multipart/form-data">
    <label for="File">File :</label>
    <input type="file" name="File" id="File">
  </form>
  <hr>


</body>

</html>