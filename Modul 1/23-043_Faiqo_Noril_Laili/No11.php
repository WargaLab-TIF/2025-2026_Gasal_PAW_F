<?php
$string = "Hello world!"; 
$word = "world";  //substring yg dicari
$position = strpos($string,$word); // Mencari posisi 'world' dalam string

 if ($position !== false) {
     echo $position;
 } else {
     echo "Kata 'world' tidak ditemukan dalam string.";
 }
?>