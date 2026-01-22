<?php
  session_start();
  require __DIR__ . '/koneksi.php';
  require_once __DIR__ . '/fungsi.php';

  #cek method form, hanya izinkan POST
  if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['flash_error'] = 'Akses tidak valid.';
    redirect_ke('read_biodata_pengunjung.php');
  }

  #validasi cid wajib angka dan > 0
  $cid = filter_input(INPUT_POST, 'cid', FILTER_VALIDATE_INT, [
    'options' => ['min_range' => 1]
  ]);

  if (!$cid) {
    $_SESSION['flash_error'] = 'CID Tidak Valid.';
    redirect_ke('edit_biodata_pengunjung.php?cid='. (int)$cid);
  }

  #ambil dan bersihkan (sanitasi) nilai dari form
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
  

  #Validasi sederhana
  $errors = []; #ini array untuk menampung semua error yang ada

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

  /*
  kondisi di bawah ini hanya dikerjakan jika ada error, 
  simpan nilai lama dan pesan error, lalu redirect (konsep PRG)
  */
  if (!empty($errors)) {
    $_SESSION['old'] = [
        'Kode_Pengunjung' => $kode_Pengunjung,
        'Nama_Pengunjung'  => $nama_Pengunjung,,
    ];

    $_SESSION['flash_error'] = implode('<br>', $errors);
    redirect_ke('edit_biodata_pengunjung.php?cid='. (int)$cid);
  }

  /*
    Prepared statement untuk anti SQL injection.
    menyiapkan query UPDATE dengan prepared statement 
    (WAJIB WHERE cid = ?)
  */
 $stmt = mysqli_prepare($conn, "UPDATE tbl_biodata_pengunjung 
                                SET Kode_Pengunjung = ?, Nama_Pengunjung = ?, Alamat_Rumah = ?, Tanggal_Kunjungan = ?, Hobi = ?, Asal_SLTA = ?, Pekerjaan = ?, Nama_ortu = ?, Nama_Pacar = ?, Nama_Mantan = ?
                                WHERE cid = ?");
  if (!$stmt) {
    #jika gagal prepare, kirim pesan error (tanpa detail sensitif)
    $_SESSION['flash_error'] = 'Terjadi kesalahan sistem (prepare gagal).';
    redirect_ke('edit_biodata_pengunjung.php?cid='. (int)$cid);
  }

  #bind parameter dan eksekusi (s = string, i = integer)
  mysqli_stmt_bind_param(
    $stmt,
    "sssssssssss",
    $kode_Pengunjung, 
    $nama_Pengunjung,
    $alamat_Rumah,
    $tanggal_Kunjungan,
    $hobi,
    $asal_SLTA,
    $pekerjaan,
    $nama_ortu,
    $nama_Pacar,
    $nama_Mantan,
    $cid
);

  if (mysqli_stmt_execute($stmt)) { #jika berhasil, kosongkan old value
    unset($_SESSION['old']);
    /*
      Redirect balik ke read.php dan tampilkan info sukses.
    */
    $_SESSION['flash_sukses'] = 'Terima kasih, data Anda sudah diperbarui.';
    redirect_ke('read_biodata.php'); #pola PRG: kembali ke data dan exit()
  } else { #jika gagal, simpan kembali old value dan tampilkan error umum
    $_SESSION['old'] = [
    'Kode_Pengunjung' => $kode_Pengunjung,
    'Nama_Pengunjung'  => $nama_Pengunjung,
    ];
    $_SESSION['flash_error'] = 'Data gagal diperbaharui. Silakan coba lagi.';
    redirect_ke('edit_biodata_pengunjung.php?cid='. (int)$cid);
  }
  #tutup statement
  mysqli_stmt_close($stmt);

  