<?php
    $students = array (
        array("Alex", "220401", "0812345678"),
        array("Bianca", "220402", "0812345687"),
        array("Candice", "220403", "0812345665"),
    );
    
    for($row = 0; $row < 3; $row++){
        echo "<p><b>Row number $row</b></p>";
        echo "<ul>";
        for($col = 0; $col < 3; $col++){
            echo "<li>" . $students[$row][$col]. "</li>";
        }
        echo "</ul>";
    }
    
    // 3.5.1. Tambahkan 5 data baru dalam array $students!
    $students[] = array("Najwa",  "220404", "0812348765");
    $students[] = array("Yongky", "220405", "0887654321");
    $students[] = array("Brintik","220406", "0813572468");
    $students[] = array("Hani", "220407", "0824687531");
    $students[] = array("Farhan", "220408", "0881726354");

    // 3.5.2. Tampilkan data dalam array $students dalam bentuk tabel!
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<tr><th>Name</th><th>NIM</th><th>Mobile</th></tr>";
    
    for ($row = 0; $row < count($students); $row++) {
        echo "<tr>";
        for ($col = 0; $col < 3; $col++) {
            echo "<td>" . $students[$row][$col] . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
    
?>