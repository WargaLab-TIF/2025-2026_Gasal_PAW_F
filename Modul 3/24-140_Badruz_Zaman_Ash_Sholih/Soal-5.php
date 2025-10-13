<?php
    $students = array(
        array("Alex", "220401", "0812345678"),
        array("Bianca", "220402", "0812345687"),
        array("Candice", "220403", "0812345665"),
        array("David", "220404", "0812345699"),
        array("Emily", "220405", "0812345700"),
        array("Frank", "220406", "0812345711"),
        array("Grace", "220407", "0812345722"),
        array("Henry", "220408", "0812345733"),
    );
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel</title>
</head>
<body>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>NIM</th>
            <th>Mobile</th>
        </tr>
        <?php
          for($row = 0; $row < 8; $row++) {
            echo "<tr>";
            for($col = 0; $col < 3; $col++) {
                echo "<td>" . $students[$row][$col] . "</td>";
                }
            echo "</tr>";
            }  
        ?>
    </table>
</body>
</html>