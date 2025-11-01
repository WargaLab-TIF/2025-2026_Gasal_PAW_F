<?php
    echo "3.1.1 <br>";
    $fruit = array("avocado", "bluebery", "cherry");
    array_push($fruit,"watermelon", "banana", "grapes", "melon", "guava");
    $index_tertinggi = array_key_last($fruit);
    echo "nilai dari index tertinggi adalah : ".$fruit[$index_tertinggi];
    echo "<br>";
    echo "index tertinggi nya dalah : $index_tertinggi";
    echo "<br> <br> <br>";

    
    

    echo "3.1.2 <br>";
    array_pop($fruit); 
    $index_tertinggi = array_key_last($fruit);
    echo "nilai dari index tertinggi setelah penghapusan data adalah : ".$fruit[$index_tertinggi];
    echo "<br>";
    echo "index tertinggi setelah penghapusan data dalah : $index_tertinggi";
    echo "<br> <br> <br>";




    echo "3.1.3 <br>";
    $veggies = array("carrot", "mustard", "spinach");
    var_dump($veggies);
    echo "<br>";
    echo "menampilakn hanya value : ". implode(", ", $veggies);