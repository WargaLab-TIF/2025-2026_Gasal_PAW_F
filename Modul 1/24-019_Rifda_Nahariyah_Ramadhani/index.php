<?php
// ini non-embedded script 
echo "Hello world<br>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    // ini embedded-script
    echo "Hello world<br>";
    ?>
</body>
</html>

<?php
$color = "silver";
$COLOR = "white";
echo "My car is $color<br>";
echo "My house is $COLOR";
?>

<?php
$greeting = "Hello world<br>";
echo $greeting;
?>

<?php
$txt = "W3schools.com";
echo " i love $txt !<br>";
?>

<?php
$x = 5;
$y = 7;
echo $x + $y . "<br>";
?>

<?php
$teks = "Hello world!"; 
echo strlen ($teks)."<br>";
?>

<?php
$kalimat = "Hello world!"; 
echo str_word_count($kalimat)."<br>"; 
?>

<?php
$balik = "Hello world!";
echo strrev($balik)."<br>";
?>

<?php 
$kalimat = "Hello world!"; 
$cari = "world";
$posisi = strpos($kalimat, $cari);
echo $posisi ."<br>";
?>

<?php
$kalimat = "Hello world!";
echo str_replace("world", "Dolly", $kalimat)."<br>";
?>


<?php
function writeMsg() {
  echo "Hello world!<br>";
}

writeMsg();
?>

<?php
function familyName($fname) {
    echo $fname ."<br>";
}

familyName("Jani");
familyName("Hege");
familyName("Stale");
familyName("kai Jim");
familyName("Borge");
?>

<?php
function familyName($fname, $year) {
  echo "$fname Born in $year<br>";
}

familyName("Hege","1975");
familyName("Stale","1978");
familyName("Kai Jim","1983");
?>

<?php
function setHeight($minheight = 50) {
  echo "The height is : $minheight <br>";
}

setHeight();
?>

<?php
function sum($x, $y) {
  $z = $x + $y;
  return $z;
}

echo "5 + 10 = " . sum(5,10) . "<br>";
echo "7 + 13 = " . sum(7,13) . "<br>";
echo "2 + 4 = " . sum(2,4);
?>
