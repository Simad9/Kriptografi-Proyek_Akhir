<?php
$konek = new mysqli("localhost", "root", "", "proyek_akhir_kriptografi");

if ($konek->connect_error) {
  die("Connection failed: " . $konek->connect_error);
}

// FUNCTION LOGIN & REGISTER
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


// FUNCTION TEKS
function enkripsi_text($text, $kunci_aes, $aes_iv)
{
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
  $enkripsi_caesar = caesar_cipher_encrypt($text, 5); //Paramater ke dua adalah shiftnya
  $enkripsi_aes = openssl_encrypt($enkripsi_caesar, 'aes-256-cbc', $kunci_aes, 0, $aes_iv);
  return $enkripsi_aes;
}

function teks_enkrip()
{
  echo "Teks Enkrip";
  global $konek;
  $text = $_POST["pesan"];

  // ENKRIP - KUNCI KUNCI INI NANTI DI SEMBUNYIKAN
  $aes_key = "thisisaverysecurekey1234567890"; // Panjang 32 karakter (256-bit)
  $aes_iv = "1234567890123456"; // Panjang 16 karakter (128-bit)
  $text = enkripsi_text($text, $aes_key, $aes_iv);

  $query = "INSERT INTO text (pesan) VALUES ('$text')";
  if (mysqli_query($konek, $query)) {
    echo "<script>alert('Berhasil Enkrip Teks = $text')</script>";
  } else {
    echo "<script>alert('Gagal')</script>";
  }
}

function dekripsi_text($text, $kunci_aes, $aes_iv)
{
  // Fungsi Dekripsi Caesar Cipher dengan kunci 5 (menggeser balik)
  function caesar_cipher_decrypt($text, $shift)
  {
    $result = '';
    $shift = $shift % 26;
    for ($i = 0; $i < strlen($text); $i++) {
      $char = $text[$i];
      if (ctype_alpha($char)) { // Hanya menggeser karakter alfabet
        $ascii = ord($char);
        $base = ctype_upper($char) ? ord('A') : ord('a'); // Memisahkan huruf besar dan kecil
        // Menggeser balik dengan -shift
        $result .= chr(($ascii - $base - $shift + 26) % 26 + $base);
      } else {
        $result .= $char; // Karakter non-alfabet tetap sama
      }
    }
    return $result;
  }

  // Dekripsi dengan AES
  $caesar_encrypted_text = openssl_decrypt($text, 'aes-256-cbc', $kunci_aes, 0, $aes_iv);

  // Dekripsi dengan Caesar Cipher (menggunakan kunci 5)
  $decrypted_text = caesar_cipher_decrypt($caesar_encrypted_text, 5);

  return $decrypted_text;
}

function teks_dekrip()
{
  echo "Teks Dekrip";
  // global $konek;
  $cypertext = $_POST["pesan"];

  $aes_key = "thisisaverysecurekey1234567890"; // Panjang 32 karakter (256-bit)
  $aes_iv = "1234567890123456"; // Panjang 16 karakter (128-bit)
  $cyper = dekripsi_text($cypertext, $aes_key, $aes_iv);


  echo "<script>alert('Berhasil Dekrip Teks = $cyper')</script>";
  // if () {
  // } else {
  //   echo "<script>alert('Gagal')</script>";
  // }
}


// FUNGSI GAMBAR
function gambar_enkrip() {}

function gambar_dekrip() {}


// FUNGSI FILE
function file_enkrip() {}

function file_dekrip() {}
