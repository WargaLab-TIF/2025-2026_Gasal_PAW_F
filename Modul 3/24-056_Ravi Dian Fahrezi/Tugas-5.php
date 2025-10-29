<?php
    $students = array(
        array("Alex", "220401", "0812345678"),
        array("Bianca", "220402", "0812345687"),
        array("Candice", "220403", "0812345665"),
    );

    for ($row = 0; $row < 3; $row++) {
        echo "<p><b>Row number $row</b></p>";
        echo "<ul>";
        for ($col = 0; $col < 3; $col++) {
            echo "<li>" . $students[$row][$col] . "</li>";
        }
        echo "</ul>";
    }

    // 3.5.1 menambahkan 5 data
    $students[] = array("Rayyan", "220404", "0812345667");
    $students[] = array("Ravi", "220405", "0812345634");
    $students[] = array("Rendi", "220406", "0812345656");
    $students[] = array("Rendi", "220406", "0812345656");
    $students[] = array("Petj", "220407", "0812345678");
    $students[] = array("Tanata", "220408", "0812345656");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p><b>3.5.2</b></p>
    <table border = "1">
        <tr>
            <th>Name Nim</th>
            <th>Mobile</th>
        </tr>
        <!-- menampilkan data dalam bentuk tabel -->
        <?php
            for ($row = 0; $row < count($students); $row++) {
                echo "<tr>";
                echo "<td>" . $students[$row][0] . " " . $students[$row][1] . "</td>";
                echo "<td>" . $students[$row][2] . "</td>";
                echo "<tr>";
            }
        ?>
    </table>
</body>
</html>