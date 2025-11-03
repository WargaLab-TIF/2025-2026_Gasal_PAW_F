<?php
// array awal
echo "<h4>Array Awal</h4>";
$kota = array("Surabaya", "Madura", "Bekasi");
print_r($kota);
echo "<br>";

// 3.6.1 Implementasi array_push()
echo "<h4>Implementasi array_push</h4>";
array_push($kota, "Blitar", "Kediri", "Malang");
print_r($kota);
echo "<br><br>";

// 3.6.2 Implementasi fungsi array_merge()
echo "<h4>Implementasi array_merge</h4>";
$desa = array("Wates", "Kamal", "Binangun");
$merge = array_merge($kota,$desa);
echo "Hasil penggabungan array : <br>";
print_r($merge);
echo "<br><br>";

// 3.6.3 Implementasi fungsi array_values()
echo "<h4>Implementasi array_values</h4>";
$a=array("Name"=>"Peter","Age"=>"41","Country"=>"USA");
print_r(array_values($a));

// 3.6.4 Implementasi fungsi array_search()
echo "<h4>Implementasi array_search</h4>";
$fruits = ["Apple", "Mango", "Banana", "Orange"];
print_r($fruits);

$search = "Banana";
$indeks = array_search($search, $fruits);
echo "<br>";

if ($indeks !== false){
    echo "Buah '$search' ditemukan di indeks ke-$indeks";
}else {
    echo "Buah '$search' tidak ditemukan.";
}

// 3.6.5 Implementasi fungsi array_filter()

echo "<h4>Implementasi array_filter</h4>";
$people = [
    "Wildan" => 17,
    "Nata" => 20,
    "Novi" => 19,
    "Arina" => 16
];

$adults = array_filter($people, function($umur) {
    return $umur >= 18;
});

echo "Data Orang Dewasa : ";
print_r($adults);




// 3.6.6 Implementasi berbagai fungsi sorting pada array
echo "<h4>Implementasi berbagai fungsi sorting pada array</h4>";
// implementasi sort
echo "<h4>sort()</h4>";
$cars = array("Volvo", "BMW", "Toyota");
sort($cars);

foreach ($cars as $key => $val) {
    echo "cars[" . $key . "] = " . $val . "<br>";
}
// implementasi rsort
echo "<h4>rsort()</h4>";
$cars=array("Volvo","BMW","Toyota");
rsort($cars);

$clength=count($cars);
for($x=0;$x<$clength;$x++)
  {
  echo $cars[$x];
  echo "<br>";
  }
// implementasi asort
echo "<h4>asort()</h4>";
$age=array("Peter"=>"35","Ben"=>"37","Joe"=>"43");
asort($age);

foreach($age as $x=>$x_value)
   {
   echo "Key=" . $x . ", Value=" . $x_value;
   echo "<br>";
   }
// implementasi ksort
echo "<h4>ksort()</h4>";
$age=array("Peter"=>"35","Ben"=>"37","Joe"=>"43");
ksort($age);

foreach($age as $x=>$x_value)
   {
   echo "Key=" . $x . ", Value=" . $x_value;
   echo "<br>";
   }
// implementasi arsort
echo "<h4>arsort()</h4>";
$age=array("Peter"=>"35","Ben"=>"37","Joe"=>"43");
arsort($age);

foreach($age as $x=>$x_value)
   {
   echo "Key=" . $x . ", Value=" . $x_value;
   echo "<br>";
   }
// implementasi krsort
echo "<h4>krsort()</h4>";
$age=array("Peter"=>"35","Ben"=>"37","Joe"=>"43");
krsort($age);

foreach($age as $x=>$x_value)
   {
   echo "Key=" . $x . ", Value=" . $x_value;
   echo "<br>";
   }
?>