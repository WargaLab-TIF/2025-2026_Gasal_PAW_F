<?php
$students = [
    ["Name"=>"Alex", "NIM"=>"220401", "Mobile"=>"0812345678"],
    ["Name"=>"Bianca", "NIM"=>"220402", "Mobile"=>"0812345687"],
    ["Name"=>"Candice", "NIM"=>"220403", "Mobile"=>"0812345665"]
];

// Tambahkan 5 data lagi
$students[] = ["Name"=>"Deni", "NIM"=>"220404", "Mobile"=>"0812345699"];
$students[] = ["Name"=>"Eka", "NIM"=>"220405", "Mobile"=>"0812345600"];
$students[] = ["Name"=>"Feri", "NIM"=>"220406", "Mobile"=>"0812345611"];
$students[] = ["Name"=>"Gita", "NIM"=>"220407", "Mobile"=>"0812345622"];
$students[] = ["Name"=>"Hana", "NIM"=>"220408", "Mobile"=>"0812345633"];
?>


<?php
echo "<table border='1' cellpadding='4'>";
echo "<tr><th>No</th><th>Name</th><th>NIM</th><th>Mobile</th></tr>";

$no = 1;
foreach ($students as $s) {
    echo "<tr>";
    echo "<td>$no</td>";
    echo "<td>{$s['Name']}</td>";
    echo "<td>{$s['NIM']}</td>";
    echo "<td>{$s['Mobile']}</td>";
    echo "</tr>";
    $no++;
}
echo "</table>";
?>

