<?php
  session_start();
  require __DIR__ . '/koneksi.php';
  require_once __DIR__ . '/fungsi.php';

  #cek method form, hanya izinkan POST
  if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['flash_error'] = 'Akses tidak valid.';
    redirect_ke('read_biodata.php');
  }

  #validasi cid wajib angka dan > 0
  $cid = filter_input(INPUT_POST, 'cid', FILTER_VALIDATE_INT, [
    'options' => ['min_range' => 1]
  ]);

  if (!$cid) {
    $_SESSION['flash_error'] = 'CID Tidak Valid.';
    redirect_ke('edit_biodata.php?cid='. (int)$cid);
  }

  #ambil dan bersihkan (sanitasi) nilai dari form
  $nim  = bersihkan($_POST['txtNimEd']  ?? '');
  $nama_lengkap  = bersihkan($_POST['txtNamaEd']  ?? '');
  $tempat_lahir = bersihkan($_POST['txtT4LhrEd'] ?? '');
  $tanggal_lahir = bersihkan($_POST['txtTglLhrEd'] ?? '');
  $hobi = bersihkan($_POST['txtHobiEd'] ?? '');
  $pasangan = bersihkan($_POST['txtPasanganEd'] ?? '');
  $pekerjaan = bersihkan($_POST['txtKerjaEd'] ?? '');
  $ortu = bersihkan($_POST['txtNmOrtuEd'] ?? '');
  $kakak = bersihkan($_POST['txtNmKakakEd'] ?? '');
  $adik = bersihkan($_POST['txtNmAdikEd'] ?? '');
  

  #Validasi sederhana
  $errors = []; #ini array untuk menampung semua error yang ada

  if ($nim === '') {
    $errors[] = 'Nim wajib diisi.';
  }

  if (mb_strlen($nim) < 8) {
    $errors[] = 'Nim minimal 8 karakter.';
  }

  if (mb_strlen($nama_lengkap) < 3) {
    $errors[] = 'Nama minimal 3 karakter.';
  }

  if ($nama_lengkap === '') {
    $errors[] = 'Nama wajib diisi.';
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

  /*
  kondisi di bawah ini hanya dikerjakan jika ada error, 
  simpan nilai lama dan pesan error, lalu redirect (konsep PRG)
  */
  if (!empty($errors)) {
    $_SESSION['old'] = [
        'nim' => $nim,
        'nama_lengkap'  => $nama_lengkap,
        'tempat' => $tempat_lahir,
        'tanggal' => $tanggal_lahir,
        'hobi' => $hobi,
    ];

    $_SESSION['flash_error'] = implode('<br>', $errors);
    redirect_ke('edit_biodata.php?cid='. (int)$cid);
  }

  /*
    Prepared statement untuk anti SQL injection.
    menyiapkan query UPDATE dengan prepared statement 
    (WAJIB WHERE cid = ?)
  */
 $stmt = mysqli_prepare($conn, "UPDATE tbl_biodata 
                                SET nim = ?, nama_lengkap = ?, tempat_lahir = ?, tanggal_lahir = ?, hobi = ?, pasangan = ?, pekerjaan = ?, nama_orang_tua = ?, nama_kakak = ?, nama_adik = ?
                                WHERE cid = ?");
  if (!$stmt) {
    #jika gagal prepare, kirim pesan error (tanpa detail sensitif)
    $_SESSION['flash_error'] = 'Terjadi kesalahan sistem (prepare gagal).';
    redirect_ke('edit_biodata.php?cid='. (int)$cid);
  }

  #bind parameter dan eksekusi (s = string, i = integer)
  mysqli_stmt_bind_param(
    $stmt,
    "sssssssssss",
    $nim,
    $nama_lengkap,
    $tempat_lahir,
    $tanggal_lahir,
    $hobi,
    $pasangan,
    $pekerjaan,
    $ortu,
    $kakak,
    $adik,
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
    'nim' => $nim,
    'nama_lengkap'  => $nama_lengkap,
    'tempat' => $tempat_lahir,
    'tanggal' => $tanggal_lahir,
    'hobi' => $hobi,
    ];
    $_SESSION['flash_error'] = 'Data gagal diperbaharui. Silakan coba lagi.';
    redirect_ke('edit_biodata.php?cid='. (int)$cid);
  }
  #tutup statement
  mysqli_stmt_close($stmt);

  