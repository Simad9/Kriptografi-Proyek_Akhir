<?php
$konek = new mysqli("localhost", "root", "", "projek_akhir_kriptografi");

if ($konek->connect_error) {
  die("Connection failed: " . $konek->connect_error);
}

// === FUNCTION LOGIN & REGISTER ===
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


// === FUNCTION TEKS ===
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
}


// === FUNGSI GAMBAR ===
// Fungsi untuk menyisipkan pesan ke dalam gambar
function embedMessage($imagePath, $message, $outputPath)
{
  // Baca gambar
  $image = imagecreatefrompng($imagePath);
  if (!$image) {
    die("Gagal membaca gambar!");
  }

  $width = imagesx($image);
  $height = imagesy($image);
  $message .= "\0"; // Tambahkan karakter null sebagai terminator

  $messageIndex = 0; // Indeks karakter dalam pesan
  $bitIndex = 0; // Indeks bit dalam satu karakter
  $messageLength = strlen($message);

  for ($y = 0; $y < $height; $y++) {
    for ($x = 0; $x < $width; $x++) {
      $rgb = imagecolorat($image, $x, $y);
      $r = ($rgb >> 16) & 0xFF;
      $g = ($rgb >> 8) & 0xFF;
      $b = $rgb & 0xFF;

      // Sisipkan pesan ke bit terakhir komponen merah
      if ($messageIndex < $messageLength) {
        $char = ord($message[$messageIndex]);
        $bit = ($char >> (7 - $bitIndex)) & 1; // Ambil bit spesifik dari karakter
        $r = ($r & ~1) | $bit; // Ganti bit terakhir pada komponen merah

        $bitIndex++;
        if ($bitIndex === 8) { // Jika sudah selesai 1 karakter
          $bitIndex = 0;
          $messageIndex++;
        }
      }

      // Buat warna baru dengan nilai RGB yang dimodifikasi
      $newColor = imagecolorallocate($image, $r, $g, $b);
      imagesetpixel($image, $x, $y, $newColor);

      // Berhenti jika pesan selesai disisipkan
      if ($messageIndex >= $messageLength) break 2;
    }
  }

  // Simpan gambar baru
  if (!imagepng($image, $outputPath)) {
    die("Gagal menyimpan gambar!");
  }
  imagedestroy($image);
}

// Fungsi untuk membaca pesan dari gambar
function extractMessage($imagePath)
{
  // Baca gambar
  $image = imagecreatefrompng($imagePath);
  if (!$image) {
    die("Gagal membaca gambar!");
  }

  $width = imagesx($image);
  $height = imagesy($image);

  $message = '';
  $char = 0;
  $bitIndex = 0;

  for ($y = 0; $y < $height; $y++) {
    for ($x = 0; $x < $width; $x++) {
      $rgb = imagecolorat($image, $x, $y);
      $r = ($rgb >> 16) & 0xFF;

      // Ambil bit terakhir dari komponen merah
      $bit = $r & 1;
      $char = ($char << 1) | $bit;
      $bitIndex++;

      // Jika sudah membaca 8 bit, bentuk 1 karakter
      if ($bitIndex === 8) {
        if ($char === 0) { // Null terminator ditemukan
          imagedestroy($image);
          return $message;
        }

        $message .= chr($char);
        $char = 0;
        $bitIndex = 0;
      }
    }
  }

  imagedestroy($image);
  return $message;
}

// Fungsi untuk enkripsi gambar
function gambar_enkrip()
{
  // Validasi file yang diunggah
  if (!isset($_FILES['gambar']) || $_FILES['gambar']['error'] !== UPLOAD_ERR_OK) {
    die("Gagal mengunggah gambar!");
  }

  // Validasi format gambar
  $imageInfo = getimagesize($_FILES['gambar']['tmp_name']);
  if ($imageInfo['mime'] !== 'image/png') {
    die("Hanya gambar PNG yang didukung!");
  }

  $message = $_POST['pesan'];
  $uploadDir = __DIR__ . '/uploads/';
  $outputDir = __DIR__ . '/output/';
  if (!is_dir($uploadDir)) mkdir($uploadDir);
  if (!is_dir($outputDir)) mkdir($outputDir);

  // Simpan file yang diunggah
  $imagePath = $uploadDir . basename($_FILES['gambar']['name']);
  if (!move_uploaded_file($_FILES['gambar']['tmp_name'], $imagePath)) {
    die("Gagal menyimpan gambar!");
  }

  // Nama file output
  $outputPath = $outputDir . 'output_' . basename($_FILES['gambar']['name']);

  // Sisipkan pesan
  embedMessage($imagePath, $message, $outputPath);

  echo "Pesan berhasil disisipkan ke dalam gambar!<br>";
  echo "Gambar output: <a href='output/" . basename($outputPath) . "'>Download</a>";
}

// Fungsi untuk dekripsi gambar
function gambar_dekrip()
{
  // Validasi file yang diunggah
  if (!isset($_FILES['gambar']) || $_FILES['gambar']['error'] !== UPLOAD_ERR_OK) {
    die("Gagal mengunggah gambar!");
  }

  // Validasi format gambar
  $imageInfo = getimagesize($_FILES['gambar']['tmp_name']);
  if ($imageInfo['mime'] !== 'image/png') {
    die("Hanya gambar PNG yang didukung!");
  }

  // Baca pesan dari gambar
  $imagePath = $_FILES['gambar']['tmp_name'];
  $message = extractMessage($imagePath);

  echo "Pesan tersembunyi: <br>";
  echo "<pre>" . htmlspecialchars($message) . "</pre>";
}



// === FUNGSI FILE ===
// Fungsi untuk menginisialisasi kunci enkripsi
function getKey(): string
{
  return 'mysecretkey123456'; // Panjang kunci harus 16, 24, atau 32 byte
}

function encryptFile(string $sourceFile, string $targetFolder): string
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

function decryptFile(string $encryptedFile, string $targetFolder): string
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

function file_kripto()
{
  $action = $_POST['action'];
  $file = $_FILES['file'];

  // Periksa apakah file diunggah
  if ($file['error'] !== UPLOAD_ERR_OK) {
    echo "<p>Error: File gagal diunggah.</p>";
    exit;
  }

  // Simpan file di folder sementara
  $uploadDir = 'uploads/';
  if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
  }
  $filePath = $uploadDir . basename($file['name']);
  move_uploaded_file($file['tmp_name'], $filePath);

  // Proses enkripsi atau dekripsi
  if ($action === 'encrypt') {
    $encryptedFolder = 'encrypted/';
    if (!is_dir($encryptedFolder)) {
      mkdir($encryptedFolder, 0777, true);
    }
    $result = encryptFile($filePath, $encryptedFolder);
    echo "<p>File terenkripsi disimpan di: <a href='$result'>$result</a></p>";
  } elseif ($action === 'decrypt') {
    $decryptedFolder = 'decrypted/';
    if (!is_dir($decryptedFolder)) {
      mkdir($decryptedFolder, 0777, true);
    }
    $result = decryptFile($filePath, $decryptedFolder);
    echo "<p>File didekripsi disimpan di: <a href='$result'>$result</a></p>";
  }

  // Hapus file asli setelah diproses
  unlink($filePath);
}
