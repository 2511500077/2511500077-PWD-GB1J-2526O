<?php
  session_start();
  require 'koneksi.php';
  require 'fungsi.php';

  /*
    Ambil nilai cid dari GET dan lakukan validasi untuk 
    mengecek cid harus angka dan lebih besar dari 0 (> 0).
    'options' => ['min_range' => 1] artinya cid harus ≥ 1 
    (bukan 0, bahkan bukan negatif, bukan huruf, bukan HTML).
  */
  $cid = filter_input(INPUT_GET, 'cid', FILTER_VALIDATE_INT, [
    'options' => ['min_range' => 1]
  ]);
  /*
    Skrip di atas cara penulisan lamanya adalah:
    $cid = $_GET['cid'] ?? '';
    $cid = (int)$cid;

    Cara lama seperti di atas akan mengambil data mentah 
    kemudian validasi dilakukan secara terpisah, sehingga 
    rawan lupa validasi. Untuk input dari GET atau POST, 
    filter_input() lebih disarankan daripada $_GET atau $_POST.
  */

  /*
    Cek apakah $cid bernilai valid:
    Kalau $cid tidak valid, maka jangan lanjutkan proses, 
    kembalikan pengguna ke halaman awal (read.php) sembari 
    mengirim penanda error.
  */
  if (!$cid) {
    $_SESSION['flash_error'] = 'Akses tidak valid.';
    redirect_ke('read_biodata_pengunjung.php');
  }

  /*
    Ambil data lama dari DB menggunakan prepared statement, 
    jika ada kesalahan, tampilkan penanda error.
  */
  $stmt = mysqli_prepare($conn, "SELECT Kode_Pengunjung, Nama_Pengunjung, Alamat_Rumah, Tanggal_Kunjungan, Hobi, Asal_SLTA, Pekerjaan, Nama_ortu, Nama_Pacar, Nama_Mantan
                                    FROM tbl_biodata WHERE cid = ? LIMIT 1");
  if (!$stmt) {
    $_SESSION['flash_error'] = 'Query tidak benar.';
    redirect_ke('read_biodata_pengunjung.php');
  }

  mysqli_stmt_bind_param($stmt, "i", $cid);
  mysqli_stmt_execute($stmt);
  $res = mysqli_stmt_get_result($stmt);
  $row = mysqli_fetch_assoc($res);
  mysqli_stmt_close($stmt);

  if (!$row) {
    $_SESSION['flash_error'] = 'Record tidak ditemukan.';
    redirect_ke('read_biodata_pengunjung.php');
  }

  #Nilai awal (prefill form)
  $kode_Pengunjung   = $row['Kode_Pengunjung'] ?? '';
$nama_Pengunjung   = $row['Nama_Pengunjung'] ?? '';
$alamat_Rumah      = $row['Alamat_Rumah'] ?? '';
$tanggal_Kunjungan = $row['Tanggal_Kunjungan'] ?? '';
$hobi              = $row['Hobi'] ?? '';
$asal_SLTA         = $row['Asal_SLTA'] ?? '';
$pekerjaan         = $row['Pekerjaan'] ?? '';
$nama_ortu         = $row['Nama_ortu'] ?? '';
$nama_Pacar        = $row['Nama_Pacar'] ?? '';
$nama_Mantan       = $row['Nama_Mantan'] ?? '';


  #Ambil error dan nilai old input kalau ada
  $flash_error = $_SESSION['flash_error'] ?? '';
  $old = $_SESSION['old'] ?? [];
  unset($_SESSION['flash_error'], $_SESSION['old']);
  if (!empty($old)) {
    $kode_Pengunjung   = $old['Kode_Pengunjung']   ?? $kode_Pengunjung;
$nama_Pengunjung   = $old['Nama_Pengunjung']   ?? $nama_Pengunjung;
$alamat_Rumah      = $old['Alamat_Rumah']      ?? $alamat_Rumah;
$tanggal_Kunjungan = $old['Tanggal_Kunjungan'] ?? $tanggal_Kunjungan;
$hobi              = $old['Hobi']              ?? $hobi;
$asal_SLTA         = $old['Asal_SLTA']         ?? $asal_SLTA;
$pekerjaan         = $old['Pekerjaan']         ?? $pekerjaan;
$nama_ortu         = $old['Nama_ortu']         ?? $nama_ortu;
$nama_Pacar        = $old['Nama_Pacar']        ?? $nama_Pacar;
$nama_Mantan       = $old['Nama_Mantan']       ?? $nama_Mantan;

  }
?>

<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Judul Halaman</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <header>
      <h1>Ini Header</h1>
      <button class="menu-toggle" id="menuToggle" aria-label="Toggle Navigation">
        &#9776;
      </button>
      <nav>
        <ul>
          <li><a href="#home">Beranda</a></li>
          <li><a href="#about">Tentang</a></li>
          <li><a href="#contact">Kontak</a></li>
        </ul>
      </nav>
    </header>

    <main>
      <section id="biodata">
  <h2>Biodata Pengunjung</h2>

  <?php if (!empty($flash_sukses_biodata)): ?>
    <div style="padding:10px; margin-bottom:10px; background:#d4edda; color:#155724; border-radius:6px;">
      <?= $flash_sukses_biodata; ?>
    </div>
  <?php endif; ?>

  <?php if (!empty($flash_error_biodata)): ?>
    <div style="padding:10px; margin-bottom:10px; background:#f8d7da; color:#721c24; border-radius:6px;">
      <?= $flash_error_biodata; ?>
    </div>
  <?php endif; ?>

  <form action="proses_biodata_pengunjung.php" method="POST">

    <label for="txtKodePen"><span>Kode Pengunjung:</span>
      <input type="text" id="txtKodePen" name="txtKodePen"
        placeholder="Masukkan Kode Pengunjung" required>
    </label>

    <label for="txtNmPengunjung"><span>Nama Pengunjung:</span>
      <input type="text" id="txtNmPengunjung" name="txtNmPengunjung"
        placeholder="Masukkan Nama Pengunjung" required>
    </label>

    <label for="txtAlRmh"><span>Alamat Rumah:</span>
      <input type="text" id="txtAlRmh" name="txtAlRmh"
        placeholder="Masukkan Alamat Rumah" required>
    </label>

    <label for="txtTglKunjungan"><span>Tanggal Kunjungan:</span>
      <input type="text" id="txtTglKunjungan" name="txtTglKunjungan"
        placeholder="Masukkan Tanggal Kunjungan" required>
    </label>

    <label for="txtHobi"><span>Hobi:</span>
      <input type="text" id="txtHobi" name="txtHobi"
        placeholder="Masukkan Hobi" required>
    </label>

    <label for="txtAsalSMA"><span>Asal SLTA:</span>
      <input type="text" id="txtAsalSMA" name="txtAsalSMA"
        placeholder="Masukkan Asal SLTA" required>
    </label>

    <label for="txtKerja"><span>Pekerjaan:</span>
      <input type="text" id="txtKerja" name="txtKerja"
        placeholder="Masukkan Pekerjaan" required>
    </label>

    <label for="txtNmOrtu"><span>Nama Orang Tua:</span>
      <input type="text" id="txtNmOrtu" name="txtNmOrtu"
        placeholder="Masukkan Nama Orang Tua" required>
    </label>

    <label for="txtNmPacar"><span>Nama Pacar:</span>
      <input type="text" id="txtNmPacar" name="txtNmPacar"
        placeholder="Masukkan Nama Pacar" required>
    </label>

    <label for="txtNmMantan"><span>Nama Mantan:</span>
      <input type="text" id="txtNmMantan" name="txtNmMantan"
        placeholder="Masukkan Nama Mantan" required>
    </label>

    <button type="submit">Kirim</button>
    <button type="reset">Batal</button>

  </form>
</section>  


    <script src="script.js"></script>
  </body>
</html>