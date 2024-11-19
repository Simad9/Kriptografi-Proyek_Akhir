<?php
session_start();

if (!isset($_SESSION['login']) && $_SESSION['role'] != 'admin') {
  header("Location: login.php?status=belum_login");
  exit;
}

function potongString($teks, $batas)
{
  // Potong string jika panjangnya lebih dari $length
  if (strlen($teks) > $batas) {
    $result = substr($teks, 0, $batas) . "...";
  } else {
    $result = $teks; // Jika string kurang dari atau sama dengan $length, tampilkan apa adanya
  }

  echo $result;
}
