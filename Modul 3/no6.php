<?php

// 3.6.1
$hewan = ["kelinci", "sapi", "kerbau"];
array_push($hewan, "ayam", "bebek");

var_dump($hewan);
echo "<br>.";

// 3.6.2
$sayur = ["bayam", "wortel"];
$buah = ["semangka", "mangga"];
$hasil = array_merge($sayur, $buah);

print_r($hasil);
echo "<br>";

// 3.6.3
$mahasiswa = ["nama"=>"Intan", "prodi"=>"Informatika", "angkatan"=> 2023];
$nilai = array_values($mahasiswa);

print_r($nilai);
echo "<br>";

// 3.6.4
$prodi = ["informatika","elektro","mesin","industri"];
$key = array_search("informatika", $prodi);
echo "Indeks dari informatika adalah : $key";
echo "<br>";

// 3.6.5
$angka = [1,2,3,4,5,6];
$genap = array_filter($angka, function($n){
    return $n % 2 == 0;
});
print_r($genap);
echo "<br>";
echo "<br>";

// 3.6.6
$cars = array("Volvo", "BMW", "Toyota");
sort($cars);

foreach ($cars as $key => $val) {
    echo "cars[" . $key . "] = " . $val . "<br>";
}
echo "<br>";

$age=array("Peter"=>"35","Ben"=>"37","Joe"=>"43");
ksort($age);

foreach($age as $x=>$x_value)
{
echo "Key=" . $x . ", Value=" . $x_value;
echo "<br>";
}
echo "<br>";

$cars=array("Volvo","BMW","Toyota");
rsort($cars);

$clength=count($cars);
for($x=0;$x<$clength;$x++)
{
echo $cars[$x];
echo "<br>";
}

echo "<br>";

$age=array("Peter"=>"35","Ben"=>"37","Joe"=>"43");
asort($age);

foreach($age as $x=>$x_value)
{
echo "Key=" . $x . ", Value=" . $x_value;
echo "<br>";
}
?>
