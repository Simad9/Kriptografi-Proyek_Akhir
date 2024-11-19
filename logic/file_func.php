<?php
// === FUNGSI FILE ===
// Fungsi enkripsi file
function enkripsi_file()
{
  // Pengaturan kunci dan IV
  $kunci_aes = $_POST["kunci-aes"];
  switch ($kunci_aes) {
    case "A":
      $aes_key = "thisisaverysecurekey1234567890"; // Panjang 32 karakter (256-bit)
      $aes_iv = "1234567890123456"; // Panjang 16 karakter (128-bit)
      break;
    case "B":
      $aes_key = "anothersecurekeyexample9876543210"; // Panjang 32 karakter (256-bit)
      $aes_iv = "6543210987654321"; // Panjang 16 karakter (128-bit)
      break;
    case "C":
      $aes_key = "yetanothersecurekeyforaes1234567"; // Panjang 32 karakter (256-bit)
      $aes_iv = "abcdef1234567890"; // Panjang 16 karakter (128-bit)
      break;
    default:
      return "Invalid AES Key";
  }
  // Periksa apakah file diunggah
  if ($_FILES['file']['error'] !== UPLOAD_ERR_OK) {
    echo "<script>alert('Error: File gagal diunggah.')</script>";
    return;
  }
  // Cek format file
  $allowedTypes = [
    'application/pdf',
    'image/jpeg',
    'image/png',
    'image/gif',
    'image/jpg',
  ];
  if (!in_array($_FILES['file']['type'], $allowedTypes)) {
    echo "<script>alert('Hanya file PDF dan gambar yang didukung!')</script>";
    return;
  }
  // Simpan file di folder sementara
  $uploadDir = dirname(__DIR__) . '/uploads/upload/';
  $filePath = $uploadDir . basename($_FILES['file']['name']);
  if (!move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
    echo "<script>alert('Error: Gagal memindahkan file.')</script>";
    return;
  }
  // Membaca file
  $data = file_get_contents($filePath);
  if ($data === false) {
    echo "<script>alert('Error: Tidak dapat membaca file')</script>";
    return;
  }
  // Enkripsi file
  $encryptedData = openssl_encrypt($data, 'aes-256-cbc', $aes_key, OPENSSL_RAW_DATA, $aes_iv);
  if ($encryptedData === false) {
    echo "<script>alert('Error: Enkripsi gagal')</script>";
    return;
  }
  // Folder untuk menyimpan file terenkripsi
  $encryptedFolder = dirname(__DIR__) . '/uploads/file_enkripsi/';
  if (!is_dir($encryptedFolder) && !mkdir($encryptedFolder, 0777, true)) {
    echo "<script>alert('Error: Gagal membuat folder')</script>";
    return;
  }
  // Nama file terenkripsi
  $encryptedFileName = "enkrip_" . basename($filePath);
  $encryptedFilePath = $encryptedFolder . $encryptedFileName;
  // Simpan IV dan data terenkripsi
  if (file_put_contents($encryptedFilePath, $aes_iv . $encryptedData) === false) {
    echo "<script>alert('Error: Gagal menyimpan file terenkripsi')</script>";
    return;
  }
  // mengembalikan nama buat nanti didownload
  return array('download' => $encryptedFileName);
}

// Fungsi dekripsi file
function dekripsi_file()
{
  // Pengaturan kunci dan IV
  $kunci_aes = $_POST["kunci-aes"];
  switch ($kunci_aes) {
    case "A":
      $aes_key = "thisisaverysecurekey1234567890"; // Panjang 32 karakter (256-bit)
      $aes_iv = "1234567890123456"; // Panjang 16 karakter (128-bit)
      break;
    case "B":
      $aes_key = "anothersecurekeyexample9876543210"; // Panjang 32 karakter (256-bit)
      $aes_iv = "6543210987654321"; // Panjang 16 karakter (128-bit)
      break;
    case "C":
      $aes_key = "yetanothersecurekeyforaes1234567"; // Panjang 32 karakter (256-bit)
      $aes_iv = "abcdef1234567890"; // Panjang 16 karakter (128-bit)
      break;
    default:
      return "Invalid AES Key";
  }
  // Periksa apakah file diunggah
  if ($_FILES['file']['error'] !== UPLOAD_ERR_OK) {
    return "Error: File gagal diunggah.";
  }
  // Cek format file
  $allowedTypes = [
    'application/pdf',
    'image/jpeg',
    'image/png',
    'image/gif',
    'image/jpg',
  ];
  if (!in_array($_FILES['file']['type'], $allowedTypes)) {
    echo "<script>alert('Hanya file PDF dan gambar yang didukung!')</script>";
    return;
  }
  // Simpan file di folder sementara
  $uploadDir = dirname(__DIR__) . '/uploads/upload/';
  $filePath = $uploadDir . basename($_FILES['file']['name']);
  if (!move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
    echo "<script>alert('Error: Gagal memindahkan file.')</script>";
    return;
  }
  // Membaca file
  $data = file_get_contents($filePath);
  if ($data === false) {
    echo "<script>alert('Error: Tidak dapat membaca file')</script>";
    return;
  }
  // Pengaturan kunci aes_iv
  $aes_iv = substr($data, 0, 16); // Ekstrak IV (16 byte pertama)
  $encryptedData = substr($data, 16); // Sisanya adalah data terenkripsi
  // Dekripsi file
  $decryptedData = openssl_decrypt($encryptedData, 'aes-256-cbc', $aes_key, OPENSSL_RAW_DATA, $aes_iv);
  if ($decryptedData === false) {
    echo "<script>alert('Error: Dekripsi gagal.')</script>";
    return;
  }
  // Folder untuk menyimpan file dekripsi
  $decryptedFolder = dirname(__DIR__) . '/uploads/file_dekripsi/';
  if (!is_dir($decryptedFolder) && !mkdir($decryptedFolder, 0777, true)) {
    echo "<script>alert('Error: Gagal membuat folder.')</script>";
    return;
  }
  // Nama file dekripsi
  $decryptedFileName = "dekrip_" . basename($filePath);
  $decryptedFilePath = $decryptedFolder . $decryptedFileName;
  // Simpan data hasil dekripsi
  if (file_put_contents($decryptedFilePath, $decryptedData) === false) {
    echo "<script>alert('Error: Gagal menyimpan file dekripsi.')</script>";
    return;
  }
  // mengembalikan nama buat nanti didownload
  return array('download' => $decryptedFileName);
}
