<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php

$i = 0;

do {
    
    if($i % 4 == 0){
        echo "$i <br>";
    }
    
    $i++;
}while ($i <= 20);

?>


</body>
</html>