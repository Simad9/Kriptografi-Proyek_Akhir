<?php
// === FUNGSI FILE ===
// Fungsi untuk menginisialisasi kunci enkripsi
function getKey()
{
  return 'mysecretkey123456'; // Panjang kunci harus 16, 24, atau 32 byte
}

function encryptFile($sourceFile,  $targetFolder)
{
  $key = getKey();
  $data = file_get_contents($sourceFile);
  if ($data === false) {
    return "Error: Tidak dapat membaca file.";
  }
  $iv = random_bytes(openssl_cipher_iv_length('aes-256-cbc'));
  $encryptedData = openssl_encrypt($data, 'aes-256-cbc', $key, 0, $iv);
  if ($encryptedData === false) {
    return "Error: Enkripsi gagal.";
  }
  $encryptedFileName = basename($sourceFile);
  $encryptedFilePath = $targetFolder . '/' . $encryptedFileName;
  file_put_contents($encryptedFilePath, $iv . $encryptedData);
  return $encryptedFilePath;
}

function decryptFile($encryptedFile, $targetFolder)
{
  $key = getKey();
  $data = file_get_contents($encryptedFile);
  if ($data === false) {
    return "Error: Tidak dapat membaca file.";
  }
  $ivLength = openssl_cipher_iv_length('aes-256-cbc');
  $iv = substr($data, 0, $ivLength);
  $encryptedData = substr($data, $ivLength);
  $decryptedData = openssl_decrypt($encryptedData, 'aes-256-cbc', $key, 0, $iv);
  if ($decryptedData === false) {
    return "Error: Dekripsi gagal.";
  }
  $decryptedFileName = str_replace('.enc', '', basename($encryptedFile));
  $decryptedFilePath = $targetFolder . '/' . $decryptedFileName;
  file_put_contents($decryptedFilePath, $decryptedData);
  return $decryptedFilePath;
}

function enkripsi_file()
{
  // Periksa apakah file diunggah
  if ($_FILES['file']['error'] !== UPLOAD_ERR_OK) {
    return "Error: File gagal diunggah.";
  }

  // Simpan file di folder sementara
  $uploadDir = dirname(__DIR__) . '/uploads/upload/';
  $filePath = $uploadDir . basename($_FILES['file']['name']);
  if (!move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
    return "Error: Gagal memindahkan file.";
  }

  // Membaca file
  $data = file_get_contents($filePath);
  if ($data === false) {
    return "Error: Tidak dapat membaca file.";
  }

  // Pengaturan kunci dan IV
  $aes_key = "thisisaverysecurekey1234567890"; // Panjang 32 karakter
  $aes_iv = openssl_random_pseudo_bytes(16); // Panjang 16 karakter

  // Enkripsi file
  $encryptedData = openssl_encrypt($data, 'aes-256-cbc', $aes_key, OPENSSL_RAW_DATA, $aes_iv);
  if ($encryptedData === false) {
    return "Error: Enkripsi gagal.";
  }

  // Folder untuk menyimpan file terenkripsi
  $encryptedFolder = dirname(__DIR__) . '/uploads/file_enkripsi/';
  if (!is_dir($encryptedFolder) && !mkdir($encryptedFolder, 0777, true)) {
    return "Error: Gagal membuat folder.";
  }

  // Nama file terenkripsi
  $encryptedFileName = "enkrip_" . basename($filePath);
  $encryptedFilePath = $encryptedFolder . $encryptedFileName;

  // Simpan IV dan data terenkripsi
  if (file_put_contents($encryptedFilePath, $aes_iv . $encryptedData) === false) {
    return "Error: Gagal menyimpan file terenkripsi.";
  }

  return array('download' => $encryptedFileName);
}

function dekripsi_file()
{
  // Periksa apakah file diunggah
  if ($_FILES['file']['error'] !== UPLOAD_ERR_OK) {
    return "Error: File gagal diunggah.";
  }

  // Simpan file di folder sementara
  $uploadDir = dirname(__DIR__) . '/uploads/upload/';
  $filePath = $uploadDir . basename($_FILES['file']['name']);
  if (!move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
    return "Error: Gagal memindahkan file.";
  }

  // Membaca file
  $data = file_get_contents($filePath);
  if ($data === false) {
    return "Error: Tidak dapat membaca file.";
  }

  // Pengaturan kunci
  $aes_key = "thisisaverysecurekey1234567890"; // Panjang 32 karakter
  $aes_iv = substr($data, 0, 16); // Ekstrak IV (16 byte pertama)
  $encryptedData = substr($data, 16); // Sisanya adalah data terenkripsi

  // Dekripsi file
  $decryptedData = openssl_decrypt($encryptedData, 'aes-256-cbc', $aes_key, OPENSSL_RAW_DATA, $aes_iv);
  if ($decryptedData === false) {
    return "Error: Dekripsi gagal.";
  }

  // Folder untuk menyimpan file dekripsi
  $decryptedFolder = dirname(__DIR__) . '/uploads/file_dekripsi/';
  if (!is_dir($decryptedFolder) && !mkdir($decryptedFolder, 0777, true)) {
    return "Error: Gagal membuat folder.";
  }

  // Nama file dekripsi
  $decryptedFileName = "dekrip_" . basename($filePath);
  $decryptedFilePath = $decryptedFolder . $decryptedFileName;

  // Simpan data hasil dekripsi
  if (file_put_contents($decryptedFilePath, $decryptedData) === false) {
    return "Error: Gagal menyimpan file dekripsi.";
  }

  return array('download' => $decryptedFileName);
}
