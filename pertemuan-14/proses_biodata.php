<?php
session_start();
require __DIR__ . '/koneksi.php';
require_once __DIR__ . '/fungsi.php';

#cek method form, hanya izinkan POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  $_SESSION['flash_error_biodata'] = 'Akses tidak valid.';
  redirect_ke('index.php#biodata');
}

$nim         = bersihkan($_POST['txtNim'] ?? '');
$nama_lengkap        = bersihkan($_POST['txtNmLengkap'] ?? '');
$tempat_lahir      = bersihkan($_POST['txtT4Lhr'] ?? '');
$tanggal_lahir    = bersihkan($_POST['txtTglLhr'] ?? '');
$hobi        = bersihkan($_POST['txtHobi'] ?? '');
$pasangan    = bersihkan($_POST['txtPasangan'] ?? '');
$pekerjaan   = bersihkan($_POST['txtKerja'] ?? '');
$ortu        = bersihkan($_POST['txtNmOrtu'] ?? '');
$kakak       = bersihkan($_POST['txtNmKakak'] ?? '');
$adik        = bersihkan($_POST['txtNmAdik'] ?? '');

$errors = [];

if ($nim === '') {
    $errors[] = 'nim wajib diisi.';
}

if ($nama_lengkap === '') {
    $errors[] = "Nama wajib diisi";
}

if ($tempat_lahir === '') {
    $errors[] = "Tempat lahir wajib diisi";
}

if ($tanggal_lahir === '') {
    $errors[] = "Tanggal lahir wajib diisi";
}

if ($hobi === '') {
    $errors[] = "Hobi wajib diisi";
}

if (mb_strlen($nim) < 8) {
    $errors[] = 'Nim minimal 8 karakter.';
}

if (mb_strlen($nama_lengkap) < 3) {
    $errors[] = 'Nama minimal 3 karakter.';
}

if (!empty($errors)) {
  $_SESSION['old'] = [
    'nim' => $nim,
    'nama_lengkap'  => $nama_lengkap,
    'tempat' => $tempat_lahir,
    'tanggal' => $tanggal_lahir,
    'hobi' => $hobi
  ];

  $_SESSION['flash_error_biodata'] = implode('<br>', $errors);
  redirect_ke('index.php#biodata');
}

$sql = "INSERT INTO tbl_biodata 
(nim, nama_lengkap, tempat_lahir, tanggal_lahir, hobi, pasangan, pekerjaan, nama_orang_tua, nama_kakak, nama_adik)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
  #jika gagal prepare, kirim pesan error ke pengguna (tanpa detail sensitif)
  $_SESSION['flash_error'] = 'Terjadi kesalahan sistem (prepare gagal).';
  redirect_ke('index.php#biodata');
}

mysqli_stmt_bind_param(
    $stmt,
    "ssssssssss",
    $nim,
    $nama_lengkap,
    $tempat_lahir,
    $tanggal_lahir,
    $hobi,
    $pasangan,
    $pekerjaan,
    $ortu,
    $kakak,
    $adik
);

if (mysqli_stmt_execute($stmt)) {
    $_SESSION['flash_sukses_biodata'] = "Biodata berhasil disimpan";
    redirect_ke('index.php#biodata');
} else {
    $_SESSION['flash_error_biodata'] = "Gagal menyimpan biodata";
    redirect_ke('index.php#biodata');
}
header("location: index.php#about");