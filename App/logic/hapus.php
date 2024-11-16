<?php
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
