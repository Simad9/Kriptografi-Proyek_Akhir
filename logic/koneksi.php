<?php
$konek = new mysqli("localhost", "root", "", "projek_akhir_kriptografi");

if ($konek->connect_error) {
  die("Connection failed: " . $konek->connect_error);
}
