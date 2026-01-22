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
  $stmt = mysqli_prepare($conn, "SELECT nim, nama_lengkap, tempat_lahir, tanggal_lahir, hobi, pasangan, pekerjaan, nama_orang_tua, nama_kakak, nama_adik
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
      <section id="contact">
        <h2>Edit biodata mahasiswa</h2>
        <?php if (!empty($flash_error)): ?>
          <div style="padding:10px; margin-bottom:10px; 
            background:#f8d7da; color:#721c24; border-radius:6px;">
            <?= $flash_error; ?>
          </div>
        <?php endif; ?>
        <form action="update_biodata.php" method="POST">

          <input type="hidden" name="cid" value="<?= (int)$cid; ?>">

          <label for="txtNim"><span>Nim:</span>
            <input type="text" id="txtNim" name="txtNimEd" 
              readonly
              value="<?= !empty($nim) ? $nim : '' ?>">
          </label>

          <label for="txtNama"><span>Nama Lengkap:</span>
            <input type="text" id="txtNama" name="txtNamaEd" 
              placeholder="Masukkan nama" required autocomplete="name"
              value="<?= !empty($nama_lengkap) ? $nama_lengkap : '' ?>">
          </label>

          <label for="txtT4Lhr"><span>Tempat Lahir:</span>
            <input type="text" id="txtT4Lhr" name="txtT4LhrEd" 
              placeholder="Masukkan Tempat Lahir" required
              value="<?= !empty($tempat_lahir) ? $tempat_lahir : '' ?>">
          </label>

          <label for="txtTglLhr"><span>Tanggal Lahir:</span>
            <input type="text" id="txtTglLhr" name="txtTglLhrEd" 
              placeholder="Masukkan Tanggal Lahir" required
              value="<?= !empty($tanggal_lahir) ? $tanggal_lahir : '' ?>">
          </label>

          <label for="txtHobi"><span>Hobi:</span>
            <input type="text" id="txtHobi" name="txtHobiEd" 
              placeholder="Masukkan Hobi" required
              value="<?= !empty($hobi) ? $hobi : '' ?>">
          </label>

          <label for="txtPasangan"><span>Pasangan:</span>
            <input type="text" id="txtPasangan" name="txtPasanganEd" 
              placeholder="Masukkan Pasangan" required
              value="<?= !empty($pasangan) ? $pasangan : '' ?>">
          </label>

          <label for="txtKerja"><span>Pekerjaan:</span>
            <input type="text" id="txtKerja" name="txtKerjaEd" 
              placeholder="Masukkan Pekerjaan" required
              value="<?= !empty($pekerjaan) ? $pekerjaan : '' ?>">
          </label>

          <label for="txtNmOrtu"><span>Nama Orang Tua:</span>
            <input type="text" id="txtNmOrtu" name="txtNmOrtuEd" 
              placeholder="Masukkan Nama Orang Tua" required
              value="<?= !empty($nama_orang_tua) ? $nama_orang_tua : '' ?>">
          </label>

          <label for="txtNmKakak"><span>Nama Kakak:</span>
            <input type="text" id="txtNmKakak" name="txtNmKakakEd" 
              placeholder="Masukkan Nama kakak" required
              value="<?= !empty($nama_kakak) ? $nama_kakak : '' ?>">
          </label>

          <label for="txtNmAdik"><span>Nama Adik:</span>
            <input type="text" id="txtNmAdik" name="txtNmAdikEd" 
              placeholder="Masukkan Nama Adik" required
              value="<?= !empty($nama_adik) ? $nama_adik : '' ?>">
          </label>

          <label for="txtCaptcha"><span>Captcha 2 x 3 = ?</span>
            <input type="number" id="txtCaptcha" name="txtCaptcha" 
              placeholder="Jawab Pertanyaan..." required>
          </label>

          <button type="submit">Kirim</button>
          <button type="reset">Batal</button>
          <a href="read_biodata_pengunjung.php" class="reset">Kembali</a>
        </form>
      </section>
    </main>

    <script src="script.js"></script>
  </body>
</html>