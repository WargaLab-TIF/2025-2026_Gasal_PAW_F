<!-- <?php
// ini non-embeded script
echo "Hello world <br>";
?> -->


<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    // ini embedded-script
    echo "Hello world <br>";
    ?>
</body>
</html> -->

<!-- <?php
 // case sensitive
$color = "silver";
$COLOR = "white";
echo "My car is $color <br>";
echo "My house is $COLOR";
?> -->

<!-- <?php
 //Variabel teks
$greeting = "Hello world <br>";
echo "$greeting";
?> -->

<!-- <?php
 // Menggabungkan string dengan variabel
$txt = "W3schools.com";
echo "i love $txt! <br>";
?> -->

<!-- <?php
 // Operasi aritmatika
$x = 5 ;
$y = 7 ;
echo $x + $y ."<br>";
?> -->

<!-- <?php
 // Fungsi String: Panjang teks
$teks = "Hello world!";
echo strlen ($teks)."<br>";
?> -->

<!-- <?php
// Fungsi String: Hitung kata
$kalimat = "Hello world!";
echo str_word_count($kalimat)."<br>";
?> -->

<!-- <?php
 // Fungsi String: Membalik teks
$miror = "Hello world!";
echo strrev($miror)."<br>";
?> -->

<!-- <?php
 // Fungsi String: Cari posisi kata
$kata = "Hello world!";
$posisi = strpos($kata,"world");
echo $posisi."<br>";
?> -->

<!-- <?php
 // Fungsi String: Ganti kata
$kata = "Hello world!";
echo str_replace("world","Dolly",$kata."<br>");
?> -->

<!-- <?php
 // Fungsi (tanpa parameter)
function writeMsg() {
    echo "Hello world! <br>";
}
writeMsg();
?> -->

<?php
// //Fungsi (dengan parameter)
// function familyName($fname) {
//   echo "$fname <br>";
// }
// familyName("Jani");
// familyName("Hege");
// familyName("Stale");
// familyName("Kai Jim");
// familyName("Borge");
?>

<?php
 // Fungsi (dengan 2 parameter)
function familyName($fname, $year) {
  echo "$fname Born in $year <br>";
}
familyName("Hege","1975");
familyName("Stale","1978");
familyName("Kai Jim","1983");
?>

<!-- <?php
 //Fungsi dengan nilai default
function setHeight($minheight = 50) {
  echo "The height is : $minheight <br>";
}
setHeight();
?> -->

<!-- <?php
 // Fungsi dengan nilai default
function sum($x, $y) {
  $z = $x + $y;
  return $z;
}
echo "5 + 10 = " . sum(5,10) . "<br>";
echo "7 + 13 = " . sum(7,13) . "<br>";
echo "2 + 4 = " . sum(2,4);
?> -->