<?php
$konek = new mysqli("localhost", "root", "", "proyek_akhir_kriptografi");

if ($konek->connect_error) {
  die("Connection failed: " . $konek->connect_error);
}

function register()
{
  global $konek;
  $password = $_POST['password'];
  $password = hash('sha256', $password); // Menggunakan SHA-256 untuk hashing password
  $sql = "INSERT INTO user (password) VALUES ('$password')";
  $hasil = $konek->query($sql);
  if ($hasil) {
    echo "<script>alert('Berhasil Registrasi')</script>";
  } else {
    echo "<script>alert('Gagal')</script>";
  }
}

function login()
{
  global $konek;
  $password = $_POST['password'];
  $password_hash = hash('sha256', $password); // Menggunakan SHA-256 untuk hashing password

  $sql = "SELECT * FROM user WHERE password = '$password_hash'";
  $hasil = $konek->query($sql);
  if ($hasil) {
    $data = mysqli_fetch_assoc($hasil);
    if ($data['password'] == $password_hash) {
      echo "<script>alert('Berhasil Login')</script>";
    } else {
      echo "<script>alert('Gagal')</script>";
    }
  } else {
    echo "<script>alert('Gagal')</script>";
  }
}

function teks_enkrip()
{
  echo "Teks Enkrip";
  $text = $_POST["pesan"];
  
}

function teks_dekrip()
{
  echo "Teks Dekrip";
}

function gambar_enkrip() {}

function gambar_dekrip() {}

function file_enkrip() {}

function file_dekrip() {}
