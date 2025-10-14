<?php
// 3. 6. 1. Implementasi fungsi array_push()!
$a=array("red","green");
array_push($a,"blue","yellow");
foreach($a as $warna){
    echo $warna;
    echo "<br>";
}
echo "<br>";

// 3. 6. 2. Implementasi fungsi array_merge()!
$a1=array("red","green");
$a2=array("blue","yellow");
$warna3 = array_merge($a1,$a2);
foreach($warna3 as $hasil_merge){
    echo $hasil_merge;
    echo "<br>";
}
echo "<br>";

// 3. 6. 3. Implementasi fungsi array_values()!
$a=array("Name"=>"Peter","Age"=>"41","Country"=>"USA");
$values = array_values($a);
foreach($a as $nilai){
    echo $nilai;
    echo "<br>";
}
echo "<br>";

// 3. 6. 4. Implementasi fungsi array_search()!
$a=array("a"=>"red","b"=>"green","c"=>"blue");
echo array_search("red",$a);
echo "<br>";

// 3. 6. 5. Implementasi fungsi array_filter()!
$nilai = [90, 75, 60, 82, 55];
$lulus = array_filter($nilai, function($n) {
    return $n >= 75;
});
foreach($lulus as $hasil_lulus){
    echo $hasil_lulus;
    echo "<br>";
}
echo "<br>";

// 3. 6. 6. Implementasi berbagai fungsi sorting pada array!
$angka = [5, 3, 9, 1, 7];
// sort() - urut naik
sort($angka);
echo "sort(): ";
print_r($angka);
echo "<br>";
// rsort() - urut turun 
rsort($angka);
echo "rsort(): ";
print_r($angka);
echo "<br>";
$umur = ["Ravi" => 20, "Elgi" => 22, "Rayyan" => 19];
// asort() - urut naik (dengan key)
asort($umur);
echo "asort(): ";
print_r($umur);
echo "<br>";
// arsort() - urut turun (dengan key)
arsort($umur);
echo "arsort(): ";
print_r($umur);
echo "<br>";
// ksort() - urut berdasarkan key naik
ksort($umur);
echo "ksort(): ";
print_r($umur);
echo "<br>";
// usort() - sorting custom
$mahasiswa = [
    ["nama" => "Ravi", "nilai" => 85],
    ["nama" => "Elgi", "nilai" => 90],
    ["nama" => "Rayyan", "nilai" => 80]
];

usort($mahasiswa, function($a, $b) {
    return $b["nilai"] <=> $a["nilai"];
});
foreach ($mahasiswa as $mhs) {
    echo $mhs["nama"] . " = " . $mhs["nilai"] . "<br>";
}
?>