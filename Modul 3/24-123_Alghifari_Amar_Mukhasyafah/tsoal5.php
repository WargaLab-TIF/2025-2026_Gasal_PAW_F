<?php
$student = array (
    array("alex","220401", "0812345678"),
    array("Bianca","220402", "0812345678"),
    array("Candiee","220403", "0812345678"),
);
for ($row = 0; $row <3; $row++) {
    echo "<p><b>Row Number $row </b></p>";
    echo "<ul>";
    for ($col = 0; $col <3; $col++) {
        echo "<li>". $student[$row][$col]."</li>";
    }
    echo "</ul>";
};


for ($i = 3; $i < 8; $i ++) {
    $student[] = array("student$i","22040$i","081234567$i"); 
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border="2">
       <?php for ($a = 0; $a < 8; $a ++) { ?>
    <tr>
        <?php for ($b = 0; $b < 3; $b ++) { ?>
            <td><?php echo $student[$a][$b]; ?></td>
        <?php } ?>
    </tr>
    <?php } ?>

    </table>
</body>
</html>