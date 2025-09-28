<!-- Soal 1 -->
<?php
echo "<h1> Hello World <h1>";
?>


<br>


<!-- Soal 2 -->
<!DOCTYPE html>
<html>
    <head>
        <title>Page Title</title>
    </head>
    <body>
        <h1>
            <?php
            // Ini adalah contoh embedded script
            echo "Hello World";
            ?>
        </h1>
    </body>
</html>


<br>


<!-- Soal 3 -->
<?php
// ini non embedded script
echo "<h1> Hello World <h1>";
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Page Title</title>
    </head>
    <body>
        <h1>
            <?php
            // Ini adalah contoh embedded script
            echo "<h1> Hello World <h1>";
            ?>
        </h1>
    </body>
</html>


<br>


<!-- Soal 4 -->
<?php
$color = "silver";
$COLOR = "white";

echo "<h1> My car is $color </h1>";
echo "<h1> My house is $COLOR </h1>";
?>


<br>


<!-- Soal 5 -->
<?php
$greeting = "Hello world";
echo $greeting;
?>


<br>


<!-- Soal 6 -->
<?php
$txt = "W3schools.com";
echo "i love $txt !";
?>


<br>


<!-- Soal 7 -->
<?php
$x = 5;
$y = 7;
echo $x + $y;
?>


<br>


<!-- Soal 8 -->
<?php
echo strlen("Hello World!");
?>


<br>


<!-- Soal 9 -->
<?php
echo str_word_count("Hello World!");
?>


<br>


<!-- Soal 10 -->
<?php
echo strrev("Hello World!");
?>


<br>


<!-- Soal 11 -->
<?php
echo strpos("Hello world!", "world");
?>


<br>


<!-- Soal 12 -->
<?php
$x = "Hello World!";
echo str_replace("World", "Dolly", $x);
?>


<br>


<!-- Soal 13 -->
<?php
function writeMsg(){
	echo "Hello world!";
}

writeMsg()
?>


<br>


<!-- Soal 14 -->
<?php
function familyName($fname) {
  echo "$fname <br>";
}

familyName("Jani");
familyName("Hege");
familyName("Stale");
familyName("Kai Jim");
familyName("Borge");
?>


<br>


<!-- Soal 15 -->
<?php
function familyName($fname, $year) {
  echo "$fname Born in $year <br>";
}

familyName("Hege", "1975");
familyName("Stale", "1978");
familyName("Kai Jim", "1983");
?>


<br>


<!-- Soal 16 -->
<?php
function setHeight($minheight = 50) {
  echo "The height is : $minheight <br>";
}

setHeight();
?>


<br>


<!-- Soal 17 -->
<?php
function sum($x, $y) {
  $z = $x + $y;
  return $z;
}

echo "5 + 10 = " . sum(5, 10) . "<br>";
echo "7 + 13 = " . sum(7, 13) . "<br>";
echo "2 + 4 = " . sum(2, 4);
?>
