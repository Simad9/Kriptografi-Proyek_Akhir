<?php
// === FUNCTION TEKS ===
// Fungsi Enkripsi Caesar Cipher
function caesar_cipher_encrypt($text, $shift)
{
  $result = '';
  $shift = $shift % 26;
  for ($i = 0; $i < strlen($text); $i++) {
    $char = $text[$i];
    if (ctype_alpha($char)) {
      $ascii = ord($char);
      $base = ctype_upper($char) ? ord('A') : ord('a');
      $result .= chr(($ascii - $base + $shift) % 26 + $base);
    } else {
      $result .= $char;
    }
  }
  return $result;
}

function enkripsi_text($text, $kunci_aes, $aes_iv, $kunci_caesar)
{
  $enkripsi_caesar = caesar_cipher_encrypt($text, $kunci_caesar); //Paramater ke dua adalah shiftnya
  $enkripsi_aes = openssl_encrypt($enkripsi_caesar, 'aes-256-cbc', $kunci_aes, 0, $aes_iv);
  return $enkripsi_aes;
}

function teks_enkrip()
{
  global $konek;

  // Pengaturan Kunci
  $kunci_caesar = mysqli_real_escape_string($konek, $_POST["kunci-caesar"]);
  $kunci_aes = mysqli_real_escape_string($konek, $_POST["kunci-aes"]);
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

  // Data-data
  $nama = enkripsi_text(mysqli_real_escape_string($konek, $_POST["nama"]), $aes_key, $aes_iv, $kunci_caesar);
  $gender = enkripsi_text(mysqli_real_escape_string($konek, $_POST["gender"]), $aes_key, $aes_iv, $kunci_caesar);
  $tgl_lhr = enkripsi_text(mysqli_real_escape_string($konek, $_POST["tgl_lhr"]), $aes_key, $aes_iv, $kunci_caesar);
  $noHp = enkripsi_text(mysqli_real_escape_string($konek, $_POST["noHp"]), $aes_key, $aes_iv, $kunci_caesar);
  $alamat = enkripsi_text(mysqli_real_escape_string($konek, $_POST["alamat"]), $aes_key, $aes_iv, $kunci_caesar);

  // Validasi file yang diunggah
  if (!isset($_FILES['foto']) || $_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
    echo "<script>alert('Gagal mengunggah gambar!')</script>";
    return;
  }
  // Validasi format gambar
  $imageInfo = getimagesize($_FILES['foto']['tmp_name']);
  $allowedTypes = [
    'image/jpeg',
    'image/png',
    'image/gif',
    'image/jpg',
  ];
  if (!in_array($imageInfo['mime'], $allowedTypes)) {
    echo "<script>alert('Hanya gambar dengan tipe " . implode(', ', $allowedTypes) . " yang didukung!')</script>";
    return;
  }  
  // Memindahkan Foto
  $namaFoto = $_FILES["foto"]["name"];
  $tmp = $_FILES["foto"]["tmp_name"];
  $path = "uploads/image/" . $namaFoto;
  move_uploaded_file($tmp, $path);

  // Masukan Ke DB
  $query = "INSERT INTO data (id_data, nama, gender, tgl_lhr, noHp, alamat, urlFoto) 
  VALUES ('','$nama', '$gender', '$tgl_lhr', '$noHp', '$alamat', '$path')";

  if (mysqli_query($konek, $query)) {
    echo "<script>alert('Berhasil Menambahkan Data')</script>";
  } else {
    echo "<script>alert('Gagal')</script>";
  }
}

// Fungsi Dekripsi Caesar Cipher dengan kunci 5 (menggeser balik)
function dekripsi_text($text, $kunci_aes, $aes_iv, $kunci_caesar)
{
  $cypertext = base64_decode($text); //di decode biar bisa terbaca oleh fungsi php
  $caesar_encrypted_text = openssl_decrypt($cypertext, 'aes-256-cbc', $kunci_aes, OPENSSL_RAW_DATA, $aes_iv);
  if ($caesar_encrypted_text === false) {
    return "Dekrispi Gagal";
  }

  // Dekripsi dengan Caesar Cipher
  $decrypted_text = caesar_cipher_decrypt($caesar_encrypted_text, $kunci_caesar);

  return $decrypted_text;
}

function caesar_cipher_decrypt($text, $kunci_caesar)
{
  $result = "";
  $shift = 26 - ($kunci_caesar % 26); //pake mod 26 biar muter sebenarnya

  foreach (str_split($text) as $char) {
    if (ctype_alpha($char)) {
      $base = ctype_lower($char) ? 'a' : 'A';
      $result .= chr(((ord($char) - ord($base) + $shift) % 26) + ord($base));
    } else {
      $result .= $char; // Non-alphabetic characters remain unchanged
    }
  }

  return $result;
}

function teks_dekrip($cypertext, $id)
{
  global $konek;
  // Pengaturan Kunci
  $kunci_caesar = mysqli_real_escape_string($konek, $_POST["kunci-caesar"]);
  $kunci_aes = mysqli_real_escape_string($konek, $_POST["kunci-aes"]);
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
  $cyper = dekripsi_text($cypertext, $aes_key, $aes_iv, $kunci_caesar);
  return $cyper;
}
