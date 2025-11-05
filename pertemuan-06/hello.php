<?php
//latihan tipe data
$nama = "Afdal";
$umur = 18;
$tinggi = 1.69;
$aktif = true;
$hobi = ["Coding", "bermain game", "mendengarkan musik"];
$mahasiswa = (object)[
    "nim" => "2511500077",
    "nama" => "Afdal",
    "prodi" => "Teknik Informatika"
];
$nilai_akhir = NULL;
echo "<h2>Demo Tipe Data PHP</h2>";

echo "<pre>";
echo "String:\n";
var_dump($nama);

echo "\nInteger:\n";
var_dump($umur);

echo "\nFloat:\n";
var_dump($tinggi);

echo "\nBoolean:\n";
var_dump($aktif);

echo "\nArray:\n";
var_dump($hobi);

echo "\nObject:\n";
var_dump($mahasiswa);

echo "\nNull:\n";
var_dump($nilai_akhir);
echo "<hr>";
echo "</pre>";

//latihan konstanta
define("KAMPUS", "ISB Atma Luhur");
const ANGKATAN = 2025;

echo "Kampus : " . KAMPUS . "<br>";
echo "Angkatan : " . ANGKATAN . "<br><br>";

define("DOSEN_PENGAMPU", "Yohanes Setiawan Japriadi, M.Kom.");
define("MATAKULIAH", "Pemrograman Web");

echo "Dosen : " . DOSEN_PENGAMPU . "<br>";
echo "MATAKULIAH : " . MATAKULIAH . "<br><br>";

//latihan operator dasar
$a = 100;
$b = "100";
$c = 0;
$d = false;


echo "<h3>
Perbandingan 
== adalah PHP akan membandingkan nilai, tapi tidak peduli tipe datanya.<br>  dan 
=== adalah HP akan membandingkan nilai dan tipe data sekaligus.<br>
</h3>";
echo "<pre>";
echo "\$a == \$b : "; var_dump($a == $b) ;
echo "\$a === \$b : "; var_dump($a === $b);
echo "\$c == \$d : "; var_dump($c == $d);
echo "\$c === \$d : "; var_dump($c === $d);

//latihan struktur control percabangan
$hari = "Jumat";
switch ($hari) {
    case "Senin" : echo "Awal Minggu<br><br>"; break;
    case "Jumat" : echo "Hampir Weekend!<br><br>"; break;
    default: echo "Hari Biasa.<br><br>";
}

//Latihan struktur kontrol perulangan dan array:
$hobi = ["coding", "bermain game", "mendengarkan musik", "traveling", "membaca"];

echo "<h3>Daftar Hobi Saya</h3>";
for ($i = 0; $i < count($hobi); $i++) {
    echo ($i + 1) . "." . $hobi[$i] . "<br>";
}

echo "<hr>";
echo "<h4>Hasil print_r():</h4>";
echo "<pre>";
print_r($hobi);
echo "</pre>";

echo "<h4>Hasil var_dump():</h4>";
echo "<pre>";
var_dump($hobi);
echo "</pre>";