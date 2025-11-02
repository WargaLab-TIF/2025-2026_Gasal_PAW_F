<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modul 3 - Array Multidimensi</title>
</head>
<body>
<?php
    echo '<h3>3.5 Deklarasi dan akses array Multidimensi</h3>';

    $students = array(
        array("Alex", "220401", "0812345678"),
        array("Bianca", "220402", "0812345687"),
        array("Candice", "220403", "0812345665")
    );

    // Data Awal
    for ($row = 0; $row < count($students); $row++) {
        echo "<p><b>Row number $row</b></p>";
        echo "<ul>";
        for ($col = 0; $col < count($students[$row]); $col++) {
            echo "<li>" . $students[$row][$col] . "</li>";
        }
        echo "</ul>";
    }

    echo '<h4>3.5.1 Tambah 5 data</h4>';

    // Tambahkan 5 data baru
    array_push(
        $students,
        array("David", "220404", "0812345666"),
        array("Eka", "220405", "0812345667"),
        array("Farah", "220406", "0812345668"),
        array("Gilang", "220407", "0812345669"),
        array("Hana", "220408", "0812345670")
    );

    // Tampilkan ulang semua data (otomatis sesuai panjang array)
    for ($row = 0; $row < count($students); $row++) {
        echo "<p><b>Row number $row</b></p>";
        echo "<ul>";
        for ($col = 0; $col < count($students[$row]); $col++) {
            echo "<li>" . $students[$row][$col] . "</li>";
        }
        echo "</ul>";
    }

    echo '<h4>3.5.2 Tampilkan menggunakan tabel</h4>';

    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<tr><th>Nama</th><th>NIM</th><th>No. HP</th></tr>";

    // Loop menampilkan data dalam bentuk tabel
    for ($row = 0; $row < count($students); $row++) {
        echo "<tr>";
        for ($col = 0; $col < count($students[$row]); $col++) {
            echo "<td>" . $students[$row][$col] . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
?>
</body>
</html>
