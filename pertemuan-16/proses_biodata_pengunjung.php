<?php
session_start();
require __DIR__ . '/koneksi.php';
require_once __DIR__ . '/fungsi.php';

#cek method form, hanya izinkan POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  $_SESSION['flash_error_biodata'] = 'Akses tidak valid.';
  redirect_ke('index.php#biodata');
}

$kode_Pengunjung        = bersihkan($_POST['txtKodePen'] ?? '');
$nama_Pengunjung        = bersihkan($_POST['txtNmPengunjung'] ?? '');
$alamat_Rumah           = bersihkan($_POST['txtAlRmh'] ?? '');
$tanggal_Kunjungan      = bersihkan($_POST['txtTglKunjungan'] ?? '');
$hobi                   = bersihkan($_POST['txtHobi'] ?? '');
$asal_SLTA              = bersihkan($_POST['txtAsalSMA'] ?? '');
$pekerjaan              = bersihkan($_POST['txtKerja'] ?? '');
$nama_ortu              = bersihkan($_POST['txtNmOrtu'] ?? '');
$nama_Pacar             = bersihkan($_POST['txtNmPacar'] ?? '');
$nama_Mantan            = bersihkan($_POST['txtNmMantan'] ?? '');

$errors = [];

if ($kode_Pengunjung === '') {
    $errors[] = 'Kode Pengunjung wajib diisi.';
}

if ($nama_Pengunjung === '') {
    $errors[] = "Nama wajib diisi";
}

if ($alamat_Rumah === '') {
    $errors[] = "Alamat Rumah wajib diisi";
}

if ($tanggal_Kunjungan === '') {
    $errors[] = "Tanggal Kunjungan wajib diisi";
}

if ($hobi === '') {
    $errors[] = "Hobi wajib diisi";
}

if ($asal_SLTA === '') {
    $errors[] = "Asal SLTA wajib diisi";
}

if (mb_strlen($kode_Pengunjung) < 8) {
    $errors[] = 'Kode minimal 8 karakter.';
}

if (mb_strlen($nama_Pengunjung) < 3) {
    $errors[] = 'Nama minimal 3 karakter.';
}





if (!empty($errors)) {
  $_SESSION['old'] = [
    'Kode_Pengunjung' => $kode_Pengunjung,
    'Nama_Pengunjung'  => $nama_Pengunjung,
    
  ];

  $_SESSION['flash_error_biodata'] = implode('<br>', $errors);
  redirect_ke('index.php#biodata');
}

$sql = "INSERT INTO tbl_biodata_pengunjung 
(Kode_Pengunjung, Nama_Pengunjung, Alamat_Rumah, Tanggal_Kunjungan, Hobi, Asal_SLTA, Pekerjaan, Nama_ortu, Nama_Pacar, Nama_Mantan)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
  #jika gagal prepare, kirim pesan error ke pengguna (tanpa detail sensitif)
  $_SESSION['flash_error_biodata'] = 'Terjadi kesalahan sistem (prepare gagal).';
  redirect_ke('index.php#biodata');
}

mysqli_stmt_bind_param(
    $stmt,
    "ssssssssss",
    $kode_Pengunjung, 
    $nama_Pengunjung,
    $alamat_Rumah,
    $tanggal_Kunjungan,
    $hobi,
    $asal_SLTA,
    $pekerjaan,
    $nama_ortu,
    $nama_Pacar,
    $nama_Mantan
);

if (mysqli_stmt_execute($stmt)) {
    $_SESSION['flash_sukses_biodata'] = "Biodata berhasil disimpan";
    redirect_ke('index.php#biodata');
} else {
    $_SESSION['flash_error_biodata'] = "Gagal menyimpan biodata";
    redirect_ke('index.php#biodata');
}
header("location: index.php#about");