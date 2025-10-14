<?php
$student=[
    ["Name"=>"Alex","Nim"=>"220401","Mobile"=>"0812345678"],
    ["Name"=>"Bianca","Nim"=>"220402","Mobile"=>"0812345687"],
   ["Name"=>"Candice","Nim"=>"220403","Mobile"=>"0812345665"],
];
//menambah 5 data lagi

$student[]= ["Name"=>"Wulan", "Nim"=>"220404", "Mobile"=>"0812340045"];
$student[]= ["Name"=>"Rika", "Nim"=>"220405", "Mobile"=>"0812350948"];
$student[]=["Name"=>"Cacil", "Nim"=>"220406", "Mobile"=>"0863457824"];
$student[]=["Name"=>"Ifa", "Nim"=>"240407", "Mobile"=>"0814569234"];
$student[]=["Name"=>"Nana", "Nim"=>"240408", "Mobile"=>"0893456791"];

?>

<?php 
echo "<table border='1' cellpadding='4'>"; 
echo "<tr><th>No</th><th>Name</th><th>NIM</th><th>Mobile</th></tr>"; 
$no = 1;
foreach ($student as $s) {
    echo "<tr>";
    echo "<td>" . $no++ . "</td>";
    echo "<td>" . $s['Name'] . "</td>";
    echo "<td>" . $s['Nim'] . "</td>";
    echo "<td>" . $s['Mobile'] . "</td>";
    echo "</tr>";
}

echo "</table>";
?>