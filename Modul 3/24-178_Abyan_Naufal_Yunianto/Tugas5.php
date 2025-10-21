<?php
    echo "<b>3.5. akses array implementasi</b> <br>";
    $students = [
        [
            "Alex","220401","0812345678"
        ],
        [
            "Bianca","220402","0812345687"
        ],
        [
            "Candice","220403","0812345665"
        ],
    ];

    for ($row = 0; $row < 3; $row++) {
        echo "<p><b>Row number $row</b></p>";
        echo "<ul>";
        for ($col = 0; $col < 3; $col++) {
            echo "<li>" . $students[$row][$col] . "</li>";
        }
        echo "</ul>";
    }

    echo "<b>3.5.1. tambah 5 data baru</b> <br>";

    $baru = [
        [
            "Blex","220404","0815345678"
        ],
        [
            "Clex","220405","0814345678"
        ],
        [
            "Dlex","220406","0813345678"
        ],
        [
            "Elex","220407","0812345678"
        ],
        [
            "Flex","220408","0811345678"
        ],
    ];

    $gabung = array_merge($students, $baru);
    
    for ($row = 0; $row < 8; $row++) {
        echo "<p><b>Row number $row</b></p>";
        echo "<ul>";
        for ($col = 0; $col < 3; $col++) {
            echo "<li>" . $gabung[$row][$col] . "</li>";
        };
        echo "</ul>";
    };

    echo "<br>";
    echo "<b>3.5.2. tampilkan data dalam array ke dalam table</b> <br>";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Siswa</title>
</head>
<body>
    <table border= "1">
        <tr>
            <th>Nama</th>
            <th>NIM</th>
            <th>No. HP</th>
        </tr>
        <?php foreach ($gabung as $student_data): ?>
        <tr>
            <?php foreach ($student_data as $detail): ?>
            <td><?= $detail; ?></td>
            <?php endforeach; ?>    
        </tr>
        <?php endforeach; ?>
    </table>
</body>