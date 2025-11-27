<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Array Asosiatif dan Multidimensi</title>
</head>
<body>

<?php

echo "<h3>3.5 Array Multidimensi</h3>";

$students = [
    ["Nama" => "Andy", "Umur" => 20, "Nilai" => 85],
    ["Nama" => "Barry", "Umur" => 21, "Nilai" => 88],
    ["Nama" => "Charlie", "Umur" => 22, "Nilai" => 79]
];

array_push(
    $students,
    ["Nama" => "Daisy", "Umur" => 20, "Nilai" => 90],
    ["Nama" => "Elly", "Umur" => 19, "Nilai" => 87],
    ["Nama" => "Fadil", "Umur" => 23, "Nilai" => 75],
    ["Nama" => "Gina", "Umur" => 21, "Nilai" => 84],
    ["Nama" => "Harris", "Umur" => 22, "Nilai" => 82]
);

echo "<table border='1' cellpadding='5'>";
echo "<tr><th>Nama</th><th>Umur</th><th>Nilai</th></tr>";
foreach($students as $s){
    echo "<tr>";
    echo "<td>" . $s["Nama"] . "</td>";
    echo "<td>" . $s["Umur"] . "</td>";
    echo "<td>" . $s["Nilai"] . "</td>";
    echo "</tr>";
}
echo "</table>";
?>

</body>
</html>
