<?php
$localhost = "localhost";
$username = "root";
$password = "";
$database = "projek_akhir_kriptografi";

$konek = new mysqli($localhost, $username, $password, $database);

if ($konek->connect_error) {
  die("Connection failed: " . $konek->connect_error);
}
