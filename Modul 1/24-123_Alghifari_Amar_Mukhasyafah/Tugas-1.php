<?php

// ini non-embeded script
echo "<h1>Hello world</h1> <br>";



$color = "silver";
$COLOR = "white";

echo "<h1> My car is $color </h1><br>";
echo "<h1> My car is $COLOR </h1><br>";


$greeting = "<h1> Hello world</h1><br>";
echo $greeting;


$txt = "W3schools.com";
echo "<h1>i love $txt !</h1>";


$x = 5;
$y = 7;
echo $x + $y . "<br>";

$test = "Hello World!";
echo strlen($test) . "<br>";



echo str_word_count($test) . "<br>";

echo strrev($test) . "<br>";

// benar: cari "World" di dalam $test
echo strpos($test, "World")."<br>";

echo str_replace('World!',"Dolly!",$test);

function writeMsg() {
    echo "<h1>Hello world!</h1>";
}
writeMsg(). "<br>";

function familyName($fname){
    echo "$fname<br>";
}

familyName('Jani');
familyName('Hege');
familyName('Stale');
familyName('Kai Jim');
familyName('Borge');

function familymame($name,$year) {
    echo "$name born in $year<br>";
}

familymame("Hege","1975");
familymame("Stale","1975");
familymame("Kai Jim","1975");

function setheight($minheight = 50) {
    return $minheight;
}

echo setheight(). "<br>";

function sum($x,$y) {
    $z = $x + $y;
    return "$x + $y = $z<br>";
}

echo sum(5,10);
echo sum(7,13);
echo sum(2,4);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- ini embedded-script -->
    <?php
        echo "<h1> Hello world</h1>";
    ?>
</body>
</html>
