<?php

    // ini non-embeded script
    echo "Hello world";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?= 
        // ini embded script
        "Hello world"; 
    ?>
</body>
</html>