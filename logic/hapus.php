<?php
session_start();

if (!isset($_SESSION['login']) && $_SESSION['role'] != 'admin') {
  header("Location: login.php?status=belum_login");
  exit;
}

require 'koneksi.php';
$id = $_GET["id"];
if ($_GET["tabel"] == "user") {
  $sql = "DELETE FROM user WHERE id_user = $id";
  $konek->query($sql);
  header("Location: ../admin_user.php");
} else {
  $sql = "DELETE FROM data WHERE id_data = $id";
  $konek->query($sql);
  header("Location: ../admin_penduduk.php");
}
