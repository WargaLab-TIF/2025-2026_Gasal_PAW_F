<?php
$buah = ["Apel", "Jeruk", "Mangga"];
array_push($buah, "Pisang", "Melon");

echo "Nomor 3.6.1 : <br>";
echo "<b>Hasil array setelah array_push():</b><br>";
print_r($buah);
echo "<br><Br>";

$angka1 = [1, 2, 3];
$angka2 = [4, 5, 6];
$gabungan = array_merge($angka1, $angka2);

echo "Nomor 3.6.2 : <br>";
echo "<b>Hasil array setelah array_merge():</b><br>";
print_r($gabungan);
echo "<br><br>";


$mahasiswa = ["nim" => "220401", "nama" => "Siti", "jurusan" => "Informatika"];
$nilai = array_values($mahasiswa);

echo "Nomor 3.6.3 : <br>";
echo "<b>Hasil array setelah array_values():</b><br>";
print_r($nilai);
echo "<br><br>";

$warna = ["merah", "biru", "kuning", "hijau"];
$cari = array_search("kuning", $warna);

echo "Nomor 3.6.4 : <br>";
echo "<b>Hasil pencarian menggunakan array_search():</b><br>";
echo "Nilai 'kuning' ditemukan pada indeks ke-: " . $cari;
echo "<br><br>";


$angka = [10, 15, 20, 25, 30, 35];

$hasil = array_filter($angka, function($n) {
    return $n > 20; // hanya ambil nilai lebih dari 20
});

echo "Nomor 3.6.5 : <br>";
echo "<b>Hasil array setelah array_filter() (nilai > 20):</b><br>";
print_r($hasil);
echo "<br><br>";

$angka = [5, 1, 8, 3, 2];

echo "Nomor 3.6.6 : <br>";
echo "<b>Array asli:</b><br>";
print_r($angka);

// sort() → urutkan dari kecil ke besar
sort($angka);
echo "<br><b>Setelah sort():</b><br>";
print_r($angka);

// rsort() → urutkan dari besar ke kecil
rsort($angka);
echo "<br><b>Setelah rsort():</b><br>";
print_r($angka);

// asort() → urutkan berdasarkan nilai, tapi pertahankan key
$buah = ["b" => "Jeruk", "a" => "Apel", "c" => "Mangga"];
asort($buah);
echo "<br><b>Setelah asort() (urut nilai, pertahankan key):</b><br>";
print_r($buah);

// ksort() → urutkan berdasarkan key
ksort($buah);
echo "<br><b>Setelah ksort() (urut berdasarkan key):</b><br>";
print_r($buah);
echo "<br>"


?>


