<?php
// 3.6.1 Implementasi array_push()
echo "<b>3.6.1 Implementasi array_push()</b><br>";
$buah = array("Apel", "Mangga", "Jeruk");
array_push($buah, "Jeruk", "Pisang");
echo "Setelah menambahkan data baru dengan array_push(): <br>";
print_r($buah);
echo "<br><br>";

// 3.6.2 Implementasi array_merge()
echo "<b>3.6.2 Implementasi array_merge()</b><br>";
$buah1 = array("Apel", "Mangga");
$buah2 = array("Jeruk", "Pisang");
$hasil = array_merge($buah1, $buah2);
echo "Hasil penggabungan dua array (buah1 dan buah2): <br>";
print_r($hasil);
echo "<br><br>";

// 3.6.3 Implementasi array_values()
echo "<b>3.6.3 Implementasi array_values()</b><br>";
$buah = array("a" => "Apel", "b" => "Mangga", "c" => "Jeruk");
$nilai = array_values($buah);
echo "Nilai-nilai dari array asosiatif (tanpa key): <br>";
print_r($nilai);
echo "<br><br>";

// 3.6.4 Implementasi array_search()
echo "<b>3.6.4 Implementasi array_search()</b><br>";
$cari = array_search("Jeruk", $buah);
echo "Indeks dari 'Jeruk' dalam array adalah: " . $cari;
echo "<br><br>";

// 3.6.5 Implementasi array_filter()
echo "<b>3.6.5 Implementasi array_filter()</b><br>";
$angka = array(1, 2, 3, 4, 5, 6);
$genap = array_filter($angka, function($n) {
    return $n % 2 == 0;
});
echo "Angka genap dari array angka: <br>";
print_r($genap);
echo "<br><br>";

// 3.6.6 Implementasi berbagai fungsi sorting
echo "<b>3.6.6 Implementasi berbagai fungsi sorting</b><br>";
$angka = array(5, 2, 8, 1);
sort($angka);
echo "Hasil sort() (ascending): ";
print_r($angka);
echo "<br>";

$angka = array(5, 2, 8, 1);
rsort($angka);
echo "Hasil rsort() (descending): ";
print_r($angka);
echo "<br>";

$nilai = array("Ani" => 90, "Budi" => 80, "Cici" => 85);
asort($nilai);
echo "Hasil asort() (urut berdasarkan nilai, key tetap): ";
print_r($nilai);
echo "<br>";

$nilai = array("Cici" => 85, "Budi" => 80, "Ani" => 90);
ksort($nilai);
echo "Hasil ksort() (urut berdasarkan key): ";
print_r($nilai);
echo "<br>";
?>
