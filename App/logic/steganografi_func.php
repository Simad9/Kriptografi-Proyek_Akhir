<?php
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
  $uploadDir = dirname(__DIR__) . '/uploads/upload/';
  $outputDir = dirname(__DIR__) . '/uploads/steganografi/';

  // Simpan file yang diunggah
  $imagePath = $uploadDir . basename($_FILES['gambar']['name']);
  if (!move_uploaded_file($_FILES['gambar']['tmp_name'], $imagePath)) {
    die("Gagal menyimpan gambar!");
  }

  // Nama file output
  $namaStegano = "stegano_" . basename($_FILES['gambar']['name']);
  $outputPath = $outputDir . $namaStegano;

  // Sisipkan pesan
  embedMessage($imagePath, $message, $outputPath);

  // echo "Pesan berhasil disisipkan ke dalam gambar!<br>";
  // echo "Gambar output: <a href='" . basename($outputPath) . "'>Download</a>";
  $stegano = array(
    'namaStegano' => $namaStegano,
  );

  return array('namaStegano' => $namaStegano);
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

  return $message;
}
