<?php
// 1) Deklarasi array multidimensi awal (3 mahasiswa)
$students = array(
    array("Alex",    "220401", "0812345678"),
    array("Bianca",  "220402", "0812345687"),
    array("Candice", "220403", "0812345665")
);

// Tampilkan array awal (opsional, untuk debugging)
// echo "<pre>"; print_r($students); echo "</pre>";

// 2) Tambahkan 5 data baru ke $students
$newStudents = array(
    array("Dewi",    "220404", "0812345699"),
    array("Eka",     "220405", "0812345611"),
    array("Fahmi",   "220406", "0812345622"),
    array("Gita",    "220407", "0812345633"),
    array("Hendra",  "220408", "0812345644")
);

// Tambah menggunakan foreach
foreach ($newStudents as $row) {
    $students[] = $row;
}

// 3) Informasi singkat setelah penambahan
$totalRows = count($students); // jumlah baris (mahasiswa)
$totalCols = count($students[0]); // jumlah kolom (diasumsikan sama untuk tiap baris)


echo "<p><strong>Jumlah data mahasiswa setelah penambahan:</strong> $totalRows</p>";

// 4) Tampilkan data dalam bentuk tabel HTML menggunakan for 
echo "<table border='1' cellpadding='8' cellspacing='0'>";
echo "<thead>";
echo "<tr><th>No</th><th>Name & NIM</th><th>Mobile</th></tr>";
echo "</thead>";
echo "<tbody>";

for ($r = 0; $r < $totalRows; $r++) {
    // jika model baris adalah [Name, NIM, Mobile]
    $name = isset($students[$r][0]) ? $students[$r][0] : "";
    $nim  = isset($students[$r][1]) ? $students[$r][1] : "";
    $mobile = isset($students[$r][2]) ? $students[$r][2] : "";

    echo "<tr>";
    echo "<td>" . ($r + 1) . "</td>";
    echo "<td>" . htmlspecialchars($name . " " . $nim) . "</td>";
    echo "<td>" . htmlspecialchars($mobile) . "</td>";
    echo "</tr>";
}

echo "</tbody>";
echo "</table>";

// 5) Contoh akses elemen tertentu (opsional) 
// Tampilkan data baris ke-2 (index 1) sebagai contoh:
if ($totalRows >= 2) {
    $row2 = $students[1];
    echo "<p>Contoh: data baris ke-2 => Name: {$row2[0]}, NIM: {$row2[1]}, Mobile: {$row2[2]}</p>";
}
?>
