<?php
session_start();

if (!isset($_SESSION['login']) && $_SESSION['role'] != 'admin') {
  header("Location: login.php?status=belum_login");
  exit;
}
$localhost = "localhost";
$username = "root";
$password = "";
$database = "projek_akhir_kriptografi";
$konek = new mysqli($localhost, $username, $password, $database);

if ($konek->connect_error) {
  die("Connection failed: " . $konek->connect_error);
}
